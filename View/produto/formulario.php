<?php include __DIR__ . '/../sidebar-html.php'; ?>

<?php require __DIR__ . '/../inicio-html.php'; ?>

    <form action="/salvar-produto<?= isset($produto) ? '?id= ' . $produto->getId() : ''; ?>" method="post">

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" value="<?= isset($produto) ? $produto->getNome(): '' ; ?> ">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" class="form-control" value="<?= isset($produto) ? $produto->getDescricao() : '' ; ?>">
        </div>

        <button class="btn btn-primary">Salvar</button>
    </form>

<?php require __DIR__ . '/../fim-html.php'; ?>