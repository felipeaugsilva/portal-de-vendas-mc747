<?php
try {
    include("wsdl.php");
    
    $client = new SoapClient($wsdlComp03);
    $result = $client->buscaAvancada($_GET["categID"], NULL);

    foreach ($result as $produto) {
        echo "<p><a href=\"detalhes_do_produto.php?prodID=".$produto[0]."\">".$produto[1]."</a></p>";
  	}
} catch (Exception $e) {
    echo "Exception: ";
    echo $e->getMessage();
}
?>
