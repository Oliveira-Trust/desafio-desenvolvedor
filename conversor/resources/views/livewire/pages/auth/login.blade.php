<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    $this->redirectIntended(default: route('conversor', absolute: false), navigate: true);
};

?>

<div class="py-8">
    <div class="max-w-md mx-auto px-4 md:px-0">
        <h1 class="dark:text-white text-center text-xl mt-10">Efetue o login para Entrar</h1>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg py-6 px-8 mt-8">

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    

            <form wire:submit="login">
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                </div>
        
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Senha')" />
        
                    <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
        
                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                </div>
        
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        {{ __('Entrar') }}
                    </x-primary-button>
                </div>
            </form>
        
        </div>
    </div>
</div>
