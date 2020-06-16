@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Visualizar Produtos</div>

                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-sm-2">
                            <label class="font-weight-bolder">Produto:</label>
                            <input type="text" name="title" id="txtTitle" class="form-control form-control-sm" value="" />
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="font-weight-bolder">Descrição</label>
                            <input type="text" name="description" id="txtDescription" class="form-control form-control-sm" value="" />
                        </div>
                        <div class="form-group col-sm-1">
                            <label class="font-weight-bolder">Valor</label>
                            <input type="text" name="price" id="txtPrice" class="form-control form-control-sm" value="" />
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
                            <a href="/productt/create" class="btn btn-sm btn-dark">
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
