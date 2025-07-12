<?php 
	include '../components/connect.php';
	if(isset($_COOKIE['seller_id'])){
      	$seller_id = $_COOKIE['seller_id'];
	   }else{
	      $seller_id = '';
	      header('location:login.php');
	   }
	//update order payment
	if (isset($_POST['update_order'])) {
		$order_id = $_POST['order_id'];
		$order_id = filter_var($order_id, FILTER_SANITIZE_STRING);

		$update_payment = $_POST['update_payment'];
		$update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);

		$update_pay = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
		$update_pay->execute([$update_payment, $order_id]);
		$success_msg[] = 'order payment_status ACTUALIZADO';
	}
	
	//detele order details

	if (isset($_POST['delete_order'])) {
		$delete_id = $_POST['order_id'];
		$delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

		$verify_delete = $conn->prepare("SELECT * FROM `orders` WHERE id=?");
		$verify_delete->execute([$delete_id]);

		if ($verify_delete->rowCount() > 0) {
			$delete_order = $conn->prepare("DELETE FROM `orders` WHERE id=?");
			$delete_order->execute([$delete_id]);
			$success_msg[] = 'Orden borrada!';
		}else{
			$warning_msg[] = 'La orden ya fue borrada!';
		}

	}
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- box icon cdn link  -->
   <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
   <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
	<title>Admin - Ordenes</title>
</head>
<body>
	<div class="main-container">
		<?php include '../components/admin_header.php'; ?>
		<section class="order-container">
			<div class="heading">
				<h1>Ordenes</h1>
			</div>
			
			<div class="box-container">
				<?php 
					$select_order = $conn->prepare("SELECT * FROM `orders` WHERE seller_id=?");
					$select_order->execute([$seller_id]);
					if ($select_order->rowCount() > 0) {
						while($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)){


				?>
				<div class="box">
					<div class="status" style="color: <?php if($fetch_order['status'] == 'in progress'){echo "limegreen";}else{echo "coral";} ?>"><?= $fetch_order['status']; ?></div>
					<div class="detail">
						<p>Usuario : <span><?= $fetch_order['name']; ?></span></p>
						<p>Id : <span><?= $fetch_order['user_id']; ?></span></p>
						<p>Fecha : <span><?= $fetch_order['date']; ?></span></p>
						<p>Número : <span><?= $fetch_order['number']; ?></span></p>
						<p>Email : <span><?= $fetch_order['email']; ?></span></p>
						<p>Valor total : <span><?= $fetch_order['price']; ?></span></p>
						<p>Método de pago: <span><?= $fetch_order['method']; ?></span></p>
						<p>Dirección : <span><?= $fetch_order['address']; ?></span></p>
					</div>
					<form action="" method="post">
						<input type="hidden" name="order_id" value="<?= $fetch_order['id']; ?>">
						<select name="update_payment" class="box" style="width:90%;">
							<option disabled selected><?php echo $fetch_order['payment_status']; ?></option>
							<option value="Pendiente">Pendiente</option>
							<option value="Completado">Completado</option>
						</select>
						<div class="flex-btn">
							<input type="submit" name="update_order" value="Actualizar pago" class="btn">
							<input type="submit" name="delete_order" value="borrar orden" class="btn" onclick="return confirm('¿Desea borrar esta orden?');">
						</div>
					</form>
				</div>
				<?php 
						}
					}else{
						echo '
							<div class="empty">
								<p>No hay ordenes!</p>
							</div>
						';
					}
				?>
			</div>
		</section>
		
	</div>
	
	
	<!-- sweetalert cdn link  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

	<!-- custom js link  -->
	<script type="text/javascript" src="script.js"></script>

	<?php include '../components/alert.php'; ?>
</body>
</html>