<?php
try {

    include("wsdl.php");

    session_start("sessao");

    if (is_null($_SESSION['cpf']) || empty($_SESSION['cpf']) || !isset($_SESSION['cpf']))
    {
        header('Location: login.php');
    }
    else
    {
        if(isset($_GET["action"]))
        {
            $action = $_GET["action"];
        }
        else
        {
            $action = "";
        }

        if(isset($_SESSION["frete"]))
        {
            unset($_SESSION["frete"]);
        }

        if(isset($_SESSION["prazo"]))
        {
            unset($_SESSION["prazo"]);
        }

        if(isset($_SESSION["erroFrete"]))
        {
            unset($_SESSION["erroFrete"]);
        }

        if($action == "adicionar")
        {
            if (!isset($_SESSION["carrinho"]) || $_SESSION["carrinho"] == "") 
            {
                $_SESSION["carrinho"] = array();
            }

            $prodID = $_GET["prodID"];

            if(!isset($_SESSION["carrinho"][$prodID]) 
                || $_SESSION["carrinho"][$prodID] == "")
            {
                $_SESSION["carrinho"][$prodID] = array();

                // componente 01 - estoque    
                $client = new SoapClient($wsdlComp01);
                $resultComp01 = $client->ReturnProductInfo(
                    array("ID" => "$prodID"));

                // componente 03 - informacoes produto
                $client = new SoapClient($wsdlComp03);
                $resultComp03 = $client->exibeDetalhesID($prodID);

                $_SESSION["carrinho"][$prodID]["id"] = $prodID;
                $_SESSION["carrinho"][$prodID]["nome"] = $resultComp03[1];
                $_SESSION["carrinho"][$prodID]["qtd"] = 1;
                $_SESSION["carrinho"][$prodID]["preco"] = $resultComp01->ReturnProductInfoResult->Price;   
                $_SESSION["carrinho"][$prodID]["peso"] = (float) $resultComp03[7];
                $_SESSION["carrinho"][$prodID]["volume"] = (float) ((((float)$resultComp03[8]) / 100) * 
                    (((float)$resultComp03[9]) / 100) * (((float)$resultComp03[10]) / 100)); 
            }
            else
            {
                $_SESSION["carrinho"][$prodID]["qtd"] = intval($_SESSION["carrinho"][$prodID]["qtd"]) + 1;
            }
        }
        else if($action == "atualizar")
        {
            $prodID = $_GET["prodID"];
            $qtd = $_POST["qtd".$prodID];

            if(intval($qtd) > 0)
            {
                $_SESSION["carrinho"][$prodID]["qtd"] = $qtd;
            }
            else
            {
                unset($_SESSION["carrinho"][$prodID]);
            }

        }
        else if($action == "frete")
        {
            $client = new SoapClient($wsdlComp06);
            $cep = $_POST["cep"];
            $modoEntrega = $_POST["modoEntrega"];

            $peso = 0;
            $volume = 0;
            foreach($_SESSION["carrinho"] as $produto)
            {
                $peso = ((float) $peso) + ((float) $produto["peso"]) * $produto["qtd"];
                $volume = ((float) $volume) + ((float) $produto["volume"]) * intval($produto["qtd"]);
            }

            $_SESSION["volume"] = $volume; //echo "<br>$volume<br>";
            $_SESSION["peso"] = $peso; //echo "<br>$peso<br>";

            $args = array("peso" => $peso, 
                          "volume" => $volume,
                          "cep" => $cep,
                          "modo_entrega" => $modoEntrega);

            $resultComp06 = $client->calculaFrete($args);
            
            $_SESSION["frete"] = $resultComp06->calculaFreteReturn[1]; //echo "<br>$_SESSION[frete]<br>";
            $_SESSION["prazo"] = $resultComp06->calculaFreteReturn[2]; //echo "<br>$_SESSION[prazo]<br>";
            $_SESSION["erroFrete"] = $resultComp06->calculaFreteReturn[0];
            $_SESSION["cep"] = $cep;
            //$keys = array_keys($_SESSION["ceps"]);
            //$size = sizeof($keys);
            $_SESSION["ceps"][$cep] = strval($cep);
        }

        if(!empty($_SESSION["carrinho"]))
        {
?>
            <table>
                <tr>
                    <td><b>Produto</b></td>
                    <td><b>Quantidade</b></td>
                    <td><b>Preco</b></td>
                    <td><b>Total</b></td>
                </tr>
                
<?php

            $total = intval(0);
            foreach($_SESSION["carrinho"] as $produto)
            {
?>
                <tr>
                    <td><?php echo $produto["id"]." - ".$produto["nome"]; ?></td>
                    <td>
                    <form id="frmQtd<?php echo $produto["id"]; ?>" 
                        method="post" 
                        action="carrinho_de_compras.php?action=atualizar&prodID=<?php echo $produto["id"]; ?>" >
                    <input id="qtd<?php echo $produto["id"]; ?>" 
                        name="qtd<?php echo $produto["id"]; ?>" type="text" 
                        value="<?php echo $produto["qtd"]; ?>">
                    <input type="submit" id="btnQtd<?php echo $produto["id"]; ?>" value="Atualizar">
                    </form>
                    </td>
                    <td><?php echo $produto["preco"]; ?></td>
<?php
                        $total_produto = intval($produto["qtd"]) * intval($produto["preco"]);
                        $total = intval($total) + intval($total_produto);
?>
                    <td><?php echo $total_produto; ?></td>
                <tr>
                
<?php
            }

            if(isset($_SESSION["frete"]))
            {
                $frete = round($_SESSION["frete"], 2);
                $_SESSION["total"] = $total;
                $total = $total + $frete;
?>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Frete</td>
                    <td><?php echo $frete; ?></td>
                </tr>
<?php
            }
?>

                <tr>
                    <td></td>
                    <td></td>
                    <td><b>Total</b></td>
                    <td><b><?php echo $total; ?></b></td>
                </tr>

            </table>

            <form id="frmFrete" method="post" action="carrinho_de_compras.php?action=frete">
                <table>
<?php
            if(isset($_SESSION["erroFrete"]))
            {
                $erroFrete = $_SESSION["erroFrete"];
                if($erroFrete == 1)
                {
?>
                    <tr>
                        <td>CEP invalido.</td>
                        <td></td>
                        <td></td>
                    </tr>
<?php
                }
                else if(isset($_SESSION["prazo"]))
                {
?>
                    <tr>
                        <td>Prazo de entrega: <?php echo $_SESSION["prazo"]; ?> dia(s)</td>
                        <td></td>
                        <td></td>
                    </tr>
<?php
                }
            }
?>
                    <tr>
                        <td>Calcular frete: </td>
                        <td><input id="cep" name="cep" type="text" maxlength="9"></td>
                        <td><input type="submit" id="btnFrete" value="Calcular"></td>
                        <!--<td></td>-->
                    </tr>
                    <tr>
                        <td>Modo de entrega:</td>
                        <td>
                            <input type="radio" name="modoEntrega" value="1" checked /> Transporte Aereo<br/>
                            <input type="radio" name="modoEntrega" value="2" /> Transporte Rodoviario<br/>
                            <input type="radio" name="modoEntrega" value="3" /> Transp. Rodoviario Prioritario
                        </td>
                    </tr>
                </table>
            </form>

            <table>
                <tr>
                    <td>
                        <form id="frmContinuar" method="post" action="categorias.php">
                            <input id="btnContinuar" type="submit" value="Continuar comprando">
                        </form>
                    </td>
                    <td>
                        <form id="frmFinalizar" method="post" action="selecionar_endereco.php?action=continuar">
                            <input id="btnFinalizar" type="submit" value="Finalizar compra">
                        </form>
                    </td>
                </tr>
            </table>
<?php
        }
        else
        {
?>
            Carrinho vazio
<?php
        }
    }

} catch (Exception $e) {
    echo "Exception: ";
    echo $e->getMessage();
}
?>
