<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{ URL::asset('resources/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::asset('resources/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('resources/css/custom.min.css') }}" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{ URL::asset('resources/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    @yield('head')

  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0">
            <a href="{{ URL::asset('/index') }}" class="site_title"><img src="{{ URL::asset('images/favicon.png')}}"> <span>&nbsp;Oliveira Trust</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <!-- <img src="" alt="..." class="img-circle profile_img"> -->
              </div>
              <div class="profile_info">
                <span>Olá, {{ Auth::user()->name }} </span>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                  <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{ URL::asset('/index') }}">Fazer Cotação</a></li>
                        <li><a href="{{ URL::asset("/historic-quotation-user") }}">Histórico de Cotações</a></li>
                      </ul>
                    </li>

                    <!-- Itens somente para usuario Admin-->
                    @if (Auth::User()->role == 'admin')
                    <li><a><i class="fa fa-table"></i> Cadastros <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                          <li><a href="{{ URL::asset('/admin/fees') }}">Taxas</a></li>
                          <li><a href="{{ URL::asset('/admin/currencies') }}">Moedas</a></li>
                          <li><a href="{{ URL::asset('/admin/payment-methods') }}">Meios Pagamento</a></li>
                      </ul>
                    </li>

                    <li><a><i class="fa fa-bar-chart"></i> Relatórios <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                          <li><a href="{{ URL::asset('/all-historic-quotation') }}">Histórico de Cotações</a></li>
                      </ul>
                    </li>
                    @endif
                  </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <!-- Menu left logout -->
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="#" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {{ Auth::User()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
