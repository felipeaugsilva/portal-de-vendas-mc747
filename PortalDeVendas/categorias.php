<?php
try {
    $client = new SoapClient("http://sql2.students.ic.unicamp.br/~ra043251/mc747/DetalheProduto.wsdl");
    $result = $client->listarCategorias();
    foreach ($result as $categoria) {
        echo $categoria[2]."<br/>";
  	} 
} catch (Exception $e) {
    echo "Exception: ";
    echo $e->getMessage();
}
?>
