@extends('layouts.app')

@section('title', 'Meu usuário')

@section('content')

    <div class="header bg-tema-2 pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Meu usuário</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                              <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active">Meu usuário</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
         <div class="row">
            <div class="col-6">
               <div class="card">
                  <div class="card-body text-center">
                     <h4>Dados cadastrais</h4>
                     <a href="#" class="btn btn-primary" onclick="abrirModalAlterarDadosCadastrais()">Alterar</a>
                  </div>
               </div>
            </div>
            <div class="col-6">
               <div class="card">
                  <div class="card-body text-center">
                     <h4>Alterar senha</h4>
                     <a href="#" class="btn btn-primary" onclick="abrirModalAlterarSenha()">Alterar</a>
                  </div>
               </div>
            </div>
         </div>
    </div>

    @component('areaUsuario.modalAlterarDadosCadastrais') @endcomponent
    @component('areaUsuario.modalAlterarSenha') @endcomponent

    <script src="{{ asset('js/controles/areaUsuario.js') }}"></script>

@endsection