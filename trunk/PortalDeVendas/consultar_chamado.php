<?php

include("wsdl.php");

$tipos = array("Reclamacao", "Sugestao", "Troca", "Duvida", "Outro");

if (isset($_POST['submit']))
{
    try
    {
        $client = new SoapClient($wsdlComp08);
        
        $args = array( "idCliente" => "00000000-0000-0000-0000-000000000004",
                       "idChamado" => $_POST['idChamado'] );
        
        $result = $client->Consultar_Chamado($args);
?>
        
        <h3>Detalhes do chamado</h3>
        <table>
            <tr>
                <td><b>ID do chamado:</b></td>
                <td><?php echo $result->Consultar_ChamadoResult->Id; ?></td>
            </tr>
            <tr>
                <td><b>Chamado aberto em:</b></td>
                <td><?php echo $result->Consultar_ChamadoResult->Data; ?></td>
            </tr>
            <tr>
                <td><b>Descricao:</b></td>
                <td><?php echo $result->Consultar_ChamadoResult->Descricao; ?></td>
            </tr>
            <tr>
                <td><b>Tipo do chamado:</b></td>
                <td><?php echo $tipos[$result->Consultar_ChamadoResult->TipoChamado]; ?></td>
            </tr>
            <tr>
                <td><b>ID do pedido:</b></td>
                <td><?php echo $result->Consultar_ChamadoResult->IdPedido; ?></td>
            </tr>
            <tr>
                <td><b>ID do produto:</b></td>
                <td><?php echo $result->Consultar_ChamadoResult->IdProduto; ?></td>
            </tr>
            <tr>
                <td><b>Alteracoes:</b></td>
                <td><?php
                    foreach ($result->Consultar_ChamadoResult->Alteracoes->Alteracao as $row) {
                        echo "<b>Data: </b>".$row->Data."<br/>";
                        echo "<b>Descricao: </b>".$row->Descricao."<br/>";
                        echo "<b>Id: </b>".$row->Id."<br/><br/>";
                    }
                ?></td>
            </tr>
        <table>
        
        <p><a href="consultar_chamado.php">Consultar outro chamado</a></p>
        <p><a href="chamados.php">Ir para chamados</a></p>
<?php        

    } catch (Exception $e) {
        echo "Exception: ";
        echo $e->getMessage();
    }
}
else {
?>

<html>
<body>
    <h3>Consultar Chamado</h3>
    <form name="consultarChamado" action="" method="post">
        <table>
            <tr>
                <td>ID do chamado:</td>
                <td><input name="idChamado" type="text"></td>
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