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
        $action = $_GET["action"];
        //$cpf = strval($_SESSION['cpf']);

        //$client = new SoapClient($wsdlComp02);

        //$args = array("CPF" => $cpf);

        //echo "-".$cpf."-<br>";
        //$result = $client->buscaInformacoesCliente($args);
        //print_r($result);

        $client = new SoapClient($wsdlComp09);
        if($action == "continuar")
        {
            //foreach($_SESSION["ceps"] as $cep)
            //{
            //    $result = $client->CepAddress($cep);
            //    echo $result->address->logradouro."<br/>";
            //    echo $result->address->bairro."<br/>";
            //    echo $result->address->localidade."<br/>";
            //    echo $result->address->uf."<br/>";
            //    echo $result->address->cep."<br/>";
            //}
        }
        else if($action == "novo_endereco")
        {

        }
?>
        <form>
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
                    //echo $result->address->uf."."<br/>";
                    echo $result->address->cep."<br/>";
?>
                </td> 
            <tr>
<?php
        }
?>
            </table>
        </form>
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
