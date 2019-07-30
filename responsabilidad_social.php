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
$ftr_clr="page-footer #01579b light-blue darken-4";
$ftr_img="img/ucs/usc_logo_header_azul.png";

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


  <!-- begin: Banner -->
  <?php include_once "servicios_banner.php"; ?>
  <!-- end: Banner -->


  <!-- begin: Slider  -->
  <div class="container">
    <div class="row right" style="margin-top: -110px; z-index: 999">
      <div class="col s12 m12">
        <a > <h4 class="white-text right" ">Responsabilidad Social Empresarial</h4></a>
      </div> 
      <div class="col s12 m12 right" >
        <a class="blue-text right" href="#internos">● Programas RSE Internos</a>
        <a class="menu_internas white-text right" href="#rrss" >● RSE con nuestras comunidades</a>
      </div> 
    </div>
  </div>
  <!-- end: Slider -->


  <!-- begin: Responsabilidad Social   -->
  <div class="section" id="rrss">
    <div class="container">
      <div class="row" style="margin-top: 20px">
        <div class="col s12 m12">
          <h4>Responsabilidad Social</h4>
          <p style="font-size: 20px"><?php echo(html_encode($elmnt_data["texto_2"])); ?></p>
        </div>
      </div>
    </div>
  </div>
  <!-- end: Responsabilidad Social   -->


  <!-- begin: Contenido -->
  <?php include_once "responsabilidad_social_conten.php"; ?>
  <!-- end: Contenido -->


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
