<?php 
	include 'components/connect.php';

   if(isset($_COOKIE['user_id'])){
      $user_id = $_COOKIE['user_id'];
   }else{
      $user_id = '';
      header('location:login.php');
   }

	include 'components/add_cart.php';

	//delete product from wishlist
	if (isset($_POST['delete_item'])) {
		$wishlist_id = $_POST['wishlist_id'];
		$wishlist_id = filter_var($wishlist_id, FILTER_SANITIZE_STRING);

		$verify_delete = $conn->prepare("SELECT * FROM `wishlist` WHERE id=?");
		$verify_delete->execute([$wishlist_id]);

		if ($verify_delete->rowCount() > 0) {
			$delete_wishlist_id = $conn->prepare("DELETE FROM `wishlist` WHERE id=?");
			$delete_wishlist_id->execute([$wishlist_id]);
			$success_msg[] = 'Producto eliminado de la wishlist!';
		}else{
			$warning_msg[] = 'Producto eliminado de la wishlist!';
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
   <link rel="stylesheet" href="css/user_style.css">
	<title>Artin - wishlist </title>
</head>
<body>
	<?php include 'components/user_header.php'; ?>
	
	<div class="banner">
        <div class="detail">
            <h1>Mi wishlist</h1>
            <p>Esta es tu wishlist: acá podés ver todos esos productos que te encantaron y están esperando a que los lleves a casa. <br>
            ¡No dejes que se te escapen!</p>
            <span><a href="home.html">home</a><i class='bx bx-right-arrow-alt'></i>wishlist</span>
        </div>
    </div>
	<section class="products">
		<div class="heading">
			<h1>Mi wishlist</h1>
		
		</div>
		<div class="box-container">
			<?php 
				$grand_total = 0;
				$select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id=?");
				$select_wishlist->execute([$user_id]);
				if ($select_wishlist->rowCount() > 0) {
					while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){
						$select_products = $conn->prepare("SELECT * FROM `products` WHERE id=?");
						$select_products->execute([$fetch_wishlist['product_id']]);
						if ($select_products->rowCount() > 0) {
							$fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
						
			?>
			<form action="" method="post" class="box <?php if($fetch_products['stock'] == 0){echo 'disabled';}; ?>">
				<input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
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
					<div class="button">
						<div><h3 class="name"><?= $fetch_products['name']; ?></h3></div>
						<div>
							<button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
							<a href="view_page.php?pid=<?= $fetch_products['id'] ?>" class="bx bxs-show"></a>
							<button type="submit" name="delete_item" onclick="return confirm('delete this item');"><i class="bx bx-x"></i></button>
						</div>
					</div>
					<input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
					<div class="flex">
						<p class="price">Precio $<?= $fetch_products['price']; ?>/-</p>
					</div>
					<div class="flex">
						<input type="hidden" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
						<a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn" style="width: 100% !important;">comprar</a>
					</div>
				</div>
			</form>
			<?php 
						$grand_total+=$fetch_wishlist['price'];
						}
					}
				}else{
					echo'
						<div class="empty">
							<p>no products added yet!</p>
						</div>
					';
				}
			?>
		</div>
	</section>


	<?php include 'components/footer.php'; ?>
	<!-- sweetalert cdn link  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

	<!-- custom js link  -->
	<script type="text/javascript" src="script.js"></script>

	<?php include 'components/alert.php'; ?>
</body>
</html>