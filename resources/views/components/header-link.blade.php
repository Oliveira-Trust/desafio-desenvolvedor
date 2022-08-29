<a
    @if ($route) href="{{ route($route) }}" @else x-on:click.prevent="" @endif
    class="@if (request()->routeIs($routeIs)) !border-b-primary-400 dark:!border-b-primary-600 @endif hover:border-b-primary-400 hover:dark:border-b-primary-600 flex h-full flex-nowrap items-center whitespace-nowrap border-x border-b-4 border-gray-200 border-b-transparent px-6 transition dark:border-gray-700"
>
    {{ $label }}
</a>
