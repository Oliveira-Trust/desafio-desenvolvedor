@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detalhe de Produto</div>

                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>Id: {{$product->id}}</li>
                            <li>Nome: {{$product->name}}</li>
                            <li>Preço: {{$product->price}}</li>
                            <li>Obs.: {{$product->obs}}</li>
                            <li>Data de cadastro: {{$product->created_at->format('d/m/Y H:i')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
