<?php
require_once __DIR__ . '/../config/config.php';
?>

<!DOCTYPE html>
<html lang="pt">
    <?php
    // ---------------------------------------------------------------------------
    // SEGURANÇA: Impede que o utilizador aceda diretamente a este script.
    // Este ficheiro deve ser acedido apenas através de submissão de formulário (POST).
    // Se for acedido diretamente (por URL) recebe a informação de Acesso Inválido
    // ----------------------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Se não for uma submissão do formulário, termina o script
    header('Location: ../public/login.php');
 // Encerra a execução do script imediatamente após o redirecionamento
    return;
    }
    // Mostrar os dados recebidos pelo formulário através do método POST
    // O nome dos campos (entre aspas) deve ser igual ao atributo "name" no login.php
    $username = isset($_POST['text_username']) ? $_POST['text_username'] : '';
// O mesmo para o campo da password.
    $password = isset($_POST['text_password']) ? $_POST['text_password'] : '';
    // --------------------------------------------------------------------
    // APRESENTAÇÃO DE DADOS ENVIADOS
    // --------------------------------------------------------------------
    echo "Utilizador: " . $username . "<br>";
    echo "Password: " . $password;?>


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



