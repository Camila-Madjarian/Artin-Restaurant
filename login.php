<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   
   if($select_user->rowCount() > 0){
     setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
     header('location:home.php');
   }else{
      $message[] = 'Los datos ingresados son incorrectos';
   }

}

?>
  <!-- CSS embebido -->
   <style>
      body {
         margin: 0;
         font-family: new time roman;
         background-color: #f8f8f8;
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

.detail span {
   font-size: 1rem;
   color:rgb(13, 13, 13) ;
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
         padding: 1rem;
      }

      .login {
         background-color: #fff;
         padding: 2rem;
         border-radius: 1rem;
         box-shadow: 0 0 20px rgba(0,0,0,0.1);
         width: 100%;
         max-width: 400px;
         display: flex;
         flex-direction: column;
         gap: 1rem;
      }

      .login h1 {
         text-align: center;
         color: #7d5100;
         margin-bottom: 1rem;
      }

      .login p {
         margin: 0;
         font-weight: 500;
         color: #333;
      }

      .login p span {
         color: red;
      }

      .login input.box {
         padding: 0.8rem;
         font-size: 1rem;
         border: 1px solid #ccc;
         border-radius: 0.5rem;
         width: 100%;
      }

      .login .link {
         text-align: right;
         font-size: 0.9rem;
      }

      .login .link a {
         color: #a0611a;
         text-decoration: none;
      }

      .login .btn {
         background-color: #a0611a;
         color: white;
         border: none;
         padding: 0.9rem;
         font-size: 1rem;
         border-radius: 2rem;
         cursor: pointer;
         transition: 0.3s ease;
      }

      .login .btn:hover {
         background-color: #7d5100;
      }
   </style>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Artin - Iniciar sesión</title>

   <!-- box icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/user_style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

        <div class="detail">
            <h1>Iniciar Sesión</h1>
            <span><a href="home.html">Home</a><i class='bx bx-right-arrow-alt'></i>Iniciar Sesión</span>
    </div>

<section class="form-container">
   <div class="heading">
      <h1>Bienvenido</h1>
     
   </div>
   <form action="" method="post" enctype="multipart/form-data" class="login">
      
      <p>Email <span>*</span></p>
      <input type="email" name="email" placeholder="Ingresa tu email" maxlength="50" required class="box">
      <p>Contraseña<span>*</span></p>
      <input type="password" name="pass" placeholder="Ingresa tu contraseña" maxlength="20" required class="box">
      <p class="link">¿No tenés una cuenta? <a href="register.php">Registrate</a></p>
      <input type="submit" name="submit" value="Inicia Sesión" class="btn">
   </form>

</section>












<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>