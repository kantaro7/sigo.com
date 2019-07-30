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


//Buscar en base de datos MARKET
$tabla="pp_market";
$ruta="upld_$tabla";
$stmt2=$db_pdo->prepare("SELECT id_$tabla, name_foto_1, name_foto_2  FROM $tabla  WHERE shown='$vlr_bd_si' and deleted='$vlr_bd_no'  ORDER BY id_$tabla DESC  LIMIT 1  OFFSET 0;");
if($stmt2===false) {
  trigger_error($db_pdo->error, E_USER_ERROR);
}
$stmt2->execute();    
if($status===false) {
  trigger_error($stmt2->error, E_USER_ERROR);
}
if($stmt2->rowCount()>0){
  $element=$stmt2->fetch();
}

$img_pth_mrk_1="admin/$ruta/ft_1_".$element["id_".$tabla].substr($element["name_foto_1"], -4)."?vrbl=".$random;
$img_pth_mrk_2="admin/$ruta/ft_2_".$element["id_".$tabla].substr($element["name_foto_2"], -4)."?vrbl=".$random;


//Buscar en base de datos BODEGÓN
$tabla="pp_bodega";
$ruta="upld_$tabla";
$stmt2=$db_pdo->prepare("SELECT id_$tabla, name_foto  FROM $tabla  WHERE shown='$vlr_bd_si' and deleted='$vlr_bd_no'  ORDER BY id_$tabla DESC  LIMIT 1  OFFSET 0;");
if($stmt2===false) {
  trigger_error($db_pdo->error, E_USER_ERROR);
}
$stmt2->execute();    
if($status===false) {
  trigger_error($stmt2->error, E_USER_ERROR);
}
if($stmt2->rowCount()>0){
  $element=$stmt2->fetch();
}

$img_pth_bdg="admin/$ruta/ft_".$element["id_".$tabla].substr($element["name_foto"], -4)."?vrbl=".$random;


//Buscar en base de datos FARMACIA
$tabla="pp_farmac";
$ruta="upld_$tabla";
$stmt2=$db_pdo->prepare("SELECT id_$tabla, name_foto_1, name_foto_2  FROM $tabla  WHERE shown='$vlr_bd_si' and deleted='$vlr_bd_no'  ORDER BY id_$tabla DESC  LIMIT 1  OFFSET 0;");
if($stmt2===false) {
  trigger_error($db_pdo->error, E_USER_ERROR);
}
$stmt2->execute();    
if($status===false) {
  trigger_error($stmt2->error, E_USER_ERROR);
}
if($stmt2->rowCount()>0){
  $element=$stmt2->fetch();
}

$img_pth_frm_1="admin/$ruta/ft_1_".$element["id_".$tabla].substr($element["name_foto_1"], -4)."?vrbl=".$random;
$img_pth_frm_2="admin/$ruta/ft_2_".$element["id_".$tabla].substr($element["name_foto_2"], -4)."?vrbl=".$random;

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

  <style type="text/css">
    .market {
      background-image: url(<?php echo($img_pth_mrk_1); ?>);
      background-size: 100%;
      background-repeat: no-repeat;
    }

    @media only screen and (max-width : 600px) {
      .market {
        background-image: url(<?php echo($img_pth_mrk_2); ?>);
        background-size: 100%;
        background-repeat: no-repeat;
      }
    }

    .bodegon {
      background-image: url(<?php echo($img_pth_bdg); ?>);
      width: 100%;
    }

    .farmacia {
      background-image: url(<?php echo($img_pth_frm_1); ?>);
      background-size: 100%;
      background-repeat: no-repeat;
    }

    @media only screen and (max-width : 600px) {
      .farmacia {
        background-image: url(<?php echo($img_pth_frm_2); ?>);
        background-size: 100%;
        background-repeat: no-repeat;
      }
    }
  </style>
</head>

<body>


  <!-- begin: Header -->
  <?php include_once "inc_header.php"; ?>
  <!-- end: Header -->


  <!-- begin: Slider  -->
  <?php include_once "index_slider.php"; ?>
  <!-- end: Slider   -->


  <!-- begin: Cards  -->
  <?php include_once "index_servic.php"; ?>
  <!-- end: Cards   -->


  <!-- begin: Market  -->
  <?php include_once "index_market.php"; ?>
  <!-- end: Market   -->


  <!-- begin: Bodegón  -->
  <?php include_once "index_bodega.php"; ?>
  <!-- end: Bodegón   -->


  <!-- begin: Farmacia  -->
  <?php //include_once "index_farmac.php"; ?>
  <!-- end: Farmacia   -->


  <!-- begin: Farmacia -->
  <div class="row" style="margin:0">

    <div class="col s12 m6 center farmacia">
      <img src="img/farmacia.png" width="100%" alt="" style="margin-top: 10px">
    </div>

    <div class="col s12 m6 center" >   
      <div class="container"  style="margin-bottom: 20%">         
        <a href="market.php#farmacia"> <p class="card-title" style="margin-top: 120px; font-size: 32px; color: #2962ff" >FARMACIA</p></a>
        <p style="margin-top: 26px; font-size: 20px; font-family: dosis">Calidad - Saludable - Eficaz </p>
        <p style="margin-top: 16px; font-size: 18px">Nuestras farmacias están a tu disposición para ofrecerte gran variedad de medicamentos y artículos para el higiene y el cuidado personal.</p>
      </div>            
    </div>

  </div>
  <!-- end: Farmacia -->


  <!-- begin: Revista  -->
  <?php include_once "index_mirevi.php"; ?>
  <!-- end: Revista   -->


  <!-- begin: Barra de Sigo -->
  <div class="col s12 m12 center barra_sigo" style="font-size: 1.64rem">
    <span> <a href="" class="white-text"><b>Sé parte de Sigo <b>-</b></b></a> <a class="white-text" href="contacto.php" style="margin-left: 8px">Contacto</a> <a style="margin-left: 8px" class="white-text" href="sucursales.php"><b>-</b> Sucursales</span></a> 
  </div>
  <!-- end: Barra de Sigo  -->


  <!-- begin: Footer -->
  <?php include_once "index_footer.php"; ?>
  <!-- end: Footer -->


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  <!-- inicio slider -->
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
  <script>
    $(function() {
      $('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
          }
        }
      });
    });
  </script>

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
