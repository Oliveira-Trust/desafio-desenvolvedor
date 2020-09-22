<div class="input-field">
	<input type="text" name="name" id="name" value="{{ isset($registro->name) ? $registro->name : null }}">
	<label for="nome">Nome</label>
</div>

<div class="input-field">
    <input type="email" name="email" id="email" value="{{ isset($registro->email) ? $registro->email : null }}">
    <label for="email">E-mail</label>
</div>

<div class="input-field">
    <input type="password" name="password" id="password" value="{{ isset($registro->password) ? $registro->password : null }}">
    <label for="password">Senha</label>
</div>
