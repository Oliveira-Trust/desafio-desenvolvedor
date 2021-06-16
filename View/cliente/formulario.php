<?php include __DIR__ . '/../sidebar-html.php'; ?>

<?php require __DIR__ . '/../inicio-html.php'; ?>

    <form action="/salvar-cliente<?= isset($cliente) ? '?id= ' . $cliente->getId() : ''; ?>" method="post">

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" value="<?= isset($cliente) ? $cliente->getNome() : '' ; ?>">
        </div>

        <div class="form-group">
            <label>CPF:</label>
            <input type="text" name="cpf" class="form-control" value="<?= isset($cliente) ? $cliente->getCpf() : '' ?>">
            <span class="font-13 text-muted">ex:999.999.999-99</span>
        </div>


        <button class="btn btn-primary">Salvar</button>
    </form>

<?php require __DIR__ . '/../fim-html.php'; ?>