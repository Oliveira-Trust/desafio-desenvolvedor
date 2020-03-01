function Login() {

    this.loginUser = function() {

        var form = $('#formLoginUser').serialize();

        returnData('controllers/UserController.php?acao=index', 'post', form);

        var json = response;

        if (json.status != undefined) {

            // Status 0 = Erro  -  Status 2 = Usuário não logado
            if (json.status == 0 || json.status == 2) {
                alert(json.msg);
            } else {
                window.location.href = '../views/purchaseOrderList.php';
            }

        } else {
            alert('Erro ao efetuar operação.');
        }
    }
}