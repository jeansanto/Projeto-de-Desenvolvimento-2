<?php
// Verifica se o objeto $produto está definido e é válido
if (!isset($produto) || !is_object($produto)) {
    echo '<p class="empty-list">Produto não encontrado.</p>';
    return;
}
?>
<div class="card produto-card">
    <div class="card-body">
        <h5 class="card-title">
            <a href="<?= $BASE_URL ?>produto.php?id=<?= $produto->id ?>"><?= htmlspecialchars($produto->title) ?></a>
        </h5>
        <p class="card-material"><?= htmlspecialchars($produto->material) ?></p>
        <p class="card-text"><?= htmlspecialchars($produto->descricao) ?></p>
        <p class="card-price">Preço: R$<?= number_format($produto->preco, 2, ',', '.') ?></p>
        <p class="card-rendimento">Rendimento: <?= htmlspecialchars($produto->rendimento) ?></p>
        <p class="card-despesas">Despesas: R$<?= number_format($produto->despesas, 2, ',', '.') ?></p>
        <div class="card-btn-container">
            <a href="<?= $BASE_URL ?>dashboard.php?id=<?= $produto->id ?>" class="btn card-btn alterar-produto">Alterar Produto</a>
            <a href="<?= $BASE_URL ?>produto.php?id=<?= $produto->id ?>" class="btn card-btn visualizar">Visualizar</a>
        </div>
    </div>
</div>

