@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cadastrar Pedido</div>

                <div class="card-body">
                        <div id="divMessage" class="alert d-none"></div>
                    <form>
                        @csrf
                            <div class="form-row">
                                <div class="form-group col-sm-5">
                                    <label class="font-weight-bolder">Listagem de Produtos:</label>
                                    <select name="selProducts" id="selProducts" class="custom-select form-control-xs">
                                        <option value="" selected>Escolha...</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label class="font-weight-bolder">Quantidade:</label>
                                    <input type="text" name="txtQuantity" id="txtQuantity" class="form-control form-control-sm" value="" />
                                </div>
                                <div class="form-group col-sm-1">
                                    <label class="invisible mb-1">invisible</label>
                                    <button type="button" id="btnAddProduct" class="btn btn-sm btn-outline-primary" title="Inserir Produto">
                                        <i class="material-icons vertical-align-middle">add_box</i>
                                    </button>
                                </div>
                            </div>
                            <div id="divProductSelected">
                            </div>

                            <div class="form-group mt-3">
                                <div class="col-sm-4 offset-sm-8 text-md-right">
                                    <button type="button" id="btnSaveOrder" class="btn btn-sm btn-outline-primary">
                                        <i class="material-icons vertical-align-middle">done_all</i> Salvar
                                    </button>
                                    <a href="{{ route('formViewOrder') }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="material-icons vertical-align-middle">replay</i>Voltar
                                    </a> 
                                </div>
                            </div>
                            <input type="hidden" name="users_id" value="{{ auth()->user()->id }}" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/order/create.js') }}" type="text/javascript"></script>
<script>
    OrderCreate.init();
</script>
@endsection
