<x-app-layout>
    <div class="row justify-content-center py-12">
        <div class="col col-10 col-md-6 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form id="formFeesCharged" method="POST" action="/saveFeesCharged">
                @csrf
                <p>Altere as taxas aplicadas na conversão da moeda</p>
                <div class="row">
                    <div class="col col-6 col-md-3">
                        <div class="form-group">
                            <label for="money_min">Valor minimo</label>
                            <input type="text" class="form-control money" name="money_min" id="money_min" 
                            value="{!! $feesCharged['money_min'] !!}" placeholder="1.000,00" required>
                        </div>
                    </div>
                    <div class="col col-6 col-md-3">
                        <div class="form-group">
                            <label for="money_max">Valor máximo</label>
                            <input type="text" class="form-control money" name="money_max" id="money_max" 
                            value="{!! $feesCharged['money_max'] !!}" placeholder="100.000,00" required>
                        </div>
                    </div>
                    <div class="col col-6 col-md-3">
                        <div class="form-group">
                            <label for="fee_ticket">Taxa de boleto</label>
                            <input type="text" class="form-control percent" name="fee_ticket" id="fee_ticket" 
                            value="{!! $feesCharged['fee_ticket'] !!}" placeholder="01.00" required>
                        </div>
                    </div>
                    <div class="col col-6 col-md-3">
                        <div class="form-group">
                            <label for="fee_card">Taxa de cartão</label>
                            <input type="text" class="form-control percent" name="fee_card" id="fee_card" 
                            value="{!! $feesCharged['fee_card'] !!}" placeholder="01.00" required>
                        </div>
                    </div>
                    <div class="col col-6 col-md-3">
                        <div class="form-group">
                            <label for="value_below">Parâmetro 
                                <i class="fa fa-info-circle active-popover" aria-hidden="true"
                                data-toggle="popover" title="Regra" 
                                data-trigger="hover"
                                data-content="Aplicar taxa informada em 'Taxa abaixo' pela conversão para valores abaixo do valor inserido em 'Parâmetro' e aplica a taxa inserida em 'Taxa acima' para valores maiores que do que foi inserido em 'Parâmetro', essa taxa deve ser aplicada apenas no valor da compra e não sobre o valor já com a taxa de forma de pagamento."></i>
                            </label>
                            <input type="text" class="form-control money" name="parameter_money" id="parameter_money"
                            value="{!! $feesCharged['parameter_money'] !!}" placeholder="1.000,00" required>
                        </div>
                    </div>
                    <div class="col col-6 col-md-3">
                        <div class="form-group">
                            <label for="fee_below">Taxa abaixo</label>
                            <input type="text" class="form-control percent" name="fee_below" id="fee_below"
                            value="{!! $feesCharged['fee_below'] !!}" placeholder="1.00" required>
                        </div>
                    </div>
                    <div class="col col-6 col-md-3">
                        <div class="form-group">
                            <label for="fee_above">Taxa acima</label>
                            <input type="text" class="form-control percent" name="fee_above" id="fee_above"
                            value="{!! $feesCharged['fee_above'] !!}" placeholder="1.00" required>
                        </div>
                    </div>
                    <div class="col-12 mt-6">
                        <div class="btn-group pull-right">
                            <a href="{{route('reset.fees')}}" class="btn btn-warning">Redefinir</a>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>    
            </form>
        </div>
    </div>
</x-app-layout>
