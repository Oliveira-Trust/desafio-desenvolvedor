<div class="row">
    <div class="column">
        <div class="content">
            <h1>Conversor de Moeda</h1>
            <?php
            echo $this->Form->create();
            echo $this->Form->label('Moeda de Origem');
            echo $this->Form->select('origin_currency', $currencies, ['id' => 'origin_currency', 'default' => 'BRL']);
            echo $this->Form->label('Moeda de Destino');
            echo $this->Form->select('destination_currency', $currencies, ['id' => 'destination_currency', 'default' => 'USD']);
            echo $this->Form->label('Valor para Conversão');
            echo $this->Form->text('value_to_convert', ['type' => 'number', 'id' => 'value_to_convert', 'min' => 1000, 'max' => 100000]);
            echo $this->Form->label('Método de Pagamento');
            echo $this->Form->select('payment_method_id', $paymentMethods, ['id' => 'payment_method_id']);
            if (!$this->Identity->isLoggedIn()) {
                echo $this->Form->control('email', ['type' => 'email', 'id' => 'email', 'label' => 'Informe o email para receber a cotação por email']);
            }
            echo $this->Form->end();
            ?>
            <div class="row">
                <div class="column text-center">
                    <?= $this->Form->button('Converter ', ['id' => 'convert-coin']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" style="max-width:600px;"></div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#convert-coin').on('click', function () {
            $('#loader').show();
            
            const emailRegex = new RegExp(/^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@[A-Za-z0-9.-]+$/, "gm");
            const elementEmail = document.querySelector("#email");

            let title = '<h3>Conversão de Moeda</h3>';
            let content = '';
            let obj = {
                '_csrfToken': $('input[name="_csrfToken"]').val(),
                'origin_currency': $('#origin_currency').val(),
                'destination_currency': $('#destination_currency').val(),
                'value_to_convert': $('#value_to_convert').val(),
                'payment_method_id': $('#payment_method_id').val(),
                'email': (elementEmail) ? $('#email').val() : ''
            };

            if (obj.email === '' || emailRegex.test(obj.email)) {
                $.post('<?= $this->Url->build('/conversions/convert/json', ['fullBase' => true]) ?>', obj, function (result) {
                    if (result.status === 200) {
                        content = 'Moeda de origem: ' + result.data.origin_currency + ' <br/>' +
                                'Moeda de destino: ' + result.data.destination_currency + '<br/>' +
                                'Valor para conversão: ' + result.data.value_to_convert + '<br/>' +
                                'Forma de pagamento: ' + result.data.payment_method + '<br/>' +
                                'Valor da "Moeda de destino" usado para conversão: ' + result.data.destination_currency_conversion_value + '<br/>' +
                                'Valor comprado em "Moeda de destino": ' + result.data.destination_currency_purchased_value + '<br/>' +
                                'Taxa de pagamento: ' + result.data.payment_tax + '<br/>' +
                                'Taxa de conversão: ' + result.data.conversion_tax + ' <br/>' +
                                'Valor utilizado para conversão descontando as taxas: ' + result.data.conversion_value_without_tax;
                    } else {
                        content = result.message;
                    }
                    $('#loader').hide();
                    $('.modal').html(title + content).modal();
                });
            } else {
                content = "O e-mail informado é inválido!";
                $('#origin_currency').focus();
                $('#loader').hide();
                $('.modal').html(title + content).modal();
            }
        });
    });
</script>
