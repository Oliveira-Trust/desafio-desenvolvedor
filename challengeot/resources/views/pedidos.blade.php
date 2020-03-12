@extends('adminlte::page')
@section('content_header')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@endsection
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pedidos</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="card card-solid">
            <div class="card-header">
                <button type="button" class="btn btn-danger float-right" id="deletar">Deletar Selecionados</button>
                <button type="button" class="btn btn-default float-right" data-toggle="modal"
                    data-target="#modal_pedido">Cadastrar Novo Pedido</button>

            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped datatable table-responsive-lg">
                    <thead>
                        <th>Check</th>
                        <th>Codigo</th>
                        <th>Cliente</th>
                        <th>Status</th>
                        <th>Valor Total</th>
                        <th>Ações</th>
                    </thead>
                    <tbody>
                        @foreach($pedido as $pedido)
                            @php                            
                                $totalpedido = 0;
                                $produtoqtd = [];
                                $produtos = [];
                            
                                foreach($pedido->getProdutosPed as $prodpedido){

                                    $produtos[] = ['produto_id' => $prodpedido->produto_id, 'quantidade' => $prodpedido->quantidade];                                
                                    $totalpedido = $totalpedido + ($prodpedido->getProduto->preco * $prodpedido->quantidade);
                                }
                                $produtoqtd[] = ['pedido_id' => $pedido->id, 'produtos' => $produtos];
                                
                                $pedidodetalhe = json_encode($produtoqtd);
                                //dd($pedidodetalhe, $produtoqtd);
                            @endphp
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input check_delete"
                                            name="{{$pedido->id}}" id="checkd_{{$pedido->id}}">
                                        <label class="custom-control-label" for="checkd_{{$pedido->id}}"></label>
                                    </div>
                                </td>
                                <td>{{$pedido->id}}</td>
                                <td>{{$pedido->getCliente->nome}}</td>
                                <td>{{$pedido->status}}</td>
                                <td>{{$totalpedido}}</td>
                                <td>
                                    <a name="edit_district" class="btn btn-info btn-sm edit_pedido" data-toggle="modal"
                                        data-target="#modal_pedido" data-info="{{$pedido->id}}, {{$pedido->cliente_id}}, {{$pedido->status}}" data-pedido="{{$pedidodetalhe}}"><i
                                            class="fas fa-pencil-alt"></i> Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="modal fade" id="modal_pedido" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <form id="form_pedido" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 id="title" class="modal-title">Cadastrar Novo Pedido</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body" style="overflow:hidden">
                            <input type="hidden" name="pedido_id" id="pedido_id">
                            <div class="form-group">
                                <label for="cliente">Cliente</label>
                                <select name="cliente" id="cliente" class="form-control" required>
                                    <option value="0" hidden>Cliente...</option>
                                    @foreach($cliente as $cliente)
                                    <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="" hidden>Selecione...</option>
                                    <option value="Aberto">Aberto</option>
                                    <option value="Pago">Pago</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
                            </div>

                            <div class="form-group">

                                <table class="table table-striped">

                                    <thead>
                                        <th>Produto</th>
                                        <th>Preço Un</th>
                                        <th>Quantidade</th>
                                    </thead>
                                    <tbody>
                                        @foreach($produto as $produto)
                                        <tr>
                                            <td>{{$produto->nome}}</td>
                                            <td>{{$produto->preco}}</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="number" class="form-control produto_qtd" name="produto_{{$produto->id}}" min="0" id="produto_{{$produto->id}}">
                                                </div>
                                                
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" id="pedido_register" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </form>
            </div>
            <!-- /.modal-dialog -->
        </div>

        <script pedido="text/javascript" language="javascript">
            $('#deletar').on('click', function(){

                let ids = []

                $('.check_delete:checked').each(function(i, el){
                    ids.push(el.name)
                })
                window.location.assign(`/pedidos/delete/${ids}`)
            })

            const modal_type = (type) => {

            if(type == 1){ //modal cadastro
                $('#form_pedido').attr('action', "pedidos/create")
                $('#form_pedido').attr('method', "POST")
                $('#title').html('Cadastrar Novo Pedido') 
                $('#pedido_register').html('Cadastrar')
            }
            else{ //modal edit
                $('#form_pedido').attr('action', "/pedidos/update/" + $('#pedido_id').val())
                $('#form_pedido').attr('method', "GET")
                $('#title').html('Editar Pedido') 
                $('#pedido_register').html('Salvar') 
            }
        }; //end modal_type

            jQuery(document).ready(function () {

                localStorage.setItem("modal_type", 1)

                $('.datatable').DataTable({
                    paging: false,
                    "language": {
                        "search": "Pesquisar",
                        "lengthMenu": "Registros Por Pagina",
                        "zeroRecords": "Nenhum Registro Encontrado",
                        "info": "Exibindo a pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "Nenhum Registro Encontrado",
                        "infoFiltered": "(Filtrando _MAX_ registros)"
                    },
                })

                modal_type(localStorage.getItem("modal_type"))
            })

        {//Limpa os campos quando fecha a modal 
            $('#modal_pedido').on('hide.bs.modal', function(){

                console.log('alo')
                
                $('#form_pedido :input').each(function(){
                if(this.name != "_token"){
                    console.log($(this))
                    $(this).val('')                                  
                }
                })

                modal_type(1)
                localStorage.setItem("modal_type", 1);
            })            
        }//Limpa os campos quando fecha a modal end


    {//trata campos editar
        $('.edit_pedido').on('click', function(){

            let values = $(this).data('info').split(',')

            let protudospedido = $(this).data('pedido')

            protudospedido = protudospedido[0]

            for(produto of protudospedido.produtos){
                $(`#produto_${produto.produto_id}`).val(produto.quantidade)
            }


            values.forEach((val, i, el) => values[i] = val.trim())

            console.log(values[2])

            $('#pedido_id').val(values[0])
            $('#cliente').val(values[1])  
            $('#status').val(values[2])  
            modal_type(2)       
            localStorage.setItem("modal_type", 2);
            $('#modal_pedido').modal()            
        })
    }
        </script>
        @endsection