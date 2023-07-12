<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Test') }}
        </h2>
    </x-slot>

    <div class="container">

        <div class="row">
            <div class="offset-3 col-8">

                <div class="card mt-5">
                    <div class="card-header bg-success text-white">
                        <b>History Currency Conversion</b>
                    </div>
                    <div class="card-body">
                        
                        <table class="table table-hover" id="cotacoes">
                            <thead>
                                <tr class="text-center" rowspan="2">
                                    <th scope="col">Source Currency</th>
                                    <th scope="col">Target Currency</th>
                                    <th scope="col">Conversion Value</th>
                                    <th scope="col">Value Target Currency</th>
                                    <th scope="col">Value Payment Fee</th>
                                    <th scope="col">Value Conversion Fee</th>
                                    <th scope="col" >Cotation Date</th>
                                </tr>
                            </thead>
                            <tbody>
                               @if (isset($data))
                                    @foreach ($data as $item)
                                        <tr class="text-center" >
                                            <td>{{ $item['source_currency'] }}</td>
                                            <td>{{ $item['target_currency'] }}</td>
                                            <td>{{ number_format($item['conversion_value'], 2, ',', '.')}}</td>
                                            <td>{{ number_format($item['value_target_currency'], 2, ',', '.') }}</td>
                                            <td>{{ number_format($item['value_payment_fee'], 2, ',', '.') }}</td>
                                            <td>{{ number_format($item['value_conversion_fee'], 2, ',', '.') }}</td>
                                            <td>{{ $item['created_at'] }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                
                    </div>
                </div>


            </div>
        </div>

    </div>
        
</x-app-layout>
