<?php
require_once 'Conexao.php';

class PedidoDAO {
    public ?int $id_status_pedido;
    public ?int $id_usuario;

    public function __construct(
        ?int $id_status_pedido = null,
        ?int $id_usuario = null
    ) {
        $this->id_status_pedido = $id_status_pedido;
        $this->id_usuario = $id_usuario;
    }

    public function getPedido() {
        $conexao = (new Conexao())->getConexao();
        $sql = "SELECT * FROM pedidos;";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPedido(PedidoModel $pedido) {
        $conexao = (new Conexao())->getConexao();

        $sql = "INSERT INTO pedidos (id_usuario, id_status_pedido) VALUES (:id_usuario, :id_status_pedido);";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id_usuario', $pedido->id_usuario);
        $stmt->bindValue(':id_status_pedido', $pedido->id_status_pedido);
        return $stmt->execute();
    }

    public function update(PedidoModel $pedido) {
        $conexao = (new Conexao())->getConexao();

        $sql = "UPDATE pedidos SET id_status_pedido = :id_status_pedido, id_usuario = :id_usuario WHERE id = :id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $pedido->id);
        $stmt->bindValue(':id_status_pedido', $pedido->id_status_pedido,);
        $stmt->bindValue(':id_usuario', $pedido->id_usuario);
        return $stmt->execute();
    }

    public function delete(PedidoModel $pedido) {
        $conexao = (new Conexao())->getConexao();

        $sql = "DELETE FROM pedidos WHERE id = :id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $pedido->id);
        return $stmt->execute();
    }

    public function getPedidoPorId(int $id) {
        $conexao = (new Conexao())->getConexao();
        
        $sql = "SELECT * FROM pedidos WHERE id = :id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getValorTotalPedido(int $idPedido) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT SUM(valor) as valor_total FROM itens_pedido WHERE id_pedido = :idPedido;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idPedido', $idPedido);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPedidoPessoa(int $id_usuario) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM pedidos WHERE id_usuario = :id_usuario;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id_usuario', $id_usuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatusPedido(PedidoModel $pedido) {
        $conexao = (new Conexao())->getConexao();

        $sql = "UPDATE pedidos SET id_status_pedido = :id_status_pedido WHERE id = :id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $pedido->id);
        $stmt->bindValue(':id_status_pedido', $pedido->id_status_pedido);
        return $stmt->execute();
    }
}
?>
