<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="{{ asset('css/semantic.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <title>Conversor de Moedas</title>
</head>

<body>
    <div class="ui divider"></div>
    <div class="ui container">
        <form class="ui form">
            <div class="field">
                <label>Moeda de destino</label>
                <select class="ui fluid dropdown">
                    <option value="">State</option>
                </select>
            </div>
            <div class="field">
                <label>Valor para Conversão</label>
                <input type="text" name="last-name" placeholder="Last Name">
            </div>
            <div class="field">
                <label>Forma de Pagamento</label>
                <select class="ui fluid dropdown">
                    <option value="">State</option>
                </select>
            </div>
            <button class="ui button" type="submit">Submit</button>
        </form>
    </div>
    <div class="ui divider"></div>
</body>

</html>