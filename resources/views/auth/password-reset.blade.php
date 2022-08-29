@push('title', 'Redefinir senha')

<x-app-layout>
    <x-auth-layout formActionRoute="{{ route('password.update') }}">
        <x-slot name="head">
            <div class="col-span-12 mb-4 flex flex-col gap-1">
                <h3 class="text-xl font-bold">Redefinir a senha</h3>
                <small class="text-xs">Confirme seu email e crie uma nova senha</small>
            </div>
        </x-slot>
        <input type="hidden" id="token" name="token" value="{{ $token }}" />
        <div class="col-span-12">
            <x-input
                helper-text="Confirme seu email"
                icon="at-symbol"
                label="Email"
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
            />
        </div>
        <div class="col-span-12">
            <x-input
                icon="lock-closed"
                label="Nova senha"
                id="password"
                name="password"
                type="password"
            />
        </div>
        <div class="col-span-12">
            <x-input
                icon="check-circle"
                label="Confirme a nova senha"
                id="password_confirmation"
                name="password_confirmation"
                type="password"
            />
        </div>
        <div class="col-span-12 mt-2 flex items-center justify-end gap-4">
            <x-button
                label="Redefinir"
                type="submit"
                outline
                primary
            />
        </div>
    </x-auth-layout>
</x-app-layout>
