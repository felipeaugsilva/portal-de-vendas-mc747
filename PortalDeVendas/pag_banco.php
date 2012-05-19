<?php

session_start("sessao");

/*if (!isset($_SESSION['cpf']))
{
    header('Location: login.php');
}
else
{*/
    include("wsdl.php");
    
    $bancos = array("Itau"=>1, "Banco do Brasil"=>2, "Bradesco"=>3, "Santander"=>4);

    try {
        // componente 10 - banco
        $client = new SoapClient($wsdlComp10);
        
        if (isset($_POST['submit']))
        {
            $bancoEscolhido = $_POST['banco'];
            $opcaoEscolhida = $_POST['opcaoPag'];
            
            if (!strcmp($opcaoEscolhida, boleto))   // boleto
            {
                $resultComp10 = $client->PagarViaBoletoBancario(array ("agencia" => $bancos[$bancoEscolhido], "conta" => 1, "valor" => 100.00));
            } 
            else if (!strcmp($opcaoEscolhida, deposito))  // deposito
            {
                $resultComp10 = $client->PagarViaDepositoBancario(array ("agencia" => $bancos[$bancoEscolhido], "conta" => 1, "valor" => 100.00));
            }
            else   // transferencia
            {
                $resultComp10 = $client->PagarViaTransferenciaBancaria(array ("agencia" => $bancos[$bancoEscolhido], "conta" => 1, "valor" => 100.00));
            }
            
            //print_r($resultComp10);
            
            //if (sucesso) {
                header('Location: compra_finalizada.php');
            //} else {
                //echo "<script language='javascript'>alert(\"Erro!\")</script>";
            //}
            
            
            
            
            
            
            // PagarViaDepositoBancario(agencia:int, conta:int, valor:double)
            /* $result = $client->PagarViaDepositoBancario(array ("agencia" => 4, "conta" => 4, "valor" => 100.00));
            
            echo "<br/>PagarViaDepositoBancario(agencia:int, conta:int, valor:double)<br/>";
            echo $result->PagarViaDepositoBancarioResult."<br/>";//idPagamento
            
            // PagarViaBoletoBancario(agencia:int, conta:int, valor:double)
            $result = $client->PagarViaBoletoBancario(array ("agencia" => 4, "conta" => 4, "valor" => 200.00));
            
            echo "<br/>PagarViaBoletoBancario(agencia:int, conta:int, valor:double)<br/>";
            echo $result->PagarViaBoletoBancarioResult."<br/>";//idPagamento
            
            // PagarViaTransferenciaBancaria(agencia:int, conta:int, valor:double)
            $result = $client->PagarViaTransferenciaBancaria(array ("agencia" => 4, "conta" => 4, "valor" => 300.00));
            
            echo "<br/>PagarViaTransferenciaBancaria(agencia:int, conta:int, valor:double)<br/>";
            echo ($idPagamento = $result->PagarViaTransferenciaBancariaResult)."<br/>";//idPagamento
            
            // VerificaStatusPagamento(idPagamento:int)
            $result = $client->VerificaStatusPagamento(array ("idPagamento" => $idPagamento));
            
            echo "<br/>VerificaStatusPagamento(idPagamento:int)<br/>";
            echo $result->VerificaStatusPagamentoResult."<br/>";
            
            // CancelarPagamento(idPagamento:int)
            $result = $client->CancelarPagamento(array ("idPagamento" => $idPagamento));
            
            echo "<br/>CancelarPagamento(idPagamento:int)<br/>";
            echo $result->CancelarPagamentoResult."<br/>";*/
        }

    } catch (Exception $e) {
        echo "Exception: ";
        echo $e->getMessage();
    }
//}
?>

<html>
<body>
    <h3>Forma de pagamento: Banco</h3>
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
