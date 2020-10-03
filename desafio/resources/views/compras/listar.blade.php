@extends('layouts.app',['current' => 'compras'])

@section('compras')

<link href="{{ asset('css/produtos.css') }}" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Lista de Compras</h2>
    <div class="row">
        <div class="col-12 text-center">
            <button type="button" name="create_recordCompra" id="create_recordCompra" class="btn btn-success cadastro">Cadastrar nova compra</button>
        </div>
    </div>
    <table class="table table-bordered compra-datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Cliente</th>
                <th>Data de Compra</th>
                <th>Quantidade</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>


<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Confirmação</h3>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Deseja realmente excluir esse registro?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_buttonCompra" id="ok_buttonCompra" class="btn btn-danger">Confirmar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
    

<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title">Criar nova compra</h4>
           </div>
           <div class="modal-body">
            <span id="form_result"></span>
            <form method="post" id="sample_form_compras" class="form-horizontal">
             @csrf
             <div class="form-group">
               <label class="control-label col-md-5" >Produto</label>
               <div class="col-md-8">
                   <select name="produto_id" id="produto_id" class="form-control">
                        @foreach ($produtos as $p)
                        <option value="{{$p->id}}">{{$p->nome}}</option>
                        @endforeach
                   </select>
               </div>
              </div>
              <div class="form-group">
               <label class="control-label col-md-5">Cliente</label>
               <div class="col-md-8">
                <select name="cliente_id" id="cliente_id" class="form-control">
                    @foreach ($clientes as $c)
                    <option value="{{$c->id}}">{{$c->nome}}</option>
                    @endforeach
               </select>
               </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-5">Data da Compra</label>
                <div class="col-md-8">
                 <input type="text" name="dt_compra" id="dt_compra" class="form-control" />
                </div>
               </div>
               <div class="form-group">
                <label class="control-label col-md-5">Quantidade</label>
                <div class="col-md-8">
                 <input type="text" name="quantidade" id="quantidade" class="form-control" />
                </div>
               </div>
               <div class="form-group">
                <label class="control-label col-md-5">Status</label>
                <div class="col-md-8">
                    <select name="status" id="status" class="form-control">
                        <option value="pendente">Pendente</option>
                        <option value="cancelado">Cancelado</option>
                        <option value="concluido">Concluído</option>
                    </select>
                </div>
               </div>
                   <br />
                   <div class="form-group" align="center">
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                   </div>
            </form>
           </div>
        </div>
       </div>
   </div>

@endsection