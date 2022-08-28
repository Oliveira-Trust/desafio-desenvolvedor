@props(['header', 'footer'])

<a
    href="{{ route($route) }}"
    {{ $attributes->merge(['class' => 'hover:scale-[102%] hover:rotate-1 opacity-[98] hover:opacity-100 transition-gpu duration-300 rounded-md border border-gray-100 p-6 shadow-lg dark:border-gray-700']) }}
>
    {{ $header }}

    <div class="mb-6"></div>

    {{ $footer }}
</a>
