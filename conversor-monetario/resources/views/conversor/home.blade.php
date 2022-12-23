<!DOCTYPE html>
<html> 
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/css/estilo.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
        <title>Home</title>
    </head>

    <body>
       
        <header>
            <h1>Desafio desenvolverdor - Oliveira Trust </h1>
        </header>

        <section class="principal">
            @if (session()->has('message'))
                <div class="alert alert-dismissable alert-success">
                    {!! session()->get('message')!!}
                </div>
            @endif
            <form class="formulario-principal" action="{{ route('consome_api.store_conversao') }}" method="POST">
                @csrf
                <div class="titulo-form">
                   <h2>Insira os dados para conversão</h2>
                </div>
                
                <div class="erro">
                    @foreach ($errors->all() as $error)
                        <h2>{{ $error }}</h2>
                    @endforeach
                </div>

                <div class="campo-form">
                    <h1>Moeda base</h1>
                    <select class="campo" name="base" id="base">
                        <option value="BRL"><p>BRL - Real Brasileiro</p></option>
                    </select>
                </div> 
                <div class="campo-form">
                    <h1>Moeda de destino</h1>
                    <select class="campo" name="destino" id="destino">
                        @foreach($traducaoMoeda as $traducao => $tr)
                            <option value="{{ $traducao }}"><p>{{ $traducao  }} - {{ $tr }}</p></option>
                        @endforeach  
                    </select>
                </div>
                
                <div class="campo-form">
                    <h1>Valor da coversão</h1>
                    <input class="campo" type="text" name ="valor" id="valor">
                </div>
                
                <div class="campo-form">
                    <h1>Forma de pagamento</h1>
                    <select class="campo" name="pagamento" id="pagamento">
                        <option value="boleto"> <p>Boleto</p></option>
                        <option value="cartao"> <p>Cartão de crédito</p> </option>
                    </select>
                </div>
                <input class="botao" type="submit" value="Converter">
           </form>
        </section>
        <br><br><br><br>
        <section class="secundario">
           <table class="secundario-table">
                <thead>
                    <tr>
                        <th class="secundario-chave"></th>
                        <th class="secundario-chave">Moeda de Origem</th>
                        <th class="secundario-chave">Moeda de Destino</th>
                        <th class="secundario-chave">Valor para conversao</th>
                        <th class="secundario-chave">Forma de pagamento</th>
                        <th class="secundario-chave">Valor da <br>"moeda de destino"</th>
                        <th class="secundario-chave">Valor comprado em <br> "moeda de destino"</th>
                        <th class="secundario-chave">Taxa de pagamento</th>
                        <th class="secundario-chave">Taxa de conversão</th>
                        <th class="secundario-chave">Valor utilizado para <br> conversão (descontando taxas)</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($conversoes as $conversao)
                    <tr >
                        <td class="secundario-conversao">Conversão</td>
                        <td class="secundario-valor"><p>{{ $conversao->moedadaOrigem  }}</p></td>
                        <td class="secundario-valor"><p>{{ $conversao->moedaDestino}}</p></td>
                        <td class="secundario-valor"><p>R$ {{ $conversao->valorConversao }}</p></td>
                        <td class="secundario-valor"><p>{{ $conversao->formaPagamento }}</p></td>
                        <td class="secundario-valor"><p>$ {{ $conversao->valorMoedaDestino }}</p></td>
                        <td class="secundario-valor"><p>$ {{ $conversao->valorComprado }}</p></td>
                        <td class="secundario-valor"><p>R$ {{ $conversao->taxaPagamento }}</p></td>
                        <td class="secundario-valor"><p>R$ {{ $conversao->taxaConversao }}</p></td>
                        <td class="secundario-valor"><p>R$ {{ $conversao->valorUtilizado }}</p></td>
                    </tr>
                @endforeach
                </tbody>    
           </table>
            
        </section>

        <footer>
            <h4>&copy; Rafael Gonçalves da Silva Vargas 2022</h4>
        </footer>
    </body>
</html>