<div class="form-row">
    <div class="form-group col-md-6 required">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" value="{{ old('nome',$usuario->nome ?? '' ?? '') }}"   class="form-control @error('nome') is-invalid @enderror"  placeholder="Nome do usuário">
        @error('nome')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-6 required">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" value="{{ old('email',$usuario->email ?? '' ?? '') }}"   class="form-control @error('email') is-invalid @enderror"  placeholder="Email(login) do usuário">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group col-md-6  {{ (!empty($usuario->id) ? '' : 'required') }}">
        <label for="nome">
            {{ (!empty($usuario->id) ? 'Nova senha' : 'Senha') }} 
        </label>
        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Senha" name="password"  autocomplete="new-password">
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    @if (empty($usuario->id))
        <div class="form-group col-md-6 required">
            <label for="nome">Confirma senha</label>
            <input id="password-confirmation" type="password" name ="password_confirmation" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" placeholder="Confirma senha"  autocomplete="new-password">
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    @endif
</div>
        