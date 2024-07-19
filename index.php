<?php
require_once("templates/header.php");
require_once("dao/ProdutoDAO.php");

$produtoDao = new ProdutoDAO($conn, $BASE_URL);

$novosProduto = $produtoDao->getnovosProduto();
$ferroProduto = $produtoDao->getProdutoByMaterial("Ferro");
$açoProduto = $produtoDao->getProdutoByMaterial("Aço");
$produtosBaratos = $produtoDao->getProdutoByPreco(0, 50); // Produtos com preço entre 0 e 50
$produtosRendimentoAlto = $produtoDao->getProdutoByRendimento(10); // Produtos com rendimento acima de 10

?>

<div id="main-container" class="container-fluid">
  <h2 class="section-title">Produtos novos</h2>
  <p class="section-descricao">Veja os últimos produtos adicionados</p>
  <div class="produtos-container">
    <?php foreach ($novosProduto as $produto) : ?>
      <?php require("templates/produto_card.php"); ?>
    <?php endforeach; ?>
    <?php if (count($novosProduto) === 0) : ?>
      <p class="empty-list">Ainda não há matérias registrado</p>
    <?php endif; ?>
  </div>
  <h2 class="section-title">Matérias de Ferro</h2>
  <p class="section-descricao">Descubra a durabilidade do ferro</p>
  <div class="produtos-container">
    <?php foreach ($ferroProduto as $produto) : ?>
      <?php require("templates/produto_card.php"); ?>
    <?php endforeach; ?>
    <?php if (count($ferroProduto) === 0) : ?>
      <p class="empty-list">Ainda não há ferro registrado</p>
    <?php endif; ?>
  </div>
  <h2 class="section-title">Matérias de Aço</h2>
  <p class="section-descricao">Qualidade do aço para seus projetos industriais.</p>
  <div class="produtos-container">
    <?php foreach ($açoProduto as $produto) : ?>
      <?php require("templates/produto_card.php"); ?>
    <?php endforeach; ?>
    <?php if (count($açoProduto) === 0) : ?>
      <p class="empty-list">Ainda não há aço registrado</p>
    <?php endif; ?>
  </div>
  <h2 class="section-title">Produtos Baratos</h2>
  <p class="section-descricao">Produtos com preço acessível.</p>
  <div class="produtos-container">
    <?php foreach ($produtosBaratos as $produto) : ?>
      <?php require("templates/produto_card.php"); ?>
    <?php endforeach; ?>
    <?php if (count($produtosBaratos) === 0) : ?>
      <p class="empty-list">Ainda não há produtos baratos registrados</p>
    <?php endif; ?>
  </div>
  <h2 class="section-title">Produtos com Alto Rendimento</h2>
  <p class="section-descricao">Produtos com alta eficiência e rendimento.</p>
  <div class="produtos-container">
    <?php foreach ($produtosRendimentoAlto as $produto) : ?>
      <?php require("templates/produto_card.php"); ?>
    <?php endforeach; ?>
    <?php if (count($produtosRendimentoAlto) === 0) : ?>
      <p class="empty-list">Ainda não há produtos com alto rendimento registrados</p>
    <?php endif; ?>
  </div>
</div>

<?php
require_once("templates/footer.php");
?>