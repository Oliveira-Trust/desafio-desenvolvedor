<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite('resources/js/app.js')
</head>

<body class="dark">
    <div class="fixed flex flex-col items-center justify-center w-full h-full dark:bg-black bg-opacity-50">
        <div class="my-5">
            <span class="text-white text-2xl font-medium text-white">
                Olá, {{ $name ?? ' seja bem vindo' }}!
            </span>
        </div>
        <div class="flex flex-row">
            <div class="mx-10">
                <div class="flex flex-col overflow-hidden bg-white rounded-lg">
                    <div class="flex flex-col px-12 py-10 bg-white">
                        <div class="mt-1">
                            {{-- <form method="post" action="{{ route('store') }}"> --}}
                            <form method="post" action="/">
                                @csrf
                                <label class="block">
                                    <span class="text-lg font-medium text-gray-800">Moeda de Destino</span>
                                    <select
                                        class="block w-full px-4 py-3 mt-1 text-lg bg-gray-100 border-2 border-transparent rounded">
                                        @foreach (App\Enums\CoinOptionsEnum::values() as $key => $value)
                                            <option value="{{ $value }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                    <span class="block font-medium text-brand-danger"></span>
                                </label>
                                <label class="block mt-6">
                                    <span class="text-lg font-medium text-gray-800">Valor de Conversão</span>
                                    <input type="number"
                                        class="block w-full px-4 py-3 mt-1 text-lg bg-gray-100 border-2 border-transparent rounded" />
                                    <span class="block font-medium text-brand-danger"></span>
                                </label>
                                <label class="block mt-6">
                                    <span class="text-lg font-medium text-gray-800">Tipo de Pagamento</span>
                                    <select
                                        class="block w-full px-4 py-3 mt-1 text-lg bg-gray-100 border-2 border-transparent rounded">
                                        @foreach (App\Enums\PaymentTypsEnum::values() as $key => $value)
                                            <option value="{{ $value }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                    <span class="block font-medium text-brand-danger"></span>
                                </label>
                                <div class="flex justify-center">
                                    <button
                                        class="px-8 py-3 mt-10 font-bold text-white rounded bg-green-500 focus:outline-none">
                                        <span>Calcular</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-10">
                <div class="flex flex-col overflow-hidden bg-white rounded-lg">
                    <div class="flex flex-col px-12 py-10 bg-white">
                        <div class="grid grid-cols-3 my-7">
                            <div class="grid grid-flow-row mx-2">
                                <span class="text-lg font-medium text-gray-800">Moeda de Origem</span>
                                <input type="text"
                                    class="block w-full px-4 py-3 mt-1 text-lg bg-gray-100 border-2 border-transparent rounded"
                                    disabled value="BRL">
                            </div>
                            <div class="grid grid-flow-row mx-2">
                                <span class="text-lg font-medium text-gray-800">Moeda de Destino</span>
                                <input type="text"
                                    class="block w-full px-4 py-3 mt-1 text-lg bg-gray-100 border-2 border-transparent rounded"
                                    disabled value="USD">
                            </div>
                            <div class="grid grid-flow-row mx-2">
                                <span class="text-lg font-medium text-gray-800">Valor para Conversão:</span>
                                <input type="text"
                                    class="block w-full px-4 py-3 mt-1 text-lg bg-gray-100 border-2 border-transparent rounded"
                                    disabled value="R$ 5000,00">
                            </div>
                        </div>
                        <div class="grid grid-cols-3 my-5">
                            <div class="grid grid-flow-row mx-2">
                                <span class="text-lg font-medium text-gray-800">Forma de Pagamento:</span>
                                <input type="text"
                                    class="block w-full px-4 py-3 mt-1 text-lg bg-gray-100 border-2 border-transparent rounded"
                                    disabled value="Boleto">
                            </div>
                            <div class="grid grid-flow-row mx-2">
                                <span class="text-lg font-medium text-gray-800">Valor para Conversão (Destino):</span>
                                <input type="text"
                                    class="block w-full px-4 py-3 mt-1 text-lg bg-gray-100 border-2 border-transparent rounded"
                                    disabled value="R$ 5,00">
                            </div>
                            <div class="grid grid-flow-row mx-2">
                                <span class="text-lg font-medium text-gray-800">Valor Comprado (Destino):</span>
                                <input type="text"
                                    class="block w-full px-4 py-3 mt-1 text-lg bg-gray-100 border-2 border-transparent rounded"
                                    disabled value="R$ 1230,00">
                            </div>
                        </div>
                        <div class="grid grid-cols-3 my-5 ">
                            <div class="grid grid-flow-row mx-2">
                                <span class="text-lg font-medium text-gray-800">Taxa de Pagamento:</span>
                                <input type="text"
                                    class="block w-full px-4 py-3 mt-1 text-lg bg-gray-100 border-2 border-transparent rounded"
                                    disabled value="R$ 82,00">
                            </div>
                            <div class="grid grid-flow-row mx-2">
                                <span class="text-lg font-medium text-gray-800">Taxa de Conversão:</span>
                                <input type="text"
                                    class="block w-full px-4 py-3 mt-1 text-lg bg-gray-100 border-2 border-transparent rounded"
                                    disabled value="R$ 32,00">
                            </div>
                            <div class="grid grid-flow-row mx-2">
                                <span class="text-lg font-medium text-gray-800">Valor para Conversão (com taxas):</span>
                                <input type="text"
                                    class="block w-full px-4 py-3 mt-1 text-lg bg-gray-100 border-2 border-transparent rounded"
                                    disabled value="R$ 4837,00">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
