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
                        <h2 class="pull-left">Relatório mensal</h2>
                    </div>
                    <?php 
                    require_once "connect.php"; 
                    $bestSeller = "SELECT `nome` FROM `cardapio` WHERE `id_item` = (SELECT `id_item` FROM `pedidos` GROUP BY `id_item` ORDER BY COUNT(`id_item`) DESC)";
                    $bestSeller = $connection->query($bestSeller);
                    $bestSeller = $bestSeller->fetch_array();

                    $billing = "SELECT  CEIL(SUM(preco)) AS faturamento FROM `cardapio` JOIN `pedidos` ON cardapio.id_item = pedidos.id_item";
                    $billing = $connection->query($billing);
                    $billing = $billing->fetch_array();

                    ?> 
                    <ul>
                    <li>Item mais pedido: <?php echo $bestSeller['nome'] ?></li>
                    <li>Faturamento semanal: <?php echo $billing['faturamento'] ?> reais</li>
                    </ul>
                </div>

                <p><a href="index.php" class="btn btn-primary">Voltar</a></p>

            </div>        
        </div>
    </div>
</body>
</html>
