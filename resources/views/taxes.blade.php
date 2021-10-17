
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Taxas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-5">

                <form class="w-full max-w-lg" action="{{ route('update-taxe') }}" method="POST">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-12">
                        @foreach ( $taxes as $taxe )
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="{{ $taxe->name }}">
                                    {{ $taxe->display_name }}
                                </label>
                                <input value="{{ $taxe->percentage }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="{{ $taxe->name }}" id="{{ $taxe->name }}" type="text">
                            </div>
                        @endforeach

                        <div class="w-full md:w-1/2 px-3 mt-3">
                            <button class="  bg-blue-500 hover:bg-blue-700 text-white font-bold p-4 rounded">
                                ALTERAR TAXAS
                            </button>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
