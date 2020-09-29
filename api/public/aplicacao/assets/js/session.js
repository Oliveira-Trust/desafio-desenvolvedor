/*
* Verifica se já existe usuário logado
*/
function verifySession(){ 
    if(localStorage.getItem("token") === null && localStorage.getItem("logged") !== true){
        $(location).attr('href', 'public/login.html');
    }else{
        $(location).attr('href', 'admin/home.html');
    }
}