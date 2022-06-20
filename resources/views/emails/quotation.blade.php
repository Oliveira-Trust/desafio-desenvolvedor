<h1>Parabéns, sua cotação foi realizada com sucesso.</h1>

<div class="info">
    <div class="row">
        <span class="title">Você pagará</span>
        <span>R${{ number_format($quotation->amount, 2, ',', '.') }}</span>
    </div>

    <div class="row">
        <span class="title">Preço utilizado na conversão</span>
        <span>R${{ number_format($quotation->price, 2, ',', '.') }}</span>
    </div>

    <div class="taxas row">
        <span class="title"><b>Taxas</b></span>
        <div class="row no-margin no-border">
            <span class="title">Taxa de pagamento</span>
            <span>R${{ number_format($quotation->fees['1'], 2, ',', '.') }}</span>
        </div>
        <div class="row no-margin no-border">
            <span class="title">Taxa de conversão</span>
            <span>R${{ number_format($quotation->fees['2'], 2, ',', '.') }}</span>
        </div>
    </div>

    <div class="row no-border">
        <span class="title">Você receberá</span>
        <span class="valor-final">{{ number_format($quotation->exchanged_amount, 2, ',', '.') }} {{ $quotation->currency->code }}</span>
    </div>
</div>

<style>
    .info {
        font-size: 18px;
        max-width: 500px;
    }

    .row {
        width: 100%;
        margin-top: 10px;
        border-bottom: 1px solid #ccc;
    }

    .no-margin {
        margin-top: 0;
    }

    .no-border {
        border-bottom: 0;
    }

    .title {
        display: inline-block;
        width: 300px;
    }


    .valor-final {
        color: red;
        font-weight: bold;
        font-size: 20px;
    }
</style>
