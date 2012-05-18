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
        $cpf = $_SESSION['cpf'];

        $client = new SoapClient($wsdlComp02);

        $args = array("CPF" => $cpf, "Campo" => "");

        echo "-".$cpf."-<br>";
        print_r($client->buscaInformacoesCliente($cpf));

        if($action == "continuar")
        {
            $cep = "";
            if(isset($_SESSION["cep"]))
            {
                $cep = $_SESSION["cep"];
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
