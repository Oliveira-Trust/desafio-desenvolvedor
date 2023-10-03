@extends('errors.template')

@section('content')

        <h1>Ocorreu um erro no servidor!</h1>
        <h2>Tente refazer o procedimento. Caso o erro persista, entre em contato com o setor de TI.</h2><br>
        <br />
        <a class="btn btn-purple waves-effect waves-light" href="{{ route('panel.index') }}">
            <i class="fa fa-angle-left"></i> 
            Voltar para o Painel 
        </a>
        
@endsection