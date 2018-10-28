<!DOCTYPE html>
<html>
<head>
	<title>Novo funcionario</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
 
<link rel="stylesheet" href="styles.css" >
 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<form method="post" class="form-horizontal col-md-6 col-md-offset-3">
		<h2>Cadastro de novo funcionario</h2>
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Nome:</label>
			    <div class="col-sm-10">
			      <input type="text" name="name"  class="form-control" id="name" placeholder="Nome" />
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Idade</label>
			    <div class="col-sm-10">
			      <input type="text" name="age"  class="form-control" id="age" placeholder="Idade" />
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">E-mail</label>
			    <div class="col-sm-10">
			      <input type="email" name="email"  class="form-control" id="email" placeholder="E-mail" />
			    </div>
			</div>

			<div class="form-group">
			<label for="input1" class="col-sm-2 control-label">Salario</label>
			<div class="col-sm-10">
				<select name="salary" class="form-control">
					<option>Salario</option>
					<option value="1000">1000</option>
					<option value="2000">2000</option>
					<option value="3000">3000</option>
					<option value="4000">4000</option>
				</select>
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
 
 $name = $age = $email = $salary = "";

if (isset($_POST) && !empty($_POST)) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];
}

if (!empty($name) && !empty($age) && !empty($email) && !empty($salary)) {
        // Prepara um statement de insercao
        $sql = "INSERT INTO `funcionarios` (nome, idade, email, salario) VALUES (?, ?, ?, ?)";
 
        if($stmt = $connection->prepare($sql)){
            // Adiciona variaveis ao statement
            $stmt->bind_param("sisd", $paramName, $paramAge, $paramEmail, $paramSalary); //variaveis do tipo string, int, float
            
            $paramName = $name;
            $paramAge = $age;
            $paramEmail = $email;
            $paramSalary = $salary;
            
            // Tentativa de execução do statement
            if($stmt->execute()){
                // Sucesso ao gravar, redireciona para página inicial
                echo "Salvo com sucesso.";
                exit();
            } else{
                echo "Erro ao salvar.";
            }
        }
         
        // Fecha o statement
        $stmt->close();
    }
    
    // Fecha a conexao
    $connection->close();
?>