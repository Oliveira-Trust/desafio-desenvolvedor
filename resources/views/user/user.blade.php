@extends('layouts.template')

@section('title', 'Usuário')

@section('content')

    <div class="container p-5">

        <div class="card">
            <div class="card-header">
                <h3>{{$user->name}}</h3>
            </div>
            <div class="card-body">
                <p>E-mail: {{$user->email}}</p>
                <p>Tipo de Usuário: {{$user->access}}</p>
            </div>
        </div>

    </div>

@endsection
