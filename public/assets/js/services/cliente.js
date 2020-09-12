
function ajax_insert_cliente(data) {
    var URLAJAX = "/api/cliente";
    return axios.post(URLAJAX, data).then((response) => {
        return response;
    });
}

function ajax_update_cliente(data,id) {
    var URLAJAX = "/api/cliente/"+id;
    return axios.post(URLAJAX, data).then((response) => {
        return response;
    });
}



function insertCliente(idForm) {
    dados = $('#'+idForm).serialize();
    ajax_insert_cliente(dados)
        .then((response) => {
            window.location.href = "/clientes";
            return true;
        })
        .catch(function (err) {
            if (err.response.status == 422) {
                msg = MontaMsgValidacao(err);
                alert(msg);
                return false;
            }
            alert("erro, tente novamente, mais tarde.");
            return false;
        });

}


function updateCliente(idForm) {
    dados = $('#'+idForm).serialize() + '&_method=put';
    id = $('.id').val();
    ajax_update_cliente(dados,id)
        .then((response) => {
            window.location.href = "/clientes";
           return true;
        })
        .catch(function (err) {
            if (err.response.status == 422) {
                msg = MontaMsgValidacao(err);
                alert(msg);
                return false;
            }
            alert("erro, tente novamente, mais tarde.");
            return false;
        });

}



function ajax_grid_cliente(data) {
    sessionStorage.setItem("cliente_dados", JSON.stringify(data));
    window.location.href =  "/novo_cliente";
}