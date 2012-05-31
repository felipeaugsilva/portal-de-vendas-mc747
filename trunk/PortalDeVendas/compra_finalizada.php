<?php

    session_start("sessao");

    if (is_null($_SESSION['cpf']) || empty($_SESSION['cpf']) || !isset($_SESSION['cpf'])) {
        header('Location: login.php');
    }

    echo "<h2>Compra finalizada com sucesso!</h2>";

    // id do pagamento
    if (isset($_SESSION["idPagamento"])) {
        echo "<p><b>ID pagamento: </b>".$_SESSION["idPagamento"]."</p>";
        unset($_SESSION["idPagamento"]);
    }

    // codigo de rastreamento
    echo "<p><b>Codigo rastreamento: </b>".$_SESSION["codRastreamento"]."</p>";
    unset($_SESSION["codRastreamento"]);

    // prazo de enrtega
    echo "<p><b>Prazo entrega: </b>".$_SESSION["prazoEntrega"]." dia(s)</p>";
    unset($_SESSION["prazoEntrega"]);

    echo "<p><a href=\"index.php\">Voltar para Home Page</a></p>";

?>