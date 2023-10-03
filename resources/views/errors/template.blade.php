<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

        <title>{{ env('APP_NAME') }}</title>


        <!-- Base Css Files -->
        <link href="{{ asset('assets/common/css/bootstrap.min.css') }}" rel="stylesheet" />

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
        

        <!-- Custom Files -->
        <link href="{{ asset('assets/common/css/helper.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/common/css/style.css') }}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        
    </head>
    <body>


        <div class="wrapper-page" style="width: 800px">
            <div class="ex-page-content text-center">
            
                @yield('content')            
            
            </div>
        </div>
    
    </body>
</html>
