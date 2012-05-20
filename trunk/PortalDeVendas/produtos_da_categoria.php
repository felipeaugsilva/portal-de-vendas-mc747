<?php

session_start("sessao");

if (is_null($_SESSION['cpf']) || empty($_SESSION['cpf']) || !isset($_SESSION['cpf'])) {
    header('Location: login.php');
}

try {
    include("wsdl.php");
    
    $client = new SoapClient($wsdlComp03);
    $result = $client->buscaAvancada($_GET["categID"], NULL);

    echo "<h2>Produtos</h2>";
    
    foreach ($result as $produto) {
        echo "<p><a href=\"detalhes_do_produto.php?prodID=".$produto[0]."\">".$produto[1]."</a></p>";
  	}
} catch (Exception $e) {
    echo "Exception: ";
    echo $e->getMessage();
}
?>
