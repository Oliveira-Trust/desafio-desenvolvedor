<?php include __DIR__ . '/../sidebar-html.php'; ?>

<?php include __DIR__ . '/../inicio-html.php'; ?>

    <a href="/novo-compra" class="btn btn-primary mb-2">
        Nova Compra
    </a>

<div class="container">
    <h1>Tabela de produto</h1>
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <td>Nome</td>
                    <td>Status da Compra</td>
                    <td>Ação</td>
                </tr>
                </thead>
                <?php foreach ($compras as $compra): ?>

                    <tr>
                        <td> <?= $compra->getNome(); ?></td>
                        <td> <?= $compra->getStatusDaCompra(); ?> </td>
                        <td>
                            <span>
                                <a href="/alterar-produto?id=<?= $compra->getId(); ?>" class="btn btn-info btn-sm">
                                    Editar
                                </a>
                                <a href="/excluir-produto?id=<?= $compra->getId(); ?>" class="btn btn-danger btn-sm">
                                    Excluir
                                </a>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>
</div>





<?php include __DIR__ . '/../fim-html.php'; ?>