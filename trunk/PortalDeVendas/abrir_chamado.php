<?php

include("wsdl.php");

session_start("sessao");

if (is_null($_SESSION['cpf']) || empty($_SESSION['cpf']) || !isset($_SESSION['cpf'])) {
    header('Location: login.php');
}

$tipos = array("Reclamacao"=>0, "Sugestao"=>1, "Troca"=>2, "Duvida"=>3, "Outro"=>4);

if (isset($_POST['submit']))
{
    try
    {
        $tipoEscolhido = $_POST['tipo'];
        
        $client = new SoapClient($wsdlComp08);
        
        $args = array("chamado" => array( "Descricao"     => $_POST['descricao'],
                                          "IdCliente"     => "00000000-0000-0000-0000-000000000004",
                                          "IdPedido"      => $_POST['idPedido'],
                                          "IdProduto"     => $_POST['idProduto'],
                                          "IdSolicitante" => $_SESSION['cpf'],
                                          "TipoChamado"   => $tipos[$tipoEscolhido] ));
        
        $result = $client->Abrir_Chamado($args);
        
        echo "<h2>Seu chamado foi aberto!</h2>";
        
        echo "<p><b>ID do chamado: </b>".$result->Abrir_ChamadoResult->Id."</p>";
        
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
    <h2>Abrir Chamado</h2>
    <form name="novoChamado" action="" method="post">
        <table>
            <tr>
                <td>Descricao:</td>
                <td><input name="descricao" type="text"></td>
            </tr>
            <tr>
                <td>Tipo:</td>
                <td><select name="tipo">
                    <?php
                    foreach (array_keys($tipos) as $tipo) {
                        echo "<option>".$tipo."</option>";
                    }
                    ?>
                </select></td>
            </tr>
            <td>ID do pedido:</td>
                <td><input name="idPedido" type="text"></td>
            </tr>
            <tr>
            <td>ID do produto:</td>
                <td><input name="idProduto" type="text"></td>
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