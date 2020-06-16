@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Detalhamento do Pedido</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 offset-sm-8 text-md-right">
                            <a href="{{ route("formViewOrder") }}" class="btn btn-sm btn-outline-secondary">
                                <i class="material-icons vertical-align-middle">replay</i> Voltar
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-sm-12 table-responsive-sm">
                            <table class="table table-sm table-striped table-bordered table-hover nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Produto</th>
                                        <th>Descrição</th>
                                        <th>Valor</th>
                                        <th>Quantidade</th>
                                        <th>Data Inclusão</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" name="hdnOrderId" id="hdnOrderId" value="{{ $idOrder }}" />
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
<script src="{{ asset('js/order/detail.js') }}" type="text/javascript"></script>
<script>
    OrderDetail.init();
</script>
@endsection
