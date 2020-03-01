function Login() {

    this.loginUser = function() {

        var form = $('#formLoginUser').serialize();

        returnData('controllers/UserController.php?acao=index', 'post', form);

        var json = response;

        if (json.status != undefined) {

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