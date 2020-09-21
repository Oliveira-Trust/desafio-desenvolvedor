@csrf
<div class="form-group">
    <label>Nome</label>
    <input type="text" name="name" class="form-control" placeholder="Nome do cliente"
           value="{{ empty($client) ? old('name') : $client->name }}" required>
</div>
<div class="form-group">
    <label>email</label>
    <input type="email" name="email" placeholder="Email do cliente"
           value="{{empty($client) ? old('email') : $client->email }}" class="form-control" required>
</div>

