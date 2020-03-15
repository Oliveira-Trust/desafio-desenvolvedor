@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifique seu endereço de e-mail</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Um link de verificação foi enviado para seu email
                        </div>
                    @endif

                    Por favor, verifique o link de verificação no seu email.

                        <br>
                        Não Recebeu?
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Clique aqui para enviar outro</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
