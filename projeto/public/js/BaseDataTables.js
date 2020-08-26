
// Customização das funcionalidades do DataTables.

/*
	Opções padrão do DataTables.
	Devem ser adicionadas ao se criar uma nova tabela.
	Ex: 
		let config = {}; // Configuração da tabela específica.
		$.extend(config, DT_DEFAULT_OPTIONS);
		let tabela = $('#exemplo').DataTable(config);
*/
const DT_DEFAULT_OPTIONS = {
	language: {
		decimal: ",", 
		url: "/js/jquery.dataTables-pt_br.json"
	}
};



/*
	Função para excluir itens em massa de uma tabela.
	Recebe a tabela de origem do DataTables, a coluna do DataTables que contém 
	o id do item, um token de formulário e a rota do request para exclusão.
	Ex: exclusaoItensMassa ( 
			$('#exemplo').DataTable(), 
			colunaId,
			'CIwNZNlR4XbisJF39I8yWnWX9wX4WFoz', 
			'/exemplo/remover');
*/
function exclusaoItensMassa(tabela, colunaId, token, rota) {
	$('#remover').click( function () {
		let linhas = tabela.rows('.selected').data().length;
		let confirmacao = confirm(linhas + ' linha(s) selecionada(s). Remover item(ns)?');
		if (confirmacao) {
			let selecionados = tabela.rows('.selected').data();
			let arr_selecionados = [];
			for (let i = 0; i < linhas; i++) {
				arr_selecionados.push(selecionados[i][colunaId]); 
			}
	
			let sendData = '_token=' + token +
							'&ids=' + arr_selecionados.toString();
			
			postRequest(rota, sendData,
				undefined,
				function(response) {
					toastr.success(response.mensagem);
					setTimeout(function() { 
						window.location.reload();
					}, 3000);
				}
			);
		}
	});
	
}


/*
	Possibilita destacar/selecionar linhas da tabela de id = idTabela 
	para posteriormente realizar ações em massa, como deleção.
	Apenas <td class="selecionavel"></td> serão clicáveis.
*/
function adicionarClasseSelecionavel(idTabela) {
	
	$('#' + idTabela + ' tbody').on( 'click', 'td.selecionavel', function () {
		if (this.parentElement.classList.contains('selected')) {
			this.parentElement.classList.remove('selected');
		} else {
			this.parentElement.classList.add('selected');
		}
	});
}


/*
	Adiciona um campo de pesquisa no rodapé das colunas que tenham um elemento
		<th><input class="tfoot-search" type="text"></th>
	correspondente. Requer o id da tabela e o objeto do DataTables.
	Ex: campoPesquisaRodape('exemplo', $('#exemplo').DataTable());
*/
function campoPesquisaRodape(idTabela, tabela) {
	
	$('#' + idTabela + ' tfoot input').on( 'keyup change', function () {
		tabela
			.column( $(this).parent().index() + ':visible' )
			.search( this.value )
			.draw();
	});
	
}

