<?php include __DIR__ . '/../sidebar-html.php'; ?>

<?php require __DIR__ . '/../inicio-html.php'; ?>



    <form action="/salvar-compra<?= isset($compra) ? '?id= ' . $compra->getId() : ''; ?>" method="post">

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" value="<?= isset($compra) ? $compra->getNome(): '' ; ?> ">
        </div>

        <div class="form-group">
            <label for="statusCompra">Status da Compra:</label>
                <select name="statusCompra" class="form-control" > teste
                    <option value="<?= isset($compra) ? $compra->getStatusDaCompra() : '' ; ?>" selected>Em aberto</option>
                    <option value="<?= isset($compra) ? $compra->getStatusDaCompra() : '' ; ?>">Pago</option>
                    <option value="<?= isset($compra) ? $compra->getStatusDaCompra() : '' ; ?>">Cancelado</option>
                </select>
        </div>

        <button class="btn btn-primary">Salvar</button>
    </form>

<?php require __DIR__ . '/../fim-html.php'; ?>