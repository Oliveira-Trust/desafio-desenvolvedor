<div class="input-field">
    <input type="text" name="nome" id="nome" value="{{ isset($registro->nome) ? $registro->nome : null }}">
    <label for="nome">Nome</label>
</div>

<div class="input-field">
    <textarea type="text" name="descricao" id="descricao" class="materialize-textarea">{{ isset($registro->descricao) ? $registro->descricao : null }}</textarea>
    <label for="descricao">Descrição</label>
</div>

<div class="input-field">
    <input type="text" name="valor" id="valor" value="{{ isset($registro->valor) ? $registro->valor : null }}">
    <label for="valor">Valor</label>
</div>

<div class="input-field">
    <div class="row">
        <label for="ativo">Ativo</label>
    </div>
    <div class="row">
        <input name="ativo" type="radio" id="ativo-s" value="S"
               {{ isset($registro->ativo) && $registro->ativo == 'S' ? ' checked="checked"' : null }} required="required"/>
        <label for="ativo-s">Sim</label>

        <input name="ativo" type="radio" id="ativo-n" value="N"
               {{ isset($registro->ativo) && $registro->ativo == 'N' ? ' checked="checked"' : null }} required="required"/>
        <label for="ativo-n">Não</label>
    </div>
</div>