<div class="input-field col s12 l12 m12">
  <input type="text" name="nome" id="nome" value="{{ isset($registro->nome) ? $registro->nome : null }}" required="required" autofocus="autofocus">
  <label for="nome">Nome</label>
</div>
<div class="input-field col s12 l12 m12">
	<input type="text" name="localizador" id="localizador" value="{{ isset($registro->localizador) ? $registro->localizador : null }}" required="required">
	<label for="localizador">Localizador</label>
</div>
<div class="input-field col s6 l6 m6">
  <select name="modo_desconto" required="required">
    <option value="">-- Selecione</option>
    <option value="porc" {{ isset($registro->modo_desconto) && $registro->modo_desconto == 'porc' ? ' selected ' : null }}>Porcentagem no valor do produto</option>
    <option value="valor" {{ isset($registro->modo_desconto) && $registro->modo_desconto == 'valor' ? ' selected ' : null }}>Valor fixo</option>
  </select>
  <label for="modo_desconto">Modo de desconto</label>
</div>
<div class="input-field col s6 l6 m6">
  <input type="text" name="desconto" id="desconto" value="{{ isset($registro->desconto) ? $registro->desconto : null }}" required="required">
  <label for="desconto">Desconto</label>
</div>
<div class="input-field col s6 l6 m6">
  <select name="modo_limite" required="required">
    <option value="">-- Selecione</option>
    <option value="qtd" {{ isset($registro->modo_limite) && $registro->modo_limite == 'qtd' ? ' selected ' : null }}>Quantidade de desconto</option>
    <option value="valor" {{ isset($registro->modo_limite) && $registro->modo_limite == 'valor' ? ' selected ' : null }}>Valor de desconto</option>
  </select>
  <label for="modo_limite">Modo de limite</label>
</div>
<div class="input-field col s6 l6 m6">
  <input type="text" name="limite" id="limite" value="{{ isset($registro->limite) ? $registro->limite : null }}" required="required">
  <label for="limite">Limite desconto</label>
</div>
<div class="input-field col s12 l12 m12">
	<input type="text" class="datepicker" name="dthr_validade" id="dthr_validade" value="{{ isset($registro->dthr_validade) ? $registro->dthr_validade : null }}" required="required">
	<label for="dthr_validade">Data vencimento</label>
</div>
<div class="input-field col s12 l12 m12">
    <div class="row">
        <label for="ativo">Ativo</label>
    </div>
    <div class="row">
      <input name="ativo" type="radio" id="ativo-s" value="S" {{ isset($registro->ativo) && $registro->ativo == 'S' ? ' checked="checked"' : null }} required="required" />
      <label for="ativo-s">Sim</label>
      <input name="ativo" type="radio" id="ativo-n" value="N" {{ isset($registro->ativo) && $registro->ativo == 'N' ? ' checked="checked"' : null }} required="required"  />
      <label for="ativo-n">Não</label>
    </div>
</div>