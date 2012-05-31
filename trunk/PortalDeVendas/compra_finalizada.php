<?php

session_start("sessao");

if (is_null($_SESSION['cpf']) || empty($_SESSION['cpf']) || !isset($_SESSION['cpf'])) {
    header('Location: login.php');
}

echo "<h2>Compra finalizada com sucesso!</h2>";
if (isset($_SESSION["idPagamento"])) {
    echo "<p><b>ID entrega: </b>".$_SESSION["idPagamento"]."</p>";
    unset($_SESSION["idPagamento"]);
}
echo "<p><a href=\"index.php\">Voltar para Home Page</a></p>";

?>