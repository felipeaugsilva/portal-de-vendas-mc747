<?php
try {

    include("wsdl.php");

    session_start("carrinho");
    
    if (!$_SESSION['carrinho'] || $_SESSION['carrinho'] == "") 
    {
        $_SESSION['carrinho'] = array();
    }

    $prodID = $_GET["prodID"];

    if(!in_array($prodID,$_SESSION['carrinho']))
    {
        $total_chaves = array_keys($_SESSION['carrinho']);
        $tamanho_array = sizeof($total_chaves);
        $_SESSION["carrinho"][$tamanho_array] = $prodID;
    }

    $client = new SoapClient($wsdlComp03);

    foreach($_SESSION["carrinho"] as $produto)
    {
                
        //echo $produto;
        // componente 03 - informacoes produto
        $resultComp03 = $client->exibeDetalhesID($produto);
        echo $resultComp03[1];
        echo "<br>";
    }
    //session_destroy();

} catch (Exception $e) {
    echo "Exception: ";
    echo $e->getMessage();
}
?>
