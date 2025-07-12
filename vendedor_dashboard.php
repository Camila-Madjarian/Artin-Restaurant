<?php
include '../components/connect.php';

if (!isset($_COOKIE['seller_id']) || !isset($_COOKIE['admin']) || $_COOKIE['admin'] === '1') {
   // El admin no puede entrar aquí ni un no logueado
   header('location:login.php');
   exit;
}

$seller_id = $_COOKIE['seller_id'];

$select_profile = $conn->prepare("SELECT * FROM sellers WHERE id = ?");
$select_profile->execute([$seller_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

// Mostrar solo productos, pedidos y funciones del vendedor
?>
<!-- Aquí tu HTML y PHP combinados para el dashboard vendedor -->
<style>
	<?php include '../css/admin_style.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- box icon cdn link  -->
   <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<title>Admin - Dashboard</title>
</head>
<body>
	

	<div class="main-container">
		<?php include '../components/admin_header.php'; ?>
		<section class="dashboard">
			<div class="heading">
				<h1>Dashboard</h1>
				<img src="../image/separator.png" width="100">
			</div>
			<div class="box-container">
				<div class="box">
					<h3>Bienvenido !</h3>
					<p><?= $fetch_profile['name']; ?></p>
					<a href="update.php" class="btn">Actualizar perfil</a>
				</div>
				<div class="box">
					<?php 
						$select_message = $conn->prepare("SELECT * FROM `message`");
						$select_message->execute();
						$number_of_msg = $select_message->rowCount();
					?>
					<h3><?= $number_of_msg; ?></h3>
					<p>mensajes sin leer</p>
					<a href="admin_message.php" class="btn">ver mensajes</a>
				</div>
				<div class="box">
					<?php 
						$select_post = $conn->prepare("SELECT * FROM `products` WHERE seller_id=?");
						$select_post->execute([$seller_id]);
						$number_of_post = $select_post->rowCount();
					?>
					<h3><?= $number_of_post; ?></h3>
					<p>Productos agregados</p>
					<a href="add_product.php" class="btn">Añadir nuevos productos</a>
				</div>
				<div class="box">
					<?php 
						$select_active_post = $conn->prepare("SELECT * FROM `products` WHERE seller_id=? AND status =?");
						$select_active_post->execute([$seller_id,'active']);
						$number_of_active_post = $select_active_post->rowCount();
					?>
					<h3><?= $number_of_active_post ?></h3>
					<p>Productos Activos</p>
					<a href="add_product.php" class="btn">ver productos</a>
				</div>
				<div class="box">
					<?php 
						$select_deactive_post = $conn->prepare("SELECT * FROM `products` WHERE seller_id=? AND status =?");
						$select_deactive_post->execute([$seller_id, 'deactive']);
						$number_of_deactive_post = $select_deactive_post->rowCount();
					?>
					<h3><?= $number_of_deactive_post ?></h3>
					<p>Productos Desactivados</p>
					<a href="add_product.php" class="btn">ver productos</a>
				</div>
			
				
				<div class="box">
					<?php 
						$select_canceled_order = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ? AND status=?");
						$select_canceled_order->execute([$seller_id,'canceled']);
						$total_canceled_order = $select_canceled_order->rowCount();
					?>
					<h3><?= $total_canceled_order; ?></h3>
					<p>Ordenes canceladas</p>
					<a href="admin_order.php" class="btn">Ordenes cancelada</a>
				</div>
				<div class="box">
					<?php 
						$select_confirm_order = $conn->prepare("SELECT * FROM `orders` WHERE seller_id=? AND status=?");
						$select_confirm_order->execute([$seller_id,'in progress']);
						$total_confirm_order = $select_confirm_order->rowCount();
					?>
					<h3><?= $total_confirm_order; ?></h3>
					<p>Ordenes confirmadas</p>
					<a href="admin_order.php" class="btn">confirmar orden</a>
				</div>
				<div class="box">
					<?php 
						$select_total_order = $conn->prepare("SELECT * FROM `orders` WHERE seller_id=?");
						$select_total_order->execute([$seller_id]);
						$total_total_order = $select_total_order->rowCount();
					?>
					<h3><?= $total_total_order; ?></h3>
					<p>Ordenes</p>
					<a href="admin_order.php" class="btn">Todas las ordenes</a>
				</div>
				
			</div>
		</section>
	</div>
	
	
	<script type="text/javascript" src="script.js"></script>
</body>
</html>