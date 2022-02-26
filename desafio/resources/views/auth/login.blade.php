@extends('templates.app')

@section('content')
    <!-- start: page -->
    <section class="body-sign">
        <div class="center-sign">
            <a href="/" class="logo pull-left" style="margin-bottom: 15px;">
                <img src="/assets/images/logo-oliveiratrust.png" height="54" alt="Porto Admin" />
            </a>

            <div class="panel panel-sign">
                <div class="panel-title-sign mt-xl text-right">
                    <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Área restrita</h2>
                </div>
                <div class="panel-body">

                    @if(session('status'))
                        <div class="alert alert-danger"><span>{{ session('status') }}</span></div>
                    @endif

                    <form action="/" method="post">
                        @csrf
                        <div class="form-group mb-lg @error('email') has-error @enderror">
                            <label>E-mail</label>
                            <div class="input-group input-group-icon">
                                <input name="email" type="text" class="form-control input-lg" />
                                <span class="input-group-addon">
                                    <span class="icon icon-lg">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </span>
                            </div>
                            
                            @error('email')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-lg @error('password') has-error @enderror">
                            <div class="clearfix">
                                <label class="pull-left">Senha</label>
                                <a href="javascript:void(0)" class="pull-right">Esqueceu sua senha?</a>
                            </div>
                            <div class="input-group input-group-icon">
                                <input name="password" type="password" class="form-control input-lg" />
                                <span class="input-group-addon">
                                    <span class="icon icon-lg">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </span>
                            </div>
                            @error('password')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="checkbox-custom checkbox-default">
                                    <input id="RememberMe" name="remember" type="checkbox"/>
                                    <label for="RememberMe">Lembre-me</label>
                                </div>
                            </div>
                            <div class="col-sm-4 text-right">
                                <button type="submit" class="btn btn-primary hidden-xs">Entrar</button>
                                <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Entrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2022. Todos os direitos reservado.
        </div>
    </section>
    <!-- end: page -->
@endsection