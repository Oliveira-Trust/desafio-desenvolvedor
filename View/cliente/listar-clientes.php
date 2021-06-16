<?php include __DIR__ . '/../sidebar-html.php'; ?>


<?php include __DIR__ . '/../inicio-html.php'; ?>

    <a href="/novo-cliente" class="btn btn-primary mb-2">
        Novo Cliente
    </a>

    <div class="container">
        <h1>Tabela de Clientes</h1>
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <td>Nome</td>
                    <td>CPF:</td>
                    <td>Ação</td>
                </tr>
                </thead>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td>  <?= $cliente->getNome(); ?></td>
                        <td>  <?= $cliente->getCpf(); ?> </td>
                        <td>
                            <span>
                                <a href="/alterar-cliente?id=<?= $cliente->getId(); ?>" class="btn btn-info btn-sm">
                                    Editar
                                </a>
                                <a href="/excluir-cliente?id=<?= $cliente->getId(); ?>" class="btn btn-danger btn-sm">
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