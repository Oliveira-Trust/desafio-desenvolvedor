<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <iframe src="{{route('currency-converter')}}" width="100%" height="600px" scrolling="no"  frameborder="0"></iframe>

</x-app-layout>
