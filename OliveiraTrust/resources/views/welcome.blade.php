<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registro de cotações</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script srt = "asset('js/jquery/dist/jquery.mask.min.js')"></script>
  <script src="plugins/jquery/jquery.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a class="nav-link">
                    <i class="fas fa-plus-square"></i>
                    <p>Registro de cotações</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a  class="nav-link">
                            <i class="fas fa-user"></i>
                            <p>UsuÃ¡rio</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('edit.user') }}" class="nav-link">
                                    <i class="fas fa-edit"></i>
                                    <p>Atualizar Dados</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="logout nav-link">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <p>Logout</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('index.cotacao') }}" class="nav-link">
                            <i class="fas fa-tasks"></i>
                            <p>Url</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
      </nav>
    </div>
  </aside>

<div class="content-wrapper">
 @yield('content')
</div>
</div>
<script>

$(document).ready(function() {
    $(".logout").click(function(e)
    {
        e.preventDefault()

        $.ajax({
            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type 	: 'post',
            url		: "/logout",
        }).done(function(response)
        {
            if(response)
            {
                window.location.reload()
            }
        }).fail(function(response)
        {
            console.log(response)
        })
    })
});

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" referrerpolicy="no-referrer"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>

</body>
</html>
