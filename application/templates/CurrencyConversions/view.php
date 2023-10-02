<div class="row">
    <div class="column">
        <div class="currencyConversions view content">
            <h3>Informações do Histórico</h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($currencyConversion->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Moeda de Origem') ?></th>
                    <td><?= h($currencyConversion->origin_currency) ?></td>
                </tr>
                <tr>
                    <th><?= __('Moeda de destino') ?></th>
                    <td><?= h($currencyConversion->destination_currency) ?></td>
                </tr>
                <tr>
                    <th><?= __('Forma de pagamento') ?></th>
                    <td><?= h($currencyConversion->payment_method) ?></td>
                </tr>
                <tr>
                    <th><?= __('Usuário') ?></th>
                    <td><?= $currencyConversion->user->email ?></td>
                </tr>
                <tr>
                    <th><?= __('Valor para conversão') ?></th>
                    <td><?= $this->Number->format($currencyConversion->value_to_convert, ['places' => 2]) ?></td>
                </tr>
                <tr>
                    <th><?= __('Valor da "Moeda de destino" usado para conversão') ?></th>
                    <td><?= $this->Number->format($currencyConversion->destination_currency_conversion_value, ['places' => 2]) ?></td>
                </tr>
                <tr>
                    <th><?= __('Valor comprado em "Moeda de destino"') ?></th>
                    <td><?= $this->Number->format($currencyConversion->destination_currency_purchased_value, ['places' => 2]) ?></td>
                </tr>
                <tr>
                    <th><?= __('Taxa de pagamento') ?></th>
                    <td><?= $this->Number->format($currencyConversion->payment_tax) ?></td>
                </tr>
                <tr>
                    <th><?= __('Taxa de conversão') ?></th>
                    <td><?= $this->Number->format($currencyConversion->conversion_tax) ?></td>
                </tr>
                <tr>
                    <th><?= __('Valor utilizado para conversão descontando as taxas') ?></th>
                    <td><?= $this->Number->format($currencyConversion->conversion_value_without_tax) ?></td>
                </tr>
                <tr>
                    <th><?= __('Data da Conversão') ?></th>
                    <td><?= h($currencyConversion->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
