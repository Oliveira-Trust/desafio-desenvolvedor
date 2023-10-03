@extends('auth.template.auth')

@section('content')

<div class="panel panel-color panel-primary panel-pages">
                <div class="panel-heading bg-img">
                    <div class="bg-overlay"></div>
                   <h3 class="text-center m-t-10 text-white"> Criar uma nova conta </h3>
                </div>


                <div class="panel-body">
                <form class="form-horizontal m-t-20" method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control input-lg{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                type="text" required="" placeholder="Nome" name="name" id="name"
                                value="{{ old('name') }}">
                        </div>

                        @if ($errors->has('name'))
                            <span class="field-error">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control input-lg{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                type="email" required="" placeholder="Email" name="email" id="email"
                                value="{{ old('email') }}">
                        </div>

                        @if ($errors->has('email'))
                            <span class="field-error">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control input-lg{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                 id="password" type="password" required="" placeholder="Senha"  name="password">
                        </div>

                        @if ($errors->has('password'))
                            <span class="field-error">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="password-confirm" type="password" class="form-control input-lg"
                                placeholder="Confirmar Senha" name="password_confirmation" id="password_confirmation"
                                required >
                        </div>
                    </div>


                    <div class="form-group ">
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-success">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup">
                                    Eu aceito <a href="#">os Termos e Condições deste Site</a>
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button class="btn btn-success waves-effect waves-light btn-lg w-lg" type="submit" id="registerBtn">
                                Registrar
                            </button>
                        </div>
                    </div>

                    <div class="form-group m-t-30">
                        <div class="col-sm-12 text-center">
                            <a href="{{ route('login') }}" id="loginLink">Já possui uma conta ?</a>
                        </div>
                    </div>
                </form>
                </div>

            </div>
@endsection

@section('js')
    <script src="{{ asset('assets/common/js/jquery.maskMoney.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#registerBtn').click(function() {
                $(this).text('carregando...').prop('disabled', true);

                // Submit the form or perform other actions
                $('#registerForm').submit();

                $('#name,#password,#password-confirm,#checkbox-signup,#registerBtn,#loginLink')
                    .prop('disabled', true);
            });
        });
    </script>
@endsection
