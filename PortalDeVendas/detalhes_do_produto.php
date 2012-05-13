<?php
try {
    $client = new SoapClient("http://sql2.students.ic.unicamp.br/~ra043251/mc747/DetalheProduto.wsdl");
    $result = $client->exibeDetalhesID($_GET["prodID"]);
    echo "<h3>".$result[1]."</h3>";
    echo "<b>Marca: </b>".$result[5]."<br/>";
    echo "<b>Especificacao: </b>".$result[6]."<br/>";
    echo "<b>Peso: </b>".$result[7]." Kg<br/>";
    echo "<b>Dimensoes: </b>".$result[8]." x ".$result[9]." x ".$result[10]." (comprimento x largura x altura)<br/><br/>";
} catch (Exception $e) {
    echo "Exception: ";
    echo $e->getMessage();
}
?>
