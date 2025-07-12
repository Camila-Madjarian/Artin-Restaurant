<?php 
	include 'components/connect.php';
	if(isset($_COOKIE['user_id'])){
      $user_id = $_COOKIE['user_id'];
   }else{
      $user_id = '';
      
   }

	//send message

	if (isset($_POST['send_message'])) {
		if ($user_id != '') {
			$id = unique_id();
			$name = $_POST['name'];
			$name = filter_var($name, FILTER_SANITIZE_STRING);

			$email = $_POST['email'];
			$email = filter_var($email, FILTER_SANITIZE_STRING);

			$subject = $_POST['subject'];
			$subject = filter_var($subject, FILTER_SANITIZE_STRING);

			$message = $_POST['message'];
			$message = filter_var($message, FILTER_SANITIZE_STRING);

			$verify_message = $conn->prepare("SELECT * FROM `message` WHERE user_id=? AND name = ? AND email = ? AND subject = ? AND message = ?");
			$verify_message->execute([$user_id, $name, $email, $subject, $message]);

			if ($verify_message->rowCount() > 0) {
				$warning_msg[] = 'El mensaje ya existe!';
			}else{
				$insert_message = $conn->prepare("INSERT INTO `message`(id,user_id,name,email,subject,message) VALUES(?,?,?,?,?,?)");
				$insert_message->execute([$id, $user_id, $name, $email, $subject, $message]);
				$success_msg[] = 'Comentario enviado!';

			}


		}else{
			$warning_msg[] = 'Por favor Inicia Sesión';
		}
	}
	

	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- box icon cdn link  -->
   <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
   <link rel="stylesheet" href="css/user_style.css">
	<title>Artin - Contactanos</title>
</head>
<body>
	<?php include 'components/user_header.php'; ?>
	
     
    </div>
	<div class="services">
		<div class="heading">
            <h1>Lo que ofrecemos:</h1>
            <p style="text-align: center;">Llevamos el verdadero sabor de la comida armenia a tu mesa, con calidad, calidez y ese toque casero que se disfruta solo o compartido.</p>
            <img src="image/separator.png" alt="">
        </div>
		<div class="box-container">
			<div class="box">
				<img src="image/0.png">
				<div>
					<h1>Seguridad</h1>
					Tu compra está protegida y es 100% segura.
				</div>
			</div>
			<div class="box">
				<img src="image/1.png">
				<div>
					<h1>Medios de pago</h1>
					Aceptamos todos los medios de pago.
				</div>
			</div>
			<div class="box">
				<img src="image/2.png">
				<div>
					<h1>Envíos Express</h1>
					Realizamos a todo el país.
				</div>
			</div>
		</div>
	</div>
	<div class="contact">
		<div class="heading">
            <h1>Contactanos</h1>
            <p style="text-align: center;">¿Querés saber más? Enviános un mensaje, estamos para ayudarte.</p>
            <img src="image/separator-img.png" alt="">
        </div>
		<div class="form-container">
			<form action="" method="post" class="register">
				
				<div class="input-field">
					<label>Nombre <sup>*</sup></label>
					<input type="text" name="name" required placeholder="Ingresa tu nombre">
				</div>
				<div class="input-field">
					<label>Email <sup>*</sup></label>
					<input type="email" name="email" required placeholder="Ingresa tu Email">
				</div>
				<div class="input-field">
					<label>Motivo <sup>*</sup></label>
					<input type="text" name="subject" required placeholder="Asunto">
				</div><div class="input-field">
					<label>Comentario <sup>*</sup></label>
					<textarea name="message" cols="30" rows="10" required placeholder="Escribe hasta 1000 palabras.."></textarea>
				</div>
				<input type="submit" name="send_message" value="Enviar mensaje" class="btn">
			</form>
		</div>
	</div>
	<div class="address">
		<div class="heading">
            <h1>Info Contacto</h1>
            <p style="text-align: center;">Just A Few Click To Make The Reservation Online For Saving Your Time And Money</p>
            <img src="image/separator-img.png" alt="">
        </div>
		<div class="box-container">
			<div class="box">
				<i class="bx bxs-map-alt"></i>
				<div>
					<h4>Dirección</h4>
					<p>Calle Falsa 123</p>
				</div>
			</div>
			<div class="box">
				<i class="bx bxs-phone-incoming"></i>
				<div>
					<h4>Número de telefono</h4>
					<p>123456780</p>
				</div>
			</div>
			<div class="box">
				<i class="bx bxs-envelope"></i>
				<div>
					<h4>Email</h4>
					<p>artin@gmail.com</p>
					
				</div>
			</div>
		</div>
	</div>
	<?php include 'components/footer.php'; ?>
	<!-- sweetalert cdn link  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

	<!-- custom js link  -->
	<script type="text/javascript" src="js/script.js"></script>

	<?php include 'components/alert.php'; ?>
</body>
</html>