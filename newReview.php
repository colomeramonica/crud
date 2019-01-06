<!DOCTYPE html>
<html>
<head>
	<title>Nova avaliação</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
 
<link rel="stylesheet" href="styles.css" >
 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/starability-basic.min.css"/>
</head>
<body>
<div class="container">
	<div class="row">
		<form method="post" class="form-horizontal col-md-6 col-md-offset-3">
		<h2>Nova avaliação</h2>

            <div class="form-group">
                <label for="input1" class="col-sm-2 control-label">Pedido</label>
                <div class="col-sm-10 available-items">
                    <select name="order" class="form-control">
                    <?php require_once "connect.php";
                    $sql = 'SELECT * FROM `pedidos`';
                    if($result = $connection->query($sql)){
                        if($result->num_rows > 0) {
                           while($row = $result->fetch_array()){ ?>
                                <option value="<?php echo $row['id_pedido'];?>"><?php echo $row['id_pedido'];?></option>
                           <?php } ?>
                        <?php } ?>   
                    <?php } ?> 
                    </select>
                </div>
            </div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Descrição</label>
			    <div class="col-sm-10">
			      <input type="text" name="description"  class="form-control" id="description" placeholder="Descrição" />
			    </div>
			</div>

			<div class="form-group">
                <label for="input1" class="col-sm-2 control-label">Nota</label>
                <fieldset class="starability-basic">
                <input type="radio" id="no-rate" class="input-no-rate" name="rating" value="0" checked aria-label="Sem avaliação" />
                <input type="radio" id="first-rate1" name="rating" value="1" />
                <label for="first-rate1" title="Terrível">1 estrelas</label>
                <input type="radio" id="first-rate2" name="rating" value="2" />
                <label for="first-rate2" title="Ruim">2 estrelas</label>
                <input type="radio" id="first-rate3" name="rating" value="3" />
                <label for="first-rate3" title="Mediano">3 estrelas</label>
                <input type="radio" id="first-rate4" name="rating" value="4" />
                <label for="first-rate4" title="Muito bom">4 estrelas</label>
                <input type="radio" id="first-rate5" name="rating" value="5" />
                <label for="first-rate5" title="ótimo">5 estrelas</label>
            </div>

			<input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="submit" />
			 <p><a href="reviews.php" class="btn btn-primary">Voltar</a></p>
		</form>
	</div>
</div>
</body>
</html>

<?php
require_once "connect.php";
 
 $item = $description = $payment = $address = "";

if (isset($_POST) && !empty($_POST)) {
    $order = $_POST['order'];
    $description = $_POST['description'];
    $rating = $_POST['rating'];
}

if (!empty($description) && !empty($rating) && !empty($order)) {
        $sql = "INSERT INTO `avaliacoes` (descricao, nota, id_pedido) VALUES (?, ?, ?)";
 
        if($stmt = $connection->prepare($sql)){
            $stmt->bind_param("sii", $paramDescription, $paramRating, $paramOrder); 
            
            $paramDescription = $description;
            $paramRating = $rating;
            $paramOrder = $order;
            
            if($stmt->execute()){
                echo "Salvo com sucesso.";
                exit();
            } else{
                echo "Erro ao salvar.";
            }
        }
         
        $stmt->close();
    }
    
    $connection->close();
?>