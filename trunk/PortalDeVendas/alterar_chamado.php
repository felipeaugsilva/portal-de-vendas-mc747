<?php

include("wsdl.php");

session_start("sessao");

if (is_null($_SESSION['cpf']) || empty($_SESSION['cpf']) || !isset($_SESSION['cpf'])) {
    header('Location: login.php');
}

$tipos = array("Aberto"=>0, "Fechado"=>1, "Em Andamento"=>2, "Cancelado"=>3);

if (isset($_POST['submit']))
{
    try
    {
        $statusEscolhido = $_POST['status'];
        
        $client = new SoapClient($wsdlComp08);
        
        $args = array ( "alteracao" => array ( "Descricao" => $_POST['descricao'],
                                               "IdChamado" => $_GET['idChamado'],
                                               "IdCliente" => "00000000-0000-0000-0000-000000000004",
                                               "Status"    => $tipos[$statusEscolhido] ));
        
        $result = $client->Alterar_Chamado($args);
                
        echo "<h2>Seu chamado foi alterado!</h2>";
        
        echo "<h3><a href=\"index.php\">Home</a></h3>";
        
        echo "<p><a href=\"chamados.php\">Ir para chamados</a></p>";

    } catch (Exception $e) {
        echo "Exception: ";
        echo $e->getMessage();
    }
}
else {
?>

<html>
<body>
    <h2>Alterar Chamado</h2>
    
    <h3><a href="index.php">Home</a></h3>
    
    <form name="alterarChamado" action="" method="post">
        <table>
            <tr>
                <td>Descricao:</td>
                <td><input name="descricao" type="text"></td>
            </tr>
            <tr>
                <td>Status:</td>
                <td><select name="status">
                    <?php
                    foreach (array_keys($tipos) as $tipo) {
                        echo "<option>".$tipo."</option>";
                    }
                    ?>
                </select></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Enviar"></td>
            </tr>
        <table>
    </form>
</body>
</html>

<?php
}
?>
