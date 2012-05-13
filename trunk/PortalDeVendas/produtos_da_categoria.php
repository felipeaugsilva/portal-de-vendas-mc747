<?php
try {
    $client = new SoapClient("http://sql2.students.ic.unicamp.br/~ra043251/mc747/DetalheProduto.wsdl");
    $result = $client->buscaAvancada($_GET["categID"], NULL);
    foreach ($result as $produto) {
        echo "<p>".$produto[1]."</p>";
  	}
} catch (Exception $e) {
    echo "Exception: ";
    echo $e->getMessage();
}
?>
