<x-app-layout>
    <div class="row justify-content-center py-12 start-controller-calc">
        <div class="col col-10 col-md-8 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form id="formCalculator">
                <div class="row">
                    <div class="col col-12 col-md-6">
                        <h3>Bem vindo!</h1>
                        <p>Insira todos os valores para converter a moeda BRL</p>
                        <div class="form-group">
                            <label for="coin_to">Moeda de destino</label>
                            <select name="coin_to" id="coin_to" class="form-control form-select-sm" aria-describedby="coinToHelp">
                                <option value="USD">USD</option>
                                <option value="BTC">BTC</option>
                            </select>
                            <small id="coinToHelp" class="form-text text-muted">Moeda a qual será convertido a moeda.</small>
                        </div>
                        <div class="form-group">
                            <label for="money">Valor para conversão</label>
                            <input type="text" class="form-control money" id="money" placeholder="{!! $feesCharged['money_min'] !!}"
                            data-min="{!! $feesCharged['money_min'] !!}" data-max="{!! $feesCharged['money_max'] !!}">
                            <small id="coinToHelp" class="form-text text-muted">Valores permitidos R$ {!! $feesCharged['money_min'] !!} à R$ {!! $feesCharged['money_max'] !!} </small>
                        </div>
                        <label for="type_of_payment">Forma de pagamento</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type_of_payment" id="typeOfPayment1" checked value="1">
                                    <label class="form-check-label" for="typeOfPayment1">
                                        Boleto
                                    </label>
                                </div>
                                <small id="typeOfPayment1" class="form-text text-muted">Taxa de {!! $feesCharged['fee_ticket'] !!}%</small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type_of_payment" id="typeOfPayment2" value="2">
                                    <label class="form-check-label" for="typeOfPayment2">
                                        Cartão de Crédito
                                    </label>
                                </div>
                                <small id="typeOfPayment2" class="form-text text-muted">Taxa de {!! $feesCharged['fee_card'] !!}%</small>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary pull-right mt-3" id="convertMoney">Calcular</button>
                    </div>
                    <div class="col col-12 col-md-6 mt-3">
                        <div class="list-of-result" style="display: none;">
                            <p>Informações enviadas para o e-mail cadastrado no usuário</p>
                        </div>
                        <ul class="list-group list-of-result mt-8" style="display: none;">
                            <li class="list-group-item font-12">
                                Moeda de origem: <span class="bold font-12">BRL</span>
                            </li>
                            <li class="list-group-item font-12">
                                Moeda de destino: <span class="bold font-12 apply-coin-to"></span>
                            </li>
                            <li class="list-group-item font-12">
                                Valor para conversão: <span class="bold font-12 apply-money"></span>
                            </li>
                            <li class="list-group-item font-12">
                                Forma de pagamento: <span class="bold font-12 apply-type-payment"></span>
                            </li>
                            <li class="list-group-item font-12">
                                Valor da "moeda" usado para conversão: <span class="bold font-12 apply-price-money"></span>
                            </li>
                            <li class="list-group-item font-12">
                                Valor comprado: <span class="bold font-12 apply-converted-money"></span>
                            </li>
                            <li class="list-group-item font-12">
                                Taxa de pagamento: <span class="bold font-12 apply-payment-rate"></span>
                            </li>
                            <li class="list-group-item font-12">
                                Valor de conversão: <span class="bold font-12 apply-cost-conversion"></span>
                            </li>
                            <li class="list-group-item font-12">
                                Valor utilizado para conversão já com desconto: <span class="bold font-12 apply-money-to-convert"></span>
                            </li>
                        </ul>
                    </div>
                </div>    
            </form>
        </div>
    </div>
</x-app-layout>
