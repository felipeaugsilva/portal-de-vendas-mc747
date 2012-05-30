<?php
try
{
    include("wsdl.php");
    $consultado = false;

    $status_list = array(
        "0" => "Em processamento",
        "1" => "Em transito",
        "2" => "Atrasado", 
        "3" => "Entregue",
        "4" => "Cancelado");

    session_start("sessao");

    if(is_null($_SESSION['cpf']) || empty($_SESSION['cpf']) 
        || !isset($_SESSION['cpf']))
    {
        header('Location: login.php');
    }
    else
    {
        if(isset($_GET["action"]))
        {
            $action = $_GET["action"];
            if($action == "consulta")
            {
                $consultado = true;
                $client = new SoapClient($wsdlComp06);
                
                $codigo = $_POST["txtCodigo"];

                $args = array("cod_rastr" => $codigo,
                              "id_status" => "");

                $resultComp06 = $client->checkStatus($args);

                $pedido = $resultComp06->checkStatusReturn[2];
                $status = $status_list[$resultComp06->checkStatusReturn[1]];

                //print_r($resultComp06);
            }
        }
    }
}
catch(Exception $ex)
{
    echo "Exception: ";
    echo $ex->getMessage();
}
?>
<html>
    <head>
        <title>Consulta entrega</title>
    </head>
    <body>
        <form id="frmConsulta" name="frmConsulta" method="post" action="consulta_entrega.php?action=consulta">
            <table>
                <tr>
                    <td>
                        <input id="txtCodigo" name="txtCodigo" type="text">
                    </td>
                    <td>
                        <input id="btnSubmit" name="btnSubmit" type="submit" value="Consultar">
                    </td>
                </tr>
            </table>
        </form>
<?php
    if($consultado == true)
    {
    
?>
    <table>
        <tr>
            <td>Pedido</td>
            <td>Status</td>
        </tr>
        <tr>
        <td><?php echo $pedido;?></td>
        <td><?php echo $status;?></td>
        </tr>
    </table>
<?php
    }
?>            

    </body>
</html>
