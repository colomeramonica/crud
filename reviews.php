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
                        <h2 class="pull-left">Avaliações</h2>
                        <a href="newReview.php" class="btn btn-success pull-right">Nova avaliação</a>
                    </div>
                    <?php
                    require_once "connect.php";
                    
                    $sql = "SELECT * FROM `avaliacoes`";
                    if($result = $connection->query($sql)){
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Pedido</th>";
                                        echo "<th>Descrição</th>";
                                        echo "<th>Nota</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id_avaliacao'] . "</td>";
                                        echo "<td>" . $row['id_pedido'] . "</td>";
                                        echo "<td>" . $row['descricao'] . "</td>";
                                        echo "<td>" . $row['nota']  . "</td>";
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
                <p><a href="client.php" class="btn btn-primary">Voltar</a></p>
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