<div class="users index content">
    <?= $this->Html->link(__('Adicionar'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Usuários') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'Código') ?></th>
                    <th><?= $this->Paginator->sort('name', 'Nome') ?></th>
                    <th><?= $this->Paginator->sort('email', 'E-mail') ?></th>
                    <th><?= $this->Paginator->sort('status', 'Ativo') ?></th>
                    <th><?= $this->Paginator->sort('created', 'Dt. Criação') ?></th>
                    <th><?= $this->Paginator->sort('modified', 'Dt. Alteração') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $this->Number->format($user->id) ?></td>
                        <td><?= h($user->name) ?></td>
                        <td><?= h($user->email) ?></td>
                        <td><?= $user->status ? __('Sim') : __('Não'); ?></td>
                        <td><?= h($user->created) ?></td>
                        <td><?= h($user->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fa-solid fa-eye"></i>', ['action' => 'view', $user->id], ['class' => 'button', 'escape' => false, 'title' => 'Visualizar']) ?>
                            <?= $this->Html->link('<i class="fa-solid fa-edit"></i>', ['action' => 'edit', $user->id], ['class' => 'button', 'escape' => false, 'title' => 'Editar']) ?>
                            <?= $this->Form->postLink('<i class="fa-solid fa-trash"></i>', ['action' => 'delete', $user->id], ['class' => 'button', 'escape' => false, 'title' => 'Excluir', 'confirm' => __('Tem certeza de que deseja excluir # {0}?', $user->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php echo $this->element('pagination'); ?>
</div>
