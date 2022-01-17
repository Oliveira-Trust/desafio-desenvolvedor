<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <title>Laravel</title>
        <style>
             @import 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css'; 

            .funkyradio div {
                float: left;
                margin: 5px;
            }

            .funkyradio label {
            width: 100%;
            border-radius: 3px;
            border: 1px solid #D1D3D4;
            font-weight: normal;
            }

            .funkyradio input[type="radio"]:empty,
            .funkyradio input[type="checkbox"]:empty {
            display: none;
            }

            .funkyradio input[type="radio"]:empty ~ label,
            .funkyradio input[type="checkbox"]:empty ~ label {
            position: relative;
            line-height: 2.5em;
            text-indent: 3.25em;
            margin-top: 2em;
            cursor: pointer;
            -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                    user-select: none;
            }

            .funkyradio input[type="radio"]:empty ~ label:before,
            .funkyradio input[type="checkbox"]:empty ~ label:before {
            position: absolute;
            display: block;
            top: 0;
            bottom: 0;
            left: 0;
            content: '';
            width: 2.5em;
            background: #D1D3D4;
            border-radius: 3px 0 0 3px;
            }

            .funkyradio input[type="radio"]:hover:not(:checked) ~ label,
            .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
            color: #888;
            }

            .funkyradio input[type="radio"]:hover:not(:checked) ~ label:before,
            .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
            content: '\2714';
            text-indent: .9em;
            color: #C2C2C2;
            }

            .funkyradio input[type="radio"]:checked ~ label,
            .funkyradio input[type="checkbox"]:checked ~ label {
            color: #777;
            }

            .funkyradio input[type="radio"]:checked ~ label:before,
            .funkyradio input[type="checkbox"]:checked ~ label:before {
            content: '\2714';
            text-indent: .9em;
            color: #333;
            background-color: #ccc;
            }

            .funkyradio input[type="radio"]:focus ~ label:before,
            .funkyradio input[type="checkbox"]:focus ~ label:before {
            box-shadow: 0 0 0 3px #999;
            }

            .funkyradio-default input[type="radio"]:checked ~ label:before,
            .funkyradio-default input[type="checkbox"]:checked ~ label:before {
            color: #333;
            background-color: #ccc;
            }

            .funkyradio-primary input[type="radio"]:checked ~ label:before,
            .funkyradio-primary input[type="checkbox"]:checked ~ label:before {
            color: #fff;
            background-color: #337ab7;
            }

            .funkyradio-success input[type="radio"]:checked ~ label:before,
            .funkyradio-success input[type="checkbox"]:checked ~ label:before {
            color: #fff;
            background-color: #5cb85c;
            }

            .funkyradio-danger input[type="radio"]:checked ~ label:before,
            .funkyradio-danger input[type="checkbox"]:checked ~ label:before {
            color: #fff;
            background-color: #d9534f;
            }

            .funkyradio-warning input[type="radio"]:checked ~ label:before,
            .funkyradio-warning input[type="checkbox"]:checked ~ label:before {
            color: #fff;
            background-color: #f0ad4e;
            }

            .funkyradio-info input[type="radio"]:checked ~ label:before,
            .funkyradio-info input[type="checkbox"]:checked ~ label:before {
            color: #fff;
            background-color: #5bc0de;
            }
        </style>
    </head>
    <body>
        <div class="container">
                    <h1> Conversão </h1>  
                    <h3>Moeda de Origem</h3>
                    BRL
                                        <div style="clear: both"></div>
                    <h3>Moeda de destino</h3>
                    <div class="funkyradio">
                        <div class="funkyradio-success" style="width: 100px;">
                            <input type="radio" name="md" id="md1" checked />
                            <label for="md1">USD</label>
                        </div>
                        <div class="funkyradio-success" style="width: 100px;">
                            <input type="radio" name="md" id="md2" />
                            <label for="md2">USD</label>
                        </div>
                    </div>
                    <div style="clear: both"></div>
                    <hr />
                    <h3>Valor para conversão</h3>
                    <input class="form-control"  type="text" name="valor">
                    <h3>Forma de pagamento</h3>

                    <div class="funkyradio">
                        <div class="funkyradio-success" style="width: 100px;">
                            <input type="radio" name="pg" id="pg1" checked />
                            <label for="pg1">Boleto</label>
                        </div>
                        <div class="funkyradio-success" style="width: 100px;">
                            <input type="radio" name="pg" id="pg2" />
                            <label for="pg2">Crédito</label>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>
