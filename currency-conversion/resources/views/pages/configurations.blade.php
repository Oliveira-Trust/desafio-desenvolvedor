{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
  <div class="card-header flex-wrap border-0 pt-6 pb-0">
    <div class="card-title">
      <h3 class="card-label">Configurações
        <div class="text-muted pt-2 font-size-sm">Configure as taxas de conversões e a Moeda.</div>
      </h3>
    </div>
  </div>

  <div class="card-body">
    <form class="form">
      @csrf
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Valor de Aplicação de Taxa</label>
            <input type="text" name="payment_conversion_value" id="payment_conversion_value" class="form-control" value="{{$configurations->payment_conversion_value}}" />
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>Taxa Mínima (%)</label>
            <input type="text" maxlength="5" name="payment_conversion_min" id="payment_conversion_min" class="form-control" value="{{$configurations->payment_conversion_min}}" />
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>Taxa Pagamento Boleto (%)</label>
            <input type="text" maxlength="5" name="payment_rate_ticket" id="payment_rate_ticket" class="form-control" value="{{$configurations->payment_rate_ticket}}" />
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>Taxa pagamento Cartão (%)</label>
            <input type="text" maxlength="5" name="payment_rate_credit_card" id="payment_rate_credit_card" class="form-control" value="{{$configurations->payment_rate_credit_card}}" />
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>Taxa Máxima (%)</label>
            <input type="text" maxlength="5" name="payment_conversion_max" id="payment_conversion_max" class="form-control" value="{{$configurations->payment_conversion_max}}" />
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>Moeda Destino</label>
            <select name="coin_exchange_from" id="coin_exchange_from" class="form-control">
              @foreach($coins as $key => $value)
              <option @if($key===$configurations->coin_exchange_from) selected @endif value='{{$key}}'>{{$key}} - {{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <span type="button" class="btn btn-primary mr-2 save">Salvar</span>
        </div>
      </div>
    </form>
  </div>
</div>


@endsection

{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}

{{-- page scripts --}}
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/pages/crud/forms/widgets/jquery-mask-money.min.js') }}"></script>
<script src="{{ asset('/js/pages/crud/forms/widgets/input-mask.js') }}"></script>
<script>
  var editor;

  $(function() {

    $("#payment_conversion_value").maskMoney({
      decimal: ",",
      thousands: "."
    });

    $("#payment_conversion_min").maskMoney({
      mask: "99.99",
      decimal: ".",
      thousands: ""
    });

    $("#payment_conversion_max").maskMoney({
      mask: "99.99",
      decimal: ".",
      thousands: ""
    });

    $("#payment_rate_credit_card").maskMoney({
      mask: "99.99",
      decimal: ".",
      thousands: ""
    });

    $("#payment_rate_ticket").maskMoney({
      mask: "99.99",
      decimal: ".",
      thousands: ""
    });

  });


  $(document).on('click', 'span.save', function() {

    var formData = new FormData($('form')[0]);
    axios({
        method: 'post',
        url: '{{ route("configuration.update") }}',
        data: formData,
        config: {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }
      })
      .then(response => {
        if (response.data.error) {
          const erro = 'Não foi possível alterar a configuração, pois foram encontrados alguns erros:<br/><br/>' + response.data.error;
          Swal.fire("Ops!", erro, "error");
        } else {
          Swal.fire("", 'Configuração alterada com sucesso!', "success");
          const table = $('#data-table').DataTable();
          $('button.close').click();
          table.ajax.reload();
        }
      })
      .catch(function(error) {
        let msgErro = 'Não foi possível alterar a configuração, pois foram encontrados alguns erros:<br/><br/>';
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
</script>
@endsection