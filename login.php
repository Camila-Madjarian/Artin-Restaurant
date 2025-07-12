<?php
include '../components/connect.php';

if (isset($_POST['submit'])) {
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
   $pass = $_POST['pass'];

   $select_seller = $conn->prepare("SELECT * FROM `sellers` WHERE email = ? LIMIT 1");
   $select_seller->execute([$email]);
   $row = $select_seller->fetch(PDO::FETCH_ASSOC);

   if ($select_seller->rowCount() > 0) {

      // 👇 Agregá esto para ver qué hay guardado como password
      var_dump($row['password']);
     

      if (password_verify($pass, $row['password'])) {
         setcookie('seller_id', $row['id'], time() + 60*60*24*30, '/');

         if (isset($row['is_admin']) && $row['is_admin'] == 1) {
            setcookie('admin', '1', time() + 60*60*24*30, '/');
            header('location:admin_dashboard.php');
         } else {
            setcookie('admin', '0', time() + 60*60*24*30, '/');
            header('location:vendedor_dashboard.php');
         }
         exit;
      } else {
         $warning_msg[] = 'Contraseña incorrecta';
      }

   } else {
      $warning_msg[] = 'Email no registrado';
   }
}
?>



<style>
   * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
   }

   body {
      background-color: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
   }

   .form-container {
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
   }

   .form-container h3 {
      font-size: 2rem;
      margin-bottom: 1.5rem;
      color: rgb(196, 152, 90);
   }

   .form-container p {
      text-align: left;
      margin: 0.5rem 0 0.2rem;
      font-weight: 600;
   }

   .form-container p span {
      color: red;
   }

   .form-container .box {
      width: 100%;
      padding: 0.8rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 1rem;
      font-size: 1rem;
   }

   .form-container .link {
      font-size: 0.9rem;
      margin-bottom: 1rem;
      text-align: left;
   }

   .form-container .link a {
      color: rgb(219, 153, 61);
      text-decoration: none;
   }

   .form-container .btn {
      width: 100%;
      padding: 0.8rem;
      background-color: rgb(236, 177, 27);
      color: white;
      border: none;
      border-radius: 2rem;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
   }

   .form-container .btn:hover {
      background-color: rgb(172, 100, 12);
   }

   .volver-container {
      margin-top: 1.2rem;
      display: flex;
      justify-content: center;
   }

   .volver-container .boton {
      padding: 0.6rem 1.2rem;
      background-color: #fff;
      color: rgb(196, 152, 90);
      border: 1px solid rgb(158, 112, 4);
      border-radius: 2rem;
      text-decoration: none;
      font-size: 1rem;
      box-shadow: 0 0.2rem 0.5rem rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
   }

   .volver-container .boton:hover {
      background-color: rgb(172, 100, 12);
      color: #fff;
   }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Iniciar Sesión</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

</head>
<body style="padding-left: 0;">
<!-- register section starts  -->

<div class="form-container">
   <form action="" method="post" enctype="multipart/form-data" class="login">
      <h3>Iniciar Sesión</h3>
      <p>Email <span>*</span></p>
      <input type="email" name="email" placeholder="Ingresa tu email" maxlength="20" required class="box">
      <p>Contraseña <span>*</span></p>
      <input type="password" name="pass" placeholder="Ingresa tu contraseña" maxlength="20" required class="box">
      <p class="link">¿No tenés una cuenta? <a href="register.php">Registrate</a></p>
      <input type="submit" name="submit" value="Iniciar sesion" class="btn">
   </form>
   <div class="volver-container">
   <a href="/Artin/home.php" class="boton">Volver</a>
</div>


</div>


<!-- registe section ends -->














<!-- sweetalert cdn link  -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

   <!-- custom js link  -->
   <script type="text/javascript" src="script.js"></script>

   <?php include '../components/alert.php'; ?>
   
</body>
</html>