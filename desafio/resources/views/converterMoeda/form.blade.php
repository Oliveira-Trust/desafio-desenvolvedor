<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Conversão de Moeda
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form id="currency-form">
                    @csrf
                    <div class="px-6 py-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2"
                                   for="moeda_destino">
                                Cotar
                            </label>
                            <select id="moeda_destino" name="moeda_destino"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>Selecione a opção desejada</option>
                                @foreach($moedas as $moeda)
                                    <option value="{{ $moeda }}">{{ $moeda }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2" for="valor">
                                Quantia
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="valor" name="valor" type="number" placeholder="Quantia">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2"
                                   for="forma_pagamento">
                                Método de Pagamento
                            </label>
                            <select id="forma_pagamento" name="forma_pagamento"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>Selecione a opção desejada</option>
                                @foreach($formasPagamento as $key => $formaPagamento)
                                    <option value="{{ $key }}">{{ $formaPagamento }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-between">
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit">
                                Cotar
                            </button>
                        </div>
                    </div>
                </form>
                <div id="alert-container"></div>
                <div id="loader"
                     class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
                    <div class="spinner-border animate-spin inline-block w-8 h-8 border-4 rounded-full" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('currency-form').addEventListener('submit', function (event) {
            event.preventDefault();

            const moedaDestino = document.getElementById('moeda_destino').value;
            const valor = document.getElementById('valor').value;
            const formaPagamento = document.getElementById('forma_pagamento').value;

            const loader = document.getElementById('loader');
            loader.classList.remove('hidden');

            axios.post('{{ route('moeda.converter') }}', {
                moeda_destino: moedaDestino,
                valor: valor,
                forma_pagamento: formaPagamento,
                _token: '{{ csrf_token() }}'
            })
                .then(response => {
                    loader.classList.add('hidden');
                    window.location.href = "{{ route('dashboard') }}";
                })
                .catch(error => {
                    loader.classList.add('hidden');
                    let errorMessage = 'Ocorreu um erro ao processar sua solicitação. Por favor, tente novamente.';
                    if (error.response && error.response.data && error.response.data.errors) {
                        const errors = error.response.data.errors;
                        errorMessage = Object.values(errors).flat().join('<br>');
                    }
                    if (error.response.data.message) {
                        errorMessage = error.response.data.message;
                    }

                    const alertContainer = document.getElementById('alert-container');
                    alertContainer.innerHTML = `
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">${errorMessage}</strong>
                    </div>
                `;
                });
        });
    </script>
</x-app-layout>
