<?php
if (isset($_POST['id']) && !empty($_POST['id'])) {
    require_once('connect.php');
        $sql = "ALTER TABLE `pedidos` SET `status` = 'Em Preparação' WHERE `id_pedido` = ?";
        $stmt = $connection->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('i', $paramId);
            $paramId = $_POST['id'];
            if ($stmt->execute()) {
                header('location: index.php');
            } else {
                echo 'Erro ao confirmar.';
            }
        }
            
    $stmt->close();
    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Confirmar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                    </div>
                    <form method="post">
                        <div class="alert alert-info fade-in">
                            <p>Confirmar pedido?</p>
                            <p>
                                <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
                                <input type="submit" value="Sim" class="btn btn-default">
                                <a href="index.php" class="btn btn-danger">Não</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>