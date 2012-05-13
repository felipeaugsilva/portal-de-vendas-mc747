<html>

<?php
$tipos = array("Reclamacao"=>0, "Sugestao"=>1, "Troca"=>2, "Duvida"=>3, "Outro"=>4);

if (isset($_POST['submit']))
{
    try
    {
        include("wsdl.php");
        
        $tipoEscolhido = $_POST['tipo'];

        $client = new SoapClient($wsdlComp08);

        $result = $client->Abrir_Chamado(1, $_POST['descricao'], NULL, NULL, $tipos["$tipoEscolhido"]); // TODO: exception nesse ponto

        print_r($result);

    } catch (Exception $e) {
        echo "Exception: ";
        echo $e->getMessage();
    }
}
?>

<body>
    <h3>Abrir Chamado</h3>
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
            <tr>
                <td><input type="submit" name="submit" value="Enviar"></td>
            </tr>
        <table>
    </form>
</body>
</html>

