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
                <h1 class="m-0 text-dark">Clientes</h1>
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
                    data-target="#modal_cliente">Cadastrar Novo Cliente</button>
                    
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped datatable table-responsive-lg">
                    <thead>
                        <th>Check</th>
                        <th>Codigo</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </thead>
                    <tbody>
                        @foreach($cliente as $cliente)
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input check_delete" name="{{$cliente->id}}" id="checkd_{{$cliente->id}}">
                                    <label class="custom-control-label" for="checkd_{{$cliente->id}}"></label>
                                  </div>            
                            </td>
                            <td>{{$cliente->id}}</td>
                            <td>{{$cliente->nome}}</td>
                            <td>
                                <a name="edit_district" class="btn btn-info btn-sm edit_cliente" data-toggle="modal"
                                    data-target="#modal_cliente" data-info="{{$cliente->id}}, {{$cliente->nome}}"><i
                                        class="fas fa-pencil-alt"></i> Editar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="modal fade" id="modal_cliente" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <form id="form_cliente" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 id="title" class="modal-title">Cadastrar Novo Cliente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body" style="overflow:hidden">
                            <input type="hidden" name="cliente_id" id="cliente_id">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" name="nome"
                                    placeholder="Nome do Cliente" value="" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" id="cliente_register" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </form>
            </div>
            <!-- /.modal-dialog -->
        </div>

        <script cliente="text/javascript" language="javascript">

            $('#deletar').on('click', function(){

                let ids = []

                $('.check_delete:checked').each(function(i, el){
                    ids.push(el.name)
                })
                window.location.assign(`/clientes/delete/${ids}`)
            })

            const modal_type = (type) => {

            if(type == 1){ //modal cadastro
                $('#form_cliente').attr('action', "clientes/create")
                $('#form_cliente').attr('method', "POST")
                $('#title').html('Cadastrar Novo Corretor') 
                $('#cliente_register').html('Cadastrar')
            }
            else{ //modal edit
                $('#form_cliente').attr('action', "/clientes/update/" + $('#cliente_id').val())
                $('#form_cliente').attr('method', "GET")
                $('#title').html('Editar Corretor') 
                $('#cliente_register').html('Salvar') 
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
            $('#modal_cliente').on('hide.bs.modal', function(){
                
                $('#form_cliente :input').each(function(){
                if(this.name != "_token"){
                    $(this).removeClass('is-valid')
                    $(this).removeClass('is-invalid')
                    $(this).val('')                                  
                }
                })

                modal_type(1)
                localStorage.setItem("modal_type", 1);
            })            
        }//Limpa os campos quando fecha a modal end


    {//trata campos editar
        $('.edit_cliente').on('click', function(){

            let values = $(this).data('info').split(',')

            values.forEach((val, i, el) => values[i] = val.trim())

            $('#cliente_id').val(values[0])
            $('#name').val(values[1])  
            modal_type(2)       
            localStorage.setItem("modal_type", 2);
            $('#modal_cliente').modal()

            
        })
    }

        </script>
        @endsection

