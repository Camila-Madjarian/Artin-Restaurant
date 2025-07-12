<header>
	<div class="logo">
	
	</div>
	<div class="right">
		<div class="bx bxs-user" id="user-btn"></div>
		<div class="toggle-btn"><i class='bx bx-menu' ></i></div>
	</div>
	<div class="profile-detail">
		<?php 
			$select_profile = $conn->prepare("SELECT * FROM `sellers` WHERE id=?");
			$select_profile->execute([$seller_id]);
			if ($select_profile->rowCount() > 0) {
				$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
			
		?>
		<div class="profile">
			<img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="logo-img" width="100">
			<p><?= $fetch_profile['name']; ?></p>
		</div>
		<div class="flex-btn">
			<a href="profile.php" class="btn">Perfil</a>
			<a href="../components/admin_logout.php" onclick="return confirm('Cerrar sesion')" class="btn">Cerrar Sesión</a>
		</div>
		<?php } ?>
	</div>
</header>
<div class="side-container">
	<div class="sidebar">
		<?php 
			$select_profile = $conn->prepare("SELECT * FROM `sellers` WHERE id=?");
			$select_profile->execute([$seller_id]);
			if ($select_profile->rowCount() > 0) {
				$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
			
		?>
		<div class="profile">
			<img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="logo-img" width="100">
			<p><?= $fetch_profile['name']; ?></p>
		</div>
		<?php } ?>
		<h5>Menú</h5>
		<div class="navbar">
			<ul>
				<li><a href="dashboard.php"><i class="bx bxs-home-smile"></i>Dashboard</a></li>
				<li><a href="add_product.php"><i class="bx bxs-shopping-bags"></i>Agregar productos</a></li>
				<li><a href="view_posts.php"><i class="bx bxs-food-menu"></i>Ver productos</a></li>
				<li><a href="user_accounts.php"><i class="bx bxs-user-detail"></i>Usuarios 🔐</a></li>
				<li><a href="admin_message.php"><i class="bx bxs-message-dots"></i>Mensajes</a></li>
				<li><a href="sellers_accounts.php"><i class="bx bxs-user-detail"></i>Vendedores</a></li>
				<li><a href="../components/admin_logout.php" onclick="return confirm('Cerrar sesion')"><i class="bx bx-log-out"></i>Cerrar Sesión</a></li>
			</ul>
		</div>
		<h5>Redes sociales</h5>
		<div class="social-links">
			<i class="bx bxl-facebook"></i>
			<i class="bx bxl-instagram-alt"></i>
			<i class="bx bxl-linkedin"></i>
			<i class="bx bxl-twitter"></i>
			<i class="bx bxl-pinterest-alt"></i>
		</div>
	</div>
</div>