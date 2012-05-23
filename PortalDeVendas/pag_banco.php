<?php

session_start("sessao");

if (is_null($_SESSION['cpf']) || empty($_SESSION['cpf']) || !isset($_SESSION['cpf'])) {
    header('Location: login.php');
}

include("wsdl.php");

$bancos = array("Itau"=>1, "Banco do Brasil"=>2, "Bradesco"=>3, "Santander"=>4);

try {
    // componente 10 - banco
    $client = new SoapClient($wsdlComp10);
    
    if (isset($_POST['submit']))
    {
        $bancoEscolhido = $_POST['banco'];
        $opcaoEscolhida = $_POST['opcaoPag'];
        $valor = $_SESSION["total"];   
        
        if (!strcmp($opcaoEscolhida, "boleto"))   // boleto
        {
            $resultComp10 = $client->PagarViaBoletoBancario(array ("agencia" => $bancos[$bancoEscolhido], "conta" => 1, "valor" => $valor));
        } 
        else if (!strcmp($opcaoEscolhida, "deposito"))  // deposito
        {
            $resultComp10 = $client->PagarViaDepositoBancario(array ("agencia" => $bancos[$bancoEscolhido], "conta" => 1, "valor" => $valor));
        }
        else   // transferencia
        {
            $resultComp10 = $client->PagarViaTransferenciaBancaria(array ("agencia" => $bancos[$bancoEscolhido], "conta" => 1, "valor" => $valor));
        }
        
        //print_r($resultComp10);
        
        //if (sucesso) {
            header('Location: compra_finalizada.php');
        //} else {
        //    echo "<script language='javascript'>alert(\"Erro!\")</script>";
        //}
    }

} catch (Exception $e) {
    echo "Exception: ";
    echo $e->getMessage();
}
?>

<html>
<body>
    <h2>Forma de pagamento: Banco</h2>
    <form name="formBanco" action="" method="post">
        <table>
            <tr>
                <td>Escolha o banco:</td>
                <td>
                    <select name="banco">
                        <option>Itau</option>
                        <option>Banco do Brasil</option>
                        <option>Bradesco</option>
                        <option>Santander</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Opcoes de pagamento:</td>
                <td>
                    <input type="radio" name="opcaoPag" value="boleto" checked /> Boleto<br/>
                    <input type="radio" name="opcaoPag" value="deposito" /> Deposito<br/>
                    <input type="radio" name="opcaoPag" value="transferencia" /> Transferencia
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Enviar"></td>
            </tr>
        <table>
    </form>
</body>
</html>
