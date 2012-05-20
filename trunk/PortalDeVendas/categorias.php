<?php

include("wsdl.php");

session_start("sessao");

if (is_null($_SESSION['cpf']) || empty($_SESSION['cpf']) || !isset($_SESSION['cpf'])) {
    header('Location: login.php');
} else {
    try {

        $client = new SoapClient($wsdlComp03);
        $result = $client->listarCategorias();
        
        echo "<h2>Categorias</h2>";
        
        foreach ($result as $categoria) {
            echo "<p><a href=\"produtos_da_categoria.php?categID=".$categoria[0]."\">".$categoria[2]."</a></p>";
        }
    } catch (Exception $e) {
        echo "Exception: ";
        echo $e->getMessage();
    }
}
?>
