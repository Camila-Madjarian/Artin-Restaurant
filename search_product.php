<?php

include 'components/connect.php';

   if(isset($_COOKIE['user_id'])){
      $user_id = $_COOKIE['user_id'];
   }else{
      $user_id = '';
   }
   include 'components/add_wishlist.php';
   include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>courses</title>

   <!-- box icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/user_style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<!-- courses section starts  -->
<div class="banner">
        <div class="detail">
            <h1>Productos</h1>
            <p>Encontrá esas comidas que te hacen sentir como en casa: sabores únicos, caseros y llenos de tradición. 
            <p> Te traemos lo mejor de una cocina con historia, para que disfrutes platos irresistibles, hechos con amor y pensados para compartir. </p> 
           <p>Elegí lo que más te gusta y dejate sorprender.</p>
            </p>
            <span><a href="home.html">Home</a><i class='bx bx-right-arrow-alt'></i>Productos</span>
        </div>
    </div>
<section class="products">

   <div class="heading">
          <h1>Resultado de la búsqueda</h1>
          <img src="image/separator-img.png" alt="">
   </div>

   <div class="box-container">

      <?php
         if(isset($_POST['search_product']) or isset($_POST['search_product_btn'])){
         $search_products = $_POST['search_product'];
         $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_products}%' AND status = ?");
         $select_products->execute(['active']);
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
               $product_id = $fetch_products['id'];

               
      ?>
      <form action="" method="post" class="box <?php if($fetch_products['stock'] == 0){echo 'disabled';}; ?>">
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
                  <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                  <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="bx bxs-show"></a>
               </div>
            </div>
            <p class="price">Precio $<?= $fetch_products['price']; ?></p>
            <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
            <div class="flex-btn">
               <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">Comprar</a>
               <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
            </div>
         </div>
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">No hubo coincidencias!</p>';
      }
      }else{
         echo '<p class="empty">Ingresa un nombre válido!</p>';
      }
      ?>

   </div>

</section>

<!-- product section ends -->

<?php include 'components/footer.php'; ?>
   
   <!-- sweetalert cdn link  -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

   <!-- custom js link  -->
   <script type="text/javascript" src="js/script.js"></script>

   <?php include 'components/alert.php'; ?>
   
</body>
</html>