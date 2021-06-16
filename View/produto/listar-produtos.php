<?php include __DIR__ . '/../sidebar-html.php'; ?>

<?php include __DIR__ . '/../inicio-html.php'; ?>

    <a href="/novo-produto" class="btn btn-primary mb-2">
        Novo Produto
    </a>

<div class="container">
    <h1>Tabela de produto</h1>
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <td>Nome</td>
                    <td>Descrição</td>
                    <td>Ação</td>
                </tr>
                </thead>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td> <?= $produto->getNome(); ?></td>
                        <td> <?= $produto->getDescricao(); ?> </td>
                        <td>
                            <span>
                                <a href="/alterar-produto?id=<?= $produto->getId(); ?>" class="btn btn-info btn-sm">
                                    Editar
                                </a>
                                <a href="/excluir-produto?id=<?= $produto->getId(); ?>" class="btn btn-danger btn-sm">
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