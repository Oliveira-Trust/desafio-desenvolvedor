@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Visualizar Produtos</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 offset-sm-8 text-md-right">
                            <a href="/productt/create" class="btn btn-sm btn-primary">
                                <i class="material-icons vertical-align-middle">note_add</i> Novo Produto
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
                                        <th>Produto</th>
                                        <th>Descrição</th>
                                        <th>Valor</th>
                                        <th>Data Inclusão</th>
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
<script src="{{ asset('js/product/view.js') }}" type="text/javascript"></script>
<script>
    ProductView.init();
</script>
@endsection
