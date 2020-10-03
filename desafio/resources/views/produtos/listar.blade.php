@extends('layouts.app',['current' => 'produtos'])

@section('produtos')

<link href="{{ asset('css/produtos.css') }}" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Lista de Produtos</h2>
    <div class="row">
        <div class="col-12 text-center">
            <button type="button" name="create_record" id="create_record" class="btn btn-success">Cadastrar produto</button>
        </div>
    </div>
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Valor</th>
                <th>Quantidade</th>
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
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Confirmar</button>
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
             <h4 class="modal-title">Criar novo produto</h4>
           </div>
           <div class="modal-body">
            <span id="form_result"></span>
            <form method="post" id="sample_form" class="form-horizontal">
             @csrf
             <div class="form-group">
               <label class="control-label col-md-4" >Nome : </label>
               <div class="col-md-8">
                <input type="text" name="nome" id="nome" class="form-control" />
               </div>
              </div>
              <div class="form-group">
               <label class="control-label col-md-4">Valor : </label>
               <div class="col-md-8">
                <input type="text" name="valor" id="valor" class="form-control" />
               </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4">Quantidade : </label>
                <div class="col-md-8">
                 <input type="text" name="quantidade" id="quantidade" class="form-control" />
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