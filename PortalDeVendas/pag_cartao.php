<?php

session_start("sessao");

if (is_null($_SESSION['cpf']) || empty($_SESSION['cpf']) || !isset($_SESSION['cpf'])) {
    header('Location: login.php');
}

include("wsdl.php");

if (isset($_POST['submit']))
{
    try {
        // componente 05 - cartao de credito
        $client = new SoapClient($wsdlComp05);
    
        echo $_POST['nome']."<br/>";
        echo $_POST['bandeira']."<br/>";
        echo $_POST['numCartao']."<br/>";
        echo $_POST['validade']."<br/>";
        echo $_POST['codSeg']."<br/>";
        
        $args = array ( "ValorDaCompra" => "10",
                        "NomeDoTitular" => $_POST['nome'],
                        "BandeiraDoCartao" => $_POST['bandeira'],
                        "NumeroDoCartão" => $_POST['numCartao'],
                        "dataDeValidade" => $_POST['validade'],
                        "CodigoDeSeguranca" => $_POST['codSeg'],
                        "QuantidadeDeParcelas" => "1" );
                        
        $resultComp05 = $client->validaCompra($args);

        //print_r($resultComp05);
        
        //header('Location: compra_finalizada.php');

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
        
    } catch (Exception $e) {
        echo "Exception: ";
        echo $e->getMessage();
    }
?>

<html>
<body>
    <h2>Forma de pagamento: Cartao de Credito</h2>
    <form name="formCartao" action="" method="post">
        <table>
            <tr>
                <td>Nome do titular:</td>
                <td><input name="nome" type="text"></td>
            </tr>
            <tr>
                <td>Cartao:</td>
                <td><select name="bandeira">
                    <?php
                    foreach ($resultComp05->return as $return) {
                        echo "<option>".$return->bandeira."</option>";
                    }
                    ?>
                </select></td>
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
                <td><input type="submit" name="submit" value="Enviar"></td>
            </tr>
        <table>
    </form>
</body>
</html>

<?php
}
?>

