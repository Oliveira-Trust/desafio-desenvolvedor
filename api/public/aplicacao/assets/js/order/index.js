var table = $('#list').DataTable();

/**
 * Se existe ID do cliente carrega os dados
 */
$( document ).ready(function() {
    if($('#id').val() != ''){
		loadList();
	}
});

/**
 * Carrega dados do cliente e os produtos pedidos para ele
 */
function loadList(){ 
    $.ajax({
        url: 'http://localhost/api/v1/clients/'+$('#id').val()+'/orders',
        headers: {
            'Authorization': 'Bearer '+localStorage.getItem('token'),
        },
        method: 'GET',
        success: function(data){
            $('#client').html(data.client.name);
            $('#client_id').val(data.client.id);
            let content = '';
            loadComboProducts(data.products);
            table.destroy();
            $.each(data.orders, function() {
                content += `
                <tr>
                <td class="name${this.pivot.id}">${this.name}</td>
                <td class="status${this.pivot.id}">${this.pivot.status}</td>
                <td class="quantity${this.pivot.id}">${this.pivot.quantity}</td>
                <td>
                    <a href="#" class="edit" id="${this.pivot.id}" product_id="${this.pivot.product_id}">Editar</a>&nbsp&nbsp
                    <a href="#" class="delete" id="${this.pivot.id}">Apagar</a>
                    </td>
                </tr>
                `;
            });
            $("#result").html(content);
            
            table = $('#list').DataTable();
            menu();
            edit();
            deleteItem();
        }
    });
}

/**
 * Define evento de edição
 */
function edit(){
    $(".edit").off("click");
    $(".edit").on("click", function(event){
        event.preventDefault(); 
        $('#order_id').val($(this).attr('id'));
        $('#product_id').val($(this).attr('product_id'));
        $('#status').val($('.status'+$(this).attr('id')).html());
        $('#quantity').val($('.quantity'+$(this).attr('id')).html());
    });
}

/**
 * Define evento de remover registro
 */
function deleteItem(){
    $(".delete").off("click");
    $(".delete").on("click", function(event){
        event.preventDefault();
        let r = confirm('Deseja remover item?');
        if(r){
            let url = 'http://localhost/api/v1/orders/'+$(this).attr('id');
            $.ajax({
                url: url,
                data: {
                    "_method": "delete"
                },
                headers: {
                    'Authorization': 'Bearer '+localStorage.getItem('token'),
                },
                method: 'POST',
                success: function(data){
                    if(data){
                        alert('Apagado com sucesso!');
                    }else{
                        alert('Erro ao apagar!');
                    }
                    loadList();
                }
            });
        }
    });
}

/**
 * Preenche combo de produtos
 * @param {*} products todos os produtos da base
 */
function loadComboProducts(products){
    $('#product_id').html('');
    let content = '';
    $.each(products, function() {
        content += `<option value="${this.id}">${this.name}</option>`;
    });
    $('#product_id').html(content);
}

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
		quantity: {
			required: true
		}
	},
	messages: {
		quantity: {
			required: "Informe, por favor!"
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
		let url = 'http://localhost/api/v1/orders';
		let type = 'POST';
		if($('#order_id').val() != ''){
			url = 'http://localhost/api/v1/orders/'+$('#order_id').val();
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
            "client_id": $("#client_id").val(),
            "product_id": $("#product_id").val(),
            "status": $("#status").val(),
			"quantity": $("#quantity").val(),
		},
		headers: {
			'Authorization': 'Bearer '+localStorage.getItem('token'),
		},
		method: type,
		success: function(data){
			if(data){
				alert('Salva com sucesso');
			}else{
				alert('Erro ao salvar');
			}
			
			//if(type == 'POST'){
			//	$('#id').val(data.id);
            //}
            $('#order_id, #quantity').val('');
            loadList();
			$("#save").prop('disabled', false).html('Salvar');
		}
	});
}