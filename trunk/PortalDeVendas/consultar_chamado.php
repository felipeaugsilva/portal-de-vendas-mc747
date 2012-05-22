<?php

include("wsdl.php");

session_start("sessao");

if (is_null($_SESSION['cpf']) || empty($_SESSION['cpf']) || !isset($_SESSION['cpf'])) {
    header('Location: login.php');
}

$tipos = array("Reclamacao", "Sugestao", "Troca", "Duvida", "Outro");

try
{
    $client = new SoapClient($wsdlComp08);
    
    $args = array( "idCliente" => "00000000-0000-0000-0000-000000000004",
                   "idChamado" => $_GET['idChamado'] );
    
    $result = $client->Consultar_Chamado($args);
?>
    
    <h2>Detalhes do chamado</h2>
    
    <h3><a href="index.php">Home</a></h3>
    
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
                if (isset($result->Consultar_ChamadoResult->Alteracoes->Alteracao)) {
                    
                    foreach ($result->Consultar_ChamadoResult->Alteracoes->Alteracao as $row) {
                        echo "<b>Data: </b>".$row->Data."<br/>";
                        echo "<b>Descricao: </b>".$row->Descricao."<br/>";
                        echo "<b>Id: </b>".$row->Id."<br/><br/>";
                    }
                }
            ?></td>
        </tr>
    <table>
    
    <p><a href="chamados.php">Consultar outro chamado</a></p>

<?php

    } catch (Exception $e) {
        echo "Exception: ";
        echo $e->getMessage();
    }
?>