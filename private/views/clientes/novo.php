
<?php
    require_once __DIR__ . '/../../includes/funcoes.php';
    redirect_if_not_logged();
    require_once __DIR__ . '/../../includes/validacoes.php';
    ?>

<?php
$erros = [];
$erro_sistema = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 // 1. Recolher dados
    $nome = $_POST["nome_cliente"] ?? "";
    $morada = $_POST["morada_cliente"] ?? "";
    $cp = $_POST["cp_cliente"] ?? "";
    $cidade = $_POST["cid_cliente"] ?? "";
    $telefone = $_POST["tel_cliente"] ?? "";
    $email = $_POST["email_cliente"] ?? "";
    $sexo = $_POST["radio_gender"] ?? "";
    $dnasc = $_POST["dnasc_cliente"] ?? "";
    $estado = $_POST["estaciv_cliente"] ?? "";
    $sistema = $_POST["campo_opcao"] ?? "";
    $profissao = $_POST["profissao_cliente"] ?? "";
    // 2. Imprimir os dados recebidos (para teste)
    // Imprimir os dados recebidos (para teste)
    // 2. Validar os dados
    $erros = []; // para erros de validação
    $erro_sistema = "";

    $nome = trim($nome);
    $morada = trim($morada);
    $cp = trim($cp);
    $cidade = trim($cidade);
    $telefone = trim($telefone);
    $email = trim($email);
    $sexo = trim($sexo);
    $dnasc = trim($dnasc);
    $estado = trim($estado);
    $sistema = trim($sistema);
    $profissao = trim($profissao);
    $erros = array_merge(
        validar_nome($nome),
        validar_morada($morada),
        validar_cp($cp),
        validar_cidade($cidade),
        validar_telefone($telefone),
        validar_email($email),
        validar_sexo($sexo),
        validar_data_nascimento($dnasc),
        validar_estado_civil($estado),
        validar_sistema_saude($sistema),
        validar_profissao($profissao)
    );

  // 3. Se não houver erros, guardar na base de dados
    // Normalizar entrada
    $nome = ucwords(strtolower($nome)); // Pedro Santos
    $cidade = ucfirst(strtolower($cidade)); // Porto
    $email = strtolower($email); // guimas@email.pt
    $sistema = strtoupper($sistema); // ADSE
    $profissao = ucwords(strtolower($profissao));
/*
    echo "<p><strong>Dados normalizados:</strong></p>";
    echo "<ul>";
    echo "<li>Nome: $nome</li>";
    echo "<li>Cidade: $cidade</li>";
    echo "<li>Email: $email</li>";
    echo "<li>Sistema de Saúde: $sistema</li>";
    echo "<li>Profissão: $profissao</li>";
    echo "</ul>";
    */

    if (empty($erros)) {
        try {
        $ligacao = new PDO(
        "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8",
        MYSQL_USERNAME,
        MYSQL_PASSWORD
        );
        $sql = "INSERT INTO clientes (
            nome, sexo, data_nascimento, email, telefone, morada, cidade, cliente_ativo, sistema_saude
            ) VALUES ( :nome, :sexo, :dnasc, :email, :telefone, :morada, :cidade, '1', :sistema)";
        $stmt = $ligacao->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':sexo' => $sexo,
            ':dnasc' => $dnasc,
            ':email' => $email,
            ':telefone' => $telefone,
            ':morada' => $morada,
            ':cidade' => $cidade,
            ':sistema' => $sistema
            ]); 
        header('Location: lista.php');
        exit;
        } catch (PDOException $err) {
        $erro_sistema = "Erro ao gravar os dados: " . $err->getMessage();
        }
        $ligacao = null;
        }
} ?>
<?php require_once __DIR__ . '/../../../config/config.php';?>
<!DOCTYPE html>
<html lang="pt">
<?php include '../../includes/header.php'; ?>
<!-- favicon -->
 <link rel="shortcut icon" href="../../assets/img/gym125.png" type="image/png">

 <!--folha de estilos css-->
 <link rel="stylesheet" href="../../assets/css/app.css">

<body>
    <!--Navbar-->
    <?php include '../../includes/nav.php'; ?>
    <!--Sidebar-->
    <div class="container-fluid">
        <div class="row">
            <?php include '../../includes/sidebar.php'; ?>

    <!-- Conteúdo Principal-->
    <main class="col-md-9 col-lg-10 p-4">

        <div class="d-flex justify-content-center mt-4">
            <div class="card w-100 shadow rounded" style="max-width: 1200px;">
                <div class="card-body">
                    <h2 class="mb-4"><strong><i class="fa-solid fa-users me-2"></i> Inserir novo cliente</strong></h2> 
                    <hr>
                    
                    <form action="#" method="post" novalidate>
 <!-- Linhas e colunas com campos organizados -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="texto_nome" class="form-label">Nome Completo</label>
                                <input type="text" name="nome_cliente" class="form-control"
                                    value="<?= htmlspecialchars($_POST['nome_cliente'] ?? '') ?>">
                            </div>
                            <div class="col-12">
                                <label for="texto_endereco" class="form-label">Morada <small>(NºPorta, Andar)</small></label>
                                <input type="text" class="form-control" id="texto_endereco" name="morada_cliente" value="<?= htmlspecialchars($_POST['morada_cliente'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="texto_cp" class="form-label">Código Postal</label>
                                <input type="text" name="cp_cliente" class="form-control" value="<?= htmlspecialchars($_POST['cp_cliente'] ?? '') ?>">

                            </div>
                            <div class="col-md-3">
                                <label for="texto_cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="texto_cidade" name="cid_cliente" value="<?= htmlspecialchars($_POST['cid_cliente'] ?? '') ?>" required>

                            </div>
                            <div class="col-md-3">
                                <label for="texto_cliente" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="texto_cliente" name="tel_cliente" value="<?= htmlspecialchars($_POST['tel_cliente'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label for="texto_email" class="form-label">Email</label>
                                <input type="email" name="email_cliente" class="form-control" value="<?= htmlspecialchars($_POST['email_cliente'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Sexo</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="radio_gender" value="m" <?= (($_POST['radio_gender'] ?? '') === 'm') ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="radio_m">Masculino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="radio_gender" value="f" <?= (($_POST['radio_gender'] ?? '') === 'f') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="radio_f">Feminino</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="texto_dnasc" class="form-label">Data de nascimento</label>
                            <input type="text" class="form-control" id="data_nasc" name="dnasc_cliente" value="<?= htmlspecialchars($_POST['dnasc_cliente'] ?? '') ?>" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="texto_estcivil" class="form-label">Estado Civil</label>
                                <select class="form-select" id="texto_estcivil" name="estaciv_cliente">
                                    <option value="solt" <?= (($_POST['estaciv_cliente'] ?? '') == 'solt') ? 'selected' : '' ?>>Solteiro</option>
                                    <option value="casd" <?= (($_POST['estaciv_cliente'] ?? '') == 'casd') ? 'selected' : '' ?>>Casado</option>
                                    <option value="ufat" <?= (($_POST['estaciv_cliente'] ?? '') == 'ufat') ? 'selected' : '' ?>>União de Facto</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="texto_SSaude" class="form-label">Sistema de Saúde</label>
                                <input type="text" class="form-control" id="texto_SSaude" name="campo_opcao" list="sistemasaude" value="<?= htmlspecialchars($_POST['campo_opcao'] ?? '') ?>">
                                <datalist id="sistemasaude">
                                    <option value="SNS">
                                    <option value="ADSE">
                                    <option value="SMAS">
                                    <option value="CTT">
                                    <option value="PSP">
                                </datalist>
                            </div>
                            <div class="col-md-4">
                                <label for="profissao" class="form-label">Profissão</label>
                                <input type="text" class="form-control" id="profissao" name="profissao_cliente" value="<?= htmlspecialchars($_POST['profissao_cliente'] ?? '') ?>">
                            </div>
                        </div>   
 
       <!--Botões-->
                        <div class="d-flex justify-content-end gap-2 mb-4">
                            <a href="lista.php" class="btn btn-outline-secondary">
                                <i class="fa-solid fa-xmark me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-regular fa-floppy-disk me-1"></i> Guardar
                            </button>
                        </div>
     <!-- Área de erros -->
                        <?php if (!empty($erros)): ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Foram encontrados os seguintes erros:</strong>
                                <ul class="mb-0">
                                    <?php foreach ($erros as $erro): ?>
                                        <li><?= htmlspecialchars($erro) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($erro_sistema)): ?>
                            <div class="alert alert-danger">
                                <strong>Erro:</strong>
                                <p><?= htmlspecialchars($erro_sistema) ?></p>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </main>
    </div>    
    <?php include '../../includes/footer.php'; ?>
    <script>
    flatpickr("#data_nasc", {
    dateFormat: "Y-m-d"
    });
    </script> 
