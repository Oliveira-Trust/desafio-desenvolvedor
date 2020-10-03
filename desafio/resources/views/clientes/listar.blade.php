@extends('layouts.app',['current' => 'clientes'])

@section('clientes')

<link href="{{ asset('css/produtos.css') }}" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Lista de Clientes</h2>
    <div class="row">
        <div class="col-12 text-center">
            <button type="button" name="create_recordCliente" id="create_recordCliente" class="btn btn-success cadastro">Cadastrar clientes</button>
        </div>
    </div>
    <table class="table table-bordered cliente-datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Data de Nascimento</th>
                <th>Telefone</th>
                <th>E-mail</th>
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
             <button type="button" name="ok_buttonCliente" id="ok_buttonCliente" class="btn btn-danger">Confirmar</button>
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
             <h4 class="modal-title">Criar novo cliente</h4>
           </div>
           <div class="modal-body">
            <span id="form_result"></span>
            <form method="post" id="sample_form_clientes" class="form-horizontal">
             @csrf
             <div class="form-group">
               <label class="control-label col-md-5" >Nome</label>
               <div class="col-md-8">
                <input type="text" name="nome" id="nome" class="form-control" />
               </div>
              </div>
              <div class="form-group">
               <label class="control-label col-md-5">CPF</label>
               <div class="col-md-8">
                <input type="text" name="cpf" id="cpf" class="form-control" />
               </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-5">Data de Nascimento</label>
                <div class="col-md-8">
                 <input type="text" name="dt_nascimento" id="dt_nascimento" class="form-control" />
                </div>
               </div>
               <div class="form-group">
                <label class="control-label col-md-5">Telefone</label>
                <div class="col-md-8">
                 <input type="text" name="telefone" id="telefone" class="form-control" />
                </div>
               </div>
               <div class="form-group">
                <label class="control-label col-md-5">E-mail</label>
                <div class="col-md-8">
                 <input type="text" name="email" id="email" class="form-control" />
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