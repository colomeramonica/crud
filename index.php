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
    <h4 class="pull-left client-dash"><a class="btn btn-info" href="client.php">Sou um cliente</a></h4>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Pedidos realizados</h2>
                        <h4 class="pull-left reports"><a class="btn btn-dark" href="reports.php">Relatórios</a></h4>
                        <a href="newItem.php" class="btn btn-success pull-right">Cadastrar novo item</a>
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
                                        echo "<th>Ações</th>";
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
                                        echo "<td>";
                                        if ($row['status'] == 'Pendente') {
                                            echo "<a href='confirmOrder.php?id=". $row['id_pedido'] ."'' title='Confirmar pedido' onclick='confirmOrder(" . $row['id_pedido'] . ")'>Confirmar</a>";
                                        }
                                            echo "<a href='editOrder.php?id=". $row['id_pedido'] ."' title='Editar pedido' data-toggle='tooltip'><span>Editar</span></a>";
                                        echo "</td>";

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
.client-dash{
    padding-left: 50px;
    font-size: 17px;
}

.reports{
    padding-left: 15px;
}
</style>
