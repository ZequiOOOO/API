<?php
require_once 'DAL/PedidoDAO.php';
require_once 'DAL/ItemPedidoDAO.php';

class PedidoModel {
    public ?int $id;
    public ?int $id_status_pedido;
    public ?int $id_usuario;

    public function __construct(
        ?int $id = null,
        ?int $id_status_pedido = null,
        ?int $id_usuario = null
    ) {
        $this->id = $id;
        $this->id_status_pedido = $id_status_pedido;
        $this->id_usuario = $id_usuario;
    }

    public function getPedido() {
        $pedidoDAO = new PedidoDAO();
        return $pedidoDAO->getPedido();
    }

    public function getPedidoPorId(int $id) {
        $pedidoDAO = new PedidoDAO();
        return $pedidoDAO->getPedidoPorId($id);
    }

    public function create() {
        $pedidoDAO = new PedidoDAO();
        return $pedidoDAO->createPedido($this);
    }

    public function getPedidoPessoa(int $id_usuario) {
        $pedidoDAO = new PedidoDAO();
        return $pedidoDAO->getPedidoPessoa($id_usuario);
    }

    public function update() {
        $pedidoDAO = new PedidoDAO();
        return $pedidoDAO->update($this);
    }

    public function updateStatusPedido() {
        $pedidoDAO = new PedidoDAO();
        return $pedidoDAO->updateStatusPedido($this);
    }

    public function delete() {
        $pedidoDAO = new PedidoDAO();
        return $pedidoDAO->delete($this);
    }
    
    public function getValorTotalPedido(int $idPedido) {
        $itemPedidoDAO = new ItemPedidoDAO();
        return $itemPedidoDAO->getValorTotalPedido($idPedido);
    }
}
?>
