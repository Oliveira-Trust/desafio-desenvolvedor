<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Dashboard saladero.">
    <meta name="author" content="daniel.guimaraes@intercase.com.br">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>Oliveira Trust - Backoffice</title>
    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png{{$cdnVersionJSCSS}}">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/favicon.png">
    <link href="/assets/css/fonts-googleapis.css" rel="stylesheet">
    <link href="/assets/css/line-awesome-11.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/app-assets/css/fontawesome/releases/v4.7.0/all.css{{$cdnVersionJSCSS}}">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/vendors.css{{$cdnVersionJSCSS}}">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/ui/prism.min.css{{$cdnVersionJSCSS}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/app.css{{$cdnVersionJSCSS}}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css{{$cdnVersionJSCSS}}">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css{{$cdnVersionJSCSS}}">
    <!-- ORDERS CARDS -->
    <link rel="stylesheet" type="text/css" href="/app-assets/fonts/simple-line-icons/style.min.css{{$cdnVersionJSCSS}}">
    <!-- END Page Level CSS-->
    @include('includes.dependency-css')
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css{{$cdnVersionJSCSS}}">
    <!-- END Custom CSS-->
    @yield('css')
</head>
<body class="vertical-layout vertical-overlay-menu 2-columns  menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-overlay-menu" data-col="2-columns">
<!-- fixed-top-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-shadow navbar-brand-center" style="background-color: #D40000">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu mr-auto" style="z-index: 99999">
                    <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#" style="color: white"><i class="ft-menu font-large-1"></i></a>
                </li>
                <li class="nav-item nav-logo-brand">
                    <a class="navbar-brand" href="{{route('main')}}">
                        <h3 class="brand-text" style="color: white">Oliveira Trust</h3>
                        @if( !isProduction() )
                        <small class="badge badge-danger font-weight-bold">{{isHmg() ? 'HMG' : 'Local'}}</small>
                        @endif
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            @component('components.top-bar')
                @slot('userName') {{ str_limit( SessionOpen('get','name'),10) }} @endslot
            @endcomponent
        </div>
    </div>
</nav>
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow menu-border" data-scroll-to-active="true">
    @component('components.side-bar')

    @endcomponent
</div>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row content-bread-crumbs">
            <div class="content-header-left col-md-8 col-12 mb-2 @if(isset($breadCrumbs)) breadcrumb-new @endif  more-actions">
                <h3 class="content-header-title mb-0 d-inline-block text-bread-crumbs">{!! array_get($viewData,'subtitle') !!}</h3>
                @if(isset($breadCrumbs))
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            @foreach( $breadCrumbs as $bread )
                                <li class="breadcrumb-item">{!! $bread !!}</li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                @endif
            </div>
            @if( isset( $btnAction ) )
            <div class="content-header-right col-md-4 col-12">
                <div class="dropdown float-md-right">
                    <a onclick="helper.goBack()" class="btn btn-info btn-click round btn-min-width mr-1 mb-1 white"><i class="la la-backward"></i>Voltar</a>
                </div>
            </div>
            @endif
        </div>
        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">
          Copyright &copy; 2020
          <a class="text-bold-800 grey darken-2" href="#" target="_blank">Saladero</a>, Todos os direitos reservados.
      </span>
    </div>
    <div class="pull-right" style="margin: -20px 20px 0 0">
        <small style="text-align: right;color: #737373">Release {{$realeseName}}</small>
    </div>
</footer>
<!-- BEGIN VENDOR JS-->
<script src="/app-assets/vendors/js/vendors.min.js{{$cdnVersionJSCSS}}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script type="text/javascript" src="/app-assets/vendors/js/ui/prism.min.js{{$cdnVersionJSCSS}}"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="/app-assets/js/core/app-menu.js{{$cdnVersionJSCSS}}" type="text/javascript"></script>
<script src="/app-assets/js/core/app.js{{$cdnVersionJSCSS}}" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
<!-- END PAGE LEVEL JS-->

{{--<script src="/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@7.1.0/dist/promise.min.js{{$cdnVersionJSCSS}}"></script>
<script src="/assets/js/sweetalert-new.min.js{{$cdnVersionJSCSS}}" type="text/javascript"></script>
<script src="/assets/js/jquery.validate-1.17.0.js{{$cdnVersionJSCSS}}"></script>
<script src="/assets/js/helpers.js{{$cdnVersionJSCSS}}"></script>
<script src="/app-assets/js/scripts/extensions/block-ui.js{{$cdnVersionJSCSS}}" type="text/javascript"></script>

@include('includes.dependency-js')

<script>

    const regexCelular = /^([9][3-9]{1}[0-9]{3}[0-9]{4})|([7-9]{1}[0-9]{3}[0-9]{4})$/mg;
    const regexContato = /^([9][3-9]{1}[0-9]{3}[0-9]{4})|([2-9]{1}[0-9]{3}[0-9]{4})$/mg;
    const regexDDD     = /^(11|12|13|14|15|16|17|18|19|22|21|24|27|28|31|32|33|34|35|37|38|41|42|43|44|45|46|47|48|49|51|53|54|55|61|62|63|64|65|66|67|68|69|71|73|74|75|77|79|81|82|83|84|85|86|87|88|89|91|92|93|94|95|96|97|98|99)$/mg;
    const regexCEP     = /^(0[1-9]{1}[0-9]{6})|([1-9]{1}[0-9]{7})$/mg;
    const regexNome    = /^([\D]{2,} [\D]{1,})$/mg;
    const regexEmail   = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    const csrfToken    = $('meta[name=csrf_token]').attr("content");

    $(function() {

        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : $('meta[name=csrf_token]').attr("content")
            }
        });

    });

    @if( !empty( array_get($viewData,'actionName') ) )$("#{{array_get($viewData,'actionName')}}").addClass('open-menu');@endif
    @if( !empty( array_get($viewData,'routeName') ) ) $("#list-{{array_get($viewData,'routeName')}}").addClass('active');@endif
</script>

@yield('js')
</body>
</html>
