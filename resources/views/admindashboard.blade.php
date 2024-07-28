<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th>Forma de pagamento</th>
                                <th>Taxa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paymentMethods as $method)
                                <form method="post" action="{{ route('admin.payment.tax') }}">
                                    @csrf
                                    @method('Patch')
                                    <tr><td><input type="hidden" name="paymentMethodId" value="{{ $method->id }}">{{ $method->method_name }}</td><td><input type="text" id="tax" name="tax" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg
                                       bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500" value="{{ $method->method_tax }}" required></td><td class="px-1 py-1"><button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">alterar taxa</button></td></tr>
                                </form>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-1 px-1"></div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">
                        <form method="post" action="{{ route('admin.conversion.tax') }}">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th colspan="4" class="px-1 py-3">TAXA DE CONVERSÃO</th>
                            </tr>
                            <tr>
                                <th>Valor de referência</th>
                                <th>Taxa até valor de referência</th>
                                <th>Taxa acima do valor de referência</th>
                            </tr>
                            <tbody>
                            <tr>
                                <td>@csrf @method('Put')
                                    <input type="text" id="reference_value" name="reference_value" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg
                                        bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500" required value="{{ $taxConversion->reference_value }}">
                                </td>
                                <td>
                                    <input type="text" id="down_value_tax" name="down_value_tax" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg
                                        bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500" required value="{{ $taxConversion->down_value_tax }}">
                                </td>
                                <td>
                                    <input type="text" id="up_value_tax" name="up_value_tax" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg
                                        bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500" required value="{{ $taxConversion->up_value_tax }}">
                                </td>
                                <td>
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                        Atualizar
                                    </button>
                                </td>
                            </tr>

                            </tbody>
                            </thead>

                        </table>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
