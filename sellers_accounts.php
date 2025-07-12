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
       if (isset($_POST['delete_seller'])) {
   $delete_id = $_POST['delete_id'];

   $delete_seller = $conn->prepare("DELETE FROM `sellers` WHERE id = ?");
   $delete_seller->execute([$delete_id]);

   // Mensaje o redirección (opcional)
   echo '<script>swal("Eliminado", "El vendedor ha sido eliminado correctamente", "success").then(() => { location.reload(); });</script>';
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
	<title>Admin - Vendedores</title>
</head>
<body>
	<div class="main-container">
		<?php include '../components/admin_header.php'; ?>
		<section class="accounts">
			<div class="heading">
				<h1>Vendedores</h1>
				<img src="../image/separator.png" width="100">
			</div>
			<div class="box-container">
				<?php 
					$select_sellers = $conn->prepare("SELECT * FROM `sellers`");
					$select_sellers->execute();
					if ($select_sellers->rowCount() > 0) {
						while($fetch_sellers = $select_sellers->fetch(PDO::FETCH_ASSOC)){
							$sellers_id = $fetch_sellers['id'];

				?>
				<div class="box">
					<img src="../uploaded_files/<?= $fetch_sellers['image']; ?>">
					<p>Seller id : <span><?= $sellers_id ?></span></p>
					<p>Nombre : <span><?= $fetch_sellers['name']; ?></span></p>
					<p>Email : <span><?= $fetch_sellers['email']; ?></span></p>
				 <form method="post" onsubmit="return confirm('¿Estás seguro de eliminar a este vendedor?');">
<input type="hidden" name="delete_id" value="<?= $sellers_id ?>">
         <button type="submit" name="delete_seller" class="btn">Eliminar</button>
      </form>
                
                </div>
				<?php 
						}
					}else{
						echo '
							<div class="empty">
								<p>No hay vendedores registrados!</p>
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