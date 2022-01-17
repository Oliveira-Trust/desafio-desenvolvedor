@extends('app')

@section('content')
<div class="container">
    <h1> Conversão </h1>  
    <h3>Moeda de Origem</h3>
    BRL
    <div style="clear: both"></div>
    <h3>Moeda de destino</h3>
    <form method="POST" action="{{route('cambio')}}">
        @csrf
        <div class="funkyradio">
            <div class="funkyradio-success" style="width: 100px;">
                <input type="radio" name="md" id="md1" value="BRL-USD" checked />
                <label for="md1">USD</label>
            </div>
            <div class="funkyradio-success" style="width: 100px;">
                <input type="radio" name="md" id="md2" value="BRL-EUR" />
                <label for="md2">EUR</label>
            </div>
        </div>
        <div style="clear: both"></div>
        <hr />
        <h3>Valor para conversão</h3>
        <input class="form-control" onKeyPress="return(moeda(this,'.',',',event))"  type="text"  name="valor" required>
        <h3>Forma de pagamento</h3>

        <div class="funkyradio">
            <div class="funkyradio-success" style="width: 100px;">
                <input type="radio" name="pg" id="pg1" value="boleto" checked />
                <label for="pg1">Boleto</label>
            </div>
            <div class="funkyradio-success" style="width: 100px;">
                <input type="radio" name="pg" id="pg2" value="credito"/>
                <label for="pg2">Crédito</label>
            </div>
        </div>
        <div style="clear: both"></div>
        <br>
        <br>
      <button type="submit" class="btn btn-success">Pagar</button>

      <br>
      <br>

    </form>
</div>
</div>
</div>

@stop

@section('javascript')
    <script>
            function moeda(a, e, r, t) {
    let n = ""
      , h = j = 0
      , u = tamanho2 = 0
      , l = ajd2 = ""
      , o = window.Event ? t.which : t.keyCode;
    if (13 == o || 8 == o)
        return !0;
    if (n = String.fromCharCode(o),
    -1 == "0123456789".indexOf(n))
        return !1;
    for (u = a.value.length,
    h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
        ;
    for (l = ""; h < u; h++)
        -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
    if (l += n,
    0 == (u = l.length) && (a.value = ""),
    1 == u && (a.value = "0" + r + "0" + l),
    2 == u && (a.value = "0" + r + l),
    u > 2) {
        for (ajd2 = "",
        j = 0,
        h = u - 3; h >= 0; h--)
            3 == j && (ajd2 += e,
            j = 0),
            ajd2 += l.charAt(h),
            j++;
        for (a.value = "",
        tamanho2 = ajd2.length,
        h = tamanho2 - 1; h >= 0; h--)
            a.value += ajd2.charAt(h);
        a.value += r + l.substr(u - 2, u)
    }
    return !1
}
    </script>
@endsection