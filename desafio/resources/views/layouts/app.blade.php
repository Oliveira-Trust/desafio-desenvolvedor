<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Desafio') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-sm navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/produtos') }}">
                    {{ config('app.name', 'Desafio') }}
                </a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="navbar-collapse collapse" id="navbarsExample03" style="">
                <ul class="navbar-nav ml-auto">
                    @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('listar_compras')}}">Compras</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('listar_produtos')}}">Produtos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('listar_clientes')}}">Clientes</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    @endguest
                </ul>
                </div>
            </div>
        </nav>

       

        <main class="py-4">
            @yield($current)
        </main>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">

    $(document).ready( function () {
        
        //Script DataTable de Produtos
        $('.yajra-datatable').dataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('listar_produtos') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nome', name: 'nome' },
            { data: 'valor', name: 'valor' },
            { data: 'quantidade', name: 'quantidade' },
            {data: 'action', name: 'action', orderable: false},
        ],
        order: [[0, 'desc']]
        });

        //Script DataTable de Clientes
        $('.cliente-datatable').dataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('listar_clientes') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'nome', name: 'nome' },
                { data: 'cpf', name: 'cpf' },
                { data: 'dt_nascimento', name: 'dt_nascimento' },
                { data: 'telefone', name: 'telefone' },
                { data: 'email', name: 'email' },
                {data: 'action', name: 'action', orderable: false},
            ],
            order: [[0, 'desc']]
        });

        //Script DataTable de Compras
        $('.compra-datatable').dataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('listar_compras') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'produto_nome', name: 'produto_nome' },
                { data: 'cliente_nome', name: 'cliente_nome' },
                { data: 'dt_compra', name: 'dt_compra' },
                { data: 'quantidade', name: 'quantidade' },
                { data: 'status', name: 'status' },
                {data: 'action', name: 'action', orderable: false},
            ],
            order: [[0, 'desc']]
        });

        //Alerta de Confirmação de exclusão de produto
        $(document).on('click', '.delete', function(){
            produto_id = $(this).attr('id');
            $('#confirmModal').modal('show');
            $('#ok_button').text('Excluir');
        });

        //Alerta de Confirmação de exclusão de cliente
        $(document).on('click', '.delete', function(){
            id = $(this).attr('id');
            $('#confirmModal').modal('show');
            $('#ok_buttonCliente').text('Excluir');
        });

        //Alerta de Confirmação de exclusão de compra
        $(document).on('click', '.delete', function(){
            id = $(this).attr('id');
            $('#confirmModal').modal('show');
            $('#ok_buttonCompra').text('Excluir');
        });


        //Exclusão de produtos
        $('#ok_button').click(function(){
            $.ajax({
                url:"produtos/destroy/"+produto_id,
                beforeSend:function(){
                    $('#ok_button').text('Excluindo...');
                },
                success:function(data)
                {
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        $('.yajra-datatable').DataTable().ajax.reload();
                        }, 2000);
                }
            })
        });

         //Exclusão de clientes
         $('#ok_buttonCliente').click(function(){
            $.ajax({
                url:"clientes/destroy/"+id,
                beforeSend:function(){
                    $('#ok_buttonCliente').text('Excluindo...');
                },
                success:function(data)
                {
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        $('.cliente-datatable').DataTable().ajax.reload();
                        }, 2000);
                }
            })
        });

        //Exclusão de compra
        $('#ok_buttonCompra').click(function(){
            $.ajax({
                url:"compras/destroy/"+id,
                beforeSend:function(){
                    $('#ok_buttonCompra').text('Excluindo...');
                },
                success:function(data)
                {
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        $('.compra-datatable').DataTable().ajax.reload();
                        }, 2000);
                }
            })
        });


        //Formulário de cadastro de um novo produto
        $('#create_record').click(function(){
            $('.modal-title').text('Cadastrar novo produto');
            $('#action_button').val('Cadastrar');
            $('#action').val('Add');
            $('#form_result').html('');
            $('#sample_form')[0].reset();
            $('#formModal').modal('show');
        });


        //Formulário de cadastro de um novo cliente
        $('#create_recordCliente').click(function(){
            $('.modal-title').text('Cadastrar novo cliente');
            $('#action_button').val('Cadastrar');
            $('#action').val('Add');
            $('#form_result_clientes').html('');
            $('#sample_form_clientes')[0].reset();
            $('#formModal').modal('show');
        });

        //Formulário de cadastro de uma nova compra
        $('#create_recordCompra').click(function(){
            $('.modal-title').text('Cadastrar nova compra');
            $('#action_button').val('Cadastrar');
            $('#action').val('Add');
            $('#form_result_compras').html('');
            $('#sample_form_compras')[0].reset();
            $('#formModal').modal('show');
        });


        //Script para abertura do model de edição de um produto
        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
            url :"/produtos/edit/"+id,
            dataType:"json",
            success:function(data)
            {
                $('#id').val(data.result.id);
                $('#nome').val(data.result.nome);
                $('#valor').val(data.result.valor);
                $('#quantidade').val(data.result.quantidade);
                $('#hidden_id').val(id);
                $('.modal-title').text('Editar produto');
                $('#action_button').val('Editar');
                $('#action').val('Edit');
                $('#formModal').modal('show');
            }
            })
        });

        //Script para abertura do model de edição de um cliente
        $(document).on('click', '.editCliente', function(){
            var id = $(this).attr('id');
            $('#form_result_clientes').html('');
            $.ajax({
            url :"/clientes/edit/"+id,
            dataType:"json",
            success:function(data)
            {
                $('#id').val(data.result.id);
                $('#nome').val(data.result.nome);
                $('#cpf').val(data.result.cpf);
                $('#dt_nascimento').val(data.result.dt_nascimento);
                $('#telefone').val(data.result.telefone);
                $('#email').val(data.result.email);
                $('#hidden_id').val(id);
                $('.modal-title').text('Editar cliente');
                $('#action_button').val('Editar');
                $('#action').val('Edit');
                $('#formModal').modal('show');
            }
            })
        });

        //Script para abertura do model de edição de um compra
        $(document).on('click', '.editCompra', function(){
            var id = $(this).attr('id');
            $('#form_result_compras').html('');
            $.ajax({
            url :"/compras/edit/"+id,
            dataType:"json",
            success:function(data)
            {
                $('#id').val(data.result.id);
                $('#produto_id').val(data.result.produto_id);
                $('#cliente_id').val(data.result.cliente_id);
                $('#quantidade').val(data.result.quantidade);
                $('#dt_compra').val(data.result.dt_compra);
                $('#hidden_id').val(id);
                $('.modal-title').text('Editar compra');
                $('#action_button').val('Editar');
                $('#action').val('Edit');
                $('#formModal').modal('show');
            }
            })
        });


        //Submit de informações de produtos
        $('#sample_form').on('submit', function(event){
            event.preventDefault();
            var action_url = '';

            if($('#action').val() == 'Add')
            {
            action_url = "{{ route('registrar_produto') }}";
            }

            if($('#action').val() == 'Edit')
            {
            action_url = "{{ route('editar_produto') }}";
            }

            $.ajax({
            url: action_url,
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function(data)
            {
                if(data.success)
                {
                     
                    $('.yajra-datatable').DataTable().ajax.reload();
                    $('#formModal').modal('hide');
                }
                $('#form_result').html(html);
            }
            });
        });


        //Submit de informações de clientes
        $('#sample_form_clientes').on('submit', function(event){
            event.preventDefault();
            var action_url = '';

            if($('#action').val() == 'Add')
            {
                action_url = "{{ route('registrar_cliente') }}";
            }

            if($('#action').val() == 'Edit')
            {
                action_url = "{{ route('editar_cliente') }}";
            }

            $.ajax({
            url: action_url,
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function(data)
            {
                if(data.success)
                {
                     
                    $('.cliente-datatable').DataTable().ajax.reload();
                    $('#formModal').modal('hide');
                }
                $('#form_result_cliente').html(html);
            }
            });
        });

        //Submit de informações de compras
        $('#sample_form_compras').on('submit', function(event){
            event.preventDefault();
            var action_url = '';

            if($('#action').val() == 'Add')
            {
                action_url = "{{ route('registrar_compra') }}";
            }

            if($('#action').val() == 'Edit')
            {
                action_url = "{{ route('editar_compra') }}";
            }

            $.ajax({
            url: action_url,
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function(data)
            {
                if(data.success)
                {
                     
                    $('.compra-datatable').DataTable().ajax.reload();
                    $('#formModal').modal('hide');
                }
                $('#form_result_compra').html(html);
            }
            });
        });
    });
    
</script>
</html>
