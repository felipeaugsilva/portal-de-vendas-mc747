<?php
try
{
    include("wsdl.php");
    $consultado = false;

    $status_list = array(
        "S05_R01" => "Pagamento pendente",
        "S05_R02" => "Pagamento efetuado",
        "S05_E01" => "Pagamento nao encontrado");

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
                $client = new SoapClient($wsdlComp10);
                
                $codigo = $_POST["txtCodigo"];
                //echo $codigo."<br>";

                $args = array("idPagamento" => $codigo);

                $resultComp06 = $client->VerificaStatusPagamento($args);

                $pedido = $codigo;
                $status = $status_list[$resultComp06->VerificaStatusPagamentoResult];

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
        <title>Consulta pagamento</title>
    </head>
    <body>
        <form id="frmConsulta" name="frmConsulta" method="post" action="consulta_pagamento.php?action=consulta">
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
