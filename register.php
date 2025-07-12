<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_files/'.$rename;

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);
   
   if($select_user->rowCount() > 0){
      $message[] = 'Email ya está en uso!';
   }else{
      if($pass != $cpass){
         $message[] = 'La contraseña no  coincide!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(id, name, email, password, image) VALUES(?,?,?,?,?)");
         $insert_user->execute([$id, $name, $email, $cpass, $rename]);
         move_uploaded_file($image_tmp_name, $image_folder);
         
         $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
         $verify_user->execute([$email, $pass]);
         $row = $verify_user->fetch(PDO::FETCH_ASSOC);
         
         if($verify_user->rowCount() > 0){
            setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:home.php');
         }
      }
   }

}

?>
<!-- CSS embebido -->
 <style>
   body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color:rgb(255, 255, 255);
   }

   .detail {
      padding: 2rem 2.5rem;
      background-color: #fff1dc;
      border-bottom: 1px solid #eee;
   }

   .detail h1 {
      font-size: 2.2rem;
      color: #8b5e00;
      margin: 0 0 0.5rem 0;
   }

   .detail p {
      font-size: 1rem;
      color: #333;
      margin-bottom: 0.8rem;
   }

   .detail span {
      font-size: 0.95rem;
      color: #111;
   }

   .detail span a {
      text-decoration: none;
      color: #a0611a;
      font-weight: 500;
   }

   .detail i {
      margin: 0 0.3rem;
      color: #a0611a;
   }

   .form-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 70vh;
      padding: 2rem;
   }

   .register {
      background-color: #fff;
      padding: 1rem;
      border-radius: 1rem;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 700px;
      display: flex;
      flex-direction: column;
      gap: 0.8rem;
   }

   .register .flex {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
   }

   .register .col {
      flex: 1 1 300px;
      display: flex;
      flex-direction: column;
      gap: 1rem;
   }

   .register p {
      margin: 0;
      font-weight: 500;
      color: black;
   }

   .register p span {
      color: red;
   }

   .register input.box {
      padding: 0.8rem;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 0.5rem;
      width: 100%;
   }

   .register .link {
      text-align: right;
      font-size: 0.9rem;
   }

   .register .link a {
      color: #a0611a;
      text-decoration: none;
   }

   .register .btn {
      background-color: #a0611a;
      color: white;
      border: none;
      padding: 0.9rem;
      font-size: 1rem;
      border-radius: 2rem;
      cursor: pointer;
      transition: 0.3s ease;
   }

   .register .btn:hover {
      background-color:rgb(98, 63, 0);
   }

   .heading {
      text-align: center;
      margin-bottom: 1rem;
   }

   .heading h1 {
      color: #7d5100;
      font-size: 2rem;
      margin-bottom: 0.5rem;
   }

   .heading img {
      max-width: 120px;
   }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Artin - Registrarse</title>

   <!-- box icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/user_style.css">

</head>
<body>
<?php include 'components/user_header.php'; ?>

        <div class="detail">
            <h1>Registrate</h1>
            <p>Completa el formulario de registro para acceder a<br>
            todas las funciones de nuestra web y descubrir increibles descuentos</p>
            <span><a href="home.html">Home</a><i class='bx bx-right-arrow-alt'></i>Registrarse</span>
        </div>

    
<section class="form-container">
   <div class="heading">
      <h1>Crea tu cuenta</h1>
      <img src="image/separator.png" alt="divisor de sección"> 
   </div>
   <form class="register" action="" method="post" enctype="multipart/form-data">
      
      <div class="flex">
         <div class="col">
            <p>Nombre <span>*</span></p>
            <input type="text" name="name" placeholder="Ingresa tu nombre" maxlength="50" required class="box">
            <p>Email <span>*</span></p>
            <input type="email" name="email" placeholder="Ingresa tu email" maxlength="20" required class="box">
         </div>
         <div class="col">
            <p>Contraseña <span>*</span></p>
            <input type="password" name="pass" placeholder="Ingresa tu contraseña" maxlength="20" required class="box">
            <p>Confirmar Contraseña <span>*</span></p>
            <input type="password" name="cpass" placeholder="Confirma tu contraseña" maxlength="20" required class="box">
         </div>
      </div>
      <p>Imagen <span>*</span></p>
      <input type="file" name="image" accept="image/*" required class="box">
      <p class="link">¿Ya tenés una cuenta? <a href="login.php">Inicia sesión</a></p>
      <input type="submit" name="submit" value="Registrarse" class="btn">
   </form>

</section>












<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>