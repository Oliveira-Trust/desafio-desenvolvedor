// função chamada para pesquisar o endereço
// de acordo com o CEP digitado
function buscaCep() {
    var cep = $("#cep").val();

    $.get("https://apps.widenet.com.br/busca-cep/api/cep.json", { code: cep },
        function (result) {
            if (result.status != 200 && result.status != 1) {
                alert(result.message || "Houve um erro desconhecido");
                return;
            } else {
                $("#estado").val(result.state)
                $("#cidade").val(result.city)
                $("#bairro").val(result.district)
                $("#logradouro").val(result.address)
            }
        });
};

// função chamada para buscar os dados dos clientes
// e atualizar o Datatable
function listaDados(tbl) {
    $.ajax({
        url: "api/clientes/",
        type: "get",
    }).done(function (result) {
        tbl.clear();

        $.each(result, function (idx, obj) {
            //gera os campos com os daods que serão exibidos no datatable
            var nome = obj.nome;
            var sexo = (obj.sexo == 'M') ? "Masculino" : "Feminino";
            var endereco = obj.logradouro + ' ' + obj.numero + '. '
                + obj.bairro + ' - ' + obj.cidade + '/' + obj.estado + '. CEP:' + obj.cep;
            var email = obj.email;
            var telefone = (obj.telefone != "") ? obj.telefone + " / " + obj.celular : obj.celular;

            // monta o objeto com os campos
            // , para serem enviados para o datatable
            var row = {
                'Nome': nome,
                'Sexo': sexo,
                'Endereco': endereco,
                'Email': email,
                'Telefone': telefone,
                // 'actions': btnDelete + " | " + btnEdit
                'actions': obj.id
            };

            tbl.row.add(row).draw();
        });

    }).fail(function (result) {
        alert("An error occurred whilst getting the row detail.");
    });
}

// função chamada para enviar os dados do
// formulário de cadastro/edição de clientes
function enviaDados() {
    var id = $("#id").val();
    var nome = $("#nome").val();
    var email = $("#email").val();
    var senha = $("#senha").val();
    var telefone = $("#telefone").val();
    var celular = $("#celular").val();
    var cep = $("#cep").val();
    var estado = $("#estado").val();
    var cidade = $("#cidade").val();
    var bairro = $("#bairro").val();
    var logradouro = $("#logradouro").val();
    var numero = $("#numero").val();
    var complemento = $("#complemento").val();
    var sexo = $("input[name='sexo']:checked").val();

    var url = "";
    var type = "";
    if (id == '' || id == 0) {
        url = 'api/clientes';
        type = 'post';
    } else {
        url = 'api/clientes/' + id;
        type = 'put';
    }

    $.ajax({
        url: url,
        type: type,
        data: {
            nome: nome, email: email, senha: senha, telefone: telefone, celular: celular,
            cep: cep, estado: estado, cidade: cidade, bairro: bairro, logradouro: logradouro,
            numero: numero, complemento: complemento, sexo: sexo
        },
        success: function (result) {
            //cahama a função responsável por alimentar o Datatable
            listaDados(tbl);

            //muda o foco para a tab de listagem
            $('a[href="#tab-content-list"]')[0].click();
        }
    })
}

function excluir(id) {

    $.ajax({
        url: 'api/clientes/' + id,
        type: 'delete',
        success: function (result) {

            if (result.code == 200) {
                alert('Cliente excluído com sucesso!')
            } else {
                alert('Cliente não excluído. Entre em contato com o suporte!')
            }

            listaDados(tbl);
        }
    });
}

function editar(id) {

    $.ajax({
        url: 'api/clientes/' + id,
        type: 'get',
        success: function (result) {

            if (result.code == 200) {
                var cliente = result.data;

                $("#nome").val(cliente.nome);
                $("#email").val(cliente.email);
                $("#senha").val(cliente.senha);
                $("#telefone").val(cliente.telefone);
                $("#celular").val(cliente.celular);
                $("#cep").val(cliente.cep);
                $("#estado").val(cliente.estado);
                $("#cidade").val(cliente.cidade);
                $("#bairro").val(cliente.bairro);
                $("#logradouro").val(cliente.logradouro);
                $("#numero").val(cliente.numero);
                $("#complemento").val(cliente.complemento);
                $("#id").val(cliente.id);

                $("input[name=sexo][value=" + cliente.sexo + "]").attr('checked', 'checked');


                $('a[href="#tab-content-form"]')[0].click();
            } else {
                alert('Cliente não Encontrado. Entre em contato com o suporte!')
            }

        }
    });
}

// função chamada para validar o
// formulário de cadastro/edição de clientes antes do envio
function validaForm() {
    var forms = $('.needs-validation');

    // Loop pelo form para evitar o submit
    var validation = Array.prototype.filter.call(forms, function (form) {
        // validação nativa do bootstrap
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            // chamando a função responsável para
            // enviar os dados do formulário para a API
            enviaDados();
        }
        form.classList.add('was-validated');
    });
}


tbl = $("#tblListaClientes").DataTable({
    destroy: true,
    'aoColumns': [
        { "data": "Nome" },
        { "data": "Sexo" },
        { "data": "Endereco" },
        { "data": "Email" },
        { "data": "Telefone" },
        {
            "data": 'actions',
            "render": function (data, type, row, meta) {

                var btnVerPedidos = '<button class="mb-2 mr-2 btn btn-info verPedido" data-id="' + data + '" > <i class="fa fa-chart-pie"></i> Pedidos</button>';
                var btnEdit = '<button class="mb-2 mr-2 btn btn-warning editButton" data-id="' + data + '" > <i class="fa fa-edit" style="color: white"></i> Editar </button>';
                var btnDelete = '<button class="mb-2 mr-2 btn btn-danger deleteButton" data-id="' + data + '" > <i class="fa fa-trash"></i> Excluir</button>';

                data = btnVerPedidos + ' ' + btnEdit + ' ' + btnDelete;
                return data;
            }
        }
    ]
});

//chamada inicial para listar os dados ao carregar a página
listaDados(tbl);

$(document).ready(function () {
    // forma as máscaras dos campos
    $("#telefone").mask('(99)9999-9999');
    $("#celular").mask('(99)99999-9999');
    $("#cep").mask('99999-999');

    // evento que controla a açõa do botão de editar
    $("#tblListaClientes").on('click', '.editButton', function () {
        var id = $(this).attr('data-id');

        editar(id);
    });

    // evento que controla a açõa do botão de excluir
    $("#tblListaClientes").on('click', '.deleteButton', function () {
        var id = $(this).attr('data-id');

        excluir(id);
    });

    // evento que controla a açõa do botão de ver pedidos
    $("#tblListaClientes").on('click', '.verPedido', function () {
        var id = $(this).attr('data-id');

        window.location = 'pedidos/clientes/'+id;
    });


    // evento que limpa o formulário ao sair da tab do formulário
    $(".nav-item").on('click', '#tab-list', function () {
        $("#nome").val('');
        $("#email").val('');
        $("#senha").val('');
        $("#telefone").val('');
        $("#celular").val('');
        $("#cep").val('');
        $("#estado").val('');
        $("#cidade").val('');
        $("#bairro").val('');
        $("#logradouro").val('');
        $("#numero").val('');
        $("#complemento").val('');
        $("#id").val('');

        $("input[name=sexo]").attr('checked', false);

        var forms = document.getElementsByClassName('needs-validation');

        var validation = Array.prototype.filter.call(forms, function (form) {
            form.classList.remove('was-validated');
        });
    })
});
