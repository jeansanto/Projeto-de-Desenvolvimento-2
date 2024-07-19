<?php
require_once("templates/header.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/ProdutoDAO.php");

$user = new User();
$userDao = new UserDAO($conn, $BASE_URL);
$produtoDao = new ProdutoDAO($conn, $BASE_URL);

$userData = $userDao->verifyToken(true);

$userProdutos = $produtoDao->getProdutoById($userData->id);
?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Painel de alterar produtos</h2>
    <p class="section-descricao">Adicione, atualize ou exclua produtos</p>
    <div class="col-md-12" id="add-produto-container">
        <a href="<?= $BASE_URL ?>newproduto.php" class="btn card-btn">
            <i class="fas fa-plus"></i> Adicionar Produto
        </a>
    </div>
    <div class="col-md-12" id="produtos-dashboard">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Título</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Material</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Rendimento</th>
                    <th scope="col">Despesas</th>
                    <th scope="col" class="actions-column">Funções</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userProdutos as $produto): ?>
                <tr>
                    <td scope="row"><?= htmlspecialchars($produto->id) ?></td>
                    <td><a href="<?= $BASE_URL ?>produto.php?id=<?= $produto->id ?>" class="table-produto-title fas fa-tag"><?= htmlspecialchars($produto->title) ?></a></td>
                    <td><?= htmlspecialchars($produto->descricao) ?></td>
                    <td><?= htmlspecialchars($produto->material) ?></td>
                    <td><i class="fas fa-dollar-sign"></i> <?= htmlspecialchars($produto->preco) ?></td>
                    <td><?= htmlspecialchars($produto->rendimento) ?></td>
                    <td><?= htmlspecialchars($produto->despesas) ?></td>
                    <td class="actions-column">
                        <a href="<?= $BASE_URL ?>editproduto.php?id=<?= $produto->id ?>" class="edit-btn">
                            <i class="far fa-edit"></i> Editar
                        </a>
                        <form action="<?= $BASE_URL ?>produto_process.php" method="post" onsubmit="return confirm('Você tem certeza que deseja excluir este produto?');">
                            <input type="hidden" name="type" value="delete">
                            <input type="hidden" name="id" value="<?= $produto->id ?>">
                            <button type="submit" class="delete-btn">
                                <i class="fas fa-times"></i> Deletar
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once("templates/footer.php");
?>
