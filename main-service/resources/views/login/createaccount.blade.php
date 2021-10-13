<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Oliveira Trust - Criar Conta</title>

    <!-- Bootstrap -->
    <link href="{{URL::asset('resources/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{URL::asset('resources/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{URL::asset('resources/animate.css/animate.min.css')}}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{URL::asset('resources/css/custom.min.css')}}" rel="stylesheet">

    <!-- Bloquear botão submit ao enviar form -->
    <script language="javascript"> function Bloquear(){ document.getElementById('btnForm').disabled = true; } </script>
  </head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div >
          <section class="login_content">
            <!-- Mensagens validação -->
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            @endif
            <!-- Mensagem confirmação evento -->
            @if (session('message'))
              <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <h2>{{ session('message')}}</h2>
              </div>
            @endif
            <form name="cadastro" method="POST" action="{{ route('store.user') }}">
              {{ csrf_field() }}
              <h1>Criar Conta</h1>
              <div>
                <input type="text" name="name" id="name" class="form-control" placeholder="Nome" required="required"
                  value="{{ old('name') }}"/>
              </div>
              <div>
                <input type="email" name="email" class="form-control" placeholder="Email" required="required" value="{{ old('email') }}"/>
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Senha" required="required" />
              </div>
              <div>
                <br/>
                <button type="submit" name="btnForm" id="btnForm" class="btn btn-default submit">Criar</button>
              </div>
              <div class="clearfix"></div>
              <div class="separator">
                <p class="change_link">Já tem cadastro?
                  <a href="{{ URL('/') }}" class="to_register"><font size='3'> Log in </font></a>
                </p>
                <div class="clearfix"></div>
                <br />
                  <div>
                      <h1><img src="{{ URL::asset('images/logo-oliveira-trust.png')}}"></h1>
                      <h1>Inovação e Segurança para os seus negócios</h1>
                      <p>©2021 All Rights Reserved. Privacy and Terms</p>
                  </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
