
<?php

require_once __DIR__ . '/../../includes/funcoes.php';
redirect_if_not_logged();?>

<!DOCTYPE html>
<html lang="pt">
    <?php require_once __DIR__ . '/../../../config/config.php';?>

    <?php include '../../includes/header.php'; ?>

    <?php include '../../includes/nav.php'; ?>

<?php
try {
 $ligacao = new PDO(
 "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8",
 MYSQL_USERNAME,
 MYSQL_PASSWORD
 );
 $ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $resultados = $ligacao->query("SELECT * FROM clientes")->fetchAll(PDO::FETCH_OBJ);
 $erro = '';
} catch (PDOException $err) {
 $erro = "Aconteceu um erro na ligação.";
 $resultados = [];
}
// Fecha a ligação
$ligacao = null; ?>


<div class="container-fluid">
    <div class="row">
        <?php include '../../includes/sidebar.php'; ?>

        <!-- Conteúdo Principal -->
        <main class="col-md-9 col-lg-10 p-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">
                    <i class="fa-solid fa-address-book me-2"></i>
                    <strong>Listagem de Clientes</strong>
                </h2>
                <a href="novo.html" class="btn btn-success">
                    <i class="fa-solid fa-plus me-1"></i> Novo cliente
                </a>
            </div>

            <hr>
            <?php if (!empty($erro)) : ?>
                <p class="text-center text-danger"><?= $erro ?></p>
            <?php else : ?>
                <?php if (count($resultados) == 0) : ?>
                <p class="text-muted">Não existem clientes registados.</p>
                <?php else : ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>Nome</th>
                            <th>Sexo</th>
                            <th>Data nascimento</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Sistema de Saúde</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($resultados as $cliente) : ?>
                        <tr>
                            <td><?= $cliente->nome ?></td> 
                            <td>[Sexo]</td>
                            <td>[data_Nasc]</td>
                            <td>[email]</td>
                            <td>[Telefone]</td>
                            <td>[sistema_saude]</td>
                            <td class="text-center">
                                <a href="detalhes.html" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="editar.html" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <a href="apagar.html" class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
            <?php endif; ?>
        <?php endif; ?>    
        </main>

    </div>
</div>

<!-- Bootstrap JS -->
    <?php include '../../includes/footer.php'; ?>