<x-app-layout>
<div class="row justify-content-center py-12">
        <div class="col col-10 col-md-10 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <p class="mb-0 ml-2">Aqui você tem acesso ao histórico</p>
            <div class="row py-12 px-6">
                <table class="table table-striped table-cellphone">
                    <thead>
                        <tr>
                            <th scope="col">Moeda dest.</th>
                            <th scope="col">Valor de conver.</th>
                            <th scope="col" class="hide-cellphone">Valor utilizado</th>
                            <th scope="col">Valor da compra</th>
                            <th scope="col" class="hide-cellphone">Form de pag.</th>
                            <th scope="col" class="hide-cellphone">Valor da moeda</th>
                            <th scope="col" class="hide-cellphone">Taxa de pag.</th>
                            <th scope="col" class="hide-cellphone">Taxa de conver.</th>
                            <th scope="col">Data</th>
                        </tr>
                    </thead>
                    <tbody class="font-12">
                    @foreach ($histories as $history)
                        <tr>
                            <td>
                                {{ $history->coin_to }}
                            </td>
                            <td>
                                {{ $history->money }}
                            </td>
                            <td class="hide-cellphone">
                                {{ $history->money_convert }}
                            </td>
                            <td>
                                {{ $history->converted_money }}
                            </td>
                            <td class="hide-cellphone">
                                {{ $history->type_payment }}
                            </td>
                            <td class="hide-cellphone">
                                {{ $history->price_money }}
                            </td>
                            <td class="hide-cellphone">
                                {{ $history->payment_rate }}
                            </td>
                            <td class="hide-cellphone">
                                {{ $history->cost_conversion }}
                            </td>
                            <td>
                                {{ $history->getDate() }}
                            </td>
                        </tr>
                        
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center div-pagination mt-4">
                    {{ $histories->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>