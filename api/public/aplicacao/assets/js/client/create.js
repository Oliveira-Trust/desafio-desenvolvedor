$('#telephone').mask('(00) 0000-000#'); // Masrcará input

/**
 * Define configuração de validação de campos
 */
$("#frm").validate({
	debug: false,
	errorClass: 'error',
	errorElement: 'p',
	errorPlacement: function(error, element) {
	  element.parents('.form-group').append(error);
	  var msg = $(element).next('.help-block').text();
	  $(element).attr('aria-label', msg );
	},
	highlight: function(element, errorClass){
	  $(element)
	  .attr('aria-invalid', true)
	  .parents('.form-group')
	  .addClass('has-error');
	},
	unhighlight: function(element, errorClass){
	  $(element).removeAttr('aria-invalid')
	  .removeAttr('aria-label')
	  .parents('.form-group').removeClass('has-error');
	},
	rules: {
		name: {
			required: true
		},
		telephone: {
			required: true
		},
		mail: {
			required: true
		}
	},
	messages: {
		name: {
			required: "Informe, por favor!"
		},
		telephone: {
			required: "Informe, por favor!"
		},
		mail: {
			required: "Informe, por favor!",
			email: "Informe um email válido, por favor!"
		}
	}
});

/**
 * Evento de salvar registro
 */
$("#save").on("click", function(event){
	event.preventDefault();
	if($("#frm").valid()){
		$(this).prop('disabled', true).html('Aguarde...');
		let url = 'http://localhost/api/v1/clients';
		let type = 'POST';
		if($('#id').val() != ''){
			url = 'http://localhost/api/v1/clients/'+$('#id').val();
			type = 'PUT';
		}
		createOrUpdate(url, type);	
	}
});

/**
 * Cadastra ou atualiza registro
 * @param {*} url para onde será submetido os dados
 * @param {*} type método: POST ou PUT
 */
function createOrUpdate(url, type){
	$.ajax({
		url: url,
		data: {
			"name": $("#name").val(),
			"telephone": $("#telephone").val(),
			"mail": $("#mail").val(),
		},
		headers: {
			'Authorization': 'Bearer '+localStorage.getItem('token'),
		},
		method: type,
		success: function(data){
			if(data){
				alert('Salva com sucesso!');
			}else{
				alert('Erro ao salvar!');
			}
			
			if(type == 'POST'){
				$('#id').val(data.id);
			}

			$("#save").prop('disabled', false).html('Salvar');
		}
	});
}

/**
 * Verifica se existe ID do registro, se existir carrega os dados
 */
$( document ).ready(function() {
    if($('#id').val() != ''){
		$.ajax({
			url: 'http://localhost/api/v1/clients/'+$('#id').val(),
			headers: {
				'Authorization': 'Bearer '+localStorage.getItem('token'),
			},
			method: 'GET',
			success: function(data){
				$('#name').val(data.name);
				$('#telephone').val(data.telephone);
				$('#mail').val(data.mail);
			}
		});
	}
});