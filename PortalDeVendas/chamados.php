<?php

include("wsdl.php");

try
{
    echo "<h2>Chamados</h2>";
    
    $client = new SoapClient($wsdlComp08);

    $cpf = "7";     // TODO pegar da sessao
    
    $args = array ( "idCliente"     => "00000000-0000-0000-0000-000000000004",
                    "idUsuario"     => $cpf,
                    "tipoChamado"   => NULL );
    
    $result = $client->Consultar_Chamados_Por_Usuario($args);
    
    echo "<table>";
    foreach ($result->Consultar_Chamados_Por_UsuarioResult->ChamadoResumido as $row) {
        echo "<tr>";
        echo "<td><a href=\"consultar_chamado.php?idChamado=".$row->Id."\">".$row->Id."</td>";
        echo "<td>".$row->Descricao."</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<p><a href=\"abrir_chamado.php\">Abrir novo chamado</a></p><br/>";

} catch (Exception $e) {
    echo "Exception: ";
    echo $e->getMessage();
}
?>