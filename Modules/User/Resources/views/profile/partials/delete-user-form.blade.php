<div class="card mt-3">
    <div class="card-body">
        <div class="card-title"><h4>Alterar senha</h4></div>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="current_password" class="form-label">Senha atual</label>
                <input type="password" name="current_password" class="form-control" id="current_password" required>
                @if ($errors->get('current_password'))
                    @include('components.common.input-errors', ['errors' => $errors->updatePassword->get('current_password')])
                @endif
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Nova senha</label>
                <input type="password" name="password" class="form-control" id="password" required>
                @if ($errors->get('password'))
                    @include('components.common.input-errors', ['errors' => $errors->updatePassword->get('password')])
                @endif
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar senha</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                @if ($errors->get('password_confirmation'))
                    @include('components.common.input-errors', ['errors' => $errors->updatePassword->get('password_confirmation')])
                @endif
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            @if (session('status') === 'password-updated')
                <div class="text-center">
                    @include('components.common.success-alert', ['successMessage' => 'Informações Atualizadas'])
                </div>
            @endif
        </form>
    </div>
</div>
