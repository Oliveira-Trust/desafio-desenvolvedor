@push('title', 'Cadastre-se')

<x-app-layout>
    <x-auth-layout formActionRoute="{{ route('auth.registration.index') }}">
        <x-slot name="head">
            <div class="col-span-12 mb-4 flex flex-col gap-1">
                <h3 class="text-xl font-bold">Cadastre-se</h3>
                <small class="text-xs">Insira suas credenciais para continuar.</small>
            </div>
        </x-slot>
        <div class="col-span-12">
            <x-input
                icon="user"
                label="Nome"
                id="name"
                name="name"
                value="{{ old('name') }}"
            />
        </div>
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
        <div
            class="col-span-12"
            x-data="{ showPassword: false }"
        >
            <x-input
                icon="lock-closed"
                label="Senha"
                id="password"
                name="password"
                x-bind:type="showPassword ? 'text' : 'password'"
            >
                <x-slot name="append">
                    <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                        <x-button
                            x-on:click="showPassword = !showPassword"
                            class="h-full rounded-r-md"
                            primary
                        >
                            <x-icon
                                x-cloak
                                x-show="!showPassword"
                                name="eye"
                                class="h-5 w-5"
                            />

                            <svg
                                x-cloak
                                x-show="showPassword"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"
                                />
                            </svg>
                        </x-button>
                    </div>
                </x-slot>
            </x-input>
        </div>
        <div class="col-span-12 mt-2 flex items-center justify-end gap-4">
            <a
                class="text-primary-500 text-sm hover:underline"
                href="{{ route('auth.login.index') }}"
            >
                Já é cadastrado?
            </a>
            <x-button
                label="Enviar"
                type="submit"
                outline
                primary
            />
        </div>
    </x-auth-layout>
</x-app-layout>
