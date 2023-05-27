//Initialize Select2 Elements
$(".select2").select2();
//Mask to BRL format
$("#valor").maskMoney();

function pagamento(valor, moeda,token){
	var mytoken = $(token).val(),
		myvalor = $(valor).val(),
		mymoeda = $(moeda).val();
		
		if(!myvalor){
			$("#aviso").html("<div class='col-sm-12'><div class='card' style='display:block;color:#fff;background:#D40000;border-radius: 5px; margin-bottom: 0; text-align: center;'><b> Informe um valor para conversão! </b></div></div>");
		
		} else if(!mymoeda){
			$("#aviso").html("<div class='col-sm-12'><div class='card' style='display:block;color:#fff;background:#D40000;border-radius: 5px; margin-bottom: 0; text-align: center;'><b> Informe a moeda qual o valor será convertido! </b></div></div>");

		}else{
			formattedNumber = myvalor,
			unformattedNumber = formattedNumber.replace(/\./g, '').replace(',', '.');
			if((unformattedNumber > 1000) && (unformattedNumber < 100000)){
				$.post('/pagamento', {_token: mytoken}, function(data){
					$("#aviso").html("");
					$('#conversao').html(data);
				});
			}else{
				$("#aviso").html("<div class='col-sm-12'><div class='card' style='display:block;color:#fff;background:#D40000;border-radius: 5px; margin-bottom: 0; text-align: center;'><b>O Valor informado deve ser entre 1.000,00 e 100.000,00 BRL</b></div></div>");
			}	
		}

}

function converter(valor, moeda, metodo_paganto, token){
	var real  = $(valor).val(),
		convertTo =	$(moeda).val(),
		metodoPaganto = $(metodo_paganto).val(),
		mytoken = $(token).val();
		if(!real){
			$("#aviso").html("<div class='col-sm-12'><div class='card' style='display:block;color:#fff;background:#D40000;border-radius: 5px; margin-bottom: 0; text-align: center;'><b> Informe um valor para conversão! </b></div></div>");
		
		} else if(!convertTo){
			$("#aviso").html("<div class='col-sm-12'><div class='card' style='display:block;color:#fff;background:#D40000;border-radius: 5px; margin-bottom: 0; text-align: center;'><b> Informe a moeda qual o valor será convertido! </b></div></div>");

		}else if(!metodoPaganto){
			$("#aviso").html("<div class='col-sm-12'><div class='card' style='display:block;color:#fff;background:#D40000;border-radius: 5px; margin-bottom: 0; text-align: center;'><b> Selecione o método de pagamento. </b></div></div>");

		}else{
			var dados_moeda = new FormData();
				dados_moeda.append('valor', real);
				dados_moeda.append('moeda', convertTo);
				dados_moeda.append('metodo_pagamento', metodoPaganto);
				dados_moeda.append('_token', mytoken);
				
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: '/converter',
					type: 'post',
					data: dados_moeda,
					async: false,
					cache: false,
					contentType: false,
					enctype: 'multipart/form-data',
					processData: false,
					success: function(response){
						$("#aviso").html("");
						$("#conversao").html(response);
					},
					error: function(response){
						$("#aviso").html(JSON.stringify(response));
					}
				});
			}
}


function createUser(nomeUser, emailUser, senhaUser, rpt_senhaUser, token){
	var nome      = $(nomeUser).val(),
		email     =	$(emailUser).val(),
		senha     = $(senhaUser).val(),
		rpt_senha = $(rpt_senhaUser).val(),
		mytoken   = $(token).val();

		if(!nome){
			$("#aviso").html("<div class='col-sm-12'><div class='card' style='display:block;color:#fff;background:#D40000;border-radius: 5px; margin-bottom: 0; text-align: center;'><b> Informe seu nome completo. </b></div></div>");
		
		} else if(!email){
			$("#aviso").html("<div class='col-sm-12'><div class='card' style='display:block;color:#fff;background:#D40000;border-radius: 5px; margin-bottom: 0; text-align: center;'><b> Informe seu e-mail. </b></div></div>");

		}else if(!senha){
			$("#aviso").html("<div class='col-sm-12'><div class='card' style='display:block;color:#fff;background:#D40000;border-radius: 5px; margin-bottom: 0; text-align: center;'><b> Informe uma senha. </b></div></div>");

		}else if(!rpt_senha){
			$("#aviso").html("<div class='col-sm-12'><div class='card' style='display:block;color:#fff;background:#D40000;border-radius: 5px; margin-bottom: 0; text-align: center;'><b> por favor repita a senha informada.</b></div></div>");
		
		}else if(rpt_senha != senha){
			$("#aviso").html("<div class='col-sm-12'><div class='card' style='display:block;color:#fff;background:#D40000;border-radius: 5px; margin-bottom: 0; text-align: center;'><b> As senhas devem ser iguais.</b></div></div>");
		
		}else{
			var dados_user = new FormData();
				dados_user.append('nome', nome);
				dados_user.append('email', email);
				dados_user.append('senha', senha);
				dados_user.append('_token', mytoken);
				
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: '/create-user',
					type: 'post',
					data: dados_user,
					async: false,
					cache: false,
					contentType: false,
					enctype: 'multipart/form-data',
					processData: false,
					success: function(response){
						$("#aviso").html("");
			
						setTimeout(
							function(){
	
								window.location.href = "/login";
							}, 5000);
					},
					error: function(response){
						$("#aviso").html(JSON.stringify(response));
					}
				});
			}
}