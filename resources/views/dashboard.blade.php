<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Simulação de conversão para moeda extrangeira
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('message')" />

                    @if($errors->any())
                    <div class="row">
                        <b style="color: red">{!! implode('', $errors->all('<div>:message</div>')) !!}</b>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('currency_trade') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-4 col-sm-12 mt-6">
                            <label for="value_for_conversion_BRL">Valor para conversão em BRL</label>
                            <input  id="amount_brl" 
                                    class="block mt-1 w-full" 
                                    type="number" min="0.00" max="10000.00" step="0.01" 
                                    name="amount_brl" :value="old('value_for_conversion_BRL')" 
                                    required autofocus />
                        </div>

                        <div class="col-md-4 col-sm-12 mt-6">
                            <label for="destination_currency">Moeda de destino</label>

                            <select id="currency" 
                                    class="block mt-1 w-full" 
                                    name="currency" :value="old('destination_currency')" 
                                    required autofocus />
                                <option value="">Selecione a moeda desejada</option>
                                @foreach ($currencies as $currency)
                                <option value="{{$currency->code}}">{{$currency->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 col-sm-12 mt-6">
                            <label for="payment_method">Forma de pagamento</label>

                            <select id="payment_method" 
                                    class="block mt-1 w-full" 
                                    name="payment_method" :value="old('payment_method')" 
                                    required autofocus />
                                <option value="">Informe como deseja realizar o pagamento</option>
                                @foreach ($payment_methods as $payment_method)
                                <option value="{{ $payment_method->id }}">{{ $payment_method->title }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-md-12 col-12 mt-6" style="text-align: center">
                        <x-button class="ml-3">
                            Simular conversão
                        </x-button>
                    </div>

                    </form> 

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
