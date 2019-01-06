<!DOCTYPE html>
<html>
<head>
	<title>Novo pedido</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
 
<link rel="stylesheet" href="styles.css" >
 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<form method="post" class="form-horizontal col-md-6 col-md-offset-3">
		<h2>Novo pedido</h2>

            <div class="form-group">
                <label for="input1" class="col-sm-2 control-label">Item</label>
                <div class="col-sm-10 available-items">
                    <select name="item" class="form-control">
                    <?php require_once "connect.php";
                    $sql = 'SELECT * FROM `cardapio`';
                    if($result = $connection->query($sql)){
                        if($result->num_rows > 0) {
                           while($row = $result->fetch_array()){ ?>
                                <option value="<?php echo $row['id_item'];?>"><?php echo $row['nome'];?></option>
                           <?php } ?>
                        <?php } ?>   
                    <?php } ?> 
                    </select>
                </div>
            </div>

			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Endereço</label>
			    <div class="col-sm-10">
			      <input type="text" name="address"  class="form-control" id="address" placeholder="Endereço de entrega" />
			    </div>
			</div>

			<div class="form-group">
                <label for="input1" class="col-sm-2 control-label">Forma de pagamento</label>
                <div class="col-sm-10">
                    <select name="payment" class="form-control">
                        <option></option>
                        <option value="debito">Cartão de Débito</option>
                        <option value="credito">Cartão de Crédito</option>
                        <option value="elo">Vale Refeição</option>
                        <option value="dinheiro">Dinheiro</option>
                    </select>
                </div>
            </div>

			<input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="submit" />
			 <p><a href="client.php" class="btn btn-primary">Voltar</a></p>
		</form>
	</div>
</div>
</body>
</html>

<?php
require_once "connect.php";
 
 $item = $description = $payment = $address = "";

if (isset($_POST) && !empty($_POST)) {
    $item = $_POST['item'];
    $payment = $_POST['payment'];
    $address = $_POST['address'];
    $date = date('d/m/Y');
}

    $sql = "INSERT INTO `pedidos` (id_item, forma_pgto, endereco, data) VALUES (?, ?, ?, NOW())";

    if($stmt = $connection->prepare($sql)){
        $stmt->bind_param("iss", $paramItem, $paramPayment, $paramAddress); 
        
        $paramItem = $item;
        $paramAddress = $address;
        $paramPayment = $payment;
        
        if($stmt->execute()){
            echo "Salvo com sucesso.";
            exit();
        } else{
            echo "Erro ao salvar.";
        }
    }
        
    $stmt->close();
    
    $connection->close();
?>