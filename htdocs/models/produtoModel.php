<?php
    require_once 'DAL/ProdutoDAO.php';

    class produtoModel {
        public ?int $idProduto;
        public ?string $descricaoProduto;
        public ?float $precoProduto;

        public function __construct(
            ?int $idProduto = null,
            ?string $descricaoProduto = null,
            ?float $precoProduto = null
        ) {
            $this->idProduto = $idProduto;
            $this->descricaoProduto = $descricaoProduto;
            $this->precoProduto = $precoProduto;
        }

        public function create() {
            $produtoDAO = new ProdutoDAO($this->descricaoProduto, $this->precoProduto);
            
            return $produtoDAO->create($this);
        }

        public function getProdutos() {
           $produtoDAO = new  ProdutoDAO();

           return $produtoDAO->getProdutos();
        }
       
        public function getProdutoPorId($idProduto) {
          $produtoDAO = new ProdutoDAO();
       
          return $produtoDAO->getProdutoPorId($idProduto);
       }
    

        public function update() {
          $produtoDAO = new ProdutoDAO($this->descricaoProduto, $this->precoProduto);
          
          return $produtoDAO->update($this);
    
    }
         public function delete() {
           $produtoDAO = new ProdutoDAO($this->descricaoProduto, $this->precoProduto);
           
           return $produtoDAO->delete($this->idProduto);
    }
        
            
        
    }
?>