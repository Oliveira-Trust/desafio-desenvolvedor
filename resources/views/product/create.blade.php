@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cadastrar Produto</div>

                <div class="card-body">
                        <div id="divMessage" class="alert d-none"></div>
                    <form>
                        @csrf
                            <div class="form-row">
                                <div class="form-group col-sm-10">
                                    <label class="font-weight-bolder">Produto:</label>
                                    <input type="text" name="title" id="txtTitle" class="form-control form-control-sm" value="" required />
                                </div>
                                <div class="form-group col-sm-2">
                                    <label class="font-weight-bolder">Preço:</label>
                                    <input type="text" name="price" id="txtPrice" class="form-control form-control-sm" value="" required />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-12">
                                    <label class="font-weight-bolder">Descrição</label>
                                    <textarea class="form-control" name="description" id="txtDescription" rows="4" required></textarea>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <div class="col-sm-4 offset-sm-8 text-md-right">
                                    <button type="button" id="btnSaveProduct" class="btn btn-sm btn-outline-primary">
                                        <i class="material-icons vertical-align-middle">done_all</i> Salvar
                                    </button>
                                    <a href="{{ route('formViewProduct') }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="material-icons vertical-align-middle">replay</i>Voltar
                                    </a> 
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/product/create.js') }}" type="text/javascript"></script>
<script>
    ProductCreate.init();
</script>
@endsection
