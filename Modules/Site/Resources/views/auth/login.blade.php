@extends('site::layouts.login')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}">{{ config('app.name') }}</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Faça login para iniciar sua sessão</p>
                {!! Form::open(['route' => 'login', 'method' => 'post','class'=>'submit-ajax']) !!}

                @include('baseadminlte3::layouts.partials.messages')
                <div class="form-group">
                    <div class="input-group">
                        <input name="identity" type="text" value="{{ request('email', 'admin@email.com.br') }}" class="form-control" placeholder="Email ou Usuário">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div data-field="identity"></div>
                    <div data-field="email"></div>
                    <div data-field="username"></div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <input name="password" type="password" value="12345679" class="form-control" placeholder="Senha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div data-field="password"></div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="checkbox-custom">
                            {!! Form::checkbox('remember', 1, null,['id'=>'remember']) !!}
                            <label for="remember">Lembrar-me</label>
                        </div>
                        {{--<div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">

                            </label>
                        </div>--}}
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                    </div>
                    <!-- /.col -->
                </div>
                {!! Form::close() !!}

            </div>

            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
