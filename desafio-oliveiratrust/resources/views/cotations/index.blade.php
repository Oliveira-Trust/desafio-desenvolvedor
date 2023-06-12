@extends('layouts.app')

@section('content')



<div class="container mt-4">
    <h2 class="mb-4">Últimas Cotações</h2>
    <div class="text-center">
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newCotationModal">
            Nova Cotação
        </button>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if ($cotations->isEmpty())
    <p>Não há cotações disponíveis.</p>
    @else
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Moeda de Origem</th>
                    <th>Moeda de Destino</th>
                    <th>Valor para Conversão</th>
                    <th>Valor Convertido</th>
                    <th>Data da Conversão</th>
                    <th>Visualizar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cotations as $cotation)
                <tr>
                    <td>#{{ $cotation->id }}</td>
                    <td>{{ $cotation->origin_currency }}</td>
                    <td>{{ $cotation->destination_currency }}</td>
                    <td>{{ $cotation->conversion_amount }}</td>
                    <td>{{ $cotation->purchase_amount }}</td>
                    <td>{{ $cotation->created_at }}</td>
                    <td>
                        <button type="button" class="btn btn-primary cotationButtonView" data-cotation-id="{{ $cotation->id }}" data-bs-toggle="modal" data-bs-target="#cotationModal">
                            Visualizar
                        </button>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>


<div class="modal fade" id="newCotationModal" tabindex="-1" aria-labelledby="newCotationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 mb-4" id="newCotationModalLabel" style="color: #333"><strong>Nova Cotação</strong></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cotations.store') }}" method="post" novalidate>
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="origin_currency" class="form-label dark-color">Moeda de Origem</label>
                        <select class="form-select " id="origin_currency" name="origin_currency" required>
                            <option value="">Selecione</option>
                            @foreach($currencies as $codeCurrency => $currency)
                            <option value="{{ $codeCurrency }}" {{ $codeCurrency == 'BRL' ? 'selected' : '' }}>
                                {{ $currency }}
                            </option>
                            @endforeach
                            <div class="invalid-feedback">
                                Por favor, selecione a moeda de origem.
                            </div>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="destination_currency" class="form-label dark-color">Moeda de Destino</label>
                        <select class="form-select" id="destination_currency" name="destination_currency" required>
                            <option value="">Selecione</option>
                            @foreach($currencies as $codeCurrency => $currency)
                            <option value="{{ $codeCurrency }}">
                                {{ $currency }}
                            </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecione a moeda de destino.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="conversion_amount" class="form-label dark-color">Valor para Conversão</label>
                        <input type="number" class="form-control" id="conversion_amount" name="conversion_amount" placeholder="0.00" step="0.01" min="1000" max="100000">
                    </div>
                    <div class="invalid-feedback">
                        Por favor, insira um valor entre 1000 e 100000.
                    </div>

                    <div class="mb-3">
                        <label for="payment_method" class="form-label dark-color">Forma de Pagamento</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option value="">Selecione</option>
                            <option value="ticket">Boleto</option>
                            <option value="creditCard">Cartão de Crédito</option>
                        </select>
                    </div>
                    <div class="invalid-feedback">
                        Por favor, selecione a forma de pagamento.
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Fazer cotação</button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="cotationModal" tabindex="-1" aria-labelledby="cotationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 mb-4 dark-color" id="cotationModalLabel">Cotação <strong>#<span class="cotationIDlabel" data-cotation-id="12345">-</span></strong></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td><strong>Moeda de Origem</strong></td>
                            <td class="currencyOriginId"></td>
                        </tr>
                        <tr>
                            <td><strong>Moeda de Destino</strong></td>
                            <td class="currencyDestinationId"></td>
                        </tr>
                        <tr>
                            <td><strong>Valor para Conversão</strong></td>
                            <td id="conversionAmountId"></td>
                        </tr>
                        <tr>
                            <td><strong>Forma de Pagamento</strong></td>
                            <td id="paymentMethodId">Boleto</td>
                        </tr>
                        <tr>
                            <td><strong>Valor do <span class="currencyDestinationId"></span></strong></td>
                            <td id="currencyRateId"></td>
                        </tr>
                        <tr>
                            <td><strong>Valor comprado em <span class="currencyDestinationId"></span></strong></td>
                            <td id="purchaseAmountId"></td>
                        </tr>
                        <tr>
                            <td><strong>Taxa de pagamento</strong></td>
                            <td id="paymentFeeId"></td>
                        </tr>
                        <tr>
                            <td><strong>Taxa de conversão</strong></td>
                            <td id="conversionFeeId"></td>
                        </tr>
                        <tr>
                            <td><strong>Valor da Conversão - Taxas</strong></td>
                            <td id="amountMinusFeeId"></td>
                        </tr>
                        <tr>
                            <td><strong>Data da Conversão</strong></td>
                            <td id="createdAtId"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <input type="hidden" id="cotationIdSendEmail">
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btnSendEmail">Enviar por Email</button>
            </div>
        </div>
    </div>
</div>

<script type="module">
    $(document).ready(function() {



        $(".cotationButtonView").click(function() {

            $.ajax({
                url: '/cotations/' + $(this).data("cotation-id"),
                method: 'GET',
                dataType: 'json',
                success: function(response) {

                    $("#cotationIdSendEmail").val(response.id);
                    $(".cotationIDlabel").text(response.id);
                    $(".currencyOriginId").text(response.origin_currency);
                    $(".currencyDestinationId").text(response.destination_currency);
                    $("#conversionAmountId").text(response.conversion_amount);
                    $("#paymentMethodId").text(response.payment_method == "ticket" ? "Boleto" : "Cartão de Crédito");
                    $("#currencyRateId").text(response.currency_rate);
                    $("#purchaseAmountId").text(response.purchase_amount);
                    $("#paymentFeeId").text(response.payment_fee);
                    $("#conversionFeeId").text(response.conversion_fee);
                    $("#amountMinusFeeId").text(response.amount_minus_fee);
                    $("#createdAtId").text(response.created_at);
                },
                error: function(xhr, status, error) {
                    console.error(error); 
                }
            });
        });

        $(".btnSendEmail").click(function() {

            $.ajax({
                url: '/cotations/sendEmail/' + $("#cotationIdSendEmail").val(),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    console.log("Requisição POST realizada com sucesso:", response);

                    var successMessage = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                        '<strong>Sucesso!</strong> ' + response.message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>';

                    $('.modal-content').prepend(successMessage);

                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                },
                error: function(error) {
                    console.log("Erro ao realizar a requisição POST:", error);


                    var errorMessage = '<div class="alert alert-error alert-dismissible fade show" role="alert">' +
                        '<strong>Sucesso!</strong> ' + response.message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>';

                    $('.modal-content').prepend(errorMessage);

                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            });
        });

        $('form').on('submit', function(event) {
            var isValid = true;
            $('select').each(function() {
                if (!$(this).val()) {
                    $(this).addClass('is-invalid');
                    isValid = false;
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            var value_cotation = $('#value_cotation').val();
            if (value_cotation < 1000 || value_cotation > 100000) {
                $('#value_cotation').addClass('is-invalid');
                isValid = false;
            } else {
                $('#value_cotation').removeClass('is-invalid');
            }

            if (!isValid) {
                event.preventDefault();
            }
        });

        console.log("its work");
    });
</script>

@endsection