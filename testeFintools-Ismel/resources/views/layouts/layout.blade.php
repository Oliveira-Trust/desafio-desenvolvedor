<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <link href="  {{ asset('css/sweetalert2.css') }}" rel="stylesheet">
    <link href="  {{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
    
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"> FINTOOLS </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item {{ Route::currentRouteName() === 'conversao.index' ? 'active': '' }}">
                    <a class="nav-link" href="{{ route('conversao.index') }}"> Conversão <span class="sr-only"></span></a>
                </li>
                <li class="nav-item {{ Route::currentRouteName() === 'taxa.index' ? 'active': '' }}">
                    <a class="nav-link" href="{{ route('taxa.index') }}">Taxas</a>
                </li>                      
            </ul>
        </div>

        <div class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" style="padding: 0px 1rem;" href="{{ route('user.logout') }}">Logout</a>
                </li>
                
                <li class="nav-item">
                    <p style="color: rgba(0,0,0,.5);"> | </p>
                </li>

                <li class="nav-item">
                    <p style="color: rgba(0,0,0,.5); margin-left: 15px;">Usuário conectado: <span class="text-danger"> {{ Auth::user()->name }}  </span> </p>
                </li> 
                                   
            </ul>
        </div>

    </nav> 
</header>


@yield("seccion1");






<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>

<script src="https://kit.fontawesome.com/407f74df21.js"></script>

<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

<script src="{{ asset('js/app.js') }}"></script>

    
</body>
</html>