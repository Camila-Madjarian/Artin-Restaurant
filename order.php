<?php 
	include 'components/connect.php';
	
	error_reporting(0);
	if(isset($_COOKIE['user_id'])){
      $user_id = $_COOKIE['user_id'];
   }else{
      $user_id = '';
      header('location:login.php');
   }

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- box icon cdn link  -->
   <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
   <link rel="stylesheet" href="css/user_style.css">
	<title>Artin - Mi orden</title>
</head>
<body>
	<?php include 'components/user_header.php'; ?>
	
	<div class="banner">
        <div class="detail">
            <h1>Mi orden</h1>
            <p>En este espacio vas a poder consultar el detalle completo de tu orden: los productos que elegiste, los precios, la información de envío y el estado actual del pedido.<br>
           Todo lo que necesitás saber, en un solo lugar.</p>
            <span><a href="home.html">Home</a><i class='bx bx-right-arrow-alt'></i>Mis ordenes</span>
        </div>
    </div>
	<div class="orders">
		<div class="heading">
			<h1>Mis ordenes</h1>
			<img src="image/separator-img.png" alt="">         
		</div>
		<div class="box-container">
			<?php 
				$select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id=? ORDER BY date DESC");
				$select_orders->execute([$user_id]);
				if ($select_orders->rowCount() > 0) {
					while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
						$product_id = $fetch_orders['product_id'];
						$select_products = $conn->prepare("SELECT * FROM `products` WHERE id=?");
						$select_products->execute([$fetch_orders['product_id']]);
						if ($select_products->rowCount() > 0) {
							while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){


			?>
			<div class="box" <?php if($fetch_orders['status']=='cancele'){echo 'style="border:2px solid red;';} ?>>
				<a href="view_order.php?get_id=<?= $fetch_orders['id']; ?>">
					<img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image">
					<div class="content">
						<img src="image/shape-19.png" alt="" class="shap">
						<p class="date"><i class='bx bxs-calendar-alt'></i><span><?= $fetch_orders['date']; ?></span></p>
						
						<div class="row">
							<h3 class="name"><?= $fetch_products['name']; ?></h3>
							<p class="price">Precio : $<?= $fetch_products['price']; ?>/-</p>
							<p class="status" style="color:<?php if($fetch_orders['status']=='delivered'){echo "green";}elseif($fetch_orders['status']=='canceled'){echo "red";}else{echo "orange";} ?>"><?= $fetch_orders['status']; ?></p>
						</div>
					</div>

				</a>
				
			</div>
			<?php 
							}
						}
					}
				}else{
						echo '<p class="empty">No hay ordenes aún!</p>';
				}
			?>
		</div>
	</div>
	<?php include 'components/footer.php'; ?>
	<!-- sweetalert cdn link  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

	<!-- custom js link  -->
	<script type="text/javascript" src="js/script.js"></script>

	<?php include 'components/alert.php'; ?>
</body>
</html>