@extends('layouts.app')

@section('conteudo')
    <div class="container">
        @if (count($errors) > 0)
            <div class="errors-container">
                <ul>
                    @foreach ($errors as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('acesso.login') }}">
            @csrf
            <img class="mb-4"
                src="https://media-exp1.licdn.com/dms/image/C560BAQGuHt16YEaIUg/company-logo_200_200/0/1519891669076?e=2159024400&v=beta&t=axsANvskLHBMH5-vBR_qO9KHo710E2-1YQrHF41bTXM"
                alt="" width="72" height="72">
            <h1 class="h3 mb-3 fw-normal">Acessar o sistema</h1>

            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword">
                <label for="floatingPassword">Senha</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Acessar</button>
        </form>
    </div>
@endsection
