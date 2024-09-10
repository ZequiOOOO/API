<?php 
require_once './models/ItemPedidoModel.php';

class ItemPedidosController {
    
    public function getItemPedidoPorId() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['idItemPedido'])) {
            return $this->mostrarErro('Você deve informar o idItemPedido!');
        }

        $itemPedidoModel = new ItemPedidoModel();
        $item = $itemPedidoModel->getItemPedidoPorId($dados['idItemPedido']); 

        return json_encode([
            'error' => null,
            'result' => $item
        ]);
    }

    public function getItensPedido() {
        $itemPedidoModel = new ItemPedidoModel();

        $itensPedido = $itemPedidoModel->getItensPedido();

        return json_encode([
            'error' => null,
            'result' => $itensPedido
        ]);
    }

    public function createItemPedido() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['descricaoProduto'])) {
            return $this->mostrarErro('Você deve informar a descricaoProduto!');
        }
        if (empty($dados['quantidade'])) {
            return $this->mostrarErro('Você deve informar a quantidade!');
        }

        $item = new ItemPedidoModel(
            null,
            null, 
            $dados['descricaoProduto'],
            $dados['quantidade']
        );

        $item->create(); 

        return json_encode([
            'error' => null,
            'result' => true
        ]);
    }

    public function updateItemPedido() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['idItemPedido'])) {
            return $this->mostrarErro('Você deve informar o idItemPedido!');
        }

        if (empty($dados['idPedido'])) {
            return $this->mostrarErro('Você deve informar o idPedido!');
        }
        if (empty($dados['idProduto'])) {
            return $this->mostrarErro('Você deve informar o idProduto!');
        }
        if (empty($dados['quantidade'])) {
            return $this->mostrarErro('Você deve informar a quantidade!');
        }

        $item = new ItemPedidoModel(
            $dados['idItemPedido'],
            $dados['idPedido'],
            $dados['idProduto'],
            $dados['quantidade']
        );

        $item->update(); 

        return json_encode([
            'error' => null,
            'result' => true
        ]);
    }


    public function deleteItemPedido() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['idItemPedido'])) {
            return $this->mostrarErro('Você deve informar o idItemPedido');
        }

        $itemPedidoModel = new ItemPedidoModel($dados['idItemPedido']);
        $itemPedidoModel->delete(); 

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
    public function getValorTotalPedido(int $idPedido) {
        $conexao = (new Conexao())->getConexao();
        
        $sql = "SELECT SUM(valor) as valor_total FROM itens_pedido WHERE id_pedido = :idPedido;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idPedido', $idPedido);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['valor_total'] ?? 0; 
    }

}
?>
