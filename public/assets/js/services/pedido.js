
function ajax_insert_pedido(data) {
    var URLAJAX = "/api/pedido";
    return axios.post(URLAJAX, data).then((response) => {
        return response;
    });
}


function ajax_select_cliente() {
    var URLAJAX = "/api/cliente";
    return axios.get(URLAJAX).then((response) => {
        return response;
    });
}

function ajax_select_produto() {
    var URLAJAX = "/api/produto";
    return axios.get(URLAJAX).then((response) => {
        return response;
    });
}


function ajax_delete_pedido(data,id) {
    var URLAJAX = "/api/pedido/" + id;
    return axios.post(URLAJAX, data).then((response) => {
        return response;
    });
}


function ajax_update_pedido(data, id) {
    var URLAJAX = "/api/pedido/" + id;
    return axios.post(URLAJAX, data).then((response) => {
        return response;
    });
}




function insertPedido(idForm) {
    dados = $('#' + idForm).serialize();
    ajax_insert_pedido(dados)
        .then((response) => {
            window.location.href = "/pedidos";
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


function updatePedido(idForm) {
    dados = $('#' + idForm).serialize() + '&_method=put';
    id = $('.id').val();
    ajax_update_pedido(dados, id)
        .then((response) => {
           // window.location.href = "/pedidos";
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


function selectClienteProduto(ElementoSelect, acao) {
    if (ElementoSelect === "#select_cliente") {
        ajax_select_cliente().then((response) => {
            if (response.data) {
                $.each(response.data, function (index, value) {
                    $(ElementoSelect).append($("<option />").val(value['id']).text(value['nome']));
                });
            }
            if (acao != 'null') {
                $(ElementoSelect + " option[value='" + acao + "']").attr("selected", "selected");
            }
        });
    } else {
        ajax_select_produto().then((response) => {
            if (response.data) {
                $.each(response.data, function (index, value) {
                    $(ElementoSelect).append($("<option />").val(value['id']).text(value['nome_produto']));
                });
            }
            if (acao != 'null') {
                $(ElementoSelect + " option[value='" + acao + "']").attr("selected", "selected");
            }

        });
    }

}


function ajax_grid_pedido(data) {
    sessionStorage.setItem("pedido_dados", JSON.stringify(data));
    window.location.href = "/novo_pedido";
}


function deletePedido(data) {
    ids ='id='+data+'&_method=delete';
    ajax_delete_pedido(ids,data)
        .then((response) => {
          //  window.location.href = "/pedidos";
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