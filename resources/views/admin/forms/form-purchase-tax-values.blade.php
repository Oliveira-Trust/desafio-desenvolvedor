<div class="row">
    @if ($errors->any())
        {{--  deve ser convertido em compnente  --}}
        <div aria-live="polite" aria-atomic="true" >
            <div >
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" onmouseover="dismissError(this)" role="alert">
                        <div class="toast-body text-bold">{{$error}}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
<div class="row">
    <div class="col-sm-12 col-md-6">
        <h5 class="label">Intervalo para cálculo do "Valor de compra"</h5>
        <div class="form-group">
            <input type='hidden' name='taxes[purchase][tax][name]' value="Valor da compra"/>
            <input type='hidden' name='taxes[purchase][tax][value]' value=0/>
            <label class="label" for="purchase_min">Mínimo</label>
            <input type='text' name='taxes[purchase][interval][min]' id="purchase_min"
                   placeholder="Valor mínimo da compra"
                   class="form-control"
                   value="{{ isset($valorCompraInterval) ? $valorCompraInterval->min : 0.0  }}"
                   required/>
        </div>
        <div class="form-group">
            <label class="label" for="purchase_max">Máximo</label>
            <input type='text' name='taxes[purchase][interval][max]' id="purchase_max"
                   placeholder="Valor máximo da compra"
                   class="form-control"
                   value="{{isset($valorCompraInterval) ? $valorCompraInterval->max : 0.0 }}"
                   required/>
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <h5  class="label">Taxas de Formas de pagamento (%)</h5>
        <div class="form-group">
            <label class="label" for="ticket">Valor da Taxa do Boleto</label>
            <input type='hidden' name='taxes[ticket][tax][name]' value="Boleto"/>
            <input type='text' name='taxes[ticket][tax][value]' id="ticket" placeholder="Valor da taxa do Boleto"
                   class="form-control"
                   value="{{isset($ticket) ? $ticket->value : 0.0 }}"
                   required/>
        </div>
        <div class="form-group">
            <label class="label" for="card_tax">Valor da Taxa Cartão de crédito</label>
            <input type='hidden' name='taxes[credit_card][tax][name]' value="Cartão de crédito"/>
            <input type='text' name='taxes[credit_card][tax][value]' id="card_tax"
                   placeholder="Valor da taxa do Cartão de crédito"
                   class="form-control"
                   value="{{isset($creditCard) ? $creditCard->value : 0.0 }}"
                   required/>
        </div>
    </div>
</div>

<div class="row mt-4">

    <div class="col-sm-12 col-md-6">
        <h5 class="label">Taxa de conversão - Mínimo (%)</h5>
        <div class="form-group">
            <input type='hidden' name='taxes[conversion_rate_min][tax][name]' value="Taxa de conversão Min"/>
            <label class="label" for="conversion_rate_value">Valor</label>
            <input type='text' name='taxes[conversion_rate_min][tax][value]' id="conversion_rate_value"
                   placeholder="Valor da taxa de conversão em %"
                   class="form-control"
                   value="{{isset($taxaConversaoMin) ? $taxaConversaoMin->value : 0.0 }}"
                   required/>
        </div>
        <div class="form-group">
            <label class="label" for="conversion_rate_min">Valor mínimo avaliado da compra</label>
            <input type='text' name='taxes[conversion_rate_min][interval][min]' id="conversion_rate_min"
                   placeholder="Valor avaliado da compra"
                   class="form-control"
                   value="{{isset($taxaConversaoIntervalMin) ? $taxaConversaoIntervalMin->min : 0.0 }}"
                   required/>
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <h5 class="label">Taxa de conversão - Máximo (%)</h5>
        <div class="form-group">
            <input type='hidden' name='taxes[conversion_rate_max][tax][name]' value="Taxa de conversão Max"/>
            <label class="label" for="conversion_rate_value_max">Valor</label>
            <input type='text' name='taxes[conversion_rate_max][tax][value]' id="conversion_rate_value_max"
                   placeholder="Valor da taxa de conversão em %"
                   class="form-control"
                   value="{{isset($taxaConversaoMax) ? $taxaConversaoMax->value : 0.0 }}"
                   required/>
        </div>
        <div class="form-group">

            <label class="label" for="conversion_rate_max">Valor máximo avaliado da compra</label>
            <input type='text' name='taxes[conversion_rate_max][interval][max]' id="conversion_rate_max"
                   placeholder="Valor máximo da compra"
                   class="form-control"
                   value="{{isset($taxaConversaoIntervalMax) ? $taxaConversaoIntervalMax->min : 0.0 }}"
                   required/>
        </div>
    </div>

</div>
<div class="row">
    <div class="form-group col-12">
        <button type="submit" class="btn btn-primary btn-block">Salvar</button>
    </div>
</div>
