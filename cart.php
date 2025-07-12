<?php 
	include 'components/connect.php';
	error_reporting(0);
	if(isset($_COOKIE['user_id'])){
      $user_id = $_COOKIE['user_id'];
   }else{
      $user_id = '';
      header('location:login.php');
   }

	//update cart product quantity
	if (isset($_POST['update_cart'])) {
		$cart_id = $_POST['cart_id'];
		$cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);
		$qty = $_POST['qty'];
		$qty = filter_var($qty, FILTER_SANITIZE_STRING);

		$update_qty = $conn->prepare("UPDATE `cart` SET qty = ? WHERE id=?");
		$update_qty->execute([$qty, $cart_id]);

		$success_msg[] = 'Carrito actualizado!';
	}
	
	//delete product from cart
	if (isset($_POST['delete_item'])) {
		$cart_id = $_POST['cart_id'];
		$cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);

		$verify_delete_item = $conn->prepare("SELECT * FROM `cart` WHERE id=?");
		$verify_delete_item->execute([$cart_id]);

		if ($verify_delete_item->rowCount() > 0) {
			$delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
			$delete_cart_id->execute([$cart_id]);

			$success_msg[] = 'articulo eliminado del carrito!';
		}else{
			$warning_msg[] = 'el articulo ya fue eliminado!';
		}
	}

	//empty cart 

	if (isset($_POST['empty_cart'])) {
		$verify_empty_item = $conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
		$verify_empty_item->execute([$user_id]);

		if ($verify_empty_item->rowCount() > 0) {
			$delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id=?");
			$delete_cart_id->execute([$user_id]);
			$success_msg[] = 'Carrito vacío';
		}else{
			$warning_msg[] = 'Tu carrito ya está vacío';
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<!-- box icon cdn link  -->
   <link rel="stylesheet" href="css/user_style.css">
	<title>Artin - wishlist</title>
</head>
<body>
	<?php include 'components/user_header.php'; ?>
	
	<div class="banner">
        <div class="detail">
            <h1>Mi Carrito</h1>
            <p>Este es tu carrito: acá podés revisar los productos que seleccionaste, ajustar cantidades y confirmar tu pedido cuando estés listo.<br>
            ¡Estás a un paso de disfrutar tus favoritos!</p>
            <span><a href="home.html">Home</a><i class='bx bx-right-arrow-alt'></i>Mi Carrito</span>
        </div>
    </div>
	<section class="products">
		<div class="heading">
			<h1>Productos agregados al carrito</h1>
		</div>
		<div class="box-container">
			<?php 
				$grand_total = 0;
				$select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
				$select_cart->execute([$user_id]);
				if ($select_cart->rowCount() > 0) {
					while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
						$select_products = $conn->prepare("SELECT * FROM `products` WHERE id=?");
						$select_products->execute([$fetch_cart['product_id']]);
						if ($select_products->rowCount() > 0) {
							$fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
						
			?>
			<form action="" method="post" class="box <?php if($fetch_products['stock'] == 0){echo 'disabled';}; ?>">
				<input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
				<img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image">
				<?php if ($fetch_products['stock'] > 9) { ?>
		         <span class="stock" style="color: green;"><i class="fas fa-check" style="margin-right: .5rem;"></i>En Stock</span>
			      <?php }elseif($fetch_products['stock'] == 0){ ?>
			         <span class="stock" style="color: red;"><i class="fas fa-times" style="margin-right: .5rem;"></i>Sin Stock</span>
			      <?php }else{ ?>
			         <span class="stock" style="color: red;">Pocas unidades <?= $fetch_products['stock']; ?>en stock</span>
			      <?php } ?>
				<div class="content">
					<img src="image/shape-19.png" alt="" class="shap">
					<h3 class="name"><?= $fetch_products['name']; ?></h3>
					<div class="flex-btn">
						<p class="price">Precio $<?= $fetch_products['price']; ?>/-</p>
						<input type="number" name="qty" required min="1" value="<?= $fetch_cart['qty']; ?>" max="99" maxlength="2" class="qty">
						<button type="submit" name="update_cart" class="bx bxs-edit fa-edit"></button>
					</div>
					<div class="flex-btn">
						<p class="sub-total">Sub total : <span>$<?= $sub_total = ($fetch_cart['qty']*$fetch_cart['price']); ?></span></p>
						<button type="submit" name="delete_item" class="btn" onclick="return confirm('¿Desea eliminar éste producto del carrito?');">Borrar</button>
					</div>
				</div>
			</form>
			<?php 
						$grand_total+=$sub_total;
						}else{
							echo'
								<div class="empty">
									<p>No se encontraron productos!</p>
								</div>
							';
						}
					}
				}else{
					echo'
						<div class="empty">
							<p>No hay productos agregados!</p>
						</div>
					';
				}
			?>
		</div>
		<?php 
			if ($grand_total != 0) {
				
		?>
		<div class="cart-total">
			<p>Total a pagar : <span>$ <?= $grand_total; ?>/-</span></p>
			<div class="button">
				<form action="" method="post">
					<button type="submit" name="empty_cart" class="btn" onclick="return confirm('¿Seguro que querés vaciar tu carrito?');">Vaciar carrito</button>
				</form>
				<a href="checkout.php" class="btn">Pagar</a>
			</div>
		</div>
		<?php }?>
	</section>


	<?php include 'components/footer.php'; ?>
	
	<!-- sweetalert cdn link  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

	<!-- custom js link  -->
	<script type="text/javascript" src="script.js"></script>

	<?php include 'components/alert.php'; ?>
</body>
</html>