<?php 
 include 'components/connect.php';
 if(isset($_COOKIE['user_id'])){
      $user_id = $_COOKIE['user_id'];
   }else{
      $user_id = '';
      header('location:login.php');
   }
	
	if (isset($_POST['place_order'])) {

		$name = $_POST['name'];
		$name = filter_var($name, FILTER_SANITIZE_STRING);
		$number = $_POST['number'];
		$number = filter_var($number, FILTER_SANITIZE_STRING);
		$email = $_POST['email'];
		$email = filter_var($email, FILTER_SANITIZE_STRING);
		$address = $_POST['flat'].', '.$_POST['street'].', '.$_POST['city'].', '.$_POST['country'].', '. $_POST['pincode'];
		$address = filter_var($address, FILTER_SANITIZE_STRING);
		$address_type = $_POST['address_type'];
		$address_type = filter_var($address_type, FILTER_SANITIZE_STRING);
		$method = $_POST['method'];
		$method = filter_var($method, FILTER_SANITIZE_STRING);

	

		$varify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
		$varify_cart->execute([$user_id]);

		if (isset($_GET['get_id'])) {
			$get_product = $conn->prepare("SELECT * FROM `products` WHERE id=? LIMIT 1");
			$get_product->execute([$_GET['get_id']]);
			if ($get_product->rowCount() > 0) {
				while($fetch_p = $get_product->fetch(PDO::FETCH_ASSOC)){
					$seller_id = $fetch_p['seller_id'];
					$insert_order = $conn->prepare("INSERT INTO `orders`(id, user_id, seller_id, name, number, email, address, address_type, method, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
			        $insert_order->execute([unique_id(), $user_id, $seller_id, $name, $number, $email, $address, $address_type, $method, $fetch_p['id'], $fetch_p['price'], 1]);
			            header('location:order.php');
					
					
				}
			}else{
				$warning_msg[] = 'Algo salió mal :(';
			}
		}elseif ($varify_cart->rowCount()>0) {
			while($f_cart = $varify_cart->fetch(PDO::FETCH_ASSOC)){
				$s_products=$conn->prepare("SELECT * FROM `products` WHERE id=? LIMIT 1");
                $s_products->execute([$f_cart['product_id']]);
                $f_product = $s_products->fetch(PDO::FETCH_ASSOC);

                $seller_id = $f_product['seller_id'];
				$insert_order = $conn->prepare("INSERT INTO `orders`(id, user_id, seller_id, name, number, email, address, address_type, method, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
			        $insert_order->execute([unique_id(), $user_id, $seller_id, $name, $number, $email, $address, $address_type, $method, $f_cart['product_id'], $f_cart['price'], $f_cart['qty']]);
			            header('location:order.php');
			}
			if ($insert_order) {
				$delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
				$delete_cart_id->execute([$user_id]);
				header('location: order.php');
			}
		}else{
			$warning_msg[] = 'Algo salió mal :(';
		}

	}
	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="css/user_style.css">
	<title>Artin - Pagos</title>
</head>
<body>
	<?php include 'components/user_header.php'; ?>
	
		<div class="banner">
	        <div class="detail">
	            <h1>Realizar Orden</h1>
	            <p>Por favor completa tus datos para poder realizar la orden.<br>
	           Una vez confirmados los datos realizaremos tu pedido</p>
	            <span><a href="home.html">Home</a><i class='bx bx-right-arrow-alt'></i>Realizar Orden</span>
	        </div>
	    </div>
		<section class="checkout">
			<div class="heading">
				
				<h1>Información de Pago</h1>
			
            </div>
                <div class="row">
                	<form method="post" class="form">

                		<input type="hidden" name="p_id" value="<?= $get_id; ?>">
                		<h3>Datos del cliente</h3>
                		<div class="flex">
                			<div class="box">
                				<div class="input-field">
                					<p>Nombre <span>*</span></p>
                					<input type="text" name="name" required maxlength="50" placeholder="Escribi tu nombre" class="input">
                				</div>
                				<div class="input-field">
                					<p>Telefono <span>*</span></p>
                					<input type="number" name="number" required maxlength="10" placeholder="Escribó tu numero" class="input">
                				</div>
                				<div class="input-field">
                					<p>Email<span>*</span></p>
                					<input type="email" name="email" required maxlength="50" placeholder="Escribi tu email" class="input">
                				</div>
                				<div class="input-field">
                					<p>Método de pago <span>*</span></p>
                					<select name="method" class="input">
                						<option value="cash on delivery">Efectivo</option>
                						<option value="credit or debit card">Crédito o Débito</option>
                						<option value="net banking">Home banking</option>
                						<option value="paytm">Paypal</option>
                					</select>
                				</div>
                				<div class="input-field">
                					<p>Dirección <span>*</span></p>
                					<select name="address_type" class="input">
                						<option value="home">Casa</option>
                						<option value="office">Oficina</option>
            
                					</select>
                				</div>
                			</div>
                			<div class="box">
                				<div class="input-field">
                					<p>Dirección<span>*</span></p>
                					<input type="text" name="flat" required maxlength="50" placeholder="Escribi tu dirección" class="input">
                				</div>
                			
                				<div class="input-field">
                					<p>Ciudad <span>*</span></p>
                					<input type="text" name="city" required maxlength="50" placeholder="Ciudad" class="input">
                				</div>
                				
                				<div class="input-field">
                					<p>CP<span>*</span></p>
                					<input type="text" name="pincode" required maxlength="6" placeholder="Código Postal" min="0" max="999999" class="input">
                				</div>
                			</div>
                		</div>
                		<button type="submit" name="place_order" class="btn">Ordenar</button>
                	</form>
                	<div class="summary">
                		<h3>Mi carrito</h3>
                		<div class="box-container">
                			<?php 
                				$grand_total=0;
                				if (isset($_GET['get_id'])) {
                					$select_get = $conn->prepare("SELECT * FROM `products` WHERE id=?");
                					$select_get->execute([$_GET['get_id']]);
                					while($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)){
                						$sub_total = $fetch_get['price'];
                						$grand_total+=$sub_total;
                					
                			?>
                			<div class="flex">
                				<img src="uploaded_files/<?=$fetch_get['image']; ?>" class="image">
                				<div>
                					<h3 class="name"><?=$fetch_get['name']; ?></h3>
                					<p class="price"><?=$fetch_get['price']; ?>/-</p>
                				</div>
                			</div>
                			<?php 
                					}
                				}else{
                					$select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
                					$select_cart->execute([$user_id]);
                					if ($select_cart->rowCount()>0) {
                						while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                							$select_products=$conn->prepare("SELECT * FROM `products` WHERE id=?");
                							$select_products->execute([$fetch_cart['product_id']]);
                							$fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
                							$sub_total= ($fetch_cart['qty'] * $fetch_product['price']);
                							$grand_total += $sub_total;
                							
                						
                			?>
                			<div class="flex">
                				<img src="uploaded_files/<?=$fetch_product['image']; ?>">
                				<div>
                					<h3 class="name"><?=$fetch_product['name']; ?></h3>
                					<p class="price"><?=$fetch_product['price']; ?> X <?=$fetch_cart['qty']; ?></p>
                				</div>
                			</div>
                			<?php 
                						}
                					}else{
                						echo '<p class="empty">Tu carrito está vacio!</p>';
                					}
                				}
                			?>
                		</div>
                		<div class="grand-total"><span>Total a pagar: </span>$<?= $grand_total ?>/-</div>
                	</div>
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