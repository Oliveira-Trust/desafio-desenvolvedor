
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico{{$cdnVersionJSCSS}}">
    <title>Oliveira Trust - Backoffice</title>
    <!-- page css -->
    <link href="../dist/auth/css/pages/login-register-lock.css{{$cdnVersionJSCSS}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/app.css{{$cdnVersionJSCSS}}">
    <link href="../dist/auth/css/style.min.css{{$cdnVersionJSCSS}}" rel="stylesheet">
    <link href="/assets/css/line-awesome-11.min.css{{$cdnVersionJSCSS}}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="../assets/css/jqbtk.min.css{{$cdnVersionJSCSS}}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js{{$cdnVersionJSCSS}}"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js{{$cdnVersionJSCSS}}"></script>
    <![endif]-->

    <style>

        .jqbtk-row button{height: 3rem;}

        @media (min-width: 320px) {
            img.logo{
                width: 100%;height: 80px;
            }
        }

        @media (min-width: 375px) {
            img.logo{
                width: 100%;height: 80px;
            }
        }

    </style>
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">Oliveira Trust</p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper" class="login-register login-sidebar" style="background-image:url(../assets/auth/images/background/login-register-2.jpg);">
    <div class="login-box card">
        <div class="card-body">
            <form class="form-horizontal form-material" id="loginform">
                <a href="javascript:void(0)" class="text-center db"><img class="logo" src="../assets/images/logo-full.png{{$cdnVersionJSCSS}}" alt="Home" /></a>
                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <div class="position-relative">
                            <input class="form-control" type="text" name="login" id="login" required="" placeholder="Seu login">
                            <div class="form-control-position cursor-pointer open-keyboard" style="margin: 5px 10px 0 0;opacity: 0.7;">
                                <i class="la la-keyboard-o" style="font-size: 2.8rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="position-relative">
                            <input class="form-control" type="password" name="password" id="password" required="" placeholder="Sua senha">
                            <div class="form-control-position cursor-pointer open-keyboard" style="margin: 5px 10px 0 0;opacity: 0.7;">
                                <i class="la la-keyboard-o" style="font-size: 2.8rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">Acessar</button>
                    </div>
                </div>
            </form>
        </div>
        <div style="text-align: right;padding-right: 5px"><small style="color: #8c8c8c">Release {{$realeseName}}</small></div>
    </div>
</section>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="../assets/auth/node_modules/jquery/jquery-3.2.1.min.js{{$cdnVersionJSCSS}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="../assets/auth/node_modules/popper/popper.min.js{{$cdnVersionJSCSS}}"></script>
<script src="../assets/auth/node_modules/bootstrap/dist/js/bootstrap.min.js{{$cdnVersionJSCSS}}"></script>
<script src="../app-assets/vendors/js/extensions/sweetalert.min.js{{$cdnVersionJSCSS}}"></script>
<script src="../assets/js/jqbtk.min.js{{$cdnVersionJSCSS}}"></script>
<script src="../assets/js/helpers.js{{$cdnVersionJSCSS}}"></script>
<!--Custom JavaScript -->
<script type="text/javascript">
    $(function() {
        $(".preloader").fadeOut();
        $('[data-toggle="tooltip"]').tooltip();
    });

    $( document ).ready(function() {
        $('.open-keyboard').on('click', function () {
            let scope = $(this);
            $('#login').keyboard({placement:'left'});
            $('#password').keyboard({placement:'left'});
            $('#'+scope.prev('input').attr('id')).focus();
        });
    });

    let inputLogin = $('input[name=login]');
    inputLogin.focus();

    // Prevent the form to be submitted on ENTER
    $('#loginform').submit(function(e){
        e.preventDefault();

        let btnScope = $('.btn');
        let textHtml = btnScope.html();
        btnScope.html('Processando...').attr('disabled',true);

        $.post({
            url: "/auth/verify",
            data: $(this).serialize(),
            dataType: '',
            success: function (data, jqXHR) {
                btnScope.html('Abrindo...');
                window.location.href = "/";
            },
            error: function(data, jqXHR) {
                btnScope.html(textHtml).attr('disabled',false);
                helper.alertError('Credenciais incorretas!');
                inputLogin.focus();
            }
        });

    });

</script>
</body>

</html>
