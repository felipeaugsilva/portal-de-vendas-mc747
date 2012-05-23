<?php

session_start("sessao");

if (is_null($_SESSION['cpf']) || empty($_SESSION['cpf']) || !isset($_SESSION['cpf'])) {
    header('Location: login.php');
}

include("wsdl.php");

try {
    // componente 04 - credibilidade
    $client = new SoapClient($wsdlComp04);
    //$resultComp04 = $client->consultaCPF(array("CPF" => $_SESSION['cpf']));
    $resultComp04 = $client->consultaCPF(array("CPF" => "82257622820"));
    
    //print_r($resultComp04->consultaCPFResult);
    
    $situacao = $resultComp04->consultaCPFResult->situacao;
    $codRetorno = $resultComp04->consultaCPFResult->codigoRetorno;
    $msgRetorno = $resultComp04->consultaCPFResult->msgRetorno;

    if ($codRetorno == 0)  // sucesso
    {
        echo "<h2>Pagamento</h2>";
        
        echo "<h3>Formas de pagamento disponiveis:</h3>";
        
        echo "<p><a href=\"pag_cartao.php\">Cartao de Credito</a></p>";
        
        if (!strcmp($situacao, "regular")) {
            echo "<p><a href=\"pag_banco.php\">Banco</a></p>";
        }

    }
    else   // cpf invalido ou nao encontrado
    {
        echo "<p><b>Erro:</b> ".$msgRetorno."</p>";
    }

} catch (Exception $e) {
    echo "Exception: ";
    echo $e->getMessage();
}

?>
