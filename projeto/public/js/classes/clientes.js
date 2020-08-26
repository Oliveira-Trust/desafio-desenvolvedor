
// Funções com bind a submits de formulários de criação, exclusão e alteração.

/*
	Remoção de cliente.
	Event é o evento do formulário submetido.
	Rota é o método do controlador.
*/
function submitFormRemoverCliente(event, rota) {
	event.preventDefault();
	
	postRequest(rota, formToSendData(event.target.elements),
		undefined,
		function(response) {
			toastr.success(response.mensagem);
			setTimeout(function() { 
				window.location.href = '/clientes/listar';
			}, 3000);
		}
	);
}

/*
	Criação de cliente.
	Event é o evento do formulário submetido.
	Rota é o método do controlador.
*/
function submitFormCriarCliente(event, rota) {
	event.preventDefault();
	
	document.getElementById('cpf').value = document.getElementById('cpf').value.replace(/\./g, '').replace('-', '');
	document.getElementById('tel').value = document.getElementById('tel').value.replace(/ /g, '').replace('+', '').trim();
	
	postRequest(rota, formToSendData(event.target.elements),
		undefined,
		// Sucesso.
		function(response) {
			toastr.success(response.mensagem);
			event.target.reset();
		},
		// Aviso.
		function(response) {
			toastr.warning(response.mensagem);
		},
		// Erro.
		function(response) {
			toastr.error(response.mensagem);
		}
	);
}

/*
	Alteração de cliente.
	Event é o evento do formulário submetido.
	Rota é o método do controlador.
*/
function submitFormAlterarCliente(event, rota) {
	event.preventDefault();
	
	document.getElementById('cpf').value = document.getElementById('cpf').value.replace(/\./g, '').replace('-', '');
	document.getElementById('tel').value = document.getElementById('tel').value.replace(/ /g, '').replace('+', '').trim();
	
	postRequest(rota, formToSendData(event.target.elements),
		undefined,
		// Sucesso.
		function(response) {
			toastr.success(response.mensagem);
			// Recarrega a página.
			setTimeout(function() { 
				window.location.reload();
			}, 3000);
		},
		// Aviso.
		function(response) {
			toastr.warning(response.mensagem);
		},
		// Erro.
		function(response) {
			toastr.error(response.mensagem);
		}
	);
}


// Formatação de campos de CPF e telefone.

/* 
	Elemento com CPF formatado.
	Recebe id do elemento no formato 'exemplo'.
*/
function criarCampoCPF (idElemento) {
	return new Cleave('#' + idElemento, {
		blocks: [3, 3, 3, 2],
		delimiters: ['.', '.', '-']
	});
}

/* 
	Elemento com telefone formatado.
	Recebe id do elemento no formato 'exemplo'.
*/
function criarCampoTel (idElemento) {
	return new Cleave('#' + idElemento, {
		phone: true,
		phoneRegionCode: 'BR'
	});
}


/* 
	Formata o CPF com auxílio de um placeholder.
	placeholder = elemento do Cleave preparado para input CPF.
	valor = valor de CPF desformatado.
	elemento = elemento HTML destino do novo valor formatado.
	Ex:
		valorFormatadoCPF(
			criarCampoCPF('placeholder-exemplo'),
			'11111111111', 
			document.getElementById('cpf')
		);
*/
function valorFormatadoCPF(placeholder, valor, elemento) {
	placeholder.setRawValue(valor);
	elemento.innerHTML = placeholder.getFormattedValue();
}


/* 
	Formata o telefone com auxílio de um placeholder.
	placeholder = elemento do Cleave preparado para input de telefone.
	valor = valor de telefone desformatado.
	elemento = elemento HTML destino do novo valor formatado.
	Ex:
		valorFormatadoTel(
			criarCampoTel('placeholder-exemplo'),
			'551122222222', 
			document.getElementById('tel')
		);
*/
function valorFormatadoTel(placeholder, valor, elemento) {
	if (valor.startsWith('55')) {
		placeholder.setRawValue('+' + valor);
	} else {
		placeholder.setRawValue(valor);
	}
	elemento.innerHTML = placeholder.getFormattedValue();
}
