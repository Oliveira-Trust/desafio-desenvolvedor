{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
  <div class="card-header flex-wrap border-0 pt-6 pb-0">
    <div class="card-title">
      <h3 class="card-label">Gestão Monetária
        <div class="text-muted pt-2 font-size-sm">Execute conversões de Real para outras moedas.</div>
      </h3>
    </div>
    <!-- Button trigger modal-->
    <button type="button" class="btn btn-primary novo-cadastro" data-toggle="modal" data-target="#modal">
      Nova Compra
    </button>
  </div>

  <div class="card-body">
    <table class="table table-bordered table-hover data-table" id="data-table">
      <thead>
        <tr>
          <th>Moeda de origem</th>
          <th>Moeda de destino</th>
          <th>Valor para conversão</th>
          <th>Forma de pagamento</th>
          <th>Valor da Moeda de destino</th>
          <th>Valor comprado em "Moeda de destino"</th>
          <th>Taxa de pagamento</th>
          <th>Taxa de conversão</th>
          <th>Valor de conversão</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>

</div>

<!-- Modal-->
<div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <div class="modal-body">
        <form class="form">
          @csrf
          <input type='hidden' name='id' id='id'>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Valor da Compra</label>
                <input type="text" maxlength="10" name="initial_conversion_value" id="initial_conversion_value" class="form-control" placeholder="Informe o valor para conversão." />
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Moeda Destino</label>
                <select name="coin_exchange_to" id="coin_exchange_to" class="form-control">
                  <option value=''>::Selecione::</option>
                  @foreach($coins as $key => $value)
                    @if($key !== $configuration->coin_exchange_from)
                      <option value='{{$key}}'>{{$key}} - {{$value}}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Forma de Pagamento</label>
                <select name="form_of_payment" id="form_of_payment" class="form-control">
                  <option value=''>::Selecione::</option>
                  <option value='Cartão'>Cartão</option>
                  <option value='Boleto'>Boleto</option>
                </select>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <span type="button" class="btn btn-primary mr-2 save">Salvar</span>
        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

@endsection

{{-- Styles Section --}}
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection


{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

{{-- page scripts --}}
<script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/pages/crud/forms/widgets/jquery-mask-money.min.js') }}"></script>
<script>
  var editor;

  $(function() {

    $("#initial_conversion_value").maskMoney({
      decimal: ",",
      thousands: "."
    });

    var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('currency.exchange.index') }}",
      columns: [{
          data: 'coin_exchange_from',
          name: 'coin_exchange_from'
        },
        {
          data: 'coin_exchange_to',
          name: 'coin_exchange_to'
        },
        {
          data: 'initial_conversion_value',
          name: 'initial_conversion_value',
          render: $.fn.dataTable.render.number('.', ',', 2)
        },
        {
          data: 'form_of_payment',
          name: 'form_of_payment',
        },
        {
          data: 'target_currency_purchased',
          name: 'target_currency_purchased',
          render: $.fn.dataTable.render.number('.', ',', 2)
        },
        {
          data: 'target_currency_value',
          name: 'target_currency_value',
          render: $.fn.dataTable.render.number('.', ',', 2)
        },
        {
          data: 'payment_rate',
          name: 'payment_rate',
          render: $.fn.dataTable.render.number('.', ',', 2)
        },
        {
          data: 'conversion_rate',
          name: 'conversion_rate',
          render: $.fn.dataTable.render.number('.', ',', 2)
        },
        {
          data: 'final_conversion_value',
          name: 'final_conversion_value',
          render: $.fn.dataTable.render.number('.', ',', 2)
        },
        {
          data: 'action',
          name: 'action'
        },
      ]
    });

  });

  $('.novo-cadastro').click(function() {
    $('.form').trigger("reset");
    $('.form-control').removeClass('is-invalid');
  })

  $(document).on('click', 'span.save', function() {
    let initialConversionValue = $('#initial_conversion_value').val();
    if (initialConversionValue !== '') {
      initialConversionValue = initialConversionValue.replace(".", "");
      initialConversionValue = initialConversionValue.replace(",", ".");
      initialConversionValue = parseFloat(initialConversionValue);
      if (initialConversionValue < 1000) {
        return Swal.fire("Ops!", "O valor de conversão deve ser maior do que 1000,00!", "error");
      }
      if (initialConversionValue >= 1000000) {
        return Swal.fire("Ops!", "O valor de conversão deve ser no máximo 999.999,99!", "error");
      }
    }

    var formData = new FormData($('form')[0]);
    axios({
        method: 'post',
        url: '{{ route("currency.exchange.store") }}',
        data: formData,
        config: {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }
      })
      .then(response => {
        if (response.data.error) {
          const erro = 'Não foi possível cadastrar a cotação, pois foram encontrados alguns erros:<br/><br/>' + response.data.error;
          Swal.fire("Ops!", erro, "error");
        } else {
          Swal.fire("", 'Cotação Efetuada com sucesso!', "success");
          const table = $('#data-table').DataTable();
          $('button.close').click();
          table.ajax.reload();
        }
      })
      .catch(function(error) {
        let msgErro = 'Não foi possível efetuar a cotação, pois foram encontrados alguns erros:<br/><br/>';
        if (error.response.data.errors) {
          $.each(error.response.data.errors, function(i, value) {
            $("#" + i).addClass('is-invalid');
            msgErro += value + '<br/>';
          });
        } else {
          msgErro += error.message;
        }
        Swal.fire("Ops!", msgErro, "error");
      })
  });

  function editar(id) {

    $('.novo-cadastro').click();

    axios({
        method: 'get',
        url: 'currency-exchange/' + id
      })
      .then(response => {
        loadForm(response.data);
      })
      .catch(function(error) {
        Swal.fire("Ops!", 'Não foi possível carregar o formulário', "error");
        $('button.close').click();
      })

  }

  function remover(id) {

    axios({
        method: 'delete',
        url: 'currency-exchange/' + id
      })
      .then(response => {
        if (response.data.error) {
          const erro = 'Não foi possível remover o registro:<br/><br/>' + response.data.error;
          Swal.fire("Ops!", erro, "error");
        } else {
          Swal.fire("", 'Registro removido com sucesso!', "success");
          var table = $('#data-table').DataTable();
          table.ajax.reload();
        }
      })
      .catch(function(error) {
        Swal.fire("Ops!", 'Não foi possível remover o registro!', "error");
      })

  }

  function loadForm(data) {
    const initial_conversion_value = data.initial_conversion_value.toString().replace('.', ',');
    $('#id').val(data.id);
    $('#initial_conversion_value').val(initial_conversion_value);
    $('#coin_exchange_to').val(data.coin_exchange_to);
    $('#form_of_payment').val(data.form_of_payment);
  }
</script>
@endsection