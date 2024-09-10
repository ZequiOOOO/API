<?php
require_once 'Conexao.php';

class ItemPedidoDAO {
    public function getItemPedidoPorId(int $idItemPedido) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM item_pedido WHERE idItemPedido = :idItemPedido;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idItemPedido', $idItemPedido);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createItemPedido(ItemPedidoModel $itemPedido) {
        $conexao = (new Conexao())->getConexao();

        $sql = "INSERT INTO item_pedido  VALUES (:idItemPedido, :quantidade, :idProduto, :idPedido);";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idProduto', $itemPedido->idProduto);
        $stmt->bindValue(':quantidade', $itemPedido->quantidade);
        return $stmt->execute();
    }

    public function update(ItemPedidoModel $itemPedido) {
        $conexao = (new Conexao())->getConexao();
        
        $sql = "UPDATE item_pedido SET idPedido = :idPedido, idProduto = :idProduto, quantidade = :quantidade WHERE idItemPedido = :idItemPedido;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idItemPedido', $itemPedido->idItemPedido);
        $stmt->bindValue(':idPedido', $itemPedido->idPedido);
        $stmt->bindValue(':idProduto', $itemPedido->idProduto);
        $stmt->bindValue(':quantidade', $itemPedido->quantidade);
        return $stmt->execute();
    }

    public function getValorTotalFromPedidoById($idPedido) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT ip.*, ip.quantidade * p.precoProduto AS valorTotal 
                FROM item_pedido ip 
                LEFT JOIN produto p ON ip.idProduto = p.idProduto 
                WHERE ip.idPedido = :idPedido;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idPedido', $idPedido);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete(ItemPedidoModel $itemPedido) {
        $conexao = (new Conexao())->getConexao();
        
        $sql = "DELETE FROM item_pedido WHERE idItemPedido = :idItemPedido;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idItemPedido', $itemPedido->idItemPedido);
        return $stmt->execute();
    }

    public function getItensPedido() {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM item_pedido;";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
