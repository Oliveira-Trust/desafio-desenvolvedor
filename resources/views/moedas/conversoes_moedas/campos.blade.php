<div class="form-row">
    <div class="form-group col-md-2 required">
        <label for="moeda_origem_view">Moeda de Origem</label>
        <input type="text" id="moeda_origem_view" disabled="disabled" name="moeda_origem_view" value="{{ old('moeda_origem_view',$conversaoMoeda->moeda_origem_view ?? 'BRL' ?? 'BRL') }}"   class="form-control @error('moeda_origem_view') is-invalid @enderror"  placeholder="">
        @error('moeda_origem_view')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group col-md-3 required">
        <label for="moeda_destino">Moeda de Destino</label>
        <select id="moeda_destino" name="moeda_destino" class="form-control  @error('moeda_destino') is-invalid @enderror" selected="{{ old('moeda_destino',$conversaoMoeda->moeda_destino ?? '' ?? '') }}" >
            <option value="">Selecione</option>
            <option value="USD" {{ old('moeda_destino',$conversaoMoeda->moeda_destino ?? '') == 'USD'? 'selected' : '' }}>Dollar Americano</option>
            <option value="EUR" {{ old('moeda_destino',$conversaoMoeda->moeda_destino ?? '') == 'EUR'? 'selected' : '' }}>Euro</option>
        </select>
        @error('moeda_destino')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-5 required">
        <label for="valor_conversao">Valor para conversão</label>
        <input type="text" id="valor_conversao" name="valor_conversao" value="{{ old('valor_conversao',$conversaoMoeda->valor_conversao ?? '' ?? '') }}"   class="form-control @error('valor_conversao') is-invalid @enderror"  placeholder="0,00" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="dinheiro" >
        @error('valor_conversao')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-3 required">
        <label for="forma_pagamento">Forma de Pagamento</label>
        <select id="forma_pagamento" name="forma_pagamento" class="form-control  @error('forma_pagamento') is-invalid @enderror" selected="{{ old('forma_pagamento',$conversaoMoeda->forma_pagamento ?? '' ?? '') }}" >
            <option value="">Selecione</option>
            <option value="B" {{ old('forma_pagamento',$conversaoMoeda->forma_pagamento ?? '') == 'B'? 'selected' : '' }}>Boleto</option>
            <option value="C" {{ old('forma_pagamento',$conversaoMoeda->forma_pagamento ?? '') == 'C'? 'selected' : '' }}>Cartão</option>
        </select>
        @error('forma_pagamento')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-5 required">
        <label for="email">Valor para conversão</label>
        <input type="email" id="email" name="email" value="{{ old('email',$conversaoMoeda->email ?? '' ?? '') }}"   class="form-control @error('email') is-invalid @enderror"  placeholder="teste@teste.com"  value=""  >
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<script type="text/javascript" src="{{asset('js/conversoes_moedas/campos.js')}}"></script> 