<div class="row">
    <div class="form-group col-md-3">
        <label for="method">Moeda de Destino</label>
        <select name="currency" class="form-control" required>
            <option value="">Selecione</option>
            @foreach ($currencies as $currencie)
                <option value="{{ $currencie['id'] }}" {{ old('currency') == $currencie['id'] ? ' selected' : '' }}>
                    {{ strtoupper($currencie['code']) }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-3">
        <label for="name">Valor para Conversão entre R$ 1.000,00 e R$ 100.000,00</label>
        <input name="amount" id="amount" value="{{ old('amount') }}" type="text"
               class="date-picker form-control col-md-7 col-xs-12 money" required="required">
    </div>
</div>
<div class="row">
    <div class="form-group col-md-3">
        <label for="method">Meio de Pagamento</label>
        <select name="method" id="method" class="form-control" required>
            <option value="">Selecione</option>
            @foreach ($paymentMethods as $paymentMethod)
                <option value="{{ $paymentMethod['id'] }}" {{ old('method') == $paymentMethod['id'] ? ' selected' : '' }}>
                    {{ $paymentMethod['method'] }}
                </option>
            @endforeach
        </select>
    </div>
</div>

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('.money').mask('000.000.000.000.000,00', {reverse: true});

        $(".money").change(function(){
            $("#value").html($(this).val().replace(/\D/g,''))
        })
    });
</script>
@endsection
