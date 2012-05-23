<?php

session_start();
session_destroy();

if (isset($_POST['submit']))
{
    try
    {
        include("wsdl.php");

        $client = new SoapClient($wsdlComp07);
        $client2 = new SoapClient($wsdlComp02);

        $result = $client->authenticate($_POST['txtUser'], $_POST['txtPass']);

        if ($result == "1") {
            session_start("sessao");
            $cpf = $_POST['txtUser'];
            $_SESSION['cpf'] = $cpf;
            //$result02 = $client2->buscaInformacaoCliente(array("CPF" => strval($cpf), "Campo" => "CEP"));
            $_SESSION["ceps"] = array();
            $cep = $result02->return;
            $_SESSION["ceps"][$cep] = $cep;
            //echo $_SESSION["ceps"]["usuario"]."<br>";
            header('Location: index.php');
        } else {
            echo "<script language='javascript'>alert(\"Autenticacao falhou!\")</script>";
        }

    } catch (Exception $e) {
        echo "Exception: ";
        echo $e->getMessage();
    }
}
?>
<html>
    <body>
        <form id="frmLogin" action="" method="post">
            <table>
                <tr>
                    <td>Usuario: </td>
                    <td><input name="txtUser" id="txtUser" type="text"></td>
                </tr>
                <tr>
                    <td>Senha:</td>
                    <td><input name="txtPass" type="password"></td>
                </tr>
                <tr>
                  <td><input name="submit" type="submit" value="Entrar"></td>
                </tr>
            <table>
        </form>
    </body>
</html>
