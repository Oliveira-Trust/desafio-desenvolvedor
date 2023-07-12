<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <title> Currency Conversion </title>
</head>

<body>

    <div class="container align-self-center">
        <div class="row">

            <div class="offset-3 col-6">

                <div class="card mt-5">
                    <div class="card-header bg-primary text-white text-center">                    
                        <b>Currency Conversion - {{ date('d/m/Y H:i:s') }}</b>
                    </div>
                    <div class="card-body">
                        <b>Conversion Value:</b> {{ number_format($conversion_value, 2, ',', '.') }} <br>
                        <b> Source Currency: </b>{{ $source_currency }} <br>
                        <b> Target Currency: </b>{{ $target_currency }} <br>
                        <b>Value Target Currency:</b> {{ number_format($value_target_currency, 2, ',', '.') }} <br>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>


</body>

</html>
