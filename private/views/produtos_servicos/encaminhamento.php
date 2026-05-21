<!DOCTYPE html>
<html lang="pt">

<?php include '../../includes/header.php'; ?> 

<body>
    <!--Navbar-->
    <?php include '../../includes/nav.php'; ?>
    <!--Sidebar-->
    <div class="container-fluid">
        <div class="row">
            <?php include '../../includes/sidebar.php'; ?>


    <!-- Conteúdo Principal-->
    <main class="content">
        <section>
            <section>
                <h2>Avaliação de Condições de Saúde</h2>
                <p>Utilize este formulário para selecionar as condições de saúde relevantes do
 cliente. As informações escolhidas irão gerar uma recomendação personalizada para o
 plano de treino.</p>
        </section>
    </main>
    <div class="form-wrapper">
        <h2><strong><i class="fa-solid fa-dumbbell"></i> Avaliação de Condições de Saúde</strong></h2>
        <hr>

        <form oninput="avaliarCondicoes()">
            <div>
                <input type="checkbox" id="temProblemasCostas" name="condicao">
                <label>Problemas de costas</label><br>
                <label><input type="checkbox" id="estaGravida" name="condicao"> Grávida</label><br>
                <label><input type="checkbox" id="temDiabetes" name="condicao"> Diabético/a</label>
            </div>

            <div class="form-group">
                <label>Recomendação:</label>
                <div id="mensagem" class="alert text-center"></div>
            </div>
        </form>
    </div> 
    <?php include '../../includes/footer.php'; ?>