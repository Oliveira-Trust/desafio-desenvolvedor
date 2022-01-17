<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        
        <!-- CSS Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        
        <!-- CSS da Aplicação -->
        <link href="{{url('css/styles.css')}}" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
        <script>
            $(function(){
                $( "#moedadestino" ).change(function( event ) {
                    event.preventDefault();
                    var moedadestino = $(this).val();

                    $.ajax({
                        url: "{{url('conversoes/cotacaoatual')}}/"+moedadestino,
                        type: 'get',
                        data: {},
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            $( "#cotacaoatual" ).val(response);
                        }
                    });
                });
                $( "#formadepagamento" ).change(function( event ) {
                    event.preventDefault();
                    var valororigem = $("#valororigem").val();
                    var formadepagamento = $(this).val();
                    var cotacaoatual = $( "#cotacaoatual" ).val();

                    $.ajax({
                        url: "{{url('conversoes/calcular')}}/"+valororigem+'/'+cotacaoatual+'/'+formadepagamento,
                        type: 'get',
                        data: {},
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            $( "#taxadepagamento" ).val(response.taxaPagamento);
                            $( "#taxadeconversao" ).val(response.taxaConversao);
                            $( "#valorconversao" ).val(response.valorConvertido);
                        }
                    });
                });
            });
        </script>

    </head>
    <body class="antialiased">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="/" class="navbar-brand">
                        <h1>Conversão de Moedas</h1>
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/conversoes" class="nav-link">Início</a>
                        </li>
                        <li class="nav-item">
                            <a href="/conversoes/create" class="nav-link">Converter</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        @yield('content')
        <footer>
            <p>Desafio Desenvolvedor</p>
        </footer>
    </body>
</html>
