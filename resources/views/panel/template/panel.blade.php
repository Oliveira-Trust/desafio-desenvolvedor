<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Base Css Files -->
        <link href="{{ asset('assets/common/css/bootstrap.min.css') }}" rel="stylesheet" />

        <!-- Boostrap Select -->
        <link href="{{ asset('assets/common/css/bootstrap-select.css') }}" rel="stylesheet" />

        <!-- Font Icons -->
        <link href="{{ asset('assets/common/libraries/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/common/libraries/ionicon/css/ionicons.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/common/css/material-design-iconic-font.min.css') }}" rel="stylesheet">

        <!-- animate css -->
        <link href="{{ asset('assets/common/css/animate.css') }}" rel="stylesheet" />

        <!-- Waves-effect -->
        <link href="{{ asset('assets/common/css/waves-effect.css') }}" rel="stylesheet">

        <!-- sweet alerts -->
        <link href="{{ asset('assets/common/libraries/sweet-alert/sweet-alert.min.css') }}" rel="stylesheet">

        <!-- select2 -->
        <link href="{{ asset('assets/common/libraries/select2/select2.css') }}" rel="stylesheet" type="text/css" />

        <!-- Currency Flags -->
        <link href="{{ asset('assets/common/css/currency-flags.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Custom Files -->
        <link href="{{ asset('assets/common/css/helper.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/common/css/style.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/common/css/app.css') }}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        @stack('css')

        <style type="text/css">
            .block {
                display: block;
            }

            .title-mb {
                margin-bottom: 30px;
            }

            .field-error {
                color: #ef5350;
                background-color: #FEECE8;
            }
        </style>
    </head>

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">

                            <div class="pull-left">
                                <a href="index.html" class="logo">
                                <img src="{{ asset('assets/common/images/logo.png') }}" alt="Logotipo" title="Logotipo"
                                    style="width: 40px; height: 40px;" />
                                <span> {{ env('APP_NAME') }}</span></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle profile" data-toggle="dropdown" alt="user-img"
                                        aria-expanded="true">
                                        <img src="{{ asset('assets/panel/images/user.png') }}" alt=""
                                            class="thumb-md img-circle">

                                        {{ auth()?->user()?->name }}

                                        <span class="label label-primary">
                                            Usuário
                                        </span>
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">

                                        <li>
                                            <a href="javascript:void(0)"><i class="md md-face-unlock"></i>
                                            Perfil</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                <i class="md md-settings-power"></i>
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">


                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                            <li>
                                <a href="{{ route('index') }}" class="waves-effect">
                                    <i class="fa fa-money"></i>
                                    <span> Conversão </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('currencyExchangeHistoric') }}" class="waves-effect">
                                    <i class="fa fa-list-alt"></i>
                                    <span> Histórico </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('currencyExchangeSettings') }}" class="waves-effect">
                                    <i class="ion-android-settings"></i>
                                    <span> Configurações </span>
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page" style="min-height: 100vh;">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title title-mb">
                                    @yield('title-page')
                                </h4>
                            </div>
                        </div>

                        @yield('content')

                    </div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer text-center" style="padding: 10px">
                    Rander Carlos - Todos os direitos reservados © {{ date('Y') }}
                </footer>

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{ asset('assets/common/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/common/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/common/js/waves.js') }}"></script>
        <script src="{{ asset('assets/common/js/wow.min.js') }}"></script>
        <script src="{{ asset('assets/common/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/common/js/jquery.scrollTo.min.js') }}"></script>
        <script src="{{ asset('assets/common/libraries/jquery-detectmobile/detect.js') }}"></script>
        <script src="{{ asset('assets/common/libraries/fastclick/fastclick.js') }}"></script>
        <script src="{{ asset('assets/common/libraries/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('assets/common/libraries/jquery-blockui/jquery.blockUI.js') }}"></script>

        <script src="{{ asset('assets/common/libraries/sweet-alert/sweet-alert.min.js') }}"></script>

        <script src="{{ asset('assets/common/libraries/select2/select2.min.js') }}"></script>


        <script src="{{ asset('assets/common/js/modernizr.min.js') }}"></script>

        <script src="{{ asset('assets/common/js/bootstrap-select.js') }}"></script>

        <!-- CUSTOM JS -->
        <script src="{{ asset('assets/common/js/jquery.app.js') }}"></script>

        @yield('js')
    </body>
</html>
