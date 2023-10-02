<div class="currencyConversions index content">
    <h3><?= __('Histórico de Conversões') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('user_id', 'Usuário') ?></th>
                    <th><?= $this->Paginator->sort('origin_currency', 'Moeda de Origem') ?></th>
                    <th><?= $this->Paginator->sort('destination_currency', 'Moeda de destino') ?></th>
                    <th><?= $this->Paginator->sort('value_to_convert', 'Valor para conversão') ?></th>
                    <th><?= $this->Paginator->sort('payment_method', 'Forma de pagamento') ?></th>
                    <th><?= $this->Paginator->sort('destination_currency_conversion_value', 'Valor "Moeda de destino" conversão') ?></th>
                    <th><?= $this->Paginator->sort('destination_currency_purchased_value', 'Valor comprado em "Moeda de destino"') ?></th>
                    <th><?= $this->Paginator->sort('payment_tax', 'Taxa de pagamento') ?></th>
                    <th><?= $this->Paginator->sort('conversion_tax', 'Taxa de conversão') ?></th>
                    <th><?= $this->Paginator->sort('conversion_value_without_tax', 'Valor conversão sem taxas') ?></th>
                    <th><?= $this->Paginator->sort('created', 'Dt. Criação') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($currencyConversions as $currencyConversion): ?>
                    <tr>
                        <td><?= $currencyConversion->user->email ?></td>
                        <td><?= h($currencyConversion->origin_currency) ?></td>
                        <td><?= h($currencyConversion->destination_currency) ?></td>
                        <td><?= $this->Number->format($currencyConversion->value_to_convert, ['places' => 2]) ?></td>
                        <td><?= h($currencyConversion->payment_method) ?></td>
                        <td><?= $this->Number->format($currencyConversion->destination_currency_conversion_value, ['places' => 2]) ?></td>
                        <td><?= $this->Number->format($currencyConversion->destination_currency_purchased_value, ['places' => 2]) ?></td>
                        <td><?= $this->Number->format($currencyConversion->payment_tax, ['places' => 2]) ?></td>
                        <td><?= $this->Number->format($currencyConversion->conversion_tax, ['places' => 2]) ?></td>
                        <td><?= $this->Number->format($currencyConversion->conversion_value_without_tax, ['places' => 2]) ?></td>
                        <td><?= h($currencyConversion->created) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $currencyConversion->id], ['class' => 'button']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php echo $this->element('pagination'); ?>
</div>
