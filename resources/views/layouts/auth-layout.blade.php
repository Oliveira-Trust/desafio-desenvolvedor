@props(['head'])

<div class="grid min-h-screen place-items-center p-6">
    <div class="flex w-full max-w-md flex-col justify-center">
        <div class="flex flex-col items-center justify-center gap-2">
            <a href="{{ route('dashboard') }}">
                <x-app-logo class="h-8" />
            </a>
            <span class="text-sm font-light">
                Desafio desenvolvedor PHP (Jr/Pleno/Sênior)
            </span>
            <div class="text-xs font-light">
                Desenvolvido por
                <a
                    class="text-primary-400 underline"
                    target="_blank"
                    href="https://github.com/gabriel-torres-brum"
                >
                    Gabriel Torres Brum
                </a>
            </div>
        </div>
        <div class="my-2"></div>
        <div
            class="flex flex-col justify-center rounded-md border border-gray-200 bg-white p-8 shadow-lg dark:border-gray-700 dark:bg-gray-800">
            <x-errors
                title="Não foi possível continuar"
                only="error"
                class="my-2"
            />
            {{ $head }}
            <form
                class="flex w-full flex-col items-end"
                action="{{ $formActionRoute }}"
                method="POST"
            >
                @csrf
                <div class="grid w-full grid-cols-12 gap-4">
                    {{ $slot }}
                </div>
            </form>
        </div>

    </div>
</div>
