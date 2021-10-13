<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - Dashboard </title>

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
        <div class="animate form login_form">
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
            <form method="POST" action="{{ route('verify.login') }}" onsubmit="Bloquear()">
                {{ csrf_field() }}
                <h1>Login Form</h1>
                <!-- se tiver erro na validação usa classe has-error pro campo ficar vermelho -->
                <div class="form-group {{ $errors->has('erro') ? 'has-error' : '' }}">
                    <!-- exibir mensagem de erro -->
                    {!! $errors->first('erro', '<span class="help-block">:message</span>') !!}
                    <input type="email" name="email" class="form-control" placeholder="Email" required="true" />
                    <!-- exibir mensagem de erro -->
                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                </div>
                <div>
                    <input type="password" name="password" class="form-control" placeholder="Senha" required="true" />
                    <!-- exibir mensagem de erro -->
                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                </div>
                <div>
                    <button type="submit" class="btn btn-default submit" id="btnForm">Log In</button>
                    <!-- <a class="btn btn-default submit" href="index.html">Log in</a> -->
                    <a class="reset_pass" href="{{ route('recover.password') }}">Recuperar Senha</a>
                </div>
                <div class="clearfix"></div>
                <div class="separator">
                    <p class="change_link">Novo aqui?
                    <a href="{{ route('new.account') }}" class="to_register"><font size='3'> Criar Conta</font> </a>
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
