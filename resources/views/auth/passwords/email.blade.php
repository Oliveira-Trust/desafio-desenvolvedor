@extends('auth.template.auth')

@section('content')

    <div class="panel panel-color panel-primary panel-pages">

        <div class="panel-heading bg-img">
            <div class="bg-overlay"></div>
            <h3 class="text-center m-t-10 text-white"> Resetar Senha </h3>
        </div>

        <div class="panel-body">
            <form method="POST" action="{{ route('password.email') }}" role="form" class="text-center">
                @csrf

                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                    @if (session('status'))
                        {{ session('status') }}
                    @else
                        Informe o seu <b>Email</b> e instruções serão enviadas para você!
                    @endif
                </div>

                <div class="form-group m-b-0">
                    <div class="input-group">
                        <input type="email" class="form-control input-lg{{ $errors->has('email') ? ' is-invalid' : ''}}"
                            name="email" value="{{ old('email') }}" required="" placeholder="Informe o email...">

                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-lg btn-success waves-effect waves-light">
                                Resetar
                            </button>
                        </span>

                    </div>

                    @if ($errors->has('email'))
                        <span class="field-error">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

            </form>

        </div>

    </div>

@endsection
