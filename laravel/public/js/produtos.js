function listaDados(tbl) {

    $.ajax({
        url: 'api/produtos',
        type: 'get',
    }).done(function (result) {
        tbl.clear();

        $.each(result, function (idx, obj) {
            const formatter = new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });

            var nome = obj.nome;
            var descricao = obj.descricao;
            var valorCompra = formatter.format(parseFloat(obj.valorCompra));
            var valorVenda = formatter.format(parseFloat(obj.valorVenda));;

            // monta o objeto com os campos
            // , para serem enviados para o datatable
            var row = {
                'Nome': nome,
                'Descricao': descricao,
                'ValorVenda': valorVenda,
                'ValorCompra': valorCompra,
                'actions': obj.id
            };

            tbl.row.add(row).draw();
        });

    })
}

function editar(id) {

    $.ajax({
        url: 'api/produtos/' + id,
        type: 'get',
        success: function (result) {

            if (result.code == 200) {
                var produto = result.data;

                const formatter = new Intl.NumberFormat('pt-BR', {
                    minimumFractionDigits: 2
                });

                var valorCompra = formatter.format(produto.valorCompra);
                var valorVenda = formatter.format(produto.valorVenda);

                $("#nome").val(produto.nome);
                $("#descricao").val(produto.descricao);
                $("#compra").val(valorCompra);
                $("#venda").val(valorVenda);
                $("#id").val(produto.id);

                $('a[href="#tab-content-form"]')[0].click();
            } else {
                alert('produto não Encontrado. Entre em contato com o suporte!')
            }

        }
    });
}

function excluir(id) {

    $.ajax({
        url: 'api/produtos/' + id,
        type: 'delete',
        success: function (result) {

            if (result.code == 200) {
                alert('Produto excluído com sucesso!')
            } else {
                alert('Produto não excluído. Entre em contato com o suporte!')
            }

            listaDados(tbl);
        }
    });
}

// função chamada para enviar os dados do
// formulário de cadastro/edição de produtos
function enviaDados() {

    var id = $("#id").val();
    var nome = $("#nome").val();
    var descricao = $("#descricao").val();
    var valorCompra = $("#compra").val().replace('.', '').replace(',', '.');
    var valorVenda = $("#venda").val().replace('.', '').replace(',', '.');

    var url = "";
    var type = "";
    if (id == '' || id == 0) {
        url = 'api/produtos';
        type = 'post';
    } else {
        url = 'api/produtos/' + id;
        type = 'put';
    }

    $.ajax({
        url: url,
        type: type,
        data: {
            nome: nome, descricao: descricao, valorCompra: valorCompra, valorVenda: valorVenda
        },
        success: function (result) {
            //cahama a função responsável por alimentar o Datatable
            listaDados(tbl);

            //muda o foco para a tab de listagem
            $('a[href="#tab-content-list"]')[0].click();
        }
    })
}


tbl = $("#tblListaProdutos").DataTable({
    destroy: true,
    'aoColumns': [
        { "data": "Nome" },
        { "data": "Descricao" },
        { "data": "ValorVenda" },
        { "data": "ValorCompra" },
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
})

listaDados(tbl);

$(document).ready(function () {
    $('#venda').mask('#.##0,00', { reverse: true });
    $('#compra').mask('#.##0,00', { reverse: true });

    // evento que controla a açõa do botão de editar
    $("#tblListaProdutos").on('click', '.editButton', function () {
        var id = $(this).attr('data-id');

        editar(id);
    });

    // evento que controla a açõa do botão de excluir
    $("#tblListaProdutos").on('click', '.deleteButton', function () {
        var id = $(this).attr('data-id');

        excluir(id);
    });

    // evento que limpa o formulário ao sair da tab do formulário
    $(".nav-item").on('click', '#tab-list', function () {
        $("#nome").val('');
        $("#descricao").val('');
        $("#venda").val('');
        $("#compra").val('');
        $("#id").val('');

        var forms = document.getElementsByClassName('needs-validation');

        var validation = Array.prototype.filter.call(forms, function (form) {
            form.classList.remove('was-validated');
        });
    })
})


// função chamada para validar o
// formulário de cadastro/edição de produtos antes do envio
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

$("document").ready(function () {
    // evento que controla a açõa do botão de editar
    $("#tblListaProdutos").on('click', '.editButton', function () {
        var id = $(this).attr('data-id');

        editar(id);
    });

    // evento que controla a açõa do botão de excluir
    $("#tblListaProdutos").on('click', '.deleteButton', function () {
        var id = $(this).attr('data-id');

        excluir(id);
    });

    // evento que controla a açõa do botão de ver pedidos
    $("#tblListaProdutos").on('click', '.verPedido', function () {
        var id = $(this).attr('data-id');

        window.location = 'pedidos/produtos/'+id;
    });
})
