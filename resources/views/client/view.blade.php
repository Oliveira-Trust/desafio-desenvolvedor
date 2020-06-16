@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Visualizar Clientes</div>

                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-sm-2">
                            <label class="font-weight-bolder">Cliente:</label>
                            <input type="text" name="name" id="txtName" class="form-control form-control-sm" value="" />
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="font-weight-bolder">E-mail:</label>
                            <input type="text" name="email" id="txtEmail" class="form-control form-control-sm" value="" />
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-sm-3">
                            <button type="button" id="btnSearch" class="btn btn-sm btn-primary">
                                <i class="material-icons vertical-align-middle">search</i>Pesquisar
                            </button>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-12 table-responsive-sm">
                            <table class="table table-sm table-striped table-bordered table-hover nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Opções</th>
                                        <th>Id</th>
                                        <th>Nome</th>
                                        <th>Email</th>
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
<script src="{{ asset('js/client/view.js') }}" type="text/javascript"></script>
<script>
    ClientView.init();
</script>
@endsection
