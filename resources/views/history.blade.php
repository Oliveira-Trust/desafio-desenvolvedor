<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Histórico de Simulação de conversão
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('message')" />

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Valor BRL</th>
                                <th>Moeda de destino</th>
                                <th>Valor Moeda de destino</th>
                                <th>Valor comprado</th>
                                <th>Taxa de pgto</th>
                                <th>Taxa de conversão</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($itens as $item)
                            <tr>
                                <td>{{  date( 'd/m/Y H:i:s' , strtotime($item->created_at)) }}</td>
                                <td style="text-align: right">{{ number_format($item->amount_brl, 2, ",", ".") }}</td>
                                <td style="text-align: center">{{ $item->currency }}</td>
                                <td style="text-align: right">{{ number_format($item->currency_rate, 3, ".", ",") }}</td>
                                <td style="text-align: right">{{ number_format($item->amount, 2, ".", ",") }}</td>
                                <td style="text-align: right">{{ number_format($item->payment_method_fee_value, 2, ",", ".") }}</td>
                                <td style="text-align: right">{{ number_format($item->amount_fee_value, 2, ",", ".") }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
