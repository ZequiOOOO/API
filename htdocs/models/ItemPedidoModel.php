<?php
require_once 'DAL/ItemPedidoDAO.php';

class ItemPedidoModel {
    public ?int $idItemPedido;
    public ?int $idPedido;
    public ?int $idProduto;
    public ?int $quantidade;

    public function __construct(
        ?int $idItemPedido = null,
        ?int $idPedido = null,
        ?int $idProduto = null,
        ?int $quantidade = null
    ) {
        $this->idItemPedido = $idItemPedido;
        $this->idPedido = $idPedido;
        $this->idProduto = $idProduto;
        $this->quantidade = $quantidade;
    }

    public function create() {
        $itemPedidoDAO = new ItemPedidoDAO();
        return $itemPedidoDAO->createItemPedido($this);
    }

    public function getItemPedidoPorId(int $idItemPedido) {
        $itemPedidoDAO = new ItemPedidoDAO();
        return $itemPedidoDAO->getItemPedidoPorId($idItemPedido);
    }

    public function getItensPedido() {
        $itemPedidoDAO = new ItemPedidoDAO();
        return $itemPedidoDAO->getItensPedido();
    }

    public function update() {
        $itemPedidoDAO = new ItemPedidoDAO();
        return $itemPedidoDAO->update($this);
    }

    public function delete() {
        $itemPedidoDAO = new ItemPedidoDAO();
        return $itemPedidoDAO->delete($this);
    }

}
?>
