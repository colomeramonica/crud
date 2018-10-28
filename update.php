<?php
require_once "connect.php";
 
$name = $address = $salary = "";
 
 $id = $_GET["id"];
if(isset($_POST["id"]) && !empty($_POST["id"])) {
    
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];
    
    if(!empty($name) && !empty($age) && !empty($email) && !empty($salary)){
        $sql = "UPDATE `funcionarios` SET nome = ?, idade = ?, email = ?, salario = ? WHERE id_funcionario = ?";
 
        if($stmt = $connection->prepare($sql)){
            $stmt->bind_param("sisdi", $paramName, $paramAge, $paramEmail, $paramSalary, $paramId);
            
            $paramName = $name;
            $paramAge = $age;
            $paramEmail = $email;
            $paramSalary = $salary;
            $paramId = $id;
            
            if($stmt->execute()){
                header("location: index.php");
                exit();
            } else{
                echo "Algo deu errado.";
            }
        }
         
        $stmt->close();
    }
    
    $connection->close();

}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Atualizar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="row">
        <form method="post" class="form-horizontal col-md-6 col-md-offset-3">
        <h2>Atualiar registro</h2>
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
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <input type="submit" href="index.php" class="btn btn-primary" value="Submit">
            <a href="index.php" class="btn btn-default">Cancel</a>
            <a href="index.php" class="btn btn-primary">Voltar</a>
        </form>
    </div>
</div>
</body>
</html>