<div class="form-row">
    <div class="form-group col-md-4 required">
        <label for="valor_minimo">Valor Mínimo</label>
        <input type="text" id="valor_minimo" name="valor_minimo" value="{{ old('valor_minimo',$conversaoTaxa->valor_minimo ?? '' ?? '') }}"   class="form-control @error('valor_minimo') is-invalid @enderror"  placeholder="" value="" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="dinheiro" >
        @error('valor_minimo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-4 required">
        <label for="valor_maximo">Valor Máximo</label>
        <input type="text" id="valor_maximo" name="valor_maximo" value="{{ old('valor_maximo',$conversaoTaxa->valor_maximo ?? '' ?? '') }}"   class="form-control @error('valor_maximo') is-invalid @enderror"  placeholder="" value="" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="dinheiro" >
        @error('valor_maximo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-4 required">
        <label for="porcentagem">Valor para conversão</label>
        <input type="text" id="porcentagem" name="porcentagem" value="{{ old('porcentagem',$conversaoTaxa->porcentagem ?? '' ?? '') }}"   class="form-control @error('porcentagem') is-invalid @enderror"  placeholder="" value="" data-type="porcentagem" >
        @error('porcentagem')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<script type="text/javascript" src="{{asset('js/conversao_taxas/campos.js')}}"></script> 

