
function ajax_insert_produto(data) {
    var URLAJAX = "/api/produto";
    return axios.post(URLAJAX, data).then((response) => {
        return response;
    });
}


function ajax_update_produto(data,id) {
    var URLAJAX = "/api/produto/"+id;
    return axios.post(URLAJAX, data).then((response) => {
        return response;
    });
}

function insertProduto(idForm) {
    dados = $('#'+idForm).serialize();

    console.log(dados);
    ajax_insert_produto(dados)
        .then((response) => {
            window.location.href = "/produtos";
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


function updateProduto(idForm) {
    dados = $('#'+idForm).serialize() + '&_method=put';
    id = $('.id').val();
    ajax_update_produto(dados,id)
        .then((response) => {
            window.location.href = "/produtos";
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


function ajax_grid_produto(data) {
    sessionStorage.setItem("produto_dados", JSON.stringify(data));
    window.location.href =  "/novo_produto";
}