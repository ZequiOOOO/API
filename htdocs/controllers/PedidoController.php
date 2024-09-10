<?php 
require_once './models/PedidoModel.php';

class PedidoController {
    
    public function getPedido() {
        $pedidoModel = new PedidoModel();
        $pedidos = $pedidoModel->getPedido(); 
        
        return json_encode([
            'error' => null,
            'result' => $pedidos
        ]);
    }

    public function getValorTotalPedido() {
        $dados = json_decode(file_get_contents('php://input'), true);
        
        if (empty($dados['idPedido'])) {
            return $this->mostrarErro('Você deve informar o idPedido');
        }

        $pedidoModel = new PedidoModel();
        $result = $pedidoModel->getValorTotalPedido($dados['idPedido']);

        return json_encode([
            'error' => null,
            'result' => $result
        ]);
    }

    public function createPedido() {
        $dados = json_decode(file_get_contents('php://input'), true);
    
        if (empty($dados['id_status_pedido'])) {
            return $this->mostrarErro('Você deve informar o id_status_pedido');
        }
        if (empty($dados['id_usuario'])) {
            return $this->mostrarErro('Você deve informar o id_usuario');
        }
    
        $pedido = new PedidoModel(
            null,
            $dados['id_status_pedido'],
            $dados['id_usuario']
        );
    
        $pedido->create(); 
    
        return json_encode([
            'error' => null,
            'result' => true
        ]);
    }

    public function getPedidoPorId() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['id'])) {
            return $this->mostrarErro('Você deve informar o id!');
        }

        $pedidoModel = new PedidoModel();
        $pedido = $pedidoModel->getPedidoPorId($dados['id']); 

        return json_encode([
            'error' => null,
            'result' => $pedido
        ]); 
    }

    public function getPedidosPessoa() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['id_usuario'])) {
            return $this->mostrarErro('Você deve informar o id_usuario');
        }

        $pedidoModel = new PedidoModel(); 
        $pedidos = $pedidoModel->getPedidoPessoa($dados['id_usuario']);
        
        return json_encode([
            'error' => null,
            'result' => $pedidos
        ]);
    }

    public function updatePedido() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['id'])) {
            return $this->mostrarErro('Você deve informar o id!');
        }

        if (empty($dados['id_status_pedido'])) {
            return $this->mostrarErro('Você deve informar o id_status_pedido!');
        }

        if (empty($dados['id_usuario'])) {
            return $this->mostrarErro('Você deve informar o id_usuario!');
        }

        $pedido = new PedidoModel(
            $dados['id'],
            $dados['id_status_pedido'],
            $dados['id_usuario']
        );

        $pedido->update(); 

        return json_encode([
            'error' => null,
            'result' => true
        ]);
    }

    public function updateStatusPedido() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['id'])) {
            return $this->mostrarErro('Você deve informar o id');
        }

        if (empty($dados['id_status_pedido'])) {
            return $this->mostrarErro('Você deve informar o id_status_pedido');
        }

        $pedidoModel = new PedidoModel($dados['id'], $dados['id_status_pedido']);
        $pedidoModel->updateStatusPedido();
        
        return json_encode([
            'error' => null,
            'result' => true  
        ]);
    }
    
    public function deletePedido() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['id'])) {
            return $this->mostrarErro('Você deve informar o id');
        }

        $pedidoModel = new PedidoModel($dados['id']);
        $pedidoModel->delete(); 

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
