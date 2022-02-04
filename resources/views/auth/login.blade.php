@extends('layouts.sb-admin-2.login.corpo')
@section('content')
<div class="card-body p-0">
    <div class="row">
        <div class="col-lg-12  ">
            <div class="pt-4">
                <div class="sidebar-brand d-flex align-items-center justify-content-center text-secondary">
                    <div class="sidebar-brand-text font-black-ops-one " >
                        <h3>
                            Oliveira Trust
                        </h3>
                    </div>
                    <div class=" pl-2">
                        <h4>
                            <i class=" text-dark fas fa-money-bill fa-lg" ></i>
                        </h4>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <div class="col-lg-12  ">
            <div class="p-4">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bem vindo!</h1>
                </div>
                @if ($errors->any())
                    <div id="flashMessage" class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                        @foreach ($errors->all() as $error)
                            {{ $error }} 
                        @endforeach
                    </div>
                @endif
                <form class="user" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <div class="form-group col-md-12 required">
                            <label for="nome">E-mail</label>
                            <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror" id="username" aria-describedby="emailHelp" placeholder="Entre com usúario ou e-email" name="username" value="{{ old('username') }}" required  autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group col-md-12 required">
                            <label for="nome">Senha</label>
                            <input type="password" id="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"  placeholder="*********">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                        </div>
                    </div> -->
                    <button type="submit" class="btn btn-secondary btn-block">
                        {{ __('Entrar') }}
                    </button>
                </form>
                <hr>
                @if (Route::has('password.request'))
                    <!-- <div class="text-center">
                        <a class="small text-info" href="{{ route('password.request') }}">Esqueci minha senha</a>
                    </div> -->
                @endif
                @if (Route::has('register'))
                <div class="text-center">
                    <a class="small text-dark" href="<?php echo url('cadastrar') ?>">Cadastrar</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 
