<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Histórico de Conversão') }}
        </h2>
    </x-slot>

    <div class="py-12 text-left">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm">
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-4 rounded-md mb-4 border border-green-300">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 text-red-800 p-4 rounded-md mb-4 border border-red-300">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 text-red-800 p-4 rounded-md mb-4 border border-red-300">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="p-6 text-gray-900">
                    <table id="conversion-table" class="bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-5 border-b border-gray-200">Moeda de origem</th>
                                <th class="py-2 px-5 border-b border-gray-200">Moeda de destino</th>
                                <th class="py-2 px-5 border-b border-gray-200">Valor para conversão</th>
                                <th class="py-2 px-5 border-b border-gray-200">Método de Pagamento</th>
                                <th class="py-2 px-5 border-b border-gray-200">Valor da moeda de conversão</th>
                                <th class="py-2 px-5 border-b border-gray-200">Valor comprado em moeda de conversão</th>
                                <th class="py-2 px-5 border-b border-gray-200">Taxa de pagamento</th>
                                <th class="py-2 px-5 border-b border-gray-200">Taxa de conversão</th>
                                <th class="py-2 px-5 border-b border-gray-200">Valor total sem as taxas</th>
                                <th class="py-2 px-5 border-b border-gray-200">
                                <th class="py-2 px-5 border-b border-gray-200">
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($conversions as $conversion)
                                @php
                                    $symbol = 'R$ ';
                                    switch ($conversion->to) {
                                        case 'USD':
                                            $symbol = '$ ';
                                            break;
                                        case 'EUR':
                                            $symbol = '€ ';
                                            break;
                                        case 'GBP':
                                            $symbol = '£ ';
                                            break;
                                        default:
                                            break;
                                    }
                                @endphp
                                <tr>
                                    <td class="py-2 px-5 border-b border-gray-200">{{ $conversion->from }}</td>
                                    <td class="py-2 px-5 border-b border-gray-200">{{ $conversion->to }}</td>
                                    <td class="py-2 px-5 border-b border-gray-200">R$ {{ number_format($conversion->amount, 2, ',', '.') }}</td>
                                    <td class="py-2 px-5 border-b border-gray-200">{{ $conversion->payment_method == 'boleto' ? 'Boleto' : 'Cartão de Crédito' }}</td>
                                    <td class="py-2 px-5 border-b border-gray-200">{{ $symbol . number_format($conversion->currency_value, 2, ',', '.') }}</td>
                                    <td class="py-2 px-5 border-b border-gray-200">{{ $symbol . number_format($conversion->purchase_amount, 2, ',', '.') }}</td>
                                    <td class="py-2 px-5 border-b border-gray-200">R$ {{ number_format($conversion->conversion_rate, 2, ',', '.') }}</td>
                                    <td class="py-2 px-5 border-b border-gray-200">R$ {{ number_format($conversion->payment_rate, 2, ',', '.') }}</td>
                                    <td class="py-2 px-5 border-b border-gray-200">R$ {{ number_format($conversion->purchase_price_excluding_taxes, 2, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('conversion.show', $conversion->id) }}" method="GET">
                                            <x-secondary-button type="submit">
                                                Detalhes da conversão
                                            </x-secondary-button>
                                        </form>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        <form action="{{ route('sendEmail', $conversion->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja enviar este email?');">
                                            @csrf
                                            @method('GET')
                                            <x-primary-button>
                                                Enviar Email
                                            </x-primary-button>
                                        </form>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        <form action="{{ route('conversion.delete', $conversion->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este registro?');">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button>
                                                Deletar
                                            </x-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
