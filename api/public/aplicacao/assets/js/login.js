/**
 * Realiza a autenticação do usuário
 */
$("#login").on("click", function(){
    if($("#username").val() == '' || $("#password").val() == ''){
        alert('Informe login e senha, por favor!');
        return;
    }
    $("#login").prop('disabled', true).val('Aguarde...');
    let url = 'http://localhost/oauth/token';
    $.post( url, {
    "grant_type": "password",
    "scope": "*",
    "client_id": "2",
    "client_secret": "1VUPQqxNSCVuYY00vhQ3obSTJeh5JpoAKipGwNOm",
    "username": $("#username").val(),
    "password": $("#password").val()
    }, function( data ) {
        $("#login").prop('disabled', false).html('Logar');
        if(data.access_token){
            localStorage.setItem('token', data.access_token);
            localStorage.setItem('logged', true);
            $(location).attr('href', '../admin/home.html');
        }
    }, "json").fail(function() {
        $("#login").prop('disabled', false).val('Logar');
        alert( "Login ou senha inválido!" );
    });
 }); 