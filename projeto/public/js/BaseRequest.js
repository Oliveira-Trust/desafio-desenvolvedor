
/* 
	Métodos para bloqueamento da tela, impedindo o usuário de 
	executar ações enquanto aguarda resposta do servidor.
*/
function blockScreen() {
	let blockDiv = document.createElement('DIV'); 
	blockDiv.id = 'block';
	blockDiv.classList.add('block-div');
	document.body.appendChild(blockDiv);
}

function unblockScreen() {
	let blocker = document.getElementById('block');
	document.body.removeChild(blocker);
}



/*
	Transforma os campos de um formulário numa string para 
	ser enviada através de POST.
	Ex: form com os campos 'nome' e 'preco' preenchidos:
		'nome=Exemplo&preco=99.99'
*/
function formToSendData (elementos) {
	let dados = '';
	for (let i = 0; i < elementos.length; i++) {
		if (elementos[i].name != '') {
			dados += '&' + elementos[i].name + '=' + elementos[i].value;
		}
	}
	if (dados.length > 0) {
		dados = dados.substring(1, dados.length);
	}
	return dados;
}


/*
	Faz com que seja chamado um método qualquer (submitFunction) 
	ao se submeter um formulário de id = formId.
*/
function bindSubmitToFunction(formId, submitFunction) {
	let form = document.getElementById(formId);
	form.addEventListener('submit', submitFunction, true);
}


/*
	Realiza uma requisição POST ao servidor.
	Ex:
		postRequest (
			'exemplo/url/request', 
			'nome=Exemplo&preco=99.99', 
			functionDefault, 	// Método sempre executado. 
			functionSuccess, 	// Callback para sucesso.
			functionWarning, 	// Callback para aviso.
			functionError,		// Callback para erro.
			blockUnblock		// Se bloqueia ou não a tela para aguardar a resposta
		)

*/
function postRequest (
	requestUrl, sendData, 
	functionDefault = function(response) {}, 
	functionSuccess = function(response) {}, 
	functionWarning = function(response) {}, 
	functionError = function(response) {},
	blockUnblock = true
	) {
	
	if (blockUnblock) { blockScreen(); }
	
	// Envia.
	let xhttp = new XMLHttpRequest();
	xhttp.open('POST', requestUrl, true);
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhttp.send(sendData);
	
	// Recebe resposta.
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (blockUnblock) { unblockScreen();}
			
			let response = JSON.parse(this.response);
			functionDefault(response);
			
			if (response.status == 'success') {
				functionSuccess(response);
			}
			if (response.status == 'warning') {
				functionWarning(response);
			}
			if (response.status == 'error') {
				functionError(response);
			}
		}
	};
}

