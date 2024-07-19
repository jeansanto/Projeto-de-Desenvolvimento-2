<?php

class Produto {

    public $id;
    public $title;
    public $descricao;
    public $material;
    public $preco;
    public $rendimento;
    public $despesas;
    public $users_id;

}

interface ProdutoDAOInterface {

    public function buildProduto($data);
    public function findAll();
    public function getnovosProduto();
    public function getProdutoByMaterial($material);
    public function getProdutoById($id);
    public function findById($id);
    public function findByTitle($title);
    public function create(produto $produto);
    public function update(produto $produto);
    public function destroy($id);

}