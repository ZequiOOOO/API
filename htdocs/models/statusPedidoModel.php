<?php
    require_once 'DAL/StatusPedidosDAO.php';

    class statusPedidoModel {
        public ?int $idStatus;
        public ?string $descricaoStatus;

        public function __construct(
            ?int $idStatus = null,
            ?string $descricaoStatus = null
        ) {
            $this->idStatus = $idStatus;
            $this->descricaoStatus = $descricaoStatus;
        }

        public function getStatusPedido() {
            $statusPedidosDAO = new StatusPedidosDAO();

            $statuses = $statusPedidosDAO->getStatusPedido();

            foreach ($statuses as &$status) {
                $status = new statusPedidomodel (
                    $status['idStatus'],
                    $status['descricaoStatus']
                );
            }

            return $statuses;
        }

    }
?>