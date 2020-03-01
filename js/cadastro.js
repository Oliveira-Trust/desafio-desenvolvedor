function Cadastro() {

    this.cadastrarUsuario = function() {
        
        var form = $('#formCadastroUser').serialize();

        returnData('controllers/UserController.php?acao=store', 'post', form);

        var json = response;

        if (json.status != undefined) {

            // Status 0 = Erro  -  Status 2 = Usuário não logado
            if (json.status == 0 || json.status == 2) {
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