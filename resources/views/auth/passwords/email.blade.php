@extends('site::layouts.login')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}">{{ config('app.name') }}</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">

            <div class="card-body login-card-body">
                <p class="login-box-msg">Você esqueceu sua senha? Aqui você pode facilmente recuperar uma nova senha.</p>
                {!! Form::open(['route' => 'password.email', 'method' => 'post','class'=>'submita-ajax']) !!}
                @include('baseadminlte3::layouts.partials.messages')

                @if(Session::has('status'))
                    <div class="alert alert-success pb-sm">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div> {{ Session::get('status') }}</div>
                    </div>
                @endif
                <div class="form-group">
                    <div class="input-group mb-3">
                        {!! Form::email('email', null, ['class' => 'form-control','placeholder' => 'Email','maxlength' => 255])!!}

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div data-field="email"></div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Solicitar Nova Senha</button>
                    </div>
                    <!-- /.col -->
                </div>
                {!! Form::close() !!}

                <p class="mt-3 mb-1">
                    <a href="{{ route('login') }}">Login</a>
                </p>
                {{--<p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p>--}}
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
