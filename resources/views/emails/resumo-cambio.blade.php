<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div>
                    <h2>Resumo da operação:</h2>
                    <div class="mb-2">
                        <label class="form-label">Moeda de Origem:</label>
                        <input class="form-control" name="moeda_origem" value="{{ $data['moeda_origem'] }}" readonly />
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Moeda de destino:</label>
                        <input class="form-control" name="moeda_destino" value="{{ $data['moeda_destino'] }}" readonly />
                    </div>
                    <div class="mb-2">
                        <label class="">Valor para conversão:</label>
                        <input class="form-control" name="valor_conversao" value="{{ $data['valor_compra']}}" readonly />
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Taxa de pagamento:</label>
                        <input class="form-control" name="taxa_pagamento" value="{{ $data['taxa_pagamento']}}" readonly />
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Taxa de conversão:</label>
                        <input class="form-control" name="taxa_conversao" value="{{ $data['taxa_conversao']}}" readonly />
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Valor para conversão - taxas:</label>
                        <input class="form-control" name="valor_compra" value="{{ $data['valor_conversao']}}" readonly />
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Forma de pagamento:</label>
                        <input class="form-control" name="forma_pagamento" value="{{ $data['forma_pagamento'] == 'CC' ? 'Cartão de Crédito' : 'Boleto Bancário' }}" readonly />
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Valor da moeda de destino:</label>
                        <input class="form-control" name="valor_moeda_destino" value="{{ $data['valor_moeda_destino'] }}" readonly />
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Valor comprado:</label>
                        <input class="form-control" name="valor_comprado" value="{{ $data['valor_comprado'] }}" readonly />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
