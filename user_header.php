<style>


.header .flex {
  display: grid;
  grid-template-columns: auto 1fr auto;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: #fff;
 
}

.navbar {
  display: flex;
  gap: 0.5rem;
}

.navbar a {
  font-size: 0.5rem;
  text-decoration: none;
  color: orange;
}

.search-form {
  background-color: #fff3db !important; /* Naranja suave */
  border-radius: 10px;
  padding: 10px; /* más delgado */
  display: flex;
  align-items: center;
  height: 38px; /* controla la altura total */
  max-width: 500px;
}

.search-form input {
  flex: 1;
  padding: 0.2rem 0.3rem;
  border-radius: 10px 0 0 10px;
  border: none;
  background: #fff3db !important;
  font-size: 0.2rem;
}

.search-form button {
  padding: 5px;
  background: #fff3db !important;
  border: none;
  border-radius: 0 10px 10px 0;
  cursor: pointer;
  font-size: 0.5rem;
  color: #7d5100;
}

.right-section {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.icons {
  display: flex;
  align-items: center;
  gap: 1rem;
  font-size: 1.8rem;
  color: #7d5100;
}

.cart-btn {
  position: relative;
}

.cart-btn sup {
  position: absolute;
  top: -8px;
  right: -10px;
  background-color: crimson;
  color: white;
  border-radius: 50%;
  padding: 2px 6px;
  font-size: 0.7rem;
}

.profile {
 font-size: 1.5rem;
  text-align: center;
  padding: 1rem; /* Más compacto que 1.5rem */
  border-radius: 1rem;
  background-color: #fff;
  box-shadow: 1.2rem 1rem rgba(0, 0, 0, 0.34);
  max-width: 380px; /* ¡Acá lo haces más delgado! */
  margin-left: 1rem; /* o auto si querés centrar */
}

.profile img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
}

.boton {
  padding: 0.6rem 1.2rem;
  background-color: #fff;
  color: rgb(196, 152, 90);
  border: 1px solid rgb(158, 112, 4);
  border-radius: 2rem;
  cursor: pointer;
  text-decoration: none;
  transition: all 0.3s ease;
  white-space: nowrap;
  font-size: 1rem;
  box-shadow: 0 0.2rem 0.5rem rgba(0, 0, 0, 0.47);
  margin: 0.3rem 0;
}

.boton:hover {
  background-color: rgb(172, 100, 12);
  color: #fff;
}

</style>

<header class="header">
  <section class="flex">

    <!-- Navegación izquierda -->
    <nav class="navbar">
      <a href="home.php"><span>Home</span></a>
      <a href="menu.php"><span>Tienda</span></a>
      <a href="order.php"><span>Ordenes</span></a>
      <a href="contact.php"><span>Contactanos</span></a>
      <a href="about-us.php"><span>Nosotros</span></a>
    </nav>

    <!-- Buscador en el centro -->
    <form action="search_product.php" method="post" class="search-form">
      <input type="text" name="search_product" placeholder="Buscar producto.." required maxlength="100">
      <button type="submit" class="bx bx-search-alt-2" name="search_product_btn"></button>
    </form>

    <!-- Íconos y perfil a la derecha -->
    <div class="right-section">
      <div class="icons">
        <?php 
          $count_wishlist_item = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id=?");
          $count_wishlist_item->execute([$user_id]);
          $total_Wishlist_items = $count_wishlist_item->rowCount();
        ?>
        <a href="wishlist.php" class="cart-btn"><i class="bx bx-heart"></i><sup><?= $total_Wishlist_items; ?></sup></a>

        <?php 
          $count_cart_item = $conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
          $count_cart_item->execute([$user_id]);
          $total_cart_items = $count_cart_item->rowCount();
        ?>
        <a href="cart.php" class="cart-btn"><i class="bx bx-cart"></i><sup><?= $total_cart_items; ?></sup></a>

        <div id="user-btn" class="bx bxs-user"></div>
      </div>

      <div class="profile">
        <?php
          $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
          $select_profile->execute([$user_id]);
          if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>
          <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
          <h3 style="margin-bottom: 0.5rem; font-size: 1rem;"><?= $fetch_profile['name']; ?></h3>
          <div class="flex-btn">
            <a href="profile.php" class="btn">Ver perfil</a>
            <a href="components/user_logout.php" onclick="return confirm('¿Desea cerrar sesión?');" class="btn">Cerrar sesión</a>
          </div>
        <?php
          } else {
        ?>
          <a href="login.php" class="boton">Iniciar Sesión</a>
          <a href="register.php" class="boton">Registrarse</a>
          <a href="admin pannel/login.php" class="boton">Vende</a>
        <?php
          }
        ?>
      </div>
    </div>

  </section>
</header>


<!-- header section ends -->

<!-- side bar section starts  

<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['name']; ?></h3>
         <span>student</span>
         <a href="profile.php" class="btn">view profile</a>
         <?php
            }else{
         ?>
         <h3>please login or register</h3>
          <div class="flex-btn" style="padding-top: .5rem;">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
         <?php
            }
         ?>
      </div>

   <nav class="navbar">
      <a href="home.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="about.php"><i class="fas fa-question"></i><span>about us</span></a>
      <a href="courses.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
      <a href="teachers.php"><i class="fas fa-chalkboard-user"></i><span>teachers</span></a>
      <a href="contact.php"><i class="fas fa-headset"></i><span>contact us</span></a>
   </nav>

</div>

 side bar section ends -->