@csrf
<div class="form-group">
    <label>Nome</label>
    <input type="text" name="name" class="form-control" placeholder="Nome do Produto"
           value="{{ empty($product) ? old('name') : $product->name }}" required>
</div>
<div class="form-group">
    <label>Descricao</label>
    <input type="text" name="description" placeholder="Descrição do produto"
           value="{{empty($product) ? old('description') : $product->description }}" class="form-control" required>
</div>
<div class="form-group">
    <label>Preço</label>
    <input type="number" name="price" placeholder="Preço do produto" class="form-control"
           value="{{empty($product) ? "0" : $product->price}}" required>
</div>
<button type="submit" class="btn btn-primary">Editar Produto</button>
