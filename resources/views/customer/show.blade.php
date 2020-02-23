@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detalhe de Cliente</div>

                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>Id: {{$customer->id}}</li>
                            <li>Nome: {{$customer->name}}</li>
                            <li>Email: {{$customer->email}}</li>
                            <li>CPF: {{$customer->cpf}}</li>
                            <li>Data de cadastro: {{$customer->created_at->format('d/m/Y H:i')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
