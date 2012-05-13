<?php
try {
    include("wsdl.php");

    $client = new SoapClient($wsdlComp03);
    $result = $client->listarCategorias();

    foreach ($result as $categoria) {
        echo "<p><a href=\"produtos_da_categoria.php?categID=".$categoria[0]."\">".$categoria[2]."</a></p>";
  	}
} catch (Exception $e) {
    echo "Exception: ";
    echo $e->getMessage();
}
?>
