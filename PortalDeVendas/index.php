<?php

session_start("sessao");

if (is_null($_SESSION['cpf']) || empty($_SESSION['cpf']) || !isset($_SESSION['cpf'])) {
    header('Location: login.php');
}

?>

<html>
<body>
    <h2>Home</h2>
    <h3><a href="login.php">Logout</a></h3>
    <p><a href="categorias.php">Categorias de produtos</a></p>
    <p><a href="chamados.php">Chamados</a></p>
</body>
</html>