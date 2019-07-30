<?php
//Iniciar sesión
session_start();

//Configure Page headers
header('P3P: CP="CAO PSA OUR"');
header("Cache-control: private");

// Configure Error Displaying
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//Load Basic Configuration, Database & General Rutines
include_once "admin/lib_php/config.php";          // Constantes Globales
include_once "admin/lib_php/general.php";         // Funciones varias

//Connect to Database
$db_pdo=new PDO("mysql:host=$host;dbname=$base", $user, $pass);

//Establecer variable random para evitar cache de fotos
$random=md5(uniqid(rand(), 1));

//Indicador de Lenguaje
$lng="esp";

//Indicador de Menú
$act_menu=0;

//Configuración de Footer
$ftr_clr="page-footer #b71c1c red darken-4";
$ftr_img="img/producto/sigo_rojo.png";

?>

<!DOCTYPE html>
<html lang="es">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>SIGO</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
  <link rel="icon" href="favicon.ico" type="image/x-icon"/>
  <link rel="shortcut icon" href="img/fav.png" type="image/x-icon"/>

</head>

<body>


  <!-- begin: Header -->
  <?php include_once "inc_header.php"; ?>
  <!-- end: Header -->


  <!-- begin: Slider  -->
  <?php include_once "nosotros_slider.php"; ?>
  <!-- end: Slider   -->


  <!-- begin: Super Market -->
  <div class="section">
    <div class="container">
      <div class="row" style="margin-top: 20px">

        <div class="col s12 m12" id="sigo">
          <h4>Sigo</h4>
          <p style="font-size: 20px">
            Sigo... Una experiencia al servicio de nuestra gente. Su legado asciende a más de 40 años. Actualmente cuenta con 16 sucursales, incluyendo tres en tierra firme - Maturín, Paraguaná, y Barcelona- y sus proyectos continúan avanzando. <br><br> Así es Sigo, una empresa marcada por el crecimiento y bienestar de su gente, que nació en pleno corazón de Porlamar y que hoy es una de las compañías más sólidas del oriente del país. 
          </p>
        </div>

        <div class="col s12 m12" id="legado">
          <h4>Un Legado</h4>
          <p style="font-size: 20px">José Martínez Valenzuela dio inicio al legado en 1972. Su espíritu emprendedor lo lleva a iniciar un primer negocio en el Boulevard Guevara de la isla de Margarita, que serviría de base para el desarrollo de La Proveeduría en Pedregales y Porlamar. </p>
        </div>


        <div class="col s12 m4" >
          <p style="font-size: 20px">
            Entusiasmo, persistencia, creatividad, deseo, imaginación, mejoramiento continuo, humildad, trabajo, fe, son atributos que Valenzuela transmitió durante toda su vida, y que inspiraron la cultura corporativa de Sigo. <br><br>De allí en adelante, hemos recorrido más de 40 años, con crecimiento sostenido y mejoramiento continuo.
          </p>
        </div>

        <div class="col s12 m8">
          <img class="responsive-img" src="img/nosotros/la_proveduria.jpg" width="100%" alt="">
        </div>

      </div>
    </div>
  </div>
  <!-- end: Super Market -->


  <!-- begin: Parallax -->
  <div class="parallax-container" id="historia">
    <div class="parallax"><img src="img/nosotros/slider_secundario.jpg"></div>
  </div>
  <!-- end: Parallax  -->


  <!-- begin: Historia -->
  <div class="section">
    <div class="row">
      <div class="col s12 m12">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>

        <!-- The Timeline -->
        <ul class="timeline">

          <!-- Item 1 -->
          <li>
            <div class="direction-r">
              <div class="flag-wrapper">
                <span class="flag">1972</span>               
              </div>
              <div class="desc">
                Fundación de Sigo, en el Boulevard Guevara de Porlamar, Isla de Margarita. <br>
                <img src="img/nosotros/cronologia_1.jpg" alt="" width="100%">
              </div>
            </div>
          </li>

          <!-- Item 2 -->
          <li>
            <div class="direction-l historia_cronologia">
              <div class="flag-wrapper">
                <span class="flag">1985</span>               
              </div>
              <div class="desc">
                Abre sus puertas Sigo La Proveeduría, en Porlamar. Hoy en día cuenta con más de 23.000m2 de piso de ventas, donde el visitante encuentra las tiendas Sigo de Supermercado, Bodegón, Sigo Kids (productos infantiles y para bebé), Ropa Íntima y Smilie’s (Restaurante self-service).<br>
                <img src="img/nosotros/cronologia_2.jpg" alt="" width="100%">
              </div>
            </div>
          </li>

          <!-- Item 3 -->
          <li>
            <div class="direction-r historia_cronologia">
              <div class="flag-wrapper">
                <span class="flag">1991</span>               
              </div>
              <div class="desc">
                Inicia operaciones Sigo en Barcelona, Edo. Anzoátegui. Con los años, la sucursal crece para convertirse en una superficie de 8.000m2 con Supermercado, Bodegón, tiendas de lencería, niños, y productos para el hogar (electrónica, lencería, pinturas, repuestos, entre otros).<br>
                <img src="img/nosotros/cronologia_33.jpg" alt="" width="100%">
              </div>
            </div>
          </li>

          <!-- Item 4 -->
          <li>
            <div class="direction-l historia_cronologia">
              <div class="flag-wrapper">
                <span class="flag">1995</span>               
              </div>
              <div class="desc">
                Se inaugura Sigo Maturín, en el Edo. Monagas, una tienda que en 2006 se amplía para convertirse en el primer Hipermercado Sigo a nivel nacional, con 12.000m2, un formato innovador donde el cliente encuentra en una misma superficie de ventas Supermercado, Bodegón, Electrónica, Hogar, productos y ropa para bébés y niños, lencería íntima, y el restaurante self-service Smilie’s.<br>
                <img src="img/nosotros/cronologia_3.jpg" alt="" width="100%">
              </div>
            </div>
          </li>

          <!-- Item 5 -->
          <li>
            <div class="direction-r historia_cronologia">
              <div class="flag-wrapper">
                <span class="flag">2002</span>               
              </div>
              <div class="desc">
                Se inaugura, en el Centro Comercial Sambil Margarita, el Bodegón Sigo, que en poco tiempo se convierte en referente de licores, delicatesses y exquisiteces en la Isla.<br>
                <img src="img/nosotros/cronologia_4.jpg" alt="" width="100%">
              </div>
            </div>
          </li>

          <!-- Item 6 -->
          <li>
            <div class="direction-l historia_cronologia">
              <div class="flag-wrapper">
                <span class="flag">2003</span>               
              </div>
              <div class="desc">
                También en el Centro Comercial Sambil Margarita, se inaugura el primer formato de tienda de conveniencia de Sigo: Sigo MiniMarket.<br>
                <img src="img/nosotros/cronologia_6.jpg" alt="" width="100%">
              </div>
            </div>
          </li>

          <!-- Item 7 -->
          <li>
            <div class="direction-r historia_cronologia">
              <div class="flag-wrapper">
                <span class="flag">2005</span>               
              </div>
              <div class="desc">
                Año de importante crecimiento para Sigo, donde se inauguran en Margarita Farmacia Sigo El Parque, en el centro de Porlamar, Supermarket Sambil, y el Centro de Procesamiento de Alimentos (CPA). También se abre la primera sucursal de Sigo en la Península de Paraguaná, Electrónica Sigo y Bodegón Sigo en el Centro Comercial Las Virtudes.<br>
                <img src="img/nosotros/cronologia_7.jpg" alt="" width="100%">
              </div>
            </div>
          </li>

          <!-- Item 8 -->
          <li>
            <div class="direction-l historia_cronologia">
              <div class="flag-wrapper">
                <span class="flag">2006</span>               
              </div>
              <div class="desc">
                Consolidando el periodo de crecimiento de la organización, en este año se inauguran Farmacia Sigo V, en la calle Táchira de Porlamar, la tienda para electrónica y hogar Sigo HomeMarket, y la tienda de Electrónica Sigo en el Centro Comercial Sambil Margarita.<br>
                <img src="img/nosotros/cronologia_8.jpg" alt="" width="100%">
              </div>
            </div>
          </li>

          <!-- Item 9 -->
          <li>
            <div class="direction-r historia_cronologia">
              <div class="flag-wrapper">
                <span class="flag">2007</span>               
              </div>
              <div class="desc">
                Para dar respuesta a la operación de sus tiendas, se trasladan las oficinas corporativas de Sigo al edificio de CPA, en la Av. Juan Bautista Arismendi de Porlamar.<br>
                <img src="img/nosotros/cronologia_9.jpg" alt="" width="100%">
              </div>
            </div>
          </li>

          <!-- Item 10 -->
          <li>
            <div class="direction-l historia_cronologia">
              <div class="flag-wrapper">
                <span class="flag">2010</span>               
              </div>
              <div class="desc">
                Bajo un nuevo concepto de “tienda-boutique”, se inaugura el Bodegón Sigo La Vela en la Isla de Margarita, con el objetivo de crear un formato de tienda que ofrece un trato personalizado a sus clientes más Premium.<br>
                <img src="img/nosotros/cronologia_10.jpg" alt="" width="100%">
              </div>
            </div>
          </li>

          <!-- Item 11 -->
          <li>
            <div class="direction-r historia_cronologia">
              <div class="flag-wrapper">
                <span class="flag">2012</span>               
              </div>
              <div class="desc">
                Inmersos en el Centro Comercial más moderno de la Isla de Margarita, HomeMarket, MiniMarket y Bodegón Costazul, llegaron para convertirse en mucho más que un lugar donde encontrar una increíble gama de productos y servicios.<br>
                <img src="img/nosotros/cronologia_11.jpg" alt="" width="100%">
              </div>
            </div>
          </li>

          <!-- Item 12 -->
          <li>
            <div class="direction-l historia_cronologia">
              <div class="flag-wrapper">
                <span class="flag">2015</span>               
              </div>
              <div class="desc">
                En este año Sigo llega a la región central del país con la inauguración de un cómodo y  amplio Mini Market, ubicado en el Centro Comercial Parque Los Aviadores, Maracay, estado Aragua.<br>
                <img src="img/nosotros/cronologia_12.jpg" alt="" width="100%">
              </div>
            </div>
          </li>

        </ul>

      </div>    
    </div>
  </div>
  <!-- end: Historia -->


  <!-- begin: Principios Rectores  -->
  <?php include_once "nosotros_prirec.php"; ?>
  <!-- end: Principios Rectores   -->


  <!-- begin: Footer -->
  <?php include_once "inc_footer.php"; ?>
  <!-- end: Footer -->


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  <!-- inicio slider-->
  <script>
    $(document).ready(function(){
      $('.slider').slider({full_width: true});
    });        
  </script>
  <!-- fin slider-->

  <!-- Carousel -->
  <script>
    $(document).ready(function(){
      $('.carousel').carousel();
    });
  </script>
  <!-- Carousel -->

  <!-- Scroll Smoot -->
  <script>
    $(function() {
      $('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 600);
            return false;
          }
        }
      });
    });
  </script>

  <!-- Preloader -->
  <script>
    $(window).load(function() {
      $("#status").fadeOut("slow");
      $("#preloader").delay(500).fadeOut("slow").remove();     
    })
  </script>

</body>
</html>
