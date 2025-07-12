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
    <title>Artin - Sobre nosotros</title>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Sobre nosotros</h1>
            <p>Somos un restaurante especializado en cocina armenia, donde cada plato está hecho con sabor, tradición y calidad. <br> Además, desarrollamos una línea de productos envasados listos para cocinar, ideales para que disfrutes en casa algo rico, fácil y auténtico. <br> Ya sea en nuestro local o desde tu cocina, llevamos lo mejor de nuestra mesa a la tuya.</p>
            <span><a href="home.html">Home</a><i class='bx bx-right-arrow-alt'></i>Sobre nosotros</span>
        </div>
    </div>
    <div class="chef">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <span>Eduardo Nalbandian</span>
                    <h1>Masterchef</h1>
                    <img src="image/separator-img.png" alt="">
                </div>
                <p>Apasionado por la cocina desde joven, Eduardo Nalbandian fundó Artin con el objetivo de compartir sabores auténticos inspirados en sus raíces y en la tradición familiar. Formado en cocina profesional y con años de experiencia, hoy lidera la propuesta gastronómica del restaurante, combinando técnicas modernas con recetas clásicas para ofrecer una experiencia única en cada plato.</p>
                <div class="flex-btn">
                    <a href="menu.php" class="btn">Explora nuestro menú</a>
                    <a href="contact.php" class="btn">Envianos una sugerencia</a>
                </div>
            </div>
            <div class="box">
                <img src="image/ceaf.png" alt="chef" class="img">
            </div>
        </div>
    </div>
   
    <!-- -----------------about-us----------------- -->
    <div class="container">
        <div class="box-container">
            <div class="img-box">
                <img src="https://i.pinimg.com/736x/80/ce/70/80ce70f613508986f9874449da6a74d8.jpg" alt="">
            </div>
            <div class="box">
                <div class="heading">
                    <h1>Diana Boudourian</h1>
                    <img src="image/separator-img.png" alt="">
                </div>
                <p>Diana Boudourian, una referente de la cocina armenia desde la Argentina, la forma que encontró de continuar con la gastronomía de sus ancestros. “Es una cocina heredada, que se transmite de generación en generación, y eso la hace muy genuina”, manifiesta.

Su sello surge de una tradición culinaria que se transmite de abuelas a madres y a tías y que apunta a preparar los alimentos en comunidad. “Es una cocina donde se unen todos los conocimientos, las sabidurías, y así vamos entremezclando entre canciones y damos forma a todos esos platos que van saliendo y se van creando continuamente”, afirma.</p>
                <a href="https://chefstv.net/sabores-de-la-infancia-y-del-medio-oriente-el-sello-de-diana-boudourian/" class="btn">Leer más</a>
            </div>
        </div>
        
    </div>
    <!-- -----------------team----------------- -->
    <div class="team">
        <div class="heading">
            <span>Nuestro equipo</span>
            <h1>Conocé nuestro equipo!</h1>
            <img src="image/separator-img.png" alt="">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/team-1.jpg" alt="" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Nicolás Nalbandian</h2>
                    <p>Chef</p>
                </div>
            </div>
            <div class="box">
                <img src="image/team-2.jpg" alt="" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Carla Minasian</h2>
                    <p>Chef</p>
                </div>
            </div>
            <div class="box">
                <img src="image/team-3.jpg" alt="" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Lautaro Karamanian</h2>
                    <p>Chef</p>
                </div>
            </div>
        </div>
    </div>
    <div class="standers">
        <div class="detail">
            <div class="heading">
                <h1>Nuestros Estandares</h1>
                <img src="image/separator-img.png" alt="">
            </div>
            <p>Sabores auténticos: recetas tradicionales hechas con pasión.</p>
            <i class='bx bxs-heart'></i>
            <p>Ingredientes frescos: seleccionados con cuidado cada día.</p>
            <i class='bx bxs-heart'></i>
            <p>Atención cálida: servicio amable, como en casa.</p>
            <i class='bx bxs-heart'></i>
            <p>Ambiente acogedor: un espacio para disfrutar y compartir.</p>
            <i class='bx bxs-heart'></i>
            <p>Calidad constante: excelencia en cada plato, siempre.</p>
            <i class='bx bxs-heart'></i>
        </div>
    </div>

    <!-- -----------------testimonios----------------- -->
    <div class="testimonial">
        <div class="heading">
            <h1>Testimonios</h1>
            <img src="image/separator-img.png" alt="">
        </div>
        <div class="testimonial-container">
            <div class="slide-row" id="slide">
              <div class="slide-col">
                    <div class="user-text">
                        <p>⭐️⭐️⭐️⭐️⭐️
"Artin me hizo viajar sin salir de la ciudad. Todo fresco, casero y lleno de sabor. Volvería mil veces."</p>
                        <h2>Martin</h2>
                        <p>Cliente</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (1).jpg" alt="avatar">
                    </div>
                </div>
    
                <div class="slide-col">
                    <div class="user-text">
                        <p>⭐️⭐️⭐️⭐️⭐️
"Una joya escondida. No conocía mucho de la comida armenia y salí enamorado. ¡Recomiendo el keppe al horno!"
</p>
                        <h2>Jonathan</h2>
                        <p>Cliente</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (2).jpg" alt="avatar">
                    </div>
                </div>
    
                <div class="slide-col">
                    <div class="user-text">
                        <p>⭐️⭐️⭐️⭐️⭐️
"El ambiente es cálido y familiar, y la atención fue impecable. Ideal para una cena especial o para compartir algo distinto."</p>
                        <h2>Julio</h2>
                        <p>Cliente</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (3).jpg" alt="avatar">
                    </div>
                </div>
              
               <div class="slide-col">
                    <div class="user-text">
                        <p>"La comida es espectacular."</p>
                        <h2>Sofia</h2>
                        <p>Cliente</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (4).jpg" alt="avatar">
                    </div>
                </div>

            </div>
        </div>
        
        <div class="indicator">
            <span class="btn1 active"></span>
            <span class="btn1"></span>
            <span class="btn1"></span>
            <span class="btn1"></span>
        </div>
    </div>
  
            </div>
        </div>
    </div>
    <?php include 'components/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>