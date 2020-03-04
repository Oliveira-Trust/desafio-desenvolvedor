@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cadastro de produto</div>

                    <div class="card-body">
                        @if (!empty($savedReturn["success"]))
                            <div class="alert alert-success" role="alert">
                                {{ $savedReturn["success"] }}
                            </div>
                        @endif
                        <form method="post" action="{{route('cliente.salvar')}}">
                            @csrf
                            <input type="hidden" name="productID" value="{{empty($client["id"])?"":$client["id"]}}">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" name="name" class="form-control" placeholder="Nome do Cliente" required value="{{empty($client["name"])?"":$client["name"]}}">
                            </div>
                            <div class="form-group">
                                <label>Ean</label>
                                <input type="email" name="email" placeholder="Email" class="form-control" required value="{{empty($client["email"])?"":$client["email"]}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
