@push('title', 'Acesso')

<x-app-layout>
    <x-auth-layout formActionRoute="{{ route('auth.login.index') }}">
        <x-slot name="head">
            <div class="col-span-12 mb-4 flex flex-col gap-1">
                <h3 class="text-xl font-bold">Acesso</h3>
                <small class="text-xs">Insira suas credenciais para continuar.</small>
            </div>
        </x-slot>
        <div class="col-span-12">
            <x-input
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
                label="Senha"
                id="password"
                name="password"
                type="password"
            />
        </div>
        <div class="col-span-12 mt-2 flex items-center justify-end gap-4">
            <a
                class="text-primary-500 text-sm hover:underline"
                href="{{ route('auth.forgot-password.index') }}"
            >
                Esqueceu a senha?
            </a>
            <x-button
                label="Acessar"
                type="submit"
                outline
                primary
            />
        </div>
        <hr class="col-span-12 border-gray-300 dark:border-gray-700">
        <div class="col-span-12 mt-2 flex items-center justify-center gap-4">
            <a
                class="text-primary-500 text-sm hover:underline"
                href="{{ route('auth.registration.index') }}"
            >
                Cadastre-se aqui
            </a>
        </div>
    </x-auth-layout>
</x-app-layout>
