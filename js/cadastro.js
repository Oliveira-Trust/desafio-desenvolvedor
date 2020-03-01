function Cadastro() {

    this.cadastrarUsuario = function() {
        
        var form = $('#formCadastroUser').serialize();

        returnData('controllers/UserController.php?acao=store', 'post', form);

        var json = response;

        if (json.status != undefined) {

            if (json.status == 0) {
                alert(json.msg);
            } else {
                alert('Usuário cadastrado com sucesso.');
                $('#name').val('');
                $('#email').val('');
                $('#password').val('');
            }

        } else {
            alert('Erro ao efetuar operação.');
        }

    }
}