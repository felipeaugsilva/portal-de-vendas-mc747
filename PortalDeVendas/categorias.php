<?php
try {
    $client = new SoapClient("http://sql2.students.ic.unicamp.br/~ra043251/mc747/DetalheProduto.wsdl");
    $result = $client->listarCategorias();
    foreach ($result as $categoria) {
        echo "<p><a href=\"produtos_da_categoria.php?categID=".$categoria[0]."\">".$categoria[2]."</a></p>";
  	}
} catch (Exception $e) {
    echo "Exception: ";
    echo $e->getMessage();
}
?>