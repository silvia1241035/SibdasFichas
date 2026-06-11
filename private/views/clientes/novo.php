
<?php
    require_once __DIR__ . '/../../includes/funcoes.php';
    redirect_if_not_logged();?>
// Verificar se o formulário foi submetido
<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    echo "<p><strong>Dados recebidos:</strong> Nome: $nome
| Morada: $morada | Código Postal: $cp | Cidade: $cidade
| Telefone: $telefone | Email: $email | Sexo: " . ($sexo == 'm' ? 'Masculino' : 'Feminino') . "
| Data de nascimento: $dnasc | Estado civil: $estado | Sistema de Saúde: $sistema

| Profissão: $profissao</p>";
    // Imprimir os dados recebidos (para teste)
    echo "<p>Nome recebido: $nome</p>";
    // 2. Validar os dados
    $nome = trim($nome);
// 1. Verificar se o campo está vazio
    if (empty($nome)) {
        $erros[] = "O campo Nome é obrigatório.";
    }
    // 2. Verificar se contém apenas números ou mistura de letras com números
    elseif (preg_match('/\d/', $nome)) {
        $erros[] = "O campo Nome não pode conter números.";
    } 
    echo "<pre>"; // torna mais legível no browser
        print_r($erros);
        echo "</pre>"; 
  // 3. Se não houver erros, guardar na base de dados
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
                                <input type="text" class="form-control" id="texto_nome" name="nome_cliente" required>
                            </div>
                            <div class="col-12">
                                <label for="texto_endereco" class="form-label">Morada <small>(NºPorta, Andar)</small></label>
                                <input type="text" class="form-control" id="texto_endereco" name="morada_cliente">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="texto_cp" class="form-label">Código Postal</label>
                                <input type="text" class="form-control" id="texto_cp" name="cp_cliente" required>
                            </div>
                            <div class="col-md-3">
                                <label for="texto_cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="texto_cidade" name="cid_cliente" required>
                            </div>
                            <div class="col-md-3">
                                <label for="texto_cliente" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="texto_cliente" name="tel_cliente" required>
                            </div>
                            <div class="col-md-3">
                                <label for="texto_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="texto_email" name="email_cliente" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Sexo</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="radio_gender" id="radio_m" value="m" checked>
                                    <label class="form-check-label" for="radio_m">Masculino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio_gender" id="radio_f" value="f">
                                    <label class="form-check-label" for="radio_f">Feminino</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="texto_dnasc" class="form-label">Data de nascimento</label>
                            <input type="text" class="form-control" id="texto_dnasc" name="dnasc_cliente" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="texto_estcivil" class="form-label">Estado Civil</label>
                                <select class="form-select" id="texto_estcivil" name="estaciv_cliente">
                                    <option selected>Escolha uma opção</option>
                                    <option value="solt">Solteiro</option>
                                    <option value="casd">Casado</option>
                                    <option value="ufat">União de Facto</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="texto_SSaude" class="form-label">Sistema de Saúde</label>
                                <input type="text" class="form-control" id="texto_SSaude" name="campo_opcao" list="sistemasaude">
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
                                <input type="text" class="form-control" id="profissao" name="profissao_cliente">
                            </div>
                        </div>   
 
       <!--Botões-->
                        <div class="d-flex justify-content-end gap-2 mb-4">
                            <a href="lista.html" class="btn btn-outline-secondary">
                                <i class="fa-solid fa-xmark me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-regular fa-floppy-disk me-1"></i> Guardar
                            </button>
                        </div>
     <!-- Área de erros -->
                        <div class="alert alert-danger text-center" role="alert">
                            • Erro
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    </div>    
<?php include '../../includes/footer.php'; ?>
