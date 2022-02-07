<!DOCTYPE html>
<html lang="en">

<head>
  <base href="../../../">
  <meta charset="utf-8" />
  <title>Guilherme Augustus - Representantes</title>
  <meta name="description" content="Login page example" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
  <!--end::Fonts-->
  <!--begin::Page Custom Styles(used by this page)-->
  <link href="{{ asset('/css/pages/login/login-2.css') }}" rel="stylesheet" type="text/css" />
  <!--end::Page Custom Styles-->
  <!--begin::Global Theme Styles(used by all pages)-->
  <link href="{{ asset('/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
  <!--end::Global Theme Styles-->
  <!--begin::Layout Themes(used by all pages)-->
  <link href="{{ asset('/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
  <!--end::Layout Themes-->
  <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
  <!--begin::Main-->
  <div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
      <!--begin::Aside-->
      <div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
        <!--begin: Aside Container-->
        <div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
          <!--begin::Logo-->
          <a href="#" class="text-center pt-2">
            <img src="{{ asset('media/logos/logo.png')}}" class="max-h-75px" alt="Oliveira Trust - Desafio Desenvolvedor" />
          </a>
          <!--end::Logo-->
          <!--begin::Aside body-->
          <div class="d-flex flex-column-fluid flex-column flex-center">
            <!--begin::Signin-->
            @if ($message = Session::get('error'))
            <div class="alert alert-custom alert-outline-2x alert-outline-danger fade show mb-5" role="alert">
              <div class="alert-icon"><i class="flaticon-warning"></i></div>
              <div class="alert-text">{{ $message }}</div>
              <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"><i class="ki ki-close"></i></span>
                </button>
              </div>
            </div>
            @endif
            <div class="login-form login-signin py-11">
              <!--begin::Form-->
              <form class="form" novalidate="novalidate" id="kt_login_signin_form" method="POST" action="{{ route('login.custom') }}">
                @csrf
                <!--begin::Title-->
                <div class="text-center pb-8">
                  <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Acesso ao Sistema</h2>
                  {{--
                    <span class="text-muted font-weight-bold font-size-h4">Or
                    <a href="" class="text-primary font-weight-bolder" id="kt_login_signup">Create An Account</a></span>
                  --}}
                </div>
                <!--end::Title-->
                <!--begin::Form group-->
                <div class="form-group">
                  <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                  <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="text" name="email" id="email" autocomplete="off" required autofocus />
                  @if ($errors->has('email'))
                  <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group">
                  <div class="d-flex justify-content-between mt-n5">
                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Senha</label>
                    {{--
                    <a href="javascript:;" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot">Forgot Password ?</a>
                    --}}
                  </div>
                  <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" name="password" id="password" required autocomplete="off" />
                  @if ($errors->has('password'))
                  <span class="text-danger">{{ $errors->first('password') }}</span>
                  @endif
                </div>
                <!--end::Form group-->
                <!--begin::Action-->
                <div class="text-center pt-2">
                  <button {{-- id="kt_login_signin_submit" --}} type="submit" class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3">Login</button>
                </div>
                <!--end::Action-->
              </form>
              <!--end::Form-->
            </div>
            <!--end::Signin-->

          </div>
          <!--end::Aside body-->
        </div>
        <!--end: Aside Container-->
      </div>
      <!--begin::Aside-->
      <!--begin::Content-->
      <div class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0" style="background-color: #B1DCED;">
        <!--begin::Title-->
        <div class="d-flex flex-column justify-content-center text-center  pt-md-5 pt-sm-5 px-lg-0 pt-5 px-7">
          <h3 class="display4 font-weight-bolder my-7 text-dark" style="color: #986923;">Oliveira Trust - Desafio Desenvolvedor</h3>
        </div>
        <!--end::Title-->
        <!--begin::Image-->
        <div class="content-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url({{ asset('/media/svg/illustrations/login-visual-2.svg')}});"></div>
        <!--end::Image-->
      </div>
      <!--end::Content-->
    </div>
    <!--end::Login-->
  </div>
  <!--end::Main-->
  <script>
    var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
  </script>
  <!--begin::Global Config(global config for global JS scripts)-->
  <script>
    var KTAppSettings = {
      "breakpoints": {
        "sm": 576,
        "md": 768,
        "lg": 992,
        "xl": 1200,
        "xxl": 1400
      },
      "colors": {
        "theme": {
          "base": {
            "white": "#ffffff",
            "primary": "#3699FF",
            "secondary": "#E5EAEE",
            "success": "#1BC5BD",
            "info": "#8950FC",
            "warning": "#FFA800",
            "danger": "#F64E60",
            "light": "#E4E6EF",
            "dark": "#181C32"
          },
          "light": {
            "white": "#ffffff",
            "primary": "#E1F0FF",
            "secondary": "#EBEDF3",
            "success": "#C9F7F5",
            "info": "#EEE5FF",
            "warning": "#FFF4DE",
            "danger": "#FFE2E5",
            "light": "#F3F6F9",
            "dark": "#D6D6E0"
          },
          "inverse": {
            "white": "#ffffff",
            "primary": "#ffffff",
            "secondary": "#3F4254",
            "success": "#ffffff",
            "info": "#ffffff",
            "warning": "#ffffff",
            "danger": "#ffffff",
            "light": "#464E5F",
            "dark": "#ffffff"
          }
        },
        "gray": {
          "gray-100": "#F3F6F9",
          "gray-200": "#EBEDF3",
          "gray-300": "#E4E6EF",
          "gray-400": "#D1D3E0",
          "gray-500": "#B5B5C3",
          "gray-600": "#7E8299",
          "gray-700": "#5E6278",
          "gray-800": "#3F4254",
          "gray-900": "#181C32"
        }
      },
      "font-family": "Poppins"
    };
  </script>
  <!--end::Global Config-->
  <!--begin::Global Theme Bundle(used by all pages)-->
  <script src="{{ asset('plugins/global/plugins.bundle.js')}}"></script>
  <script src="{{ asset('plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
  {{--<script src="{{ asset('js/scripts.bundle.js')}}"></script>--}}
  <!--end::Global Theme Bundle-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js/pages/custom/login/login-general.js')}}"></script>
  <!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>

{{--
@extends('app')

@section('content')
<main class="login-form">
  <div class="cotainer">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <h3 class="card-header text-center">Login</h3>
          <div class="card-body">
            <form method="POST" action="{{ route('login.custom') }}">
@csrf
<div class="form-group mb-3">
  <input type="text" placeholder="Email" id="email" class="form-control" name="email" required autofocus>
  @if ($errors->has('email'))
  <span class="text-danger">{{ $errors->first('email') }}</span>
  @endif
</div>

<div class="form-group mb-3">
  <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
  @if ($errors->has('password'))
  <span class="text-danger">{{ $errors->first('password') }}</span>
  @endif
</div>

<div class="form-group mb-3">
  <div class="checkbox">
    <label>
      <input type="checkbox" name="remember"> Remember Me
    </label>
  </div>
</div>

<div class="d-grid mx-auto">
  <button type="submit" class="btn btn-dark btn-block">Signin</button>
</div>
</form>

</div>
</div>
</div>
</div>
</div>
</main>
@endsection
--}}