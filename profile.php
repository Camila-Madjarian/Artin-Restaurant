<?php

   include 'components/connect.php';

   if(isset($_COOKIE['user_id'])){
      $user_id = $_COOKIE['user_id'];
   }else{
      $user_id = '';
      header('location:login.php');
   }

   $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
   $select_orders->execute([$user_id]);
   $total_orders = $select_orders->rowCount();

   $select_comments = $conn->prepare("SELECT * FROM `message` WHERE user_id = ?");
   $select_comments->execute([$user_id]);
   $total_comments = $select_comments->rowCount();




?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Artin - Perfil</title>

   <!-- box icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/user_style.css">
   <style>
body {
   margin: 0;
   font-family: New Time Roman;
   background-color: #f8f8f8;
}

.detail-page {
   padding: 2rem 2.5rem;
   background-color: #fff1dc;
   border-bottom: 1px solid #eee;
}

.detail-page h1 {
   font-size: 2.2rem;
   color: #8b5e00;
   margin: 0 0 0.5rem 0;
}

.detail-page span {
   font-size: 1rem;
   color: rgb(13, 13, 13);
}

.detail-page span a {
   text-decoration: none;
   color: #a0611a;
   font-weight: 500;
}

.detail-page i {
   margin: 0 0.3rem;
   color: #a0611a;
}

.profile-page {
   padding: 2rem;
   max-width: 1000px;
   margin: auto;
}

.profile-page .heading h1 {
   font-size: 1.8rem;
   color: #7d5100;
   margin-bottom: 1.5rem;
   text-align: center;
}

.details-page {
   display: flex;
   flex-direction: row;
   gap: 2rem;
   justify-content: space-between;
   align-items: flex-start;
   flex-wrap: wrap;
}

.user {
   flex: 1 1 280px;
   background: #fff;
   padding: 1.5rem;
   border-radius: 1rem;
   text-align: center;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
}

.user img {
   width: 100px;
   height: 100px;
   border-radius: 50%;
   object-fit: cover;
   margin-bottom: 1rem;
}

.user h3 {
   margin: 0.5rem 0 0;
   color: #333;
}

.user p {
   color: #777;
   margin-bottom: 1rem;
}

.user .btn {
   background-color: #a0611a;
   color: white;
   border: none;
   padding: 0.6rem 1.2rem;
   font-size: 0.9rem;
   border-radius: 2rem;
   cursor: pointer;
   transition: 0.3s ease;
}

.user .btn:hover {
   background-color: #7d5100;
}

.box-container-page {
   flex: 1 1 400px;
   display: flex;
   flex-direction: column;
   gap: 1.5rem;
}

.box-page {
   background: #fff;
   padding: 1.5rem;
   border-radius: 1rem;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
   display: flex;
   flex-direction: column;
   align-items: center;
   text-align: center;
}

.flex-page {
   display: flex;
   align-items: center;
   gap: 1rem;
   color: #333;
}

.box-page i {
   font-size: 1.6rem;
   color: #a0611a;
}

.box-page h3 {
   margin: 0;
   font-size: 1.4rem;
   font-weight: bold;
}

.box-page span {
   color: #777;
}

.btn-page {
   background-color: #a0611a;
   color: white;
   border: none;
   padding: 0.5rem 1.2rem;
   font-size: 0.9rem;
   border-radius: 1.5rem;
   cursor: pointer;
   transition: 0.3s ease;
   margin-top: 0.5rem;
}

.btn-page:hover {
   background-color: #7d5100;
}

@media (max-width: 768px) {
   .details-page {
      flex-direction: column;
      align-items: center;
   }

   .box-container-page {
      width: 100%;
   }
}


</style>


</head>
<body>

   <?php include 'components/user_header.php'; ?>

        <div class="detail-page">
            <h1>Mi perfil</h1>
            <span><a href="home.html">Home</a><i class='bx bx-right-arrow-alt'></i>Perfil</span>
        </div>
   

    <section class="profile-page">
       <div class="heading">
          <h1>Información</h1>
     
       </div>
       <div class="details-page">
          <div class="user">
             <img src="uploaded_files/<?= $fetch_profile['image']; ?>">
             <h3><?= $fetch_profile['name']; ?></h3>
             <p>Usuario</p>
             <a href="update.php" class="btn">Actualizar usuario</a>
          </div>
          <div class="box-container-page">
             <div class="box-page">
                <div class="flex-page">
                   <i class="bx bxs-bookmarks"></i>
                   <h3><?= $total_orders; ?></h3>
                   <span>Ordenes</span>
                </div>
                <a href="order.php" class="btn-page">ver ordenes</a>
             </div>

             <div class="box-page">
                <div class="flex-page">
                   <i class="bx bxs-chat"></i>
                   <h3><?= $total_comments; ?></h3>
                   <span>Comentarios</span>
                </div>
                <a href="comments.php" class="btn-page">ver comentarios</a>
             </div>
          </div>
       </div>
    </section>











<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>