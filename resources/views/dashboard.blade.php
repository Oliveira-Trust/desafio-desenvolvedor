<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2>Dados de Conversão</h2>
                <div class="row col-lg-12 ml-4">
                    <div class="block-content col-lg-12 pb-6 ">
                        <form class="form-horizontal" method="POST" action ="/quotation" name="form-quotation"
                            autocomplete="off">
                            @csrf
                            <div class="form-group row">
                            <div class="col-lg-4 mt-2 >
                                    <label class="form-control-label">Valor de Conversão:</label>
                                <div class="input-group ">
                                    <input type="number" id="amount" name="amount" class="form-control align-rigth" required/>
                                    <div class="input-group-pospend ">
                                      <div class="input-group-text">,00</div>
                                     </div>

                                </div>    
                            </div>
    
                                <div class="col-lg-4 mt-2">
                                    <label class="form-control-label">Moeda de Destino:</label>
                                    <select name="coin"  class = "form-control" id="equipamento_id" required>
                                        <option value="">Selecione uma moeda</option>
                                        <option value="USD">Dolar Americano</option>
                                        <option value="EUR">Euro</option>
                                        <option value="GBP">Libra Esterlina</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mt-2">
                                    <label class="form-control-label">Forma de Pagamento:</label>
                                    <select name="paymentType" id="paymentType" class = "form-control" id="equipamento_id" required>
                                        <option value="">Selecione forma de pagamento</option>
                                        <option value="Cartao Credito">Cartão de Crédito</option>
                                        <option value="Boleto">Boleto</option>
                                    </select>
                                </div>

                            </div>

                            <hr />

                            <div class="form-group row pl-4 pb-4">
                                <div class="col">
                                        <button type="reset" class="btn btn-alt-info">
                                        Limpar</button>
                                    <button type="button" class="btn btn-alt-success new-quotation" value="Gravar">
                                        <span><i class="fa fa-check"></i> Gravar</span>
                                    </button>

                                 </div>
                            </div>
                        </form>
                     </div>

                     <div class="block-content col-lg-6 pb-6 this-quotation">

                    </div>
                     
                </div>
            
        </div>
    </div>
    <div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="row col-lg-12 ml-2">
                <h2>Cotações Anteriores </h2>
                <div class="block-content">
                       <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Data</th>
                                <th scope="col">Moeda Origem</th>
                                <th scope="col">Valor de Conversão</th>
                                <th scope="col">Moeda Destino</th>
                                <th scope="col">Valor Unitário</th>
                                <th scope="col">Taxa de pagamento</th>
                                <th scope="col">Taxa de Conversão</th>
                                <th scope="col">Valor Liquido a Converter</th>
                                <th scope="col">Valor Convertido</th>
                                </tr>
                            </thead>
                            <tbody class="last-quotation">
                           </tbody>
                        </table>
                     </div>
                </div>
              
                </div>
            </div>
    </div>

    </div>
    <script src="http://code.jquery.com/jquery-1.9.0rc1.js"></script>

    <script type="text/javascript">

    getQuotation()

    function getQuotation(){
        let html =``
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: `/quotations/getAll` + location.search
    
            }).done(function (dados){
                dados.data.forEach((quotation, key)=> {
                        html += `<tr>
                                <td>${dateBR(quotation.created_at)}</td>
                                <td>${quotation.target_coin}</td>
                                <td>${numberToReal(quotation.conversion_amount)}</td>
                                <td>${quotation.source_coin}</td>
                                <td>${numberToReal(quotation.source_coin_value)}</td>
                                <td>${numberToReal(quotation.rate_payment)}</td>
                                <td>${numberToReal(quotation.conversion_rate)}</td>
                                <td>${numberToReal(quotation.net_amount)}</td>
                                <td>${numberToReal(quotation.buy_amount)}</td>
                                <tr>`
                    })
                    $('.last-quotation').html(html)
            })
    }



 $('.new-quotation').click(function(e){
    let html =``
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $.ajax({
        url:'/quotation'+location.search,
        method:'POST',
        data:$('form[name="form-quotation"]').serialize(),
        success: function(response){
            $('form[name="form-quotation"]').each(function () {
                this.reset()
                alert('Cotação Realizada com Sucesso!')
                getQuotation()
            })
        },
        error:function (response) {
            alert(response.message)
        }

    })
})



function numberToReal (numero)
  {
      var numero = numero.split('.');
      numero[0] = numero[0].split(/(?=(?:...)*$)/).join('.');
      return numero.join(',');
  }

 function dateBR(date) 
 {
	data = new Date(date);
	dataFormatada = data.toLocaleDateString('pt-BR', {timeZone: 'UTC'});
	return dataFormatada
 }
</script>


</x-app-layout>
