@extends('layouts.app-public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center py-5">
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
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header h4">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route($userLogin) }}" aria-label="{{ __('Login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail') }}
                                </label>
                                <?php
                                $isAdmin = preg_match('#admin#s', url()->current());
                                ?>
                                <div class="col-md-5">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : ''}}"
                                           name="email"
                                           value="{{ ($isAdmin ? 'administrador@system-admin.com' : 'customer02@gmail.com') }}"
                                           required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}
                                </label>

                                <div class="col-md-5">
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           value="secret"
                                           name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <?php if(false): ?>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="form-group row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-check text-right">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
                                        {{--                                        <a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                        {{--                                            {{ __('Forgot Your Password?') }}--}}
                                        {{--                                        </a>--}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
