<?php

require_once("models/Produto.php");
require_once("models/Message.php");

class ProdutoDAO implements ProdutoDAOInterface
{
    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildProduto($data)
    {
        $produto = new Produto();
        $produto->id = $data["id"];
        $produto->title = $data["title"];
        $produto->descricao = $data["descricao"];
        $produto->material = $data["material"];
        $produto->preco = $data["preco"];
        $produto->rendimento = $data["rendimento"];
        $produto->despesas = $data["despesas"];
        $produto->users_id = $data["users_id"];
        return $produto;
    }

    public function findAll()
    {
    }

    public function getnovosProduto()
    {
        $produtos = [];
        $stmt = $this->conn->query("SELECT * FROM produtos ORDER BY id DESC");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $produtosArray = $stmt->fetchAll();
            foreach ($produtosArray as $produto) {
                $produtos[] = $this->buildProduto($produto);
            }
        }
        return $produtos;
    }

    public function getProdutoByMaterial($material)
    {
        $produtos = [];
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE material = :material ORDER BY id DESC");
        $stmt->bindParam(":material", $material);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $produtosArray = $stmt->fetchAll();
            foreach ($produtosArray as $produto) {
                $produtos[] = $this->buildProduto($produto);
            }
        }
        return $produtos;
    }

    public function getProdutoById($id)
    {
        $produtos = [];
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE users_id = :users_id");
        $stmt->bindParam(":users_id", $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $produtosArray = $stmt->fetchAll();
            foreach ($produtosArray as $produto) {
                $produtos[] = $this->buildProduto($produto);
            }
        }
        return $produtos;
    }

    public function getProdutoByPreco($precoMin, $precoMax)
    {
        $produtos = [];
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE preco BETWEEN :precoMin AND :precoMax ORDER BY preco ASC");
        $stmt->bindParam(":precoMin", $precoMin);
        $stmt->bindParam(":precoMax", $precoMax);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $produtosArray = $stmt->fetchAll();
            foreach ($produtosArray as $produto) {
                $produtos[] = $this->buildProduto($produto);
            }
        }
        return $produtos;
    }

    public function getProdutoByRendimento($rendimentoMin)
    {
        $produtos = [];
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE rendimento >= :rendimentoMin ORDER BY rendimento DESC");
        $stmt->bindParam(":rendimentoMin", $rendimentoMin);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $produtosArray = $stmt->fetchAll();
            foreach ($produtosArray as $produto) {
                $produtos[] = $this->buildProduto($produto);
            }
        }
        return $produtos;
    }

    public function findById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $produtoData = $stmt->fetch();
            return $this->buildProduto($produtoData);
        }

        return null; // Retorna null se não encontrar
    }

    public function findByTitle($title)
    {
    }

    public function create(Produto $produto)
    {
        $stmt = $this->conn->prepare("INSERT INTO produtos (
            title, descricao, material, preco, rendimento, despesas, users_id
        ) VALUES (
            :title, :descricao, :material, :preco, :rendimento, :despesas, :users_id
        )");

        $stmt->bindParam(":title", $produto->title);
        $stmt->bindParam(":descricao", $produto->descricao);
        $stmt->bindParam(":material", $produto->material);
        $stmt->bindParam(":preco", $produto->preco);
        $stmt->bindParam(":rendimento", $produto->rendimento);
        $stmt->bindParam(":despesas", $produto->despesas);
        $stmt->bindParam(":users_id", $produto->users_id);

        $stmt->execute();

        $this->message->setMessage("Produto adicionado com sucesso!", "success", "index.php");
    }

    public function update(Produto $produto)
    {
        $stmt = $this->conn->prepare("UPDATE produtos SET
            title = :title,
            descricao = :descricao,
            material = :material,
            preco = :preco,
            rendimento = :rendimento,
            despesas = :despesas
            WHERE id = :id
        ");

        $stmt->bindParam(":title", $produto->title);
        $stmt->bindParam(":descricao", $produto->descricao);
        $stmt->bindParam(":material", $produto->material);
        $stmt->bindParam(":preco", $produto->preco);
        $stmt->bindParam(":rendimento", $produto->rendimento);
        $stmt->bindParam(":despesas", $produto->despesas);
        $stmt->bindParam(":id", $produto->id);

        $stmt->execute();

        $this->message->setMessage("Produto atualizado com sucesso!", "success", "dashboard.php");
    }

    public function destroy($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM produtos WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $this->message->setMessage("Produto deletado com sucesso!", "success", "dashboard.php");
    }
}
