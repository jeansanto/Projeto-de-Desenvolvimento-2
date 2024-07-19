<?php

require_once("globals.php");
require_once("db.php");
require_once("models/Produto.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/ProdutoDAO.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$produtoDao = new ProdutoDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");

$userData = $userDao->verifyToken();

if ($type === "create") {

    $title = filter_input(INPUT_POST, "title");
    $descricao = filter_input(INPUT_POST, "descricao");
    $material = filter_input(INPUT_POST, "material");
    $preco = filter_input(INPUT_POST, "preco");
    $rendimento = filter_input(INPUT_POST, "rendimento");
    $despesas = filter_input(INPUT_POST, "despesas");

    $produto = new Produto();

    if (!empty($title) && !empty($descricao) && !empty($material)) {

        $produto->title = $title;
        $produto->descricao = $descricao;
        $produto->material = $material;
        $produto->preco = $preco;
        $produto->rendimento = $rendimento;
        $produto->despesas = $despesas;
        $produto->users_id = $userData->id;

        $produtoDao->create($produto);
        
    } else {
        $message->setMessage("Adicionar pelo menos: produto, descrição e material!", "error", "back");
    }
} elseif ($type === "update") {

    $id = filter_input(INPUT_POST, "id");
    $title = filter_input(INPUT_POST, "title");
    $descricao = filter_input(INPUT_POST, "descricao");
    $material = filter_input(INPUT_POST, "material");
    $preco = filter_input(INPUT_POST, "preco");
    $rendimento = filter_input(INPUT_POST, "rendimento");
    $despesas = filter_input(INPUT_POST, "despesas");

    $produto = $produtoDao->findById($id);

    if ($produto) {
        $produto->title = $title;
        $produto->descricao = $descricao;
        $produto->material = $material;
        $produto->preco = $preco;
        $produto->rendimento = $rendimento;
        $produto->despesas = $despesas;

        $produtoDao->update($produto);

        $message->setMessage("Produto atualizado com sucesso!", "success", "dashboard.php");
    } else {
        $message->setMessage("Produto não encontrado!", "error", "dashboard.php");
    }
} elseif ($type === "delete") {

    $id = filter_input(INPUT_POST, "id");

    $produto = $produtoDao->findById($id);

    if ($produto) {
        $produtoDao->destroy($id);
        $message->setMessage("Produto deletado com sucesso!", "success", "dashboard.php");
    } else {
        $message->setMessage("Produto não encontrado!", "error", "dashboard.php");
    }
} else {
    $message->setMessage("Informações inválidas!", "error", "index.php");
}
?>
