<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Editar Forma de Pagamento'), ['action' => 'edit', $paymentMethod->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Excluir Forma de Pagamento'), ['action' => 'delete', $paymentMethod->id], ['confirm' => __('Tem certeza de que deseja excluir # {0}?', $paymentMethod->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Listar Formas de Pagamento'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Adicionar Forma de Pagamento'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="paymentMethods view content">
            <h3><?= h($paymentMethod->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Código') ?></th>
                    <td><?= $this->Number->format($paymentMethod->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <td><?= h($paymentMethod->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Percentual') ?></th>
                    <td><?= $this->Number->format($paymentMethod->percent_value) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dt. Criação') ?></th>
                    <td><?= h($paymentMethod->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dt. Modificação') ?></th>
                    <td><?= h($paymentMethod->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ativo') ?></th>
                    <td><?= $paymentMethod->status ? __('Sim') : __('Não'); ?></td>
                </tr>
            </table>
            <?= $this->Html->link(__('Voltar'), $this->request->referer(), ['class' => 'button']) ?>
        </div>
    </div>
</div>
