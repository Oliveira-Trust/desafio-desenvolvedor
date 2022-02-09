<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Compra de Moedas
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{route('calcular')}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Moeda de Destino</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="moedaDestino">
                              <option value="USD">USD</option>
                              <option value="EUR">EUR</option>

                            </select>
                          </div>
                        <div class="form-group">
                          <label for="valor_conversao">Valor para Conversão (BRL) </label>
                          @if($errors->any())
                          <div class="alert alert-danger" role="alert">
                            {{$errors->first()}}
                          </div>

                        @endif
                          <input type="text" class="form-control" id="valor_conversao" placeholder="R$" name="valorConverter" required>
                        </div>

                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="pgto" class="custom-control-input" value="Boleto" required>
                            <label class="custom-control-label" for="customRadio1">Boleto</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="pgto" class="custom-control-input" value="card" required>
                            <label class="custom-control-label" for="customRadio2">Cartão de Crédito</label>
                        </div>
                       
                       <div class="text-center"> <button type="submit" class="btn btn-outline-primary" id="calculando">Calcular</button></div>
                      </form>
                </div>
                @isset($hash)
                
                <div class="container" style="margin-top: 20px">
                    Moeda de origem: {{$moedaOrigem ?? ""}}<br>
                    Moeda de destino: {{$moedaDestino ?? ""}}<br>
                    Valor para conversão: {{$valorConversao ?? ""}}<br>
                    Forma de pagamento: {{$formaPgto ?? ""}}<br>
                    Valor da "Moeda de destino" usado para conversão: $ {{$valorMoedaDestino ?? ""}}<br>
                    Valor comprado em "Moeda de destino": $ {{$valorComprado ?? ""}} (taxas aplicadas no valor de compra diminuindo no valor total de conversão)<br>
                    Taxa de pagamento: R$ {{$taxaPagamento ?? ""}}<br>
                    Taxa de conversão: R$ {{$taxaConversao ?? ""}}<br>
                    Valor utilizado para conversão descontando as taxas: R${{$valorTotalUsado ?? ""}}<br>

                </div>
                @endisset

            </div>
        </div>
    </div>
</x-app-layout>
<script src="{{asset('js/maskMoney.min.js')}}" type="text/javascript"></script>
<script>
    $(function(){
     
            $('#valor_conversao').maskMoney({
              prefix:'R$ ',
              allowNegative: true,
              thousands:'.', decimal:',',
              affixesStay: true});

    })
</script>
