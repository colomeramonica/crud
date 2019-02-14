<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <h4 class="pull-left"><a class="btn btn-info" href="index.php">Sou admin</a></h4>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Pedidos realizados</h2>
                        <h4 class="pull-left reports"><a class="btn btn-dark" href="reviews.php">Avaliações</a></h4>
                        <a href="newOrder.php" class="btn btn-success pull-right">Fazer pedido</a>
                    </div>
                    <?php
                    require_once "connect.php";
                    
                    $sql = "SELECT * FROM `pedidos`";
                    if($result = $connection->query($sql)){
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Item</th>";
                                        echo "<th>Data</th>";
                                        echo "<th>Status</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    $date = strtotime($row['data_pedido']);

                                    $join = 'SELECT `nome` FROM `cardapio` as c JOIN `pedidos` as p ON c.id_item = p.id_item';
                                    $item = $connection->query($join);
                                    $itemName = $item->fetch_array();

                                    echo "<tr>";
                                        echo "<td>" . $row['id_pedido'] . "</td>";
                                        echo "<td>" . $itemName['nome'] . "</td>";
                                        echo "<td>" . date('d/m/Y', $date)  . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            $result->free();
                        } else{
                            echo "<p class='lead'><em>Nenhum registro encontrado.</em></p>";
                        }
                    } else{
                        echo "ERRO: Não foi possivel estabelecer conexao. " . $connection->error;
                    }
                    
                    $connection->close();
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

<style>
h4{
    padding-left: 50px;
    font-size: 17px;
}
</style>