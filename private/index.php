<?php
require_once __DIR__ . '/../../config/config.php';
?>

<!DOCTYPE html>
<html lang="pt">

    <?php include 'includes/header.php'; ?>



    <!--Navbar-->
    <?php include 'includes/nav.php'; ?> 
    <div class="container-fluid">
        <div class="row">
            <?php include 'includes/sidebar.php'; ?> 


    <!-- Conteúdo Principal-->
            <main class="col-md-9 col-lg-10 p-4">
                <section>
                    <h2><?php echo APP_NAME; ?></h2>
                    <p>Escolha uma opção no menu lateral para continuar</p>
                </section>
            </main>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?> 



</html>