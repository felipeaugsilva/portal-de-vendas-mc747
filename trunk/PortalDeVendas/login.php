<?php
if (isset($_POST['submit']))
{
    try
    {
        include("wsdl.php");

        //$client = new SoapClient($wsdlComp07);

        //$result = $client->NOME_DO_METODO($_POST['txtUser'], $_POST['txtPass']);

        //if (sucesso) {
            header('Location: categorias.php');
        //} else {
            //echo "<script language='javascript'>alert(\"Autenticacao falhou!\")</script>";
        //}

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
                    <td><input id="txtUser" type="text"></td>
                </tr>
                <tr>
                    <td>Senha:</td>
                    <td><input name="txtPass" type="password>"></td>
                </tr>
                <tr>
                  <td><input name="submit" type="submit" value="Entrar"></td>
                </tr>
            <table>
        </form>
    </body>
</html>
