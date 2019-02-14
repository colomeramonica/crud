<?php
if (isset($_GET['id'])) {
    require_once('connect.php');
        $id = $_GET['id'];

        $sql = "UPDATE `pedidos` SET `status` = 'Em Preparação' WHERE `id_pedido` = ?";
        $stmt = $connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('i', $paramId);
            $paramId = $id;

            if ($stmt->execute()) {
                header('location: index.php');
            } else {
                echo 'Erro ao confirmar.';
            }
        }
            
    $connection->close();
}
?>