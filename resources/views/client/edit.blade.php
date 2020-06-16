@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Cliente</div>

                <div class="card-body">
                        <div id="divMessage" class="alert d-none"></div>
                    <form>
                        @csrf
                            <div class="form-row">
                                <div class="form-group col-sm-2">
                                    <label class="font-weight-bolder">ID:</label>
                                    <input type="text" name="txtId" id="txtId" class="form-control form-control-sm" value="" readonly required />
                                </div>
                                <div class="form-group col-sm-8">
                                    <label class="font-weight-bolder">Cliente:</label>
                                    <input type="text" name="name" id="txtName" class="form-control form-control-sm" value="" required />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-10">
                                    <label class="font-weight-bolder">E-mail:</label>
                                    <input type="email" name="email" id="txtEmail" class="form-control form-control-sm" value="" required />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-4">
                                    <label class="font-weight-bolder">Password:</label>
                                    <input type="password" name="password" class="form-control form-control-sm" value="" required />
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="font-weight-bolder">Password Confirmation:</label>
                                    <input type="password" name="password_confirmation" class="form-control form-control-sm" value="" required />
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <div class="col-sm-4 offset-sm-8 text-md-right">
                                    <button type="button" id="btnUpdateClient" class="btn btn-sm btn-outline-primary">
                                        <i class="material-icons vertical-align-middle">autorenew</i> Atualizar
                                    </button>
                                    <a href="{{ route('formViewClient') }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="material-icons vertical-align-middle">replay</i>Voltar
                                    </a> 
                                </div>
                            </div>
                            <input type="hidden" name="hdnUserId" id="hdnUserId" value="{{ $user_id }}" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/client/edit.js') }}" type="text/javascript"></script>
<script>
    ClientEdit.init();
</script>
@endsection
