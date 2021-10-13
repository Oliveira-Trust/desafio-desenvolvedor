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

    <script language="javascript"> function Bloquear(){ document.getElementById('recuperarSenha').disabled = true; } </script>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <!-- Mensagem confirmação evento -->
            @if (session('message'))
              <div class="alert alert-danger alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <h2>{{ session('message')}}</h2>
              </div>
            @endif
            <form method="POST" action="{{ route('new.password') }}" onsubmit="Bloquear()">
                {{ csrf_field() }}
                <h1>Recuperar Senha</h1>
                <!-- se tiver erro na validação usa classe has-error pro campo ficar vermelho -->
                <div class="form-group {{ $errors->has('erro') ? 'has-error' : '' }}">
                    <!-- exibir mensagem de erro -->
                    {!! $errors->first('erro', '<span class="help-block">:message</span>') !!}
                    <input type="email" name="email" class="form-control" placeholder="Digite seu Email cadastrado" required="true" />
                    <!-- exibir mensagem de erro -->
                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                </div>
                <div>
                    <button type="submit" name="recuperarSenha" id="recuperarSenha" class="btn btn-default submit">Recuperar Senha</button>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <p class="change_link">Novo aqui?
                    <a href="{{ route('login') }}" class="to_register"> Criar Conta </a>
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
