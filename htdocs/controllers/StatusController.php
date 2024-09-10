
<?php 
    require_once './models/statusPedidoModel.php';

    class StatusController {
        public function getStatus() {
            $statusPedidoModel = new statusPedidoModel();
            $status = $statusPedidoModel->getStatusPedido();

           
            return json_encode([
                'error' => null,
                'result' => $status
            ]);
        }

        public function getStatusPorId() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['id']))
                return $this->mostrarErro('Você deve informar o id!');

            $response = (new StatusPedidoModel())->getStatusPorId($dados['id']);

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }
    }
?>


