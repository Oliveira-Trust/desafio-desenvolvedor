@extends('auth.template.auth')

@section('content')
    <div class="panel panel-color panel-primary panel-pages">

        <div class="panel-heading bg-img">
            <div class="bg-overlay"></div>
            <h3 class="text-center m-t-10 text-white"> Verificar seu endereço de email </h3>
        </div>

        <div class="panel-body">

            @if (session('resent'))
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Um link de verificação foi enviado para seu endereço de email.
            </div>
            @endif

            Antes de prosseguir, favor confira se chegou no seu email o link de verificação.
            Se você não recebeu o email,<a href="{{ route('verification.resend') }}">Clique aqui para solicitar outro.</a>.
        </div>
    </div>
@endsection
