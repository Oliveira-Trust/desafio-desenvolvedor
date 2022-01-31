@extends('layouts.app-public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center py-5">
                <img src="{{url('dist/img/logo-texto.png')}}">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-4">
                <a class="btn btn-info btn-block" href="{{route('admin.login-form')}}">
                    Área do Administrador
                </a>
            </div>
            <div class="col-sm-12 col-md-4">
                <a class="btn btn-info btn-block" href="{{route('customer.login-form')}}">
                    Área do Cliente
                </a>
            </div>
        </div>
    </div>
@endsection
