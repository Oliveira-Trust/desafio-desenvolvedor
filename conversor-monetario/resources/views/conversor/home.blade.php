<!DOCTYPE html>
<html> 
    <head>
        <meta charset="utf-8">
        <title>Home</title>
    </head>

    <body>
        <header>
        </header>

        <section>
            <form action="/valida" method="POST">
                @csrf
                <div>
                    <h1>Moeda base</h1>
                    <select name="base" id="base">
                        <option value="{{ $siglas[0] }}">{{ $moedasValidas[0] }}</option>
                    </select>
                </div>
                <div>
                    <h1>Moeda de destino</h1>
                    <select name="destino" id="destino">
                        <option value="{{ $siglas[1] }}">{{ $moedasValidas[1] }}</option>
                        <option value="{{ $siglas[2] }}">{{ $moedasValidas[2] }}</option>
                        <option value="{{ $siglas[3] }}">{{ $moedasValidas[3] }}</option>
                    </select>
                </div>
                
                <div>
                    <h1>Valor da coversão</h1>
                    <input type="text" name ="valor" id="valor">
                </div>
                
                <div>
                    <h1>Forma de pagamento</h1>
                    <select name="pagamento" id="pagamento">
                        <option value="Boleto">Boleto</option>
                        <option value="Cartao">Cartão de crédito</option>
                    </select>
                </div>
                <input type="submit" value="Converter">
           </form>
        </section>
    </body>
</html>