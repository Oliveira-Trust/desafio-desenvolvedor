/**
 * Verifica se já tem alguém autenticado, caso contrário redireciona para tela de login
 */
if(localStorage.getItem("token") == null || localStorage.getItem("logged") == false){
    $(location).attr('href', '../public/login.html');
}

/**
 * Pega o token de acesso
 */
$.ajax({
    url: "http://localhost/api/v1/profile",
    headers: {
        'Authorization': 'Bearer '+localStorage.getItem('token'),
    },
    method: 'GET',
    success: function(data){ 
        $('#user').html(data.user.name);
    }
});

/**
 * Deslogar do sistema
 */
$("#login_out").on("click", function(event){
    event.preventDefault();
    localStorage.removeItem('token');
    localStorage.removeItem('logged');
    $(location).attr('href', '../public/login.html');
 }); 

 menu();

/**
 * Configura o menu do sistema
 */
function menu(){
    $(".link_item").off("click");
    $(".link_item").on("click", function(event){ 
        event.preventDefault();
        let id = ($(this).attr('id_item') != undefined)? $(this).attr('id_item'): '';
        
        $.get( $(this).attr('url'), function( data ) {
            $( "#content" ).html( data );
            $( "#id" ).val( id );
            menu();
        });
    }); 
}