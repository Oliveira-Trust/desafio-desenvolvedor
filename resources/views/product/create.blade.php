<form action="{{route('store_product')}}" method="post">
    @csrf
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name">
    <label for="price">Price:</label>
    <input type="text" name="price" id="price">
    <button>Adicionar</button>
</form>
