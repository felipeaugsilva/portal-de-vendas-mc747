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

        if($action == "continuar")
        {
            foreach($_SESSION["ceps"] as $cep)
            {
                $client = new SoapClient($wsdlComp09);
                echo $cep."<br>";
?>
<?php
            }
        }
        else if($action == "novo_endereco")
        {

        }
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
