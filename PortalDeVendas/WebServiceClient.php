<?php
try {
	/*
	Grupo 01 - Registro e Controle de Estoque de Produtos
	*/
	/*
	$client = new SoapClient("http://gerestoque.heliohost.org/Service1.asmx?wsdl=0");
	
	// ReturnProductInfo(ID:int)
	$result = $client->ReturnProductInfo(array("ID" => "1"));
	
	echo "<br/>ReturnProductInfo(ID:int)<br/>";
	echo $result->ReturnProductInfoResult->ID."<br/>";
	echo $result->ReturnProductInfoResult->Name."<br/>";
	echo $result->ReturnProductInfoResult->Price."<br/>";
	echo $result->ReturnProductInfoResult->Quantity."<br/>";
	echo $result->ReturnProductInfoResult->Error."<br/>";
	
	// AddProduct(ID:int, qtd:int)
	$result = $client->AddProduct(array("ID" => "1", "qtd" => "1"));
	
	echo "<br/>AddProduct(ID:int, qtd:int)<br/>";
	echo $result->AddProductResult."<br/>";
	
	// SubProduct(ID:int, qtd:int)
	$result = $client->SubProduct(array("ID" => "1", "qtd" => "1"));
	
	echo "<br/>SubProduct(ID:int, qtd:int)<br/>";
	echo $result->SubProductResult."<br/>";
	*/
	
	
	/*
	Grupo 02 - Informações de Clientes
	*/
	/*
	$client = new SoapClient("http://staff01.lab.ic.unicamp.br:8280/clientesWS/clientes2?wsdl");
	
	// buscaInformacoesCliente(CPF:string)
	$result = $client->buscaInformacoesCliente(array("CPF" => "21375324845"));
	
	echo "<br/>buscaInformacoesCliente(CPF:string)<br/>";
	echo $result->return->CPF."<br/>";
	echo $result->return->nome."<br/>";
	echo $result->return->dataNascimento."<br/>";
	echo $result->return->dataCadastro."<br/>";
	echo $result->return->RG."<br/>";
	echo $result->return->CEP."<br/>";
	echo $result->return->numeroEndereco."<br/>";
	echo $result->return->complementoEndereco."<br/>";
	echo $result->return->potencialCompra."<br/>";
	echo $result->return->email."<br/>";
	
	// buscaInformacaoCliente(CPF:string, campoCliente:string)
	$result = $client->buscaInformacaoCliente(array("CPF" => "21375324845", "Campo" => "email"));
	
	echo "<br/>buscaInformacaoCliente(CPF:string, campoCliente:string)<br/>";
	echo $result->return."<br/>";
	
	// buscaPotencialCliente(CPF:string)
	$result = $client->buscaPotencialCliente(array("CPF" => "21375324845"));

	echo "<br/>buscaPotencialCliente(CPF:string)<br/>";
	echo $result->return."<br/>";
	*/
	
	
	/*
	Grupo 03 - Informações Detalhadas de Produtos
	*/
	/*
	$client = new SoapClient("http://sql2.students.ic.unicamp.br/~ra043251/mc747/DetalheProduto.wsdl");
	
	// exibeDetalhesID(id:int)
	$result = $client->exibeDetalhesID(1);
	
	echo "exibeDetalhesID(1)<br/>";
	echo $result[0]."<br/>";//id
	echo $result[1]."<br/>";//nome
	echo $result[2]."<br/>";//categoria_id
	echo $result[3]."<br/>";//categoria_nome
	echo $result[4]."<br/>";//marca_id
	echo $result[5]."<br/>";//marca_nome
	echo $result[6]."<br/>";//especificacao
	echo $result[7]."<br/>";//peso
	echo $result[8]."<br/>";//comprimento
	echo $result[9]."<br/>";//largura
	echo $result[10]."<br/>";//altura
	
	// buscaAvancada(categoria_id:int, marca:int)
	$result = $client->buscaAvancada(16, 4);
	
	echo "<br/>buscaAvancada(16, 4) - estatico<br/>";
	echo $result[0][0]."<br/>";//id
	echo $result[0][1]."<br/>";//nome
	echo $result[0][2]."<br/>";//categoria_id
	echo $result[0][3]."<br/>";//categoria_nome
	echo $result[0][4]."<br/>";//marca_id
	echo $result[0][5]."<br/>";//marca_nome
	echo $result[0][6]."<br/>";//especificacao
	echo $result[0][7]."<br/>";//peso
	echo $result[0][8]."<br/>";//comprimento
	echo $result[0][9]."<br/>";//largura
	echo $result[0][10]."<br/>";//altura
	
	echo "<br/>buscaAvancada(16, 4) - iterativo<br/>";
	foreach ($result as $row) {
		foreach ($row as $column) {
			echo $column."<br/>";
		}
		echo "<br/>";
	}

	// buscaSimplificada(id:int)
	$result = $client->buscaSimplificada(2);
	
	echo "<br/>buscaSimplificada(2)<br/>";
	echo $result[0]."<br/>";//id
	echo $result[1]."<br/>";//peso
	echo $result[2]."<br/>";//comprimento
	echo $result[3]."<br/>";//largura
	echo $result[4]."<br/>";//altura

	// listarCategorias()
	$result = $client->listarCategorias();
	
	echo "<br/>listarCategorias() - estatico<br/>";
	echo $result[0][0]."<br/>";//id
	echo $result[0][1]."<br/>";//id_pai
	echo $result[0][2]."<br/><br/>";//nome
	
	echo "<br/>listarCategorias() - iterativo<br/>";
	foreach ($result as $row) {
		foreach ($row as $column) {
			echo $column."<br/>";
		}
		echo "<br/>";
	}
	*/
	
	
	/*
	Grupo 04 - Proteção ao Crédito
	*/
	/*
	$client = new SoapClient("http://mc747grupo04.heliohost.org/ProtecaoAoCredito.asmx?WSDL=0");
	
	// consultaCPF(CPF:string)
	$result = $client->consultaCPF(array("CPF" => "21375324845"));
	
	echo "<br/>consultaCPF(CPF:string)<br/>";
	echo $result->consultaCPFResult->situacao."<br/>";
	echo $result->consultaCPFResult->codigoRetorno."<br/>";
	echo $result->consultaCPFResult->msgRetorno."<br/>";
	*/
	
	
	/*
	Grupo 05 - Meios de Pagamento: Cartões de Crédito
	*/
	
	$client = new SoapClient("http://ec2-50-19-145-76.compute-1.amazonaws.com:8080/PagamentoCartao/PagamentoCartao?wsdl");
	
	// listaCartoes()
	$result = $client->listaCartoes();
	
	echo "<br/>listaCartoes() - estatico<br/>";
	echo $result->return[0]->bandeira."<br/>";
	echo $result->return[0]->quantidade_max_parcelas."<br/>";
	echo $result->return[0]->juros[0]->numero."<br/>";
	echo $result->return[0]->juros[0]->juros."<br/>";
	
	echo "<br/>listaCartoes() - dinamico<br/>";
	foreach ($result->return as $return) {
		echo $return->bandeira."<br/>";
		echo $return->quantidade_max_parcelas."<br/>";
		if (is_array($return->juros)) {
			foreach ($return->juros as $row) {
				echo $row->numero.", ".$row->juros."<br/>";
			}
		}
		else {
			echo $return->juros->numero.", ".$return->juros->juros."<br/>";
		}
		echo "<br/>";
	}
	
	// validaCompra(valorDaCompra:long, nomeDoTitular:string, bandeiraDoCartão:string, numeroDoCartão:string, dataDeValidade:string, codigoDeSeguranca:string, quantidadeDeParcelas:int)
	$args = array (
		"ValorDaCompra" => "1000",
		"NomeDoTitular" => "JOAO",
		"BandeiraDoCartao"=> "Visa",
		"NumeroDoCartao" => "1234123412341234",
		"dataDeValidade" => "12/12",
		"CodigoDeSeguranca" => "123",
		"QuantidadeDeParcelas" => "1"
	);
	$result = $client->validaCompra($args);
	
	print_r($result);
	
	
	
	/*
	Grupo 06 - Logística e Entrega dos Produtos
	*/
	/*
	$client = new SoapClient("http://staff01.lab.ic.unicamp.br:8680/c06/services/C06_Logistica?wsdl");
	
	// checkStatus(cod_rastr:int, id_status:int);
	$args = array (
		"cod_rastr" => "1",
		"id_status" => "1"
	);
	$result = $client->checkStatus($args);
	
	echo "<br/>checkStatus(cod_rastr:int, id_status:int)<br/>";
	echo $result->checkStatusReturn[0]."<br/>";//erro
	echo $result->checkStatusReturn[1]."<br/>";//situacao_entrega
	echo $result->checkStatusReturn[2]."<br/>";//codigo_rastreamento
	echo $result->checkStatusReturn[3]."<br/>";//url_rastreamento
	echo $result->checkStatusReturn[4]."<br/>";//status
	
	// webserviceTransporte(peso:int, volume:double, cep:int, meio:int, id_NotaFiscal:int)
	$args = array (
		"peso" => "1",
		"volume" => "1",
		"cep" => "12345678",
		"meio" => "1",
		"id_NotaFiscal" => "1"
	);
	$result = $client->webserviceTransporte($args);
	
	echo "<br/>webserviceTransporte(peso:int, volume:double, cep:int, meio:int, id_NotaFiscal:int)<br/>";
	echo $result->webserviceTransporteReturn[0]."<br/>";//erro
	echo $result->webserviceTransporteReturn[1]."<br/>";//cod_rastreamento
	echo $result->webserviceTransporteReturn[2]."<br/>";//frete
	echo $result->webserviceTransporteReturn[3]."<br/>";//prazo

	// calculaFrete(peso:int, volume:double, cep:int, modo_entrega:int)
	$args = array (
		"peso" => "1",
		"volume" => "1",
		"cep" => "12345678",
		"modo_entrega" => "1"
	);
	$result = $client->calculaFrete($args);
	
	echo "<br/>calculaFrete(peso:int, volume:double, cep:int, modo_entrega:int)<br/>";
	echo $result->calculaFreteReturn[0]."<br/>";//erro
	echo $result->calculaFreteReturn[1]."<br/>";//frete
	echo $result->calculaFreteReturn[2]."<br/>";//prazo
	*/
	
	/*
	Grupo 07 - Autenticação
	*/
	/*
	$client = new SoapClient("http://sci-psych.com/mc747/AuthService/public/index/wsdl");
	
	// authenticateIn(cpf:string, password:string)
	$args = array (
		"cpf" => "john",
		"password" => "reese"
	);
	$result = $client->authenticate($args);
	
	print_r($result);
	*/
	
	
	/*
	Grupo 08 - Atendimento ao Cliente
	*/
	/*
	$client = new SoapClient("http://mc747atendimento.no-ip.org:2121/AtendimentoCliente.AtendimentoCliente.svc?wsdl");
	
	// Abrir_Chamado(Descricao:string, IdCliente:guid, IdPedido:string, IdProduto:string, IdSolicitante:string, TipoChamado:unsignedByte)
	$args = array ( "chamado" => array (
		"Descricao"		=> "Teste Grupo 04",
		"IdCliente"		=> "00000000-0000-0000-0000-000000000004",
		"IdPedido"		=> "1",
		"IdProduto"		=> "1",
		"IdSolicitante"	=> "1",
		"TipoChamado"	=> '1'
	));
	$result = $client->Abrir_Chamado($args);

	echo "<br/>Abrir_Chamado(Descricao:string, IdCliente:guid, IdPedido:string, IdProduto:string, IdSolicitante:string, TipoChamado:unsignedByte)<br/>";
	echo $result->Abrir_ChamadoResult->Data."<br/>";
	echo $result->Abrir_ChamadoResult->Id."<br/>";
	
	// Consultar_Chamado(idCliente:guid, idChamado:guid)
	$args = array (
		"idCliente" => "00000000-0000-0000-0000-000000000004",
		"idChamado" => "1d5cebf3-35f8-4559-a990-fbc244a6bda1"
	);
	$result = $client->Consultar_Chamado($args);

	echo "<br/>Consultar_Chamado(idCliente:guid, idChamado:guid)<br/>";
	echo $result->Consultar_ChamadoResult->Data."<br/>";
	echo $result->Consultar_ChamadoResult->Descricao."<br/>";
	echo $result->Consultar_ChamadoResult->Id."<br/>";
	echo $result->Consultar_ChamadoResult->IdCliente."<br/>";
	echo $result->Consultar_ChamadoResult->IdPedido."<br/>";
	echo $result->Consultar_ChamadoResult->IdProduto."<br/>";
	echo $result->Consultar_ChamadoResult->IdSolicitante."<br/>";
	echo $result->Consultar_ChamadoResult->TipoChamado."<br/>";
	foreach ($result->Consultar_ChamadoResult->Alteracoes->Alteracao as $row) {
		echo $row->Data."<br/>";
		echo $row->Descricao."<br/>";
		echo $row->Id."<br/>";
		echo $row->Status."<br/>";
	}
	
	// Alterar_Chamado(Descricao:string, IdChamado:guid, IdCliente:guid, Status:unsignedByte)
	$args = array ( "alteracao" => array (
		"Descricao" => "Teste Grupo 04 - Alteracao",
		"IdChamado" => "1d5cebf3-35f8-4559-a990-fbc244a6bda1",
		"IdCliente" => "00000000-0000-0000-0000-000000000004",
		"Status"	=> '0'
	));
	$result = $client->Alterar_Chamado($args);

	echo "<br/>Alterar_Chamado(Descricao:string, IdChamado:guid, IdCliente:guid, Status:unsignedByte)<br/>";
	echo $result->Alterar_ChamadoResult."<br/>";
	
	// Consultar_Chamados_Por_Usuario(idCliente:guid, idUsuario:string, tipoChamado:unsignedByte)
	$args = array (
		"idCliente" 	=> "00000000-0000-0000-0000-000000000004",
		"idUsuario" 	=> "1",
		"tipoChamado"	=> '1'
	);
	$result = $client->Consultar_Chamados_Por_Usuario($args);

	echo "<br/>Consultar_Chamados_Por_Usuario(idCliente:guid, idUsuario:string, tipoChamado:unsignedByte)<br/>";
	foreach ($result->Consultar_Chamados_Por_UsuarioResult->ChamadoResumido as $row) {
		echo $row->Data."<br/>";
		echo $row->Descricao."<br/>";
		echo $row->Id."<br/>";
		echo $row->IdCliente."<br/>";
		echo $row->IdSolicitante."<br/>";
		echo $row->TipoChamado."<br/>";
		echo $row->UltimoStatus."<br/>";
	}
	*/
	
	/*
	Grupo 09 - Endereço
	*/
	/*
	$client = new SoapClient("http://padovan.org:3000/address_services/wsdl");

	// EnderecoPorCep(Cep:string)
	$result = $client->CepAddress("13083-755");
	
	echo "<br/>EnderecoPorCep(Cep:string)<br/>";
	echo $result->address->logradouro."<br/>";
	echo $result->address->bairro."<br/>";
	echo $result->address->localidade."<br/>";
	echo $result->address->uf."<br/>";
	echo $result->address->cep."<br/>";
	echo $result->errors[0]->code."<br/>";
	echo $result->errors[0]->description."<br/>";
	
	// SearchAddress(Query:string)
	$result = $client->SearchAddress("campinas");
	
	echo "<br/>SearchAddress(Query:string) - estatico<br/>";
	echo $result->addresses[0]->logradouro."<br/>";
	echo $result->addresses[0]->bairro."<br/>";
	echo $result->addresses[0]->localidade."<br/>";
	echo $result->addresses[0]->uf."<br/>";
	echo $result->addresses[0]->cep."<br/>";
	echo $result->errors[0]->code."<br/>";
	echo $result->errors[0]->description."<br/>";
	
	echo "<br/>SearchAddress(Query:string) - iterativo<br/>";
	foreach ($result->addresses as $row) {
		echo $row->logradouro."<br/>";
		echo $row->bairro."<br/>";
		echo $row->localidade."<br/>";
		echo $row->uf."<br/>";
		echo $row->cep."<br/><br/>";
	}
	foreach ($result->errors as $row) {
		echo $row->code."<br/>";
		echo $row->description."<br/>";
	}
	
	// VerifyAddress(Logradouro:string, Bairro:string, Localidade:string, Uf:string, Cep:string)
	$result = $client->VerifyAddress(array("logradouro" => "Rua Antonio Augusto de Almeida", "bairro" => "Cidade Universitaria", "localidade" => "Campinas", "uf" => "SP", "cep" => "13083-755"));
	
	echo "<br/>VerifyAddress(Logradouro:string, Bairro:string, Localidade:string, Uf:string, Cep:string)<br/>";
	echo $result->valid."<br/>";
	foreach ($result->errors as $row) {
		echo $row->code."<br/>";
		echo $row->description."<br/>";
	}
	*/
	
	
	/*
	Grupo 16 - Meio de Pagamento: Banco
	*/
	/*
	$client = new SoapClient("http://www.mc747.homologa.isat.com.br/BancoService.svc?wsdl");

	// PagarViaDepositoBancario(agencia:int, conta:int, valor:double)
	$result = $client->PagarViaDepositoBancario(array ("agencia" => 4, "conta" => 4, "valor" => 100.00));
	
	echo "<br/>PagarViaDepositoBancario(agencia:int, conta:int, valor:double)<br/>";
	echo $result->PagarViaDepositoBancarioResult."<br/>";//idPagamento
	
	// PagarViaBoletoBancario(agencia:int, conta:int, valor:double)
	$result = $client->PagarViaBoletoBancario(array ("agencia" => 4, "conta" => 4, "valor" => 200.00));
	
	echo "<br/>PagarViaBoletoBancario(agencia:int, conta:int, valor:double)<br/>";
	echo $result->PagarViaBoletoBancarioResult."<br/>";//idPagamento
	
	// PagarViaTransferenciaBancaria(agencia:int, conta:int, valor:double)
	$result = $client->PagarViaTransferenciaBancaria(array ("agencia" => 4, "conta" => 4, "valor" => 300.00));
	
	echo "<br/>PagarViaTransferenciaBancaria(agencia:int, conta:int, valor:double)<br/>";
	echo ($idPagamento = $result->PagarViaTransferenciaBancariaResult)."<br/>";//idPagamento
	
	// VerificaStatusPagamento(idPagamento:int)
	$result = $client->VerificaStatusPagamento(array ("idPagamento" => $idPagamento));
	
	echo "<br/>VerificaStatusPagamento(idPagamento:int)<br/>";
	echo $result->VerificaStatusPagamentoResult."<br/>";
	
	// CancelarPagamento(idPagamento:int)
	$result = $client->CancelarPagamento(array ("idPagamento" => $idPagamento));
	
	echo "<br/>CancelarPagamento(idPagamento:int)<br/>";
	echo $result->CancelarPagamentoResult."<br/>";
	*/

} catch (Exception $e) {
	echo "Exception: ";
	echo $e->getMessage();
}

?>