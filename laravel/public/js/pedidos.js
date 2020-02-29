function listaDados(tbl) {

    //consulta a API para trazer todos os pedidos
    $.ajax({
        url: 'api/pedidos',
        type: 'get',
    }).done(function (result) {
        tbl.clear();

        $.each(result, function (idx, obj) {

            const currencyFormatter = new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });

            //converte a string para um tipo Date válido
            var dataSplit = obj.dataCompra.split(' ')
            var date = dataSplit[0].split('-').reverse().join('/');
            var time = dataSplit[1].split(':').slice(0, -1).join(':');
            var dataCompra = date + ' ' + time;

            var valorTotal = currencyFormatter.format(parseFloat(obj.valorTotal));

            // monta o objeto com os campos
            // , para serem enviados para o datatable
            var row = {
                '#': obj.id,
                'Produto': { 'id': obj.produtos.id, 'nome': obj.produtos.nome, },
                'Cliente': { 'id': obj.clientes.id, 'nome': obj.clientes.nome, },
                'Data': dataCompra,
                'Status': obj.status,
                'Quantidade': obj.quantidade,
                'valorTotal': valorTotal,
                'actions': obj.id
            };

            tbl.row.add(row).draw();
        });

    });

    //consulta a API para trazer todos os produtos
    $.ajax({
        url: 'api/produtos',
        type: 'get',

    }).done(function (produtos) {

        //cria o primeiro option,
        // somente com texto e sem id
        $("#produto").append(new Option("Selecione um Produto", ""));

        //varre todos os produtos e cria um option para cada um
        $.each(produtos, function (idx, obj) {
            $('#produto').append(
                $('<option>')
                    .val(obj.id)
                    .text(obj.nome)
                    .attr('data-venda', obj.valorVenda)
            );
        })
    });

    //consulta a API para trazer todos os clientes
    $.ajax({
        url: 'api/clientes',
        type: 'get',

    }).done(function (clientes) {

        //cria o primeiro option,
        // somente com texto e sem id
        $("#cliente").append(new Option("Selecione um Cliente", ""));

        //varre todos os clientes e cria um option para cada um
        $.each(clientes, function (idx, obj) {
            $("#cliente").append(new Option(obj.nome, obj.id));
        });

        $("#cliente").select2({
            width: '100%',
            containerCssClass: ':all:'
        });
    });
}

function editar(id) {

    $.ajax({
        url: 'api/pedidos/' + id,
        type: 'get',
        success: function (result) {

            if (result.code == 200) {
                var pedido = result.data;

                //converte a string para um tipo Date válido
                var dataCompra = pedido.dataCompra.split('-').join('/');

                $("#produto").val(pedido.idProduto);
                $("#cliente").val(pedido.idCliente);
                $("#status").val(pedido.status);
                $("#quantidade").val(pedido.quantidade);
                $("#valorTotal").val(pedido.valorTotal);
                $("#dataCompra").val(dataCompra);
                $("#id").val(pedido.id);

                $('#cliente').trigger('change');


                $('a[href="#tab-content-form"]')[0].click();
            } else {
                alert('pedido não Encontrado. Entre em contato com o suporte!')
            }

        }
    });
}

function excluir(id) {

    $.ajax({
        url: 'api/pedidos/' + id,
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
// formulário de cadastro/edição de pedidos
function enviaDados() {
    const dateFormatter = Intl.DateTimeFormat('fr-ca', {
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric'
    });

    var re = new RegExp('/', 'g');

    var dataCompra = $("#dataCompra").val().split('/').join('-');
    // var dataCompra = splitDate[0] + '-' + splitDate[1]

    var id = $("#id").val();
    var produto = $("#produto").val();
    var cliente = $("#cliente").val();
    var quantidade = $("#quantidade").val();
    var valorTotal = $("#valorTotal").val().replace('.', '').replace(',', '.');
    var status = $("#status").val();
    // var dataCompra = dateFormatter.format(convertDate);

    var url = "";
    var type = "";
    if (id == '' || id == 0) {
        url = 'api/pedidos';
        type = 'post';
    } else {
        url = 'api/pedidos/' + id;
        type = 'put';
    }

    $.ajax({
        url: url,
        type: type,
        data: {
            idProduto: produto, idCliente: cliente, quantidade: quantidade, valorTotal: valorTotal, dataCompra: dataCompra, status:status
        },
        success: function (result) {
            //cahama a função responsável por alimentar o Datatable
            listaDados(tbl);

            //muda o foco para a tab de listagem
            $('a[href="#tab-content-list"]')[0].click();
        }
    })
}


tbl = $("#tblListaPedidos").DataTable({
    destroy: true,
    'aoColumns': [
        { "data": "#" },
        {
            "data": "Produto",
            'render': function (data, type, row, meta) {
                var data = '<a href="produtos/' + data.id + '"> ' + data.nome + '</a>';

                return data;
            }
        },
        {
            "data": "Cliente",
            'render': function (data, type, row, meta) {
                var data = '<a href="clientes/' + data.id + '"> ' + data.nome + '</a>';

                return data;
            }
        },
        { "data": "Data" },
        { "data": "Status" },
        { "data": "Quantidade" },
        { "data": "valorTotal" },
        {
            "data": 'actions',
            "render": function (data, type, row, meta) {

                var btnEdit = '<button class="mb-2 mr-2 btn btn-warning editButton" data-id="' + data + '" > <i class="fa fa-edit" style="color: white"></i> Editar </button>';
                var btnDelete = '<button class="mb-2 mr-2 btn btn-danger deleteButton" data-id="' + data + '" > <i class="fa fa-trash"></i> Excluir</button>';

                data = btnEdit + ' ' + btnDelete;
                return data;
            }
        }
    ]
})

listaDados(tbl);

// função chamada para validar o
// formulário de cadastro/edição de pedidos antes do envio
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

//função para calcular o valor total
//recebe o valor de venda e a quantidade
//exibe o resultado no campo readonly valorTotal
function calculaValorTotal(valorVenda, quantidade) {

    const formatter = Intl.NumberFormat('pt-BR', {
        type: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2
    })

    var valorTotal = valorVenda * quantidade;

    if (isNaN(valorTotal)) {
        $("#quantidade").val(1);
        $("#produto").val("");
        $("#valorTotal").val("");
    } else {

        $("#valorTotal").val(formatter.format(valorTotal));
    }

}

function teste() {
    $("#exampleModal").modal('show');
}

$("document").ready(function () {
    $("#dataCompra").datetimepicker({
        maxDate: new Date() //limita a data de compra até a data de hoje
    });

    // evento que controla a açõa do botão de editar
    $("#tblListaPedidos").on('click', '.editButton', function () {
        var id = $(this).attr('data-id');

        editar(id);
    });

    // evento que controla a açõa do botão de excluir
    $("#tblListaPedidos").on('click', '.deleteButton', function () {
        var id = $(this).attr('data-id');

        excluir(id);
    });

    $("#produto").change(function () {
        var valorVenda = $(this).find(':selected').data('venda')
        var quantidade = $("#quantidade").val();

        calculaValorTotal(valorVenda, quantidade);
    });

    $("#quantidade").keyup(function () {
        var valorVenda = $("#produto").find(':selected').data('venda');
        var quantidade = $(this).val();

        calculaValorTotal(valorVenda, quantidade);
    });

    // evento que limpa o formulário ao sair da tab do formulário
    $(".nav-item").on('click', '#tab-list', function () {
        $("#produto").val('');
        $("#cliente").val('');
        $("#status").val('');
        $("#quantidade").val('1');
        $("#valorTotal").val('');
        $("#dataCompra").val('');
        $("#id").val('');

        $("#cliente").trigger('change');
        var forms = document.getElementsByClassName('needs-validation');

        var validation = Array.prototype.filter.call(forms, function (form) {
            form.classList.remove('was-validated');
        });
    })
})
