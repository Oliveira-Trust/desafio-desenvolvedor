<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('Primeiro')) ?>
        <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('Próximo') . ' >') ?>
        <?= $this->Paginator->last(__('Último') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, listando {{current}} registro(s) de {{count}} total')) ?></p>
</div>