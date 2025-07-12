<?php

   include 'components/connect.php';

   if(isset($_COOKIE['user_id'])){
      $user_id = $_COOKIE['user_id'];
   }else{
      $user_id = '';
      
   }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/user_style.css">
    <title>Restaurant Artin</title>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <!-- slider section -->
    <div class="slider-container" id="home">
        <div class="slider">
            <div class="slideBox active">
              
                <div class="imgBox">
                    <img src="image/banner-slider.jpg" alt="">
                </div>
            </div>
            <div class="slideBox">
             
                <div class="imgBox">
                    <img src="image/banner-slider2.jpg" alt="">
                </div>
            </div>
            
        </div>
        <ul class="controls">
            <li onclick="nextSlide();" class="next"><i class='bx bx-right-arrow-alt'></i></li>
            <li onclick="prevsSlide();" class="prev"><i class='bx bx-left-arrow-alt'></i></li>
        </ul>
    </div>
    <!-- service -->
    <div class="service">
        <div class="box-container">
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" alt="" class="img1">
                        <img src="image/services (1).png" alt="" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>Delivery</h4>
                    <span>Express</span>
                </div>
            </div>
           
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (5).png" alt="" class="img1">
                        <img src="image/services (6).png" alt="" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>Métodos </h4>
                    <span>de Pago</span>
                </div>
            </div>
            <!-- service item -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (7).png" alt="" class="img1">
                        <img src="image/services (8).png" alt="" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>Descuentos</h4>
                    <span>para clientes</span>
                </div>
            </div>
            <!-- service item -->
        
            </div>
            <!-- service item -->
         
        </div>
    </div>
    <!-- categories -->
    <div class="categories">
        <div class="heading">
            <h1>Nuestros productos más elegidos</h1>
            <img src="image/separator.png" alt="">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/kefte.jpg" alt="">
                <a href="" class="btn">kefte</a>
            </div>
            <div class="box">
                <img src="image/lemenyuh.jpeg" alt="">
                <a href="" class="btn">lehmeyun</a>
            </div>
            <div class="box">
                <img src="image/mammul.jpg" alt="">
                <a href="" class="btn">Mamul</a>
            </div>
            <div class="box">
                <img src="image/sfijas.jpg" alt="">
                <a href="" class="btn">Sfijas</a>
            </div>
        </div>
    </div>
    <img src="image/banner-desc.png" alt="" class="menu-banner">
    <!-- taste -->

  
   
    
   
    <footer>
        <div class="content">
   
            <div class="box">
         
                <p>Si querés formar parte de nuestro equipo, por favor contactanos.</p>
                <a href="contact.php" class="btn">Contáctanos</a>
            </div>
            <div class="box">
                <h3>Mi cuenta</h3>
                <a href=""><i class='bx bx-chevron-right'></i>Mi usuario</a>
                <a href=""><i class='bx bx-chevron-right'></i>Ordenes</a>
                <a href=""><i class='bx bx-chevron-right'></i>Wish-List</a>
                <a href=""><i class='bx bx-chevron-right'></i>Newsletter</a>
            </div>
            <div class="box">
                <h3>Información</h3>
                <a href="contact.php"><i class='bx bx-chevron-right'></i>Sobre nosotros</a>
                <a href=""><i class='bx bx-chevron-right'></i>Delivery</a>
                <a href=""><i class='bx bx-chevron-right'></i>Politica de privacida</a>
                <a href=""><i class='bx bx-chevron-right'></i>Terminos y condiciones</a>
            </div>
            <div class="box">
                <h3>Extras</h3>
                <a href="contact.php"><i class='bx bx-chevron-right'></i>Marcas</a>
                <a href=""><i class='bx bx-chevron-right'></i>Certificaciones</a>
                <a href=""><i class='bx bx-chevron-right'></i>Contactanos</a>
                <a href=""><i class='bx bx-chevron-right'></i>Especiales</a>
            </div>
            <div class="box">
                <h3>Contactanos</h3>
                <p><i class='bx bxs-phone'></i> 112356789</p>
                <p><i class='bx bxs-envelope' ></i>artin@gmail.com</p>
                <p><i class='bx bxs-location-plus' ></i>Calle Falsa 123, Argentina</p>
                <div class="icons">
                    <i class='bx bxl-facebook'></i>
                    <i class='bx bxl-twitter'></i>
                    <i class='bx bxl-instagram' ></i>
                    <i class='bx bxl-linkedin'></i>
                </div>
            </div>
            
       
    </footer>
    <script src="js/script.js"></script>
</body>
</html>