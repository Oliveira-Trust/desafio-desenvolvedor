<div class="paymentMethods index content">
    <?= $this->Html->link(__('Adicionar'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Formas de Pagamento') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'Código') ?></th>
                    <th><?= $this->Paginator->sort('name', 'Nome') ?></th>
                    <th><?= $this->Paginator->sort('percent_value', 'Percentual') ?></th>
                    <th><?= $this->Paginator->sort('status', 'Ativo') ?></th>
                    <th><?= $this->Paginator->sort('created', 'Dt. Criação') ?></th>
                    <th><?= $this->Paginator->sort('modified', 'Dt. Alteração') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paymentMethods as $paymentMethod): ?>
                    <tr>
                        <td><?= $this->Number->format($paymentMethod->id) ?></td>
                        <td><?= h($paymentMethod->name) ?></td>
                        <td><?= $this->Number->format($paymentMethod->percent_value) ?></td>
                        <td><?= $paymentMethod->status ? __('Sim') : __('Não'); ?></td>
                        <td><?= h($paymentMethod->created) ?></td>
                        <td><?= h($paymentMethod->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa-solid fa-eye"></i>', ['action' => 'view', $paymentMethod->id], ['class' => 'button', 'escape' => false, 'title' => 'Visualizar']) ?>
                            <?= $this->Html->link('<i class="fa-solid fa-edit"></i>', ['action' => 'edit', $paymentMethod->id], ['class' => 'button', 'escape' => false, 'title' => 'Editar']) ?>
                            <?= $this->Form->postLink('<i class="fa-solid fa-trash"></i>', ['action' => 'delete', $paymentMethod->id], ['class' => 'button', 'escape' => false, 'title' => 'Excluir', 'confirm' => __('Tem certeza de que deseja excluir # {0}?', $paymentMethod->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php echo $this->element('pagination'); ?>
</div>
