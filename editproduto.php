<?php
require_once("templates/header.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/ProdutoDAO.php");

$user = new User();
$userDao = new UserDAO($conn, $BASE_URL);
$produtoDao = new ProdutoDAO($conn, $BASE_URL);

$userData = $userDao->verifyToken(true);

$produto = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produto = $produtoDao->findById($id);
}
?>

<div id="main-container" class="container-fluid">
    <div class="offset-md-4 col-md-4">
        <h1 class="page-title">Editar Produto</h1>
        <p class="page-descricao">Atualize as informações do produto</p>
        <?php if ($produto): ?>
        <form action="<?= $BASE_URL ?>produto_process.php" method="post">
            <input type="hidden" name="type" value="update">
            <input type="hidden" name="id" value="<?= $produto->id ?>">
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($produto->title) ?>" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" class="form-control" required><?= htmlspecialchars($produto->descricao) ?></textarea>
            </div>
            <div class="form-group">
                <label for="material">Material:</label>
                <input type="text" name="material" id="material" class="form-control" value="<?= htmlspecialchars($produto->material) ?>" required>
            </div>
            <div class="form-group">
                <label for="preco">Preço:</label>
                <input type="number" name="preco" id="preco" class="form-control" step="0.01" value="<?= htmlspecialchars($produto->preco) ?>" required>
            </div>
            <div class="form-group">
                <label for="rendimento">Rendimento:</label>
                <input type="number" name="rendimento" id="rendimento" class="form-control" step="0.01" value="<?= htmlspecialchars($produto->rendimento) ?>" required>
            </div>
            <div class="form-group">
                <label for="despesas">Despesas:</label>
                <input type="number" name="despesas" id="despesas" class="form-control" step="0.01" value="<?= htmlspecialchars($produto->despesas) ?>" required>
            </div>
            <input type="submit" class="btn card-btn" value="Salvar">
        </form>
        <?php else: ?>
        <p>Produto não encontrado.</p>
        <?php endif; ?>
    </div>
</div>

<?php
require_once("templates/footer.php");
?>
