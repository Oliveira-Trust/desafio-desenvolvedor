@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header">{{ __('Introdução') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="mb-4">
                        <h2>Seja bem-vindo(a), {{ \Illuminate\Support\Facades\Auth::user()->name }}!</h2>
                        <p>Este desafio foi desenvolvido para a vaga Desenvolvedor PHP Júnior da empresa <a href="https://www.oliveiratrust.com.br" target="_blank" class="text-bg-danger px-1 rounded-2">Oliveira Trust</a></p>
                    </div>
                    <div>
                        <a class="btn btn-dark" href="{{ route('cambio.index') }}">Iniciar Sistema</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Sobre mim...') }}</div>

                <div class="card-body">
                    <div class="mb-4">
                        <h5>Prazer, sou o João Vitor Santos!</h5>
                        <p>Tenho 20 anos, atuo como Desenvolvedor Full-Stack para uma consultoria de softwares. Comecei meus estudos na área de TI no começo de 2020, quando passei no processo seletivo para realizar o ensino médio integrado ao ensino técnico de Informática para Internet pela ETEC. Hoje estou cursando Análise e Desenvolvimento de Sistemas pela FIAP (Av. Paulista). Pretendo evoluir muito na área e me especializar ainda mais nos próximos anos.</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <a class="btn btn-info border border-black" href="https://www.linkedin.com/in/jo%C3%A3o-santos-3b02a5220/" target="_blank">LinkedIn</a>
                            <a class="btn btn-dark border border-black" href="https://github.com/jvs4nt" target="_blank">Github</a>
                        </div>
                        <div>
                            <a class="btn btn-secondary" href="{{ asset('files/JoaoVitorSantos.pdf') }}" download="Curriculo_Joao_Santos.pdf" target="_blank">Download CV</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
