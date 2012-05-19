<?php

session_start("sessao");

/*if (!isset($_SESSION['cpf']))
{
    header('Location: login.php');
}
else
{*/
    include("wsdl.php");

    try {
        // componente 05 - cartao de credito
        $client = new SoapClient($wsdlComp05);
        
        if (isset($_POST['submit']))
        {
            //echo $_POST['nome']."<br/>";
            /*$args = array ( "ValorDaCompra" => "10",
                            "NomeDoTitular" => $_POST['nome'],
                            "BandeiraDoCartão" => $_POST['bandeira'],
                            "NumeroDoCartão" => $_POST['numCartao'],
                            "dataDeValidade" => $_POST['validade'],
                            "CodigoDeSeguranca" => $_POST['codSeg'],
                            "QuantidadeDeParcelas" => "1" );
                            
            $resultComp05 = $client->validaCompra($args);
    
            print_r($resultComp05);*/
            
            //if (sucesso) {
                header('Location: compra_finalizada.php');
            //} else {
                //echo "<script language='javascript'>alert(\"Erro!\")</script>";
            //}
        }
        
        $resultComp05 = $client->listaCartoes();
        
        //print_r( $resultComp05 );
        
        /*foreach ($resultComp05->return as $return)
        {
            echo $return->bandeira."<br/>";
            echo $return->quantidade_max_parcelas."<br/>";
            if (is_array($return->juros)) {
                foreach ($return->juros as $row) {
                    echo $row->numero.", ".$row->juros."<br/>";
                }
            }
            else {
                echo $return->juros->numero.", ".$return->juros->juros."<br/>";
            }
            echo "<br/>";
        }*/

    } catch (Exception $e) {
        echo "Exception: ";
        echo $e->getMessage();
    }
//}
?>

<html>
<body>
    <h3>Forma de pagamento: Cartao de Credito</h3>
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