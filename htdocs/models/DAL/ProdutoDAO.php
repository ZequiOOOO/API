<?php
    require_once 'Conexao.php';

class ProdutoDAO{
    public function getProdutos() {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM produto;";

        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(produtoModel $produto) {

        $conexao = (new Conexao())->getConexao();
        
        $sql = "INSERT INTO produto VALUES(:idProduto,:descricao,:preco);";

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idProduto', null);
        $stmt->bindValue(':descricao', $produto->descricaoProduto);
        $stmt->bindValue(':preco', $produto->precoProduto);
        
        return $stmt->execute();
    }
    
    public function getProdutoPorId($idProduto) {
        $conexao = (new Conexao())->getConexao();
        $sql = "SELECT * FROM produto WHERE idProduto = :idProduto;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idProduto', $idProduto);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function update(produtoModel $produto) {
        
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE produto SET descricao = :descricao, preco = :preco WHERE :id = id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $produto->idProduto);
            $stmt->bindValue(':id', $produto->idProduto);
            $stmt->bindValue(':descricao', $produto->descricaoProduto);
            $stmt->bindValue(':preco', $produto->precoProduto);
            return $stmt->execute();
        }

        public function delete($idProduto) {
            $conexao = (new Conexao())->getConexao();

            $sql = "DELETE FROM produto WHERE id = :id;";
            
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $idProduto);
            return $stmt->execute();
        }
          
}
?>