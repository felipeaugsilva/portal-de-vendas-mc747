<?php
try {

    include("wsdl.php");

    session_start("carrinho");
    
    if (!$_SESSION['carrinho'] || $_SESSION['carrinho'] == "") 
    {
        $_SESSION['carrinho'] = array();
    }

    $prodID = $_GET["prodID"];

    /*if(!in_array($prodID,$_SESSION['carrinho']))
    {
        $total_chaves = array_keys($_SESSION['carrinho']);
        $tamanho_array = sizeof($total_chaves);
        $_SESSION["carrinho"][$tamanho_array] = $prodID;
    }*/

    if(!$_SESSION["carrinho"][$prodID] || $_SESSION["carrinho"][$prodID] == "")
    {
        $_SESSION["carrinho"][$prodID] = array();

        // componente 01 - estoque    
        $client = new SoapClient($wsdlComp01);
        $resultComp01 = $client->ReturnProductInfo(array("ID" => "$prodID"));
        
        // componente 03 - informacoes produto
        $client = new SoapClient($wsdlComp03);
        $resultComp03 = $client->exibeDetalhesID($prodID);

        $_SESSION["carrinho"][$prodID]["nome"] = $resultComp03[1];
        $_SESSION["carrinho"][$prodID]["qtd"] = 1;
        $_SESSION["carrinho"][$prodID]["preco"] = $resultComp01->ReturnProductInfoResult->Price;   
    }
    else
    {
        $_SESSION["carrinho"][$prodID]["qtd"] = intval($_SESSION["carrinho"][$prodID]["qtd"]) + 1;
    }

    echo "<table>";
    echo "<tr>";
    echo "<td><b>Produto</b></td>";
    echo "<td><b>Quantidade</b></td>";
    echo "<td><b>Preco</b></td>";
    echo "<td><b>Total</b></td>";
    echo "</tr>";

    $total = intval(0);
    foreach($_SESSION["carrinho"] as $produto)
    {
        echo "<tr>";
        echo "<td>".$produto["nome"]."</td>";
        echo "<td>".$produto["qtd"]."</td>";
        echo "<td>".$produto["preco"]."</td>";
        $total_produto = intval($produto["qtd"]) * intval($produto["preco"]);
        $total = intval($total) + intval($total_produto);
        echo "<td>".$total_produto."</td>";
        echo "<tr>";
    }

    echo "<tr>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td><b>Total</b></td>";
    echo "<td><b>".$total."</b></td>";
    echo "</tr>";
    
    echo "</table>";

    //session_destroy();

} catch (Exception $e) {
    echo "Exception: ";
    echo $e->getMessage();
}
?>
