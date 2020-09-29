$('#quantity').mask('0#'); // Masrcará input
$('#price').mask('###.00', {reverse: true}); // Mascará input

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
		brand: {
			required: true
		},
		price: {
			required: true
        },
        quantity: {
			required: true
		}
	},
	messages: {
		name: {
			required: "Informe, por favor!"
		},
		brand: {
			required: "Informe, por favor!"
		},
		price: {
			required: "Informe, por favor!",
        },
        quantity: {
			required: "Informe, por favor!",
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
		let url = 'http://localhost/api/v1/products';
		let type = 'POST';
		if($('#id').val() != ''){
			url = 'http://localhost/api/v1/products/'+$('#id').val();
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
			"brand": $("#brand").val(),
            "price": $("#price").val(),
            "quantity": $("#quantity").val(),
		},
		headers: {
			'Authorization': 'Bearer '+localStorage.getItem('token'),
		},
		method: type,
		success: function(data){
			if(data){
				alert('Salvo com sucesso!');
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
			url: 'http://localhost/api/v1/products/'+$('#id').val(),
			headers: {
				'Authorization': 'Bearer '+localStorage.getItem('token'),
			},
			method: 'GET',
			success: function(data){
				$('#name').val(data.name);
				$('#brand').val(data.brand);
                $('#price').val(data.price);
                $('#quantity').val(data.quantity);
			}
		});
	}
});