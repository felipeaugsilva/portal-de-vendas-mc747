<html>
<head>
    <title>Selecionar endereco</title>
</head>
<body>
<?php
try 
{
    include("wsdl.php");

    session_start("sessao");

    if(!isset($_SESSION['cpf']))
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

        if($action == "finalizar")
        {
            $client = new SoapClient($wsdlComp06);
            $volume = $_SESSION["volume"];
            $peso = $_SESSION["peso"];
            $cep = $_POST["endereco"];

            $args = array("peso" => $peso,
                "volume" => $volume,
                "cep" => $cep,
                "modo_entrega" => 3);

            $resultComp06 = $client->calculaFrete($args);

            $frete = round($resultComp06->calculaFreteReturn[1], 2);
            $total = $_SESSION["total"];
            $total = $total + $frete;
            $_SESSION["total"] = $total;
            header('Location: pagamento.php');

        }

        $client = new SoapClient($wsdlComp09);
        
        if($action == "novo_endereco")
        {
            $novo_cep = $_POST["cep"];
            $_SESSION["ceps"][$novo_cep] = $novo_cep;
        }
?>
        <form id="frmEndereco" name="frmEndereco" method="post" action="selecionar_endereco.php?action=finalizar">
            <table>
<?php
        foreach($_SESSION["ceps"] as $cep)
        {
            $result = $client->CepAddress($cep);
?>
            <tr>
                <td>
                <input type="radio" name="endereco" id="endereco" value="<?php echo $result->address->cep?>">
                </td>
                <td>
<?php
                    echo $result->address->logradouro."<br/>";
                    echo $result->address->bairro." - ".$result->address->localidade." / ".$result->address->uf."<br/>";
                    echo $result->address->cep."<br/>";
?>
                </td> 
            <tr>
<?php
        }
?>
            </table>
            <input type="submit" id="btnFinalizar" value="Finalizar compra">
        </form>
        <form id="frmNovo" name="frmNovo" method="post" action="selecionar_endereco.php?action=novo_endereco">
           <table>
                <tr>
                    <td>Adicionar endereco:</td>
                    <td><input type="text" id="cep" name="cep" maxlength="9">
                    <td><input type="submit" id="btnFrete" name="btnFrete" value="Adicionar"></td>
                </tr>
           </table> 
        </form>

       <table>
           <tr>
                <td>
                    <form id="frmVoltar" method="post" action="carrinho_de_compras.php">
                        <input type="submit" id="btnVoltar" value="Voltar">
                    </form>
                </td>
           </tr>
       </table>
<?php
    }

} 
catch (Exception $e) 
{
    echo "Exception: ";
    echo $e->getMessage();
}
?>
<body>
</html>
