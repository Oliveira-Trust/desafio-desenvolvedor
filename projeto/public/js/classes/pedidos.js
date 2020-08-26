
// Funções com bind a submits de formulários de criação, exclusão e alteração.

/*
	Remoção de pedido.
	Event é o evento do formulário submetido.
	Rota é o método do controlador.
*/
function submitFormRemoverPedido(event, rota) {
	event.preventDefault();
	
	postRequest(rota, formToSendData(event.target.elements),
		undefined,
		function(response) {
			toastr.success(response.mensagem);
			setTimeout(function() { 
				window.location.href = '/pedidos/listar';
			}, 3000);
		}
	);
}

/*
	Criação de pedido.
	Event é o evento do formulário submetido.
	Rota é o método do controlador.
*/
function submitFormCriarPedido(event, rota) {
	event.preventDefault();
	
	let produtosAdicionadosStr = getListagemProdutosAdicionados();
	
	if (produtosAdicionadosStr != null) {
		let sendData = formToSendData(event.target.elements);
		sendData += '&produtos=' + produtosAdicionadosStr; 
		
		postRequest(rota, sendData,
			undefined,
			function(response) {
				toastr.success(response.mensagem);
				setTimeout(function() { 
					window.location.reload();
				}, 3000);	
			},
			function(response) {
				toastr.warning(response.mensagem);
			}
		);
	} else {
		toastr.warning('Adicione pelo menos um produto ao pedido.');
	}
	
	
}

/*
	Alteração de pedido.
	Event é o evento do formulário submetido.
	Rota é o método do controlador.
*/
function submitFormAlterarPedido(event, rota) {
	event.preventDefault();
	
	let produtosAdicionadosStr = getListagemProdutosAdicionados();
	
	if (produtosAdicionadosStr != null) {
		let sendData = formToSendData(event.target.elements);
		sendData += '&produtos=' + produtosAdicionadosStr; 
		
		postRequest(rota, sendData,
			undefined,
			function(response) {
				toastr.success(response.mensagem);
				setTimeout(function() { 
					window.location.reload();
				}, 3000);
			}, 
			function(response) {
				toastr.warning(response.mensagem);
			},
			function(response) {
				toastr.error(response.mensagem);
			}
		);
	} else {
		toastr.warning('Adicione pelo menos um produto ao pedido.');
	}
}


/*
	Agrega todos os produtos adicionados à um pedido numa string
	em formato JSON contendo as ids dos produtos e suas quantidades.
	Se não houver produtos adicionados retorna null.
	Ex:
		[ 
			{"id": 1, "quant": 5},
			{"id": 4, "quant": 2},
			{"id": 2, "quant": 1}
		]
*/
function getListagemProdutosAdicionados () {
	
	let produtosAdicionados = document.getElementById('produtos-adicionados');
	
	let produtosAdicionadosStr = '[';
	for (let i = 0; i < produtosAdicionados.childElementCount; i++) {
		produtosAdicionadosStr += '{ "id": ' + 
			produtosAdicionados.children[i].dataset.id + 
			', "quant": ' + 
			produtosAdicionados.children[i].dataset.quantidade + 
			' },';
	}
	if (produtosAdicionadosStr.length > 1) {
		produtosAdicionadosStr = produtosAdicionadosStr.substring(0, produtosAdicionadosStr.length - 1) + ']';
	} else {
		return null;
	}
	
	return produtosAdicionadosStr;
}


/*
	Pesquisa por um produto no JSON carregado do servidor.
*/
function getProdutoById(produtoId) {
	for (let i = 0; i < produtos.length; i++) {
		if (produtos[i].id == produtoId) {
			return produtos[i];
		}
	}
	return null;
}


/*
	Atualiza valor monetário na tela de acordo com 
	o produto escolhido e sua quantidade.
*/
function atualizaValoresProduto() {
	let produtoId = document.getElementById('produto_id').value;
	let quantidadeProduto = document.getElementById('quantidade').value;
	
	let produto = getProdutoById(produtoId);
	
	if (produto != null) { 
		document.getElementById('preco-produto').innerHTML = produto.preco.toFixed(2).replace('.', ',');
		
		let subtotalProduto = parseInt(quantidadeProduto) * produto.preco;
		document.getElementById('subtotal-produto').innerHTML = subtotalProduto.toFixed(2).replace('.', ',');
	}
	
}


/*
	Retorna HTML de uma div que lista o produto adicionado com suas propriedades.
	Views de alteração e adição de pedido.
*/
function produtoAdicionado(id, quantidade, valor, nome, preco) {
	return '<div class="produto-adicionado" data-id="' + id + 
		'" data-quantidade="' + quantidade + '" data-subtotal-produto="' + 
		valor + '"><a href="/produtos/ver/' + id + 
		'" title="Ver produto ' + nome + '">' + nome + 
		'</a> - R$ ' + parseFloat(preco).toFixed(2).replace('.', ',') + 
		' Total: ' + quantidade + 
		'<i class="fa fa-times" aria-hidden="true" onclick="removerProduto(this);"></i></div>';
}


/*
	Remove produto da listagem no pedido.
*/
function removerProduto(element) {
	
	let subtotalProduto = parseFloat(element.parentElement.dataset.subtotalProduto);
	let valorAnterior = parseFloat(document.getElementById('total-pedido').innerHTML.replace(',', '.'));
	
	// Remove valor monetário do total.
	document.getElementById('total-pedido').innerHTML = (valorAnterior - subtotalProduto).toFixed(2).replace('.', ',');
	
	element.parentElement.remove();
}


/*
	Método chamado ao se submeter o formulário de adição de produto nas
	views de criar e alterar pedido.
*/
function adicionarProduto() {
	event.preventDefault();
	
	let valorAnterior = parseFloat(document.getElementById('total-pedido').innerHTML.replace(',', '.'));
	let valorProduto = parseFloat(document.getElementById('subtotal-produto').innerHTML.replace(',', '.'));
	
	// Adiciona valor monetário ao total.
	document.getElementById('total-pedido').innerHTML = (valorAnterior + valorProduto).toFixed(2).replace('.', ',');

	let produtoId = document.getElementById('produto_id').value;
	let produto = getProdutoById(produtoId);
	if (produto != null) {
		document.getElementById('produtos-adicionados').innerHTML += produtoAdicionado (
			produtoId, 
			document.getElementById('quantidade').value,
			valorProduto,
			produto.nome, 
			produto.preco
		);
	}
}


/*
	Preenche inputs com dados do primeiro produto disponível
	na view de alterar e criar pedido.
*/
function preencherPrimeiroProduto() {
	document.getElementById('preco-produto').innerHTML = produtos[0].preco.toFixed(2).replace('.', ',');
	let quantidadeProduto = document.getElementById('quantidade').value;
	let subtotalProduto = parseInt(quantidadeProduto) * produtos[0].preco;
	document.getElementById('subtotal-produto').innerHTML = subtotalProduto.toFixed(2).replace('.', ',');
}

