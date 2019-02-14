<!DOCTYPE html>
<html>
<head>
	<title>Novo item</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
 
<link rel="stylesheet" href="styles.css" >
 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<form method="post" class="form-horizontal col-md-6 col-md-offset-3">
		<h2>Cadastro de novo item no cardápio</h2>
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Nome:</label>
			    <div class="col-sm-10">
			      <input type="text" name="name"  class="form-control" id="item_name" placeholder="Nome" />
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Descrição:</label>
			    <div class="col-sm-10">
			      <input type="text" name="description"  class="form-control" id="item_description" placeholder="Descrição" />
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Preço:</label>
			    <div class="col-sm-10">
			      <input type="number" name="price"  min="1" step="any" class="form-control" id="item_price" placeholder="Preço" />
			    </div>
			</div>

			<input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="submit" />
			 <p><a href="index.php" class="btn btn-primary">Voltar</a></p>
		</form>
	</div>
</div>
</body>
</html>

<?php
require_once "connect.php";
 
 $name = $description = $price = "";


	if (isset($_POST) && !empty($_POST)) {
		$name = $_POST['name'];
		$description = $_POST['description'];
		$price = $_POST['price'];	
	}

		$sql = "INSERT INTO `cardapio` (nome, descricao, preco) VALUES (?, ?, ?)";
		if (!empty($name) && !empty($description) && !empty($price)) {
			if($stmt = $connection->prepare($sql)){
				$stmt->bind_param("ssd", $paramName, $paramDscrp, $paramPrice);
				
				$paramName = $name;
				$paramDscrp = $description;
				$paramPrice = $price;
				
				if($stmt->execute()){
					echo "Salvo com sucesso.";
					exit();
				} else{
					echo "Erro ao salvar.";
				}
			}
				
			$stmt->close();
			
			$connection->close();
	}
?>