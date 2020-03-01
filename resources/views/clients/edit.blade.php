<form method="POST" action="/clients/{{$client->id}}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{$client->name}}">
    </div>
    <button type="submit">Salvar</button>
</form>
