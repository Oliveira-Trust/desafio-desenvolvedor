<!doctype html>
<html lang="en">

<style>
    li a.active {
        border-bottom: 3px #fff solid;
        color: black;
    }

    .bd-example {
        position: relative;
        padding: 1rem;
        margin: 1rem -0.75rem 0;
        border: solid #dee2e6;
        border-width: 1px;
    }
</style>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <title>Conversor de Moedas - Oliveira Trust</title>
</head>

<body>

    <div class="container">
        <div class="row" style="background-color: #e5e5e5;padding: 10px;">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link {{ $type == 'conversao' ? 'active' : '' }}" aria-current="page" href="{{ route('conversoes') }}">Conversões</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $type == 'moeda' ? 'active' : '' }}" href="{{ route('moedas') }}">Moedas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $type == 'pagamento' ? 'active' : '' }}" href="{{ route('formas.pags') }}">Formas de Pagamentos</a>
                </li>
            </ul>
        </div>


        <!-- Content here -->
        {{ $slot }}
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
