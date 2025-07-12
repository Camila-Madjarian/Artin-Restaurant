<?php 
	include '../components/connect.php';
	if(isset($_COOKIE['seller_id'])){
      	$seller_id = $_COOKIE['seller_id'];
	   }else{
	      $seller_id = '';
	      header('location:login.php');
	   }

	//add product to database
	if (isset($_POST['publish'])) {
		$id = unique_id();
		$title = $_POST['title'];
		$title = filter_var($title, FILTER_SANITIZE_STRING);
		$price = $_POST['price'];
		$price = filter_var($price, FILTER_SANITIZE_STRING);
		$content = $_POST['content'];
		$content = filter_var($content, FILTER_SANITIZE_STRING);

		$stock = $_POST['stock'];
   		$stock = filter_var($stock, FILTER_SANITIZE_STRING);
		$status = 'active';

		$image = $_FILES['image']['name'];
		$image = filter_var($image, FILTER_SANITIZE_STRING);
		$image_size = $_FILES['image']['size'];
		$image_tmp_name = $_FILES['image']['tmp_name'];
		$image_folder = '../uploaded_files/'.$image;

		$select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ? AND seller_id = ?");
		$select_image->execute([$image, $seller_id]);

		if (isset($image)) {
			if ($select_image->rowCount() > 0) {
				$warning_msg[] = 'Imagen repetida';
			}elseif($image_size > 2000000){
				$warning_msg[] = 'Imagen muy grande';
			}else{
				move_uploaded_file($image_tmp_name, $image_folder);
			}
		}else{
			$image = '';
		}
		if ($select_image->rowCount() > 0 AND $image !='') {
			$warning_msg[] = 'Renombra tu imagen';
		}else{
			$insert_post = $conn->prepare("INSERT INTO `products`(id,seller_id,name,price,image,stock, product_detail,status) VALUES(?,?,?,?,?,?,?,?)");
			$insert_post->execute([$id,$seller_id,$title,$price,$image, $stock,$content,$status]);
			$success_msg[] = 'Producto agregado exitosamente!';
		}
	}


	//save draft product to database
	if (isset($_POST['draft'])) {
		$id = unique_id();
		$title = $_POST['title'];
		$title = filter_var($title, FILTER_SANITIZE_STRING);
		$price = $_POST['price'];
		$price = filter_var($price, FILTER_SANITIZE_STRING);
		$content = $_POST['content'];
		$content = filter_var($content, FILTER_SANITIZE_STRING);

		$stock = $_POST['stock'];
   		$stock = filter_var($stock, FILTER_SANITIZE_STRING);
		$status = 'deactive';

		$image = $_FILES['image']['name'];
		$image = filter_var($image, FILTER_SANITIZE_STRING);
		$image_size = $_FILES['image']['size'];
		$image_tmp_name = $_FILES['image']['tmp_name'];
		$image_folder = '../uploaded_files/'.$image;

		$select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ? AND seller_id = ?");
		$select_image->execute([$image, $seller_id]);

		if (isset($image)) {
			if ($select_image->rowCount() > 0) {
				$warning_msg[] = 'Imagen repetida';
			}elseif($image_size > 2000000){
				$warning_msg[] = 'Imagen muy grande';
			}else{
				move_uploaded_file($image_tmp_name, $image_folder);
			}
		}else{
			$image = '';
		}
		if ($select_image->rowCount() > 0 AND $image !='') {
			$warning_msg[] = 'Renombra tu imagen';
		}else{
			$insert_post = $conn->prepare("INSERT INTO `products`(id,seller_id,name,price,image,stock, product_detail,status) VALUES(?,?,?,?,?,?,?,?)");
			$insert_post->execute([$id,$seller_id,$title,$price,$image, $stock,$content,$status]);
			$success_msg[] = 'Producto agregado exitosamente!';
		}
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
	<title>Admin - agregar producto</title>
</head>
<body>
	<div class="main-container">
		
		<?php include '../components/admin_header.php'; ?>
		<section class="post-editor">
			<div class="heading">
				<h1>Agregar producto</h1>
				<img src="../image/separator.png" width="100">
			</div>
			
			
			<div class="form-container">
				<form action="" method="post" enctype="multipart/form-data" class="register">
					<div class="input-field">
						<p>Nombre del producto <span>*</span></p>
						<input type="text" name="title" maxlength="100" placeholder="Agregar nombre" required class="box">
					</div>
					<div class="input-field">
						<label>Precio<sup>*</sup></label>
						<input type="number" name="price" maxlength="100" placeholder="Agregar precio" required class="box">
					</div>
					<div class="input-field">
						<p>Detalles<span>*</span></p>
						<textarea name="content" required maxlength="10000" placeholder="Detalle del producto" class="box"></textarea>
					</div>
					<div class="input-field">
						<p>Stock <span>*</span></p>
         				<input type="number" name="stock" required maxlength="10" placeholder="total de productos disponibles" min="0" max="9999999999" class="box">
					</div>
					<div class="input-field">
						<label>Imagen del producto<sup>*</sup></label>
						<input type="file" name="image" accept="image/*" required class="box">
					</div>
					<div class="flex-btn">
						<input type="submit" name="publish" value="Publicar" class="btn">
						<input type="submit" name="draft" value="Guardar borrador" class="btn">
					</div>
				</form>
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