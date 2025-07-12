<?php
if (!isset($_COOKIE['admin']) || $_COOKIE['admin'] !== '1') {
   header('location:dashboard.php');
   exit;
}
?>


<?php 
	include '../components/connect.php';
	if(isset($_COOKIE['seller_id'])){
      	$seller_id = $_COOKIE['seller_id'];
	   }else{
	      $seller_id = '';
	      header('location:login.php');
	   }
?>
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
	<title>Admin - Usuarios</title>
</head>
<body>
	<div class="main-container">
		<?php include '../components/admin_header.php'; ?>
		<section class="accounts">
			<div class="heading">
				<h1>Usuarios</h1>
				<img src="../image/separator.png" width="100">
			</div>
			<div class="box-container">
				<?php 
					$select_users = $conn->prepare("SELECT * FROM `users`");
					$select_users->execute();
					if ($select_users->rowCount() > 0) {
						while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
							$user_id = $fetch_users['id'];

				?>
				<div class="box">
					<img src="../uploaded_files/<?= $fetch_users['image']; ?>">
					<p>User id : <span><?= $user_id ?></span></p>
					<p>Nombre : <span><?= $fetch_users['name']; ?></span></p>
					<p>Email : <span><?= $fetch_users['email']; ?></span></p>
				</div>
				<?php 
						}
					}else{
						echo '
							<div class="empty">
								<p>No hay usuarios registrados!</p>
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