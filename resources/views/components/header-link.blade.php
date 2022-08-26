<a
    href="{{ route($route) }}"
    class="@if (request()->routeIs($route)) bg-primary-100 dark:bg-primary-500 !border-primary-300 dark:!border-primary-700 @endif hover:bg-primary-100 dark:hover:bg-primary-500 flex h-full items-center border-b-4 border-transparent px-6 transition"
>
    {{ $page }}
</a>
