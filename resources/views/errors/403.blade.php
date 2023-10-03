@extends('errors.template')

@section('content')

        <h1>Acesso Negado!</h1>
        <h2>Infelizmente, você não possui acesso a essa página ou procedimento!</h2><br>
        <br />
        <a class="btn btn-purple waves-effect waves-light" href="{{ route('panel.index') }}">
            <i class="fa fa-angle-left"></i> 
            Voltar para o Painel 
        </a>
        
@endsection