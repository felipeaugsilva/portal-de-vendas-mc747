<?php

session_start("sessao");

/*if (!isset($_SESSION['cpf']))
{
    header('Location: login.php');
}
else
{*/
    include("wsdl.php");
    
    echo "<h3>Forma de pagamento: Banco</h3>";

    try {
        // componente 10 - banco
        //$client = new SoapClient($wsdlComp10);
        //$resultComp10 = $client->;

    } catch (Exception $e) {
        echo "Exception: ";
        echo $e->getMessage();
    }
//}
?>