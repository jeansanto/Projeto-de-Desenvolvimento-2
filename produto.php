<?php
require_once("templates/header.php");
require_once("models/Produto.php");
require_once("dao/ProdutoDAO.php");

$id = filter_input(INPUT_GET, "id");

$produto = null; // Corrigido para inicializar como null

$produtoDao = new ProdutoDAO($conn, $BASE_URL);

if (empty($id)) {
    $message->setMessage("O Produto não foi encontrado!", "error", "index.php");
} else {
    $produto = $produtoDao->findById($id);

    if (!$produto) {
        $message->setMessage("O Produto não foi encontrado!", "error", "index.php");
    }
}

$userOwnsProduto = false;

if (!empty($userData)) {
    if ($userData->id === $produto->users_id) {
        $userOwnsProduto = true;
    }
}
?>

<div id="main-container" class="container-fluid">
    <div class="row">
        <div class="offset-md-1 col-md-6 produto-container">
            <?php if ($produto) : ?>
                <h1 class="page-title"><?= htmlspecialchars($produto->title) ?></h1>
                <p class="produto-details">
                    <span>Preço: <?= htmlspecialchars($produto->preco) ?></span>
                    <span class="pipe"></span>
                    <span>Material: <?= htmlspecialchars($produto->material) ?></span>
                    <span class="pipe"></span>
                    <span>Rendimento: <?= htmlspecialchars($produto->rendimento) ?></span>
                    <span class="pipe"></span>
                    <span>Despesas: <?= htmlspecialchars($produto->despesas) ?></span>
                </p>
                <p class="produto-description"><?= htmlspecialchars($produto->descricao) ?></p>
            <?php else : ?>
                <p class="error-message">Produto não encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
require_once("templates/footer.php");
?>