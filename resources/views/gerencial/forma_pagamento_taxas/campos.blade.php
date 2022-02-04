<div class="form-row">
    <div class="form-group col-md-2 required">
        <label for="tipo">Moeda de Origem</label>
        <input type="text" id="tipo" disabled="disabled" name="tipo" value="{{ old('tipo',$formaPagamentoTaxa->tipo == 'B' ? 'Boleto' : 'Cartão' ) }}"   class="form-control @error('tipo') is-invalid @enderror"  placeholder="">
        @error('tipo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-5 required">
        <label for="porcentagem">Valor para conversão</label>
        <input type="text" id="porcentagem" name="porcentagem" value="{{ old('porcentagem',$formaPagamentoTaxa->porcentagem ?? '' ?? '') }}"   class="form-control @error('porcentagem') is-invalid @enderror"  placeholder="" value="" data-type="porcentagem" >
        @error('porcentagem')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<script type="text/javascript" src="{{asset('js/forma_pagamento_taxas/campos.js')}}"></script> 