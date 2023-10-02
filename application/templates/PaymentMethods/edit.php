<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Form->postLink(
                __('Excluir'),
                ['action' => 'delete', $paymentMethod->id],
                ['confirm' => __('Tem certeza de que deseja excluir # {0}?', $paymentMethod->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Listar Formas de Pagamento'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="paymentMethods form content">
            <?= $this->Form->create($paymentMethod) ?>
            <fieldset>
                <legend><?= __('Editar Forma de Pagamento') ?></legend>
                <?php
                    echo $this->Form->control('name',['label' => 'Nome']);
                    echo $this->Form->control('percent_value',['label' => 'Percentual']);
                    echo $this->Form->control('status', ['label' => 'Ativo']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Salvar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
