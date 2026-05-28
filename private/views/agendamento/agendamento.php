<!DOCTYPE html>
<html lang="pt">
<?php require_once __DIR__ . '/../../../config/config.php';?>

<body>
    <?php include '../../includes/header.php'; ?>
    <!--Navbar-->
    <?php include '../../includes/nav.php'; ?>
    <!--Sidebar-->
    <div class="container-fluid">
        <div class="row">

        <!-- Sidebar -->
            <?php include '../../includes/sidebar.php'; ?>
        
        
    <!-- Conteúdo Principal-->
            <main class="col-md-9 col-lg-10 p-4">
                <section>
                    <h2>Agendamento de treinos</h2>
                    <p>Aqui tem um horário de treinos por onde pode escolher qual fazer</p>
                </section>
            </main>
        </div>
    </div>        
<?php include '../../includes/footer.php'; ?>