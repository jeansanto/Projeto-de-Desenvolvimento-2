<?php
require_once("templates/header.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");

$user = new User();
$userDao = new UserDao($conn, $BASE_URL);

$userData = $userDao->verifyToken(true);
?>

<div id="main-container" class="container-fluid">
    <div class="offset-md-4 col-md-4">
        <h1 class="page-title">Adicionar Produto</h1>
        <p class="page-descricao">Preencha o Formulário</p>
        <form action="<?= $BASE_URL ?>produto_process.php" id="add-produto-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">
            <div class="form-group">
                <label for="title">Produto:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Digite seu Produto">
            </div>
            <div class="form-group">
                <label for="material">Material:</label>
                <select name="material" id="material" class="form-control">
                    <option value="">Selecione</option>
                    <option value="Ferro">Ferro</option>
                    <option value="Aço">Aço</option>
                    <option value="Alumínio">Alumínio</option>
                    <option value="Vidro">Vidro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="preco">Preço:</label>
                <input type="text" class="form-control" id="preco" name="preco" placeholder="Digite seu Preço">
            </div>
            <div class="form-group">
                <label for="rendimento">Rendimento / Lucro:</label>
                <input type="text" class="form-control" id="rendimento" name="rendimento" placeholder="Digite seu Rendimento">
            </div>
            <div class="form-group">
                <label for="despesas">Despesas:</label>
                <input type="text" class="form-control" id="despesas" name="despesas" placeholder="Digite seu Despesas">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="5" class="form-control" placeholder="Descreve o Produto"></textarea>
            </div>
            <input type="submit" class="btn card-btn" value="Adicionar Produto">
        </form>
    </div>
</div>

<?php
require_once("templates/footer.php");
?>