
// Funções com bind a submits de formulários de criação, exclusão e alteração.

/*
	Remoção de produto.
	Event é o evento do formulário submetido.
	Rota é o método do controlador.
*/
function submitFormRemoverProduto(event, rota) {
	event.preventDefault();
	
	postRequest(rota, formToSendData(event.target.elements),
		undefined,
		function(response) {
			toastr.success(response.mensagem);
			setTimeout(function() { 
				window.location.href = '/produtos/listar';
			}, 3000);
		},
		function(response) {
			toastr.warning(response.mensagem);
			setTimeout(function() { 
				window.location.href = '/produtos/listar';
			}, 4000);
		}
	);
}

/*
	Criação de produto.
	Event é o evento do formulário submetido.
	Rota é o método do controlador.
*/
function submitFormCriarProduto(event, rota) {
	event.preventDefault();
	
	postRequest(rota, formToSendData(event.target.elements),
		undefined,
		function(response) {
			toastr.success(response.mensagem);
			event.target.reset();
		},
		undefined, // Aviso.
		function(response) {
			toastr.error(response.mensagem);
		}
	);
}

/*
	Alteração de produto.
	Event é o evento do formulário submetido.
	Rota é o método do controlador.
*/
function submitFormAlterarProduto(event, rota) {
	event.preventDefault();
	
	postRequest(rota, formToSendData(event.target.elements),
		undefined,
		function(response) {
			toastr.success(response.mensagem);
		},
		undefined, // Aviso.
		function(response) {
			toastr.error(response.mensagem);
		}
	);
}

