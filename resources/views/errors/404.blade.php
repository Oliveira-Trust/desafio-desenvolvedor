@extends('errors.template')

@section('content')

        <h1>Não existe!</h1>
        <h2>A página ou recurso informado não foi encontrado!</h2><br>
        <br />
        <a class="btn btn-purple waves-effect waves-light" href="{{ route('panel.index') }}">
            <i class="fa fa-angle-left"></i> 
            Voltar para o Painel 
        </a>
        
@endsection