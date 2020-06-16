@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Visualizar Pedidos</div>

                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-sm-2">
                            <label class="font-weight-bolder">Cliente:</label>
                            <input type="text" name="user" id="txtUser" class="form-control form-control-sm" value="" />
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="font-weight-bolder">Total:</label>
                            <input type="text" name="total" id="txtTotal" class="form-control form-control-sm" value="" />
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="font-weight-bolder">Status</label>
                            <select name="selStatus" id="selStatus" class="custom-select form-control-xs">
                                <option value="" selected>Todos...</option>
                                <option value="1">Em Aberto</option>
                                <option value="2">Pago</option>
                                <option value="3">Cancelado</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-sm-3">
                            <button type="button" id="btnSearch" class="btn btn-sm btn-primary">
                                <i class="material-icons vertical-align-middle">search</i>Pesquisar
                            </button>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 offset-sm-8 text-md-right">
                            <a href="{{ route("formCreateOrder") }}" class="btn btn-sm btn-dark">
                                <i class="material-icons vertical-align-middle">note_add</i> Novo Pedido
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 table-responsive-sm">
                            <table class="table table-sm table-striped table-bordered table-hover nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Opções</th>
                                        <th>Id</th>
                                        <th>Cliente</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <nav id="paginationNav">
                        <ul class="pagination"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/order/view.js') }}" type="text/javascript"></script>
<script>
    OrderView.init();
</script>
@endsection
