<?php
include '../components/connect.php';

if (isset($_POST['submit'])) {

   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);

   $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); // bcrypt

   // Procesamiento de la imagen si corresponde
   $image = $_FILES['image']['name'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_files/' . $image;

   // Validar si ya existe el email
   $check_email = $conn->prepare("SELECT * FROM `sellers` WHERE email = ?");
   $check_email->execute([$email]);

   if ($check_email->rowCount() > 0) {
      $warning_msg[] = 'Este email ya está registrado';
   } else {
      $insert = $conn->prepare("INSERT INTO `sellers`(id, name, email, password, image) VALUES (?, ?, ?, ?, ?)");
      $insert->execute([$id, $name, $email, $pass, $image]);

      move_uploaded_file($image_tmp_name, $image_folder);
      $success_msg[] = 'Registro exitoso. Ahora puedes iniciar sesión';
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
      max-width: 600px;
      text-align: center;
   }

   .form-container h3 {
      font-size: 2rem;
      margin-bottom: 1.5rem;
      color: rgb(236, 177, 27);
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
      margin-top: 1rem;
   }

   .form-container .btn:hover {
      background-color: rgb(172, 100, 12);
   }

   .form-container .link {
      text-align: left;
      margin: 1rem 0 0.5rem;
      font-size: 0.9rem;
   }

   .form-container .link a {
      color: rgb(196, 152, 90);
      text-decoration: none;
      margin-left: 0.3rem;
   }

   .flex {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      justify-content: space-between;
   }

   .col {
      flex: 1 1 45%;
   }

   .input-field {
      margin-bottom: 1rem;
   }

   input[type="file"].box {
      padding: 0.5rem;
      border-radius: 8px;
      border: 1px solid #ccc;
      background-color: #fafafa;
   }

   @media(max-width: 600px) {
      .flex {
         flex-direction: column;
      }

      .col {
         flex: 1 1 100%;
      }
   }

</style>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registro</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

</head>
<body style="padding-left: 0;">



<!-- register section starts  -->

<div class="form-container">
   
   <form class="register" action="" method="post" enctype="multipart/form-data">
      <h3>Registrarse</h3>
      <div class="flex">
         <div class="col">
            <p>Nombre <span>*</span></p>
            <input type="text" name="name" placeholder="Ingresa tu nombre" maxlength="50" required class="box">
            <p>Email<span>*</span></p>
            <input type="email" name="email" placeholder="Ingresa tu email" maxlength="20" required class="box">
         </div>
         <div class="col">
            <div class="input-field">
               <p>Contraseña <span>*</span></p>

               <input type="password" name="pass" placeholder="Ingresa tu contraseña" maxlength="20" required class="box">
            </div>
            <div class="input-field">
               <p>Confirma tu contraseña<span>*</span></p>
               <input type="password" name="cpass" placeholder="Confirma tu contraseña" maxlength="20" required class="box">
            </div>
         </div>
      </div>
      <div class="input-field">
         <p>Foto <span>*</span></p>
         <input type="file" name="image" accept="image/*" required class="box">
      </div>
      
      <p class="link">¿Ya tenés una cuenta?<a href="login.php">Inicia Sesión</a></p>
      <input type="submit" name="submit" value="Registrarse" class="btn">
   </form>
</div>

<!-- registe section ends -->

<!-- sweetalert cdn link  -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

   <!-- custom js link  -->
   <script type="text/javascript" src="script.js"></script>

   <?php include '../components/alert.php'; ?>
   
</body>
</html>