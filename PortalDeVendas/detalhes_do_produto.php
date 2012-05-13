<?php
try {
    include("wsdl.php");

    $prodID = $_GET["prodID"];

    // componente 01 - estoque    
    $client = new SoapClient($wsdlComp01);
    $resultComp01 = $client->ReturnProductInfo(array("ID" => "$prodID"));
    
    // componente 03 - informacoes produto
    $client = new SoapClient($wsdlComp03);
    $resultComp03 = $client->exibeDetalhesID($prodID);

    // mostrar informacoes
    echo "<h3>".$resultComp03[1]."</h3>";
    echo "<b>Marca: </b>".$resultComp03[5]."<br/>";
    echo "<b>Especificacao: </b>".$resultComp03[6]."<br/>";
    echo "<b>Peso: </b>".$resultComp03[7]." Kg<br/>";
    echo "<b>Dimensoes: </b>".$resultComp03[8]." x ".$resultComp03[9]." x ".$resultComp03[10]." (comprimento x largura x altura)<br/><br/>";
    echo "<b>Preco: </b>R$ ".$resultComp01->ReturnProductInfoResult->Price."<br/>";
    echo "<b>Quantidade em estoque: </b>".$resultComp01->ReturnProductInfoResult->Quantity."<br/><br/>";

} catch (Exception $e) {
    echo "Exception: ";
    echo $e->getMessage();
}
?>
