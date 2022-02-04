@extends('layouts.sb-admin-2.login.corpo')
@section('content')

<div class="card-body p-0">
    <div class="row">
        <div class="col-lg-12  ">
            <!-- Otimismo #EDB520  Confianca #EC7F46 -->
            <div class="pt-4">
                <div class="sidebar-brand d-flex align-items-center justify-content-center text-secondary">
                    <div class="sidebar-brand-text font-black-ops-one " >
                        <h3>
                        Oliveira Trust
                        </h3>
                    </div>
                    <div class=" pl-2">
                        <h4>
                            <i class=" text-dark fas fa-money-bill fa-lg" ></i>
                        </h4>
                    </div>
                </div>
            </div>
            <hr>
            <!-- <img src="{{asset('img/logos/gv_400.png')}}" class="img-fluid" alt="Responsive image"> -->
        </div>
        <div class="col-lg-12">
            <div class="p-4">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Cadastrar</h1>
                </div>
                <form class="user" method="POST" action="{{ route('cadastrar') }}">
                    @csrf
                    <!-- {{csrf_field()}} -->
                    <div class="form-row">
                        <div class="form-group col-md-12 required">
                            <label for="nome">Nome da empresa</label>
                            <input id="nome-empresa" value="Oliveira Trust" name="Empresa[razao_social]" type="text" class="form-control form-control-user @error('Empresa.razao_social') is-invalid @enderror" placeholder="Nome da empresa"  autocomplete="nome" autofocus>
                            @error('Empresa.razao_social')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 required">
                            <label for="nome">Seu nome completo</label>
                            <input id="nome" value="Pedro Henrique Novaes Braga" name="nome" type="text" class="form-control form-control-user @error('nome') is-invalid @enderror" placeholder="Nome"  autocomplete="nome" autofocus>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 required">
                            <label for="telefone">Telefone</label>
                            <input id="telefone" value="1111111111" name="Empresa[telefone]" type="text" class="form-control form-control-user @error('Empresa.telefone') is-invalid @enderror" placeholder="Telefone"  autocomplete="telefone" autofocus>
                            @error('Empresa.telefone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 ">
                            <label for="celular">Celular/WhatsApp</label>
                            <input id="celular" value="11111111112" name="Empresa[celular]" type="text" class="form-control form-control-user @error('celular') is-invalid @enderror" placeholder="Celular"  autocomplete="celular" autofocus>
                            @error('celular')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 required">
                            <label for="email">Email</label>
                            <input id="email" value="pedro.phnb@gmail.com" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email"  placeholder="E-mail">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 required">
                            <label for="password">Senha</label>
                            <input id="password" value="12345678" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Senha" name="password"  autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 required">
                            <label for="nome">Confirma senha</label>
                            <input id="password-confirmation" value="12345678" type="password" name ="password_confirmation" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" placeholder="Confirma senha"  autocomplete="new-password">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary btn-user btn-block">
                        {{ __('Cadastrar') }}
                    </button>
                </form>
                <hr>
                <!-- <div class="text-center">
                        <a class="small" href="{{ route('password.request') }}">Esqueci minha senha</a>
                </div> -->
                <div class="text-center">
                    <a class="small text-dark" href="{{ route('login') }}">Já tem uma conta? Conecte-se!</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
