<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Oliveira Trust | Registre-se</title>
  <link rel="shortcut icon" href="{{ env('APP_URL')}}/dist/img/icon_oliveiva.ico?crc=4141983071"/>

  <!-- Google Font: Montserrat -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ env('APP_URL')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ env('APP_URL')}}/dist/css/adminlte.min.css">
    <style>
        body{
           font-family: 'Montserrat'; 
        }
        .login-card-body, 
        .register-card-body {
            background-color: #fff;
            border-top: 0;
            color: #666;
            padding: 20px;
            border-radius: 20px;
        }

        .form-control {
            display: block;
            width: 100%;
            height: calc(2.25rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ddd;
            border-radius: 0.25rem;
            box-shadow: inset 0 0 0 transparent;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .input-group-append {
            margin-left: -1px;
            background: #ddd;
            border-radius: 0 5px 5px 0px;
            color: #333;
        }

        .input-group-text {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            text-align: center;
            white-space: nowrap;
            background-color: #e9ecef;
            border: 1px solid #ddd;
            border-radius: 0.25rem;
        }

        .login-card-body .input-group .input-group-text, .register-card-body .input-group .input-group-text {
            background-color: transparent;
            border-bottom-right-radius: 0.25rem;
            border-left: 0;
            border-top-right-radius: 0.25rem;
            color: #333;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .btn-danger {
            color: #fff;
            background-color: #D40000;
            border-color: #D40000;
            box-shadow: none;
            transition: .6s;
        }


        .btn-danger:not(:disabled):not(.disabled).active, .btn-danger:not(:disabled):not(.disabled):active, .show>.btn-danger.dropdown-toggle {
            color: #fff;
            background-color: #F26060;
            border-color: #F26060;
        }

        .btn-danger.focus, .btn-danger:focus {
            color: #fff;
            background-color: #F26060;
            border-color: #F26060;
            box-shadow: 0 0 0 0 rgb(225 83 97 / 50%);
        }

        .btn-danger:hover {
            color: #fff;
            background-color: #F26060;
            border-color: #F26060;
            border-radius: 20px;
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #ff8080;
            outline: 0;
            box-shadow: inset 0 0 0 transparent;
        }

        .login-card-body .input-group .form-control:focus~.input-group-append .input-group-text, 
        .login-card-body .input-group .form-control:focus~.input-group-prepend .input-group-text, 
        .register-card-body .input-group .form-control:focus~.input-group-append .input-group-text, 
        .register-card-body .input-group .form-control:focus~.input-group-prepend .input-group-text {
            border-color: #ff8080;
        }
        .login-card-body .input-group .form-control:focus~.input-group-append .input-group-text, .login-card-body .input-group .form-control:focus~.input-group-prepend .input-group-text, .register-card-body .input-group .form-control:focus~.input-group-append .input-group-text, .register-card-body .input-group .form-control:focus~.input-group-prepend .input-group-text {
            border-color: #ff8080;
        }
    </style>
</head>
<body class="hold-transition register-page">
<div class="row" id="aviso"></div>
<div class="register-box">
  <div class="register-logo">
    <a href="{{ env('APP_URL')}}/">
        <img src="{{ env('APP_URL')}}/dist/img/logotipo_padrao_grey.svg" alt="AdminLTE Logo" class="brand-image" style="opacity: .8; width: 70%;">
    </a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Registre uma nova assinatura</p>

        <div class="input-group mb-3">
          <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="senha" class="form-control" placeholder="Senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="rpt_senha" name="rpt_senha" placeholder="Digite novamente a senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <input class="form-control" type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
            <button type="button" onclick="createUser('#nome', '#email', '#senha','#rpt_senha', '#token')" class="btn btn-danger btn-block">Registrar</button>
          </div>
          <!-- /.col -->
        </div>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ env('APP_URL')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ env('APP_URL')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ env('APP_URL')}}/dist/js/adminlte.min.js"></script>
<!--Script Select2-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Script Desafio OT -->
<script src="{{ env('APP_URL')}}/dist/js/main.js"></script>
</body>
</html>
