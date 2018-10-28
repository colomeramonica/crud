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
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Funcionarios Cadastrados</h2>
                        <a href="insert.php" class="btn btn-success pull-right">Adicionar novo funcionario</a>
                    </div>
                    <?php
                    require_once "connect.php";
                    
                    $sql = "SELECT * FROM `funcionarios`";
                    if($result = $connection->query($sql)){
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nome</th>";
                                        echo "<th>Idade</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Salario</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id_funcionario'] . "</td>";
                                        echo "<td>" . $row['nome'] . "</td>";
                                        echo "<td>" . $row['idade'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['salario'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id_funcionario'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['id_funcionario'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id_funcionario'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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