@extends('layouts.login')

@section('title', 'Login')

@section('content')

    <!-- Header -->
    <div class="header bg-gradient-danger py-7 py-lg-5 pt-lg-5">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        <h1 class="text-white">Alan Quidornne de Souza</h1>
                        <p class="text-lead text-white">Processo seletivo Oliveira Trust.</p>
                        <h2 class="text-white">Acesso com os dados abaixo</h2>
                        <p class="text-lead text-white"><b>E-mail:</b> aquidornne@gmail.com</p>
                        <p class="text-lead text-white"><b>Senha:</b> alan123</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>

    <!-- Page content -->
    <form class="form-horizontal form-material" method="POST" action="{{ route('login') }}">
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">

                            <div class="mb-3">
                                @include('includes.alerts')
                            </div>

                            {{ csrf_field() }}

                            <div class="form-group mb-3 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">Login</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
 
@endsection
