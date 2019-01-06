<?php
require_once "connect.php";
 
$item = $address = $payment = "";
 
$id = $_GET["id"];
if(isset($_POST["id"]) && !empty($_POST["id"])) {
    
    $item = $_POST['item'];
    $address = $_POST['address'];
    $payment = $_POST['payment'];
    $status = $_POST['status'];
    
    $sql = "UPDATE `pedidos` SET id_item = ?, endereco = ?, forma_pgto = ?, status = ? WHERE id_pedido = ?";

    if($stmt = $connection->prepare($sql)){
        $stmt->bind_param("isssi", $paramItem, $paramAddress, $paramPayment, $paramStatus, $paramId);
        
        $paramItem = $item;
        $paramAddress = $address;
        $paramPayment = $payment;
        $paramStatus = $status;
        $paramId = $id;
        
        if($stmt->execute()){
            header("location: index.php");
            exit();
        } else{
            echo "Algo deu errado.";
        }
    }
        
    $stmt->close();
    
    $connection->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Editar pedido</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
 
<link rel="stylesheet" href="styles.css" >
 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<?php require_once "connect.php"; ?>
	<div class="row">
		<form method="post" class="form-horizontal col-md-6 col-md-offset-3">
		<h2>Editar pedido</h2>

            <?php if ($_GET['id']) {
                $id = $_GET['id']; 
                $select = "SELECT * FROM `pedidos` WHERE `id_pedido` = $id";
                $saved = $connection->query($select);
                while ($field = $saved->fetch_array()) {
            ?> 
                <div class="form-group">
                    <label for="input1" class="col-sm-2 control-label">Item</label>
                    <div class="col-sm-10">
                        <select name="item" class="form-control">
                        <?php $sql = 'SELECT * FROM `cardapio`';
                        if($result = $connection->query($sql)){
                            if($result->num_rows > 0) {
                            while($row = $result->fetch_array()){ ?>
                               <?php if($field['id_item'] == $row['id_item']) { ?>
                                <option selected value="<?php echo $row['id_item'];?>"><?php echo $row['nome'];?></option>
                               <?php } else {?>
                                <option selected value="<?php echo $row['id_item'];?>"><?php echo $row['nome'];?></option>
                               <?php } ?>
                            <?php } ?>
                            <?php } ?>   
                        <?php } ?> 
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="input1" class="col-sm-2 control-label">Endereço:</label>
                    <div class="col-sm-10">
                    <input type="text" name="address"  class="form-control" id="address" placeholder="Endereço de entrega" value="<?php echo $field['endereco']; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="input1" class="col-sm-2 control-label">Forma de pagamento</label>
                    <div class="col-sm-10">
                        <select name="payment" class="form-control">
                            <option selected value="<?php $field['forma_pgto']?>"></option>
                            <option value="debito">Cartão de Débito</option>
                            <option value="credito">Cartão de Crédito</option>
                            <option value="elo">Vale Refeição</option>
                            <option value="dinheiro">Dinheiro</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="input1" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status" class="form-control">
                            <option value=""></option>
                            <option value="Pendente">Pendente</option>
                            <option value="Em Preparação">Em Preparação</option>
                            <option value="Enviado">Enviado</option>
                            <option value="Cancelado">Cancelado</option>
                        </select>
                    </div>
                </div>
            <?php } ?>
            <?php } ?>

            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <input type="submit" href="index.php" class="btn btn-primary" value="Enviar">
			 <!-- <p><a href="admin.php" class="btn btn-primary">Voltar</a></p> -->
		</form>
	</div>
</div>
</body>
</html>

