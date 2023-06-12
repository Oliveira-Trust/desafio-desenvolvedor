<form action="{{ route('cotations.store') }}" method="post" novalidate enctype="multipart/form-data">

    @csrf
    <div class="mb-3">
        <label for="coin_origin" class="form-label dark-color">Moeda de Origem</label>
        <select class="form-select " id="coin_origin" name="coin_origin" required>
            <option value="BRL" selected>BRL - Real Brasileiro</option>
            <option value="USD">USD - Dólar Americano</option>
            <option value="EUR">EUR - Euro</option>
            <option value="JPY">JPY - Iene Japonês</option>
            <div class="invalid-feedback">
                Por favor, selecione a moeda de origem.
            </div>
        </select>
    </div>

    <div class="mb-3">
        <label for="coin_final" class="form-label dark-color">Moeda de Destino</label>
        <select class="form-select" id="coin_final" name="coin_final" required>
            <option value="">Selecione</option>
            <option value="USD">USD - Dólar Americano</option>
            <option value="EUR">EUR - Euro</option>
            <option value="JPY">JPY - Iene Japonês</option>
        </select>
        <div class="invalid-feedback">
            Por favor, selecione a moeda de destino.
        </div>
    </div>

    <div class="mb-3">
        <label for="value_cotation" class="form-label dark-color">Valor para Conversão</label>
        <input type="number" class="form-control" id="value_cotation" name="value_cotation" placeholder="0.00" step="0.01" min="1000" max="100000">
    </div>
    <div class="invalid-feedback">
        Por favor, insira um valor entre 1000 e 100000.
    </div>

    <div class="mb-3">
        <label for="payment_type" class="form-label dark-color">Forma de Pagamento</label>
        <select class="form-select" id="payment_type" name="payment_type" required>
            <option value="">Selecione</option>
            <option value="boleto">Boleto</option>
            <option value="cartaoCredito">Cartão de Crédito</option>
        </select>
    </div>
    <div class="invalid-feedback">
        Por favor, selecione a forma de pagamento.
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Fazer cotação</button>
        <button type="button" class="btn btn-dark">Enviar por email</button>

    </div>
</form>