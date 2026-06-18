<?php
require_once 'includes/funcoes.php';
start_session();
// --------------------------------------------------------------------
// SEGURANÇA: Impede que o utilizador aceda diretamente a este script.
// Este ficheiro deve ser acedido apenas através de submissão de formulário (POST).
// Se for acedido diretamente (por URL), será redirecionado para o login.
// --------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
 // Redireciona para o formulário de login (interface pública)
 header('Location: ../public/login.php');
 // Encerra a execução do script imediatamente após o redirecionamento
 return;
}

// --------------------------------------------------------------------
// RECOLHA DE DADOS DO FORMULÁRIO

$username = isset($_POST['text_username']) ? trim($_POST['text_username']) : '';
$password = isset($_POST['text_password']) ? $_POST['text_password'] : '';
// --------------------------------------------------------------------
// Guarda o nome de utilizador na sessão para identificar o utilizador autenticado
$_SESSION['utilizador'] = $username;
// Redirecionar para a página principal privada
header('Location: home.php');



try {
    $ligacao = new PDO(
        "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8",  
        MYSQL_USERNAME,
        MYSQL_PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $parametros = [
        ':u' => $_POST['text_username'],
        ':p' => $_POST['text_password']
    ];
    $comando = $ligacao->prepare("SELECT * FROM agents WHERE name = :u AND passwrd = :p");  
    $comando->execute($parametros);
    $resultados = $comando->fetchAll(PDO::FETCH_OBJ);
    if (count($resultados) === 0) {
        $_SESSION['server_error'] = 'Login inválido';
        header('Location: ../public/login.php');
        return;
    }
    $agente = $resultados[0];
 // Atualizar last_login
    $stmt = $ligacao->prepare("UPDATE agents SET last_login = NOW() WHERE id = ?");  
    $stmt->execute([$agente->id]);
 // Guardar na sessão
    $_SESSION['utilizador'] = $agente->name;
    $_SESSION['profile'] = $agente->profile;
} catch (PDOException $e) {
 $_SESSION['server_error'] = 'Erro ao ligar à base de dados.';
 header('Location: ../public/login.php');
return;
}
?>



