<?php

include("wsdl.php");

session_start("sessao");

if (is_null($_SESSION['cpf']) || empty($_SESSION['cpf']) || !isset($_SESSION['cpf'])) {
    header('Location: login.php');
}

try
{
    echo "<h2>Chamados</h2>";
    
    echo "<h3><a href=\"index.php\">Home</a></h3>";
    
    $client = new SoapClient($wsdlComp08);
    
    $args = array ( "idCliente"     => "00000000-0000-0000-0000-000000000004",
                    "idUsuario"     => $_SESSION['cpf'],
                    "tipoChamado"   => NULL );
    
    $result = $client->Consultar_Chamados_Por_Usuario($args);
    
    echo "<table>";
    if (isset($result->Consultar_Chamados_Por_UsuarioResult->ChamadoResumido)) {
        if (is_array($result->Consultar_Chamados_Por_UsuarioResult->ChamadoResumido)) {
            foreach ($result->Consultar_Chamados_Por_UsuarioResult->ChamadoResumido as $row) {
                echo "<tr>";
                echo "<td><a href=\"consultar_chamado.php?idChamado=".$row->Id."\">".$row->Id."</td>";
                echo "<td>".$row->Descricao."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td><a href=\"consultar_chamado.php?idChamado=".$result->Consultar_Chamados_Por_UsuarioResult->ChamadoResumido->Id."\">".$result->Consultar_Chamados_Por_UsuarioResult->ChamadoResumido->Id."</td>";
            echo "<td>".$result->Consultar_Chamados_Por_UsuarioResult->ChamadoResumido->Descricao."</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    
    echo "<p><a href=\"abrir_chamado.php\">Abrir novo chamado</a></p><br/>";

} catch (Exception $e) {
    echo "Exception: ";
    echo $e->getMessage();
}
?>