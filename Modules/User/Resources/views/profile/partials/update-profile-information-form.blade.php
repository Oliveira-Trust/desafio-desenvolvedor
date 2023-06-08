<div class="card">
    <div class="card-body">
        <div class="card-title"><h4>Atualizar Informações</h4></div>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}"
                    required>
                @if ($errors->get('name'))
                    @include('components.common.input-errors', ['errors' => $errors->get('name')])
                @endif
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}"
                    required>
                @if ($errors->get('email'))
                    @include('components.common.input-errors', ['errors' => $errors->get('email')])
                @endif
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            @if (session('status') === 'profile-updated')
                <div class="text-center mt-2">
                    @include('components.common.success-alert', ['successMessage' => 'Informações Atualizadas'])
                </div>
            @endif
        </form>
    </div>
</div>
