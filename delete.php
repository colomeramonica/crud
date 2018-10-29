<?php

if (isset($_POST['id']) && !empty($_POST['id'])) {
    require_once('connect.php');

        $sql = 'DELETE FROM `funcionarios` WHERE `id_funcionario` = ?';

        $stmt = $connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('i', $paramId);

            $paramId = trim($_POST['id']);

            if ($stmt->execute()) {
                header('location: index.php');
            } else {
                echo 'Erro ao salvar.';
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
    <title>Remover</title>
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
                        <h1>Apagar registro</h1>
                    </div>
                    <form method="post">
                        <div class="alert alert-danger fade-in">
                            <p>Você tem certeza que deseja remover?</p>
                            <p>
                                <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>">
                                <input type="submit" value="Sim" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">Não</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>