<?php 
    require_once './models/ProdutoModel.php';

class ProdutoController {
    
    public function getProdutos() {
        $produtoModel = new produtoModel();
        $produtos = $produtoModel->getProdutos(); 
        
        return json_encode([
            'error' => null,
            'result' => $produtos
        ]);
    }
    
    public function getProdutoPorId() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['idProduto'])) {
            return $this->mostrarErro('Você deve informar o idProduto!');
        }

        $produtoModel = new produtoModel();
        $produto = $produtoModel->getProdutoPorId($dados['idProduto']); 

        return json_encode([
            'error' => null,
            'result' => $produto
        ]);
    }
    public function createProduto() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['descricaoProduto'])) {
            return $this->mostrarErro('Você deve informar o idProduto');
        }
        if (empty($dados['precoProduto'])) {
            return $this->mostrarErro('Você deve informar o idProduto');
        }

        $produto = new produtoModel(
            null,
            $dados['descricaoProduto'],
            $dados['precoProduto'] 
        );

        $produto->create(); 

        return json_encode([
            'error' => null,
            'result' => true
        ]);
    }

    public function updateProduto() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['idProduto'])) {
            return $this->mostrarErro('Você deve informar o idProduto!');
        }

        if (empty($dados['descricaoProduto'])) {
            return $this->mostrarErro('Você deve informar a descricaoProduto!');
        }

        if (empty($dados['precoProduto'])) {
            return $this->mostrarErro('Você deve informar o precoProduto!');
        }

        $produto = new produtoModel(
            $dados['idProduto'],
            $dados['descricaoProduto'],
            $dados['precoProduto']
        );

        $produto->update(); 

        return json_encode([
            'error' => null,
            'result' => true
        ]);
    }

    
    public function deleteProduto() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['idProduto'])) {
            return $this->mostrarErro('Você deve informar o idProduto');
        }

        $produtoModel = new produtoModel($dados['idProduto']);
        $produtoModel->delete(); 

        return json_encode([
            'error' => null,
            'result' => true
        ]);
    }

    private function mostrarErro(string $mensagem) {
        return json_encode([
            'error' => $mensagem,
            'result' => null
        ]);
    }
}
?>


