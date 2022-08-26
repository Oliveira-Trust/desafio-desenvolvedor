@props(['head'])

<div class="grid min-h-screen place-items-center p-6">
    <div
        class="flex w-full max-w-md flex-col justify-center rounded-md border border-slate-100 bg-white p-6 shadow-xl dark:border-slate-700 dark:bg-slate-800">
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
