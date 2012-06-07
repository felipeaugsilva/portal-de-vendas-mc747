<?php

session_start("sessao");

if (is_null($_SESSION['cpf']) || empty($_SESSION['cpf']) || !isset($_SESSION['cpf'])) {
    header('Location: login.php');
}

include("wsdl.php");

$total = $_SESSION["total"];
if (isset($_POST['submit']))
{
    try {
        // componente 05 - cartao de credito
        $client = new SoapClient($wsdlComp05);
        
        $qtd_parcelas = $_POST["parcelas"];
        echo "Total: ".$_SESSION["total"]."<br>";
        echo "Parcelas: ".$qtd_parcelas."<br>";
                
        $args = array ( "ValorDaCompra" => $_SESSION["total"] * 100,
                        "NomeDoTitular" => $_POST['nome'],
                        "BandeiraDoCartao" => $_POST['bandeira'],
                        "NumeroDoCartao" => $_POST['numCartao'],
                        "DataDeValidade" => $_POST['validade'],
                        "CodigoDeSeguranca" => $_POST['codSeg'],
                        "QuantidadeDeParcelas" => $qtd_parcelas);
                        
        $resultComp05 = $client->validaCompra($args);

        if ($resultComp05->return == 1)
        {
            $client = new SoapClient($wsdlComp01);
            
            // carrinho
            foreach($_SESSION["carrinho"] as $produto) {
                $resultComp01 = $client->SubProduct(array("ID" => $produto["id"], "qtd" => $produto["qtd"]));
            }
            unset($_SESSION["carrinho"]);
        	//header('Location: compra_finalizada.php');
            
            // transporte
            $client = new SoapClient($wsdlComp06);
            
            $args = array ( "peso" => $_SESSION["peso"],
                            "volume" => $_SESSION["volume"],
                            "cep" => $_SESSION["cep"],
                            "meio" => $_SESSION["modoEntrega"],
                            "id_NotaFiscal" => "1" );
                            
            $resultComp06 = $client->webserviceTransporte($args);
            
            $_SESSION["codRastreamento"] = $resultComp06->webserviceTransporteReturn[1];
            $_SESSION["prazoEntrega"]    = $resultComp06->webserviceTransporteReturn[3];
            
            header('Location: compra_finalizada.php');
        }
        else {
        	throw new Exception("Pagamento não foi aprovado");
        }

    } catch (Exception $e) {
        echo "<b>Exception: </b>";
        echo $e->getMessage();
        echo "<p><a href=\"pag_cartao.php\">Tentar novamente<a><p>";
        echo "<p><a href=\"pagamento.php\">Escolher outra forma de pagamento<a><p>";
    }
}
else
{
    try {
        // componente 05 - cartao de credito
        $client = new SoapClient($wsdlComp05);
        $resultComp05 = $client->listaCartoes();
        
        if(isset($_GET["action"]))
        {
            $action = $_GET["action"];
            if($action == "calcula_bandeira")
            {
                $bandeira = $_POST["bandeira"];
                $total = $_SESSION["total"];
                $imprime_bandeira = true;
                $parcela_html = "";
                
                foreach ($resultComp05->return as $return) {
                    $current_bandeira = $return->bandeira;
                    //print_r($resultComp05);
                    if($bandeira == $current_bandeira)
                    {
                        $parcela_html = "<tr style=\"display: none;\"><td><input type=\"hidden\" name=\"bandeira\" id=\"bandeira\" value=\"$bandeira\"></td></tr>";
  //                      foreach ($resultComp05->return as $return) {
                            if (is_array($return->juros)) 
                            {
			                    foreach ($return->juros as $row) 
			                    {
			                        $qtd_parcelas = $row->numero;
			                        $juros = $row->juros;
                                    if($qtd_parcelas > 0)
                                    {

                                        $total_com_juros = $total + $total * $juros;
                                        $valor_parcela = $total_com_juros / $qtd_parcelas;
                                        $parcela_html = 
                                            $parcela_html. 
                                            "<tr>". 
                                            "<td>".
                                            "<input type=\"radio\" name=\"parcelas\" value=\""
                                            .$qtd_parcelas."\">".$qtd_parcelas." x ".round($valor_parcela,2)." = ".$total_com_juros.
                                            "</td>".
                                            "</tr>";
                                    }
                                }
                            }
                            else 
                            {
                                $qtd_parcelas = $return->juros->numero;
                                $juros = $return->juros->juros;
                                if($qtd_parcelas > 0)
                                {

                                    $total_com_juros = $total + $total * $juros;
                                    $valor_parcela = $total_com_juros / $qtd_parcelas;
                                    $_SESSION["valorParcela"] = $valor_parcela;
                                    $parcela_html = 
                                        $parcela_html. 
                                        "<tr>". 
                                        "<td>".
                                        "<input type=\"radio\" name=\"parcelas\" value=\""
                                            .$qtd_parcelas."\">".$qtd_parcelas." x ".round($valor_parcela,2).
                                        "</td>".
                                        "</tr>";
                                }
                            }
                        //                        }
                    }
                }
            }
        }

    } catch (Exception $e) {
        echo "Exception: ";
        echo $e->getMessage();
    }
?>

<html>
<head>

</head>
<body>
    <h2>Forma de pagamento: Cartao de Credito</h2>

    <form id="frmBandeira" name="frmBandeira" method="post" action="pag_cartao.php?action=calcula_bandeira">
        <table>
            <tr>
               <td>Cartao:</td>
               <td>
                <select name="bandeira" onchange="javascript: this.form.submit();" onkeyup="javascript: this.form.submit();">
<?php
    if(!isset($bandeira))
    {
        echo "<option>Selecionar</option>";
    }
    foreach ($resultComp05->return as $return) 
    {
        if(!isset($bandeira))   
        {
            echo "<option value=\"".$return->bandeira."\">".$return->bandeira."</option>";
        }
        else
        {
            if($bandeira == $return->bandeira)
            {
                echo "<option value=\"".$return->bandeira."\" selected>".$return->bandeira."</option>";
            }
            else
            {
                echo "<option value=\"".$return->bandeira."\">".$return->bandeira."</option>";
            }
        }
    }
?>
               </select>
               </td>
           </tr>
        </table>
    </form>
    <form name="formCartao" action="" method="post">
        <table>
            <tr>
                <td>Nome do titular:</td>
                <td><input name="nome" type="text"></td>
            </tr>
            <tr>
                <td>Numero do cartao:</td>
                <td><input name="numCartao" type="text"></td>
                <td><i>(xxxx.xxxx.xxxx.xxxx)</i></td>
            </tr>
            <tr>
                <td>Data Validade:</td>
                <td><input name="validade" type="text"></td>
                <td><i>(mm/aa)</i></td>
            </tr>
            <tr>
                <td>Codigo de seguranca:</td>
                <td><input name="codSeg" type="text"></td>
            </tr>
            <tr>
                <td>Valor total:</td>
                <td>
                    R$ <?php echo $_SESSION["total"]; ?>
                </td>
            </tr>
        <table>

        <table id="pagamento" name="pagamento">
<?php 
    if(isset($imprime_bandeira))
    {
        if($imprime_bandeira == true)
        {
            echo $parcela_html;
        }
    }
?>
            <tr>
                <td><input type="submit" name="submit" value="Enviar"></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
}
?>

