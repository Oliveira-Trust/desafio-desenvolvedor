<form action="{{route('store_client')}}" method="post">
    @csrf
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name">
    <label for="email">Email:</label>
    <input type="text" name="email" id="email">
    <button>Adicionar</button>
</form>
