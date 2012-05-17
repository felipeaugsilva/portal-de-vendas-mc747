<?php

session_start("sessao");

/*if (!isset($_SESSION['cpf']))
{
    header('Location: login.php');
}
else
{*/
    include("wsdl.php");
    
    echo "<h3>Forma de pagamento: Cartao de Credito</h3>";

    try {
        // componente 05 - cartao de credito
        //$client = new SoapClient($wsdlComp05);
        //$resultComp05 = $client->;

    } catch (Exception $e) {
        echo "Exception: ";
        echo $e->getMessage();
    }
//}
?>