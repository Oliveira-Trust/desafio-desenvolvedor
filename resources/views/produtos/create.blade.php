<x-app-layout>
<form class="row g-3" method="POST" action="{{route('salvar_produto')}}">
    @csrf  
    <div class="mb-3">
        <label for="descricao" class="form-label">Descricao</label>
        <input type="text" class="form-control" id="descricao" name="descricao">
    </div>
    <div class="mb-3">
        <label for="valor" class="form-label">Valor</label>
        <input type="text" class="form-control" id="valor" name="valor">
    </div>
    <div class="mb-3 form-check">
        <label for="quantidade" class="form-label">Quantidade</label>
        <input type="number" step="1" class="form-control" id="quantidade" name="quantidade">
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
</x-app-layout>