<div class="row">
    <div class="column column-50 column-offset-25">
        <div class="users form content">
            <?= $this->Flash->render() ?>
            <h3>Login</h3>
            <?= $this->Form->create() ?>
            <?= $this->Form->control('email', ['label' => 'E-mail', 'required' => true]) ?>
            <?= $this->Form->control('password', ['label' => 'Senha', 'required' => true]) ?>
            <?= $this->Form->submit(__('Login')); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>