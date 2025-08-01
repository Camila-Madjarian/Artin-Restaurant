<?php 
	include 'components/connect.php';
	
	if(isset($_COOKIE['user_id'])){
      $user_id = $_COOKIE['user_id'];
   }else{
      $user_id = '';
      
   }

	$pid = $_GET['pid'];

	include 'components/add_wishlist.php';
	include 'components/add_cart.php';

	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- box icon cdn link  -->
   <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
   <link rel="stylesheet" href="css/user_style.css">
	<title>Artin - ver producto</title>
</head>
<body>
	<?php include 'components/user_header.php'; ?>
	
	<div class="banner">
        <div class="detail">
            <h1>Detalle del producto</h1>
            <p>Conocé todos los detalles de este producto: sus ingredientes, origen, modo de preparación y todo lo que necesitás saber antes de agregarlo a tu carrito. Cada artículo está seleccionado para ofrecerte calidad y sabor en cada bocado.</p>
            <span><a href="home.html">Home</a><i class='bx bx-right-arrow-alt'></i>Detalle del Producto</span>
        </div>
    </div>
	<section class="view_page">
		<div class="heading">
          <h1>Detalle del producto</h1>
       </div>
		<?php 
			if (isset($_GET['pid'])) {
				$pid = $_GET['pid'];
				$select_products = $conn->prepare("SELECT * FROM `products` WHERE id= '$pid'");
				$select_products->execute();
				if ($select_products->rowCount() > 0) {
					while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){


		?>
		<form action="" method="post" class="box">
			<div class="img-box">
				<img src="uploaded_files/<?= $fetch_products['image']; ?>">
			</div>
			<div class="detail">
				<?php if ($fetch_products['stock'] > 9) { ?>
		         <span class="stock" style="color: green;"><i class="fas fa-check" style="margin-right: .5rem;"></i>En Stock</span>
		      <?php }elseif($fetch_products['stock'] == 0){ ?>
		         <span class="stock" style="color: red;"><i class="fas fa-times" style="margin-right: .5rem;"></i>Sin Stock</span>
		      <?php }else{ ?>
		         <span class="stock" style="color: red;">Pocas unidades <?= $fetch_products['stock']; ?>en stock</span>
		      <?php } ?>
				<p class="price">$ <?= $fetch_products['price']; ?>/-</p>
				<div class="name"><?= $fetch_products['name']; ?></div>
				<p class="product-detail"><?= $fetch_products['product_detail']; ?></p>
				<input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
				<div class="button">
					<button type="submit" name="add_to_wishlist" class="btn">agregar a la wishlist <i class="bx bx-heart"></i></button>
					<input type="hidden" name="qty" value="1" min="0" class="quantity">
					<button type="submit" name="add_to_cart" class="btn">agregar al carrito <i class="bx bx-cart"></i></button>
				</div>
			</div>
		</form>
		<?php 
					}
				}
			}
		?>
	</section>
	<section class="products">
		<div class="heading">
			<h1>Productos similares</h1>
		</div>
		<?php include 'components/shop.php'; ?>
	</section>

	<?php include 'components/footer.php'; ?>
	<!-- sweetalert cdn link  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

	<!-- custom js link  -->
	<script type="text/javascript" src="js/script.js"></script>

	<?php include 'components/alert.php'; ?>
</body>
</html>