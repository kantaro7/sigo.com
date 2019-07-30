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
$ftr_clr="page-footer #0097a7 cyan darken-2";
$ftr_img="img/sucursales/logo_header_turquesa.png";

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


  <!-- begin: Slider -->
  <?php include_once "sucursales_slider.php"; ?>
  <!-- end: Slider -->


  <!-- begin: Proveeduria -->
  <div class="container" id="margarita">
    <div class="row">
      <div class="col s12 m12">
        <h4>La Proveduría <img class="sucursales_titulos" src="img/sucursales/margarita_titulo_sucursales.png" alt=""></h4>
      </div>
      <div class="col s12 m6" style="font-size: 17px">
        <p>Es la primera tienda de Sigo luego de su proceso de expansión. Aquí encuentras Súper Market, Farmacia y Bodegón y el restaurant self-service Smilie's.</p>
      </div>
      <div class="col s12 m6" style="font-size: 17px">
        <p>Además de las tiendas Sigo, el centro comercial cuenta con múltiples servicios como bancos, ópticas, tiendas de deporte, ropa, entre muchas otras.</p>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="row">
      <div class="col s12 m6 proveduria_margarita" style="margin: 0; padding: 0">
      </div>
      <div class="col s12 m6" style="margin: 0; padding: 0">
        <iframe class="proveduria_margarita_mapas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d987.1013863472101!2d-63.86879850312627!3d10.952686978584847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c318c0095997c67%3A0xa1ed7958be7dddaa!2sSigo!5e1!3m2!1sen!2sve!4v1503971548308" width="100%"  frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>      
    </div> 
  </div>

  <div class="container">
    <div class="row">
      <div class="col s12 m12">
        <p style="font-size: 17px">Dirección: Av. Juan Bautista Arismendi, Edif. Sigo. Porlamar. <br>Estado Nueva Esparta.</p>
      </div>
    </div>
  </div>

  <div class=" localizador">
    <div class="container">
      <div class="row">

        <div class="col s12 m1 center"><img class="iconos_sucursales1" style="vertical-align: middle;" src="img/sucursales/telefono.png" alt="" width="12%" ></div>
        <div class="col s12 m5">
          <p class="white-text" style="font-size: 17px; margin-top: 8%"> Teléfonos: (0295) 265.21.48 – 265.21.79</p>
        </div>

        <div class="col s12 m1 center"><img class="iconos_sucursales1" style="vertical-align: middle;" src="img/sucursales/horario.png" alt="" width="12%" ></div>
        <div class="col s12 m5">
          <p class="white-text" style="font-size: 17px">
            Horario: Lunes a Sábado, 10:00 a.m a 6:30 p.m. <br>Domingo, 8:00 a.m a 5:00 p.m</p>
          </div>

        </div>
      </div>
    </div>
    <!-- end: Proveduria -->


    <!-- begin: Parque Costazul -->
    <div class="container">
      <div class="row">
        <div class="col s12 m12">
          <h4>Parque Costazul <img class="sucursales_titulos" src="img/sucursales/margarita_titulo_costazul.png" alt=""></h4>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="row">
        <div class="col s12 m6 proveduria_costazul" style="margin: 0; padding: 0">
        </div>
        <div class="col s12 m6" style="margin: 0; padding: 0">
          <iframe class="proveduria_margarita_mapas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1902.5687839545355!2d-63.826012591020294!3d10.990785639068932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6f6c042901e703b0!2sSigo+Supermarket!5e0!3m2!1sen!2sve!4v1503971313306" width="100%"  frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>      
      </div> 
    </div>

    <div class="container">
      <div class="row">
        <div class="col s12 m12">
          <p style="font-size: 17px">Dirección: Av. Jóvito Villalba. Sector Los Robles. Pampatar. <br>Estado Nueva Esparta.</p>
        </div>
      </div>
    </div>

    <div class=" localizador">
      <div class="container">
        <div class="row">
          <div class="col s12 m1 center"><img class="iconos_sucursales" style="vertical-align: middle;" src="img/sucursales/telefono.png" alt=""> </div>
          <div class="col s12 m5">
            <p class="white-text" style="font-size: 17px"
            >Súper Market Parque Costazul: (0295) 265.21.48 / 265.21.79 <br> 
            Mini Market, Home Market y Bodegón Parque Costazul: (0295) 265.21.48 / 265.21.79
          </p>
        </div>
        <div class="col s12 m1 center"><img class="iconos_sucursales" src="img/sucursales/horario.png" alt="" width="12%" ></div>
        <div class="col s12 m5">
          <p class="white-text horario_sucursales" style="font-size: 17px; margin-top: -2px ">
            Súper Market Parque Costazul: Lunes a Sábado 10:00 a.m. a 8:00 p.m. Domingo 12:00 a.m. a 8:00 p.m.
            Mini Market, Home Market y Bodegón Parque Costazul: Lunes a Sábado 11:30 p.m. a 8:00 p.m. Domingo 12:00 p.m. a 8:00 p.m.
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- end: Parque Costazul -->


  <!-- begin: Sambil Margarita -->
  <div class="container">
    <div class="row">
      <div class="col s12 m12">
        <h4>Sambil Margarita <img class="sucursales_titulos" src="img/sucursales/margarita_titulo_costazul.png" alt=""></h4>
      </div>   
    </div>
  </div>

  <div class="section">
    <div class="row">
      <div class="col s12 m6 sambilmargarita_sucursales" style="margin: 0; padding: 0">
      </div>
      <div class="col s12 m6" style="margin: 0; padding: 0">
        <iframe class="proveduria_margarita_mapas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1267.7856926183729!2d-63.814612545266016!3d10.998946212517705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c318fb28773bdab%3A0x5b44c9684c99cd15!2sSigo+SuperMarket+Sambil+Margarita!5e1!3m2!1sen!2sve!4v1503971640451" width="100%"  frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>      
    </div> 
  </div>

  <div class="container">
    <div class="row">
      <div class="col s12 m12">
        <p style="font-size: 17px"> Av. Jóvito Villalba. Urb. San Lorenzo. Centro Comercial Sambil Margarita. Local T-128. Entrada Playa Caribe. Pampatar. <br> Estado Nueva Esparta. </p>
      </div>
    </div>
  </div>

  <div class=" localizador">
    <div class="container">
      <div class="row">
        <div class="col s12 m1 center"><img class="iconos_sucursales" style="vertical-align: middle;" src="img/sucursales/telefono.png" alt=""> </div>
        <div class="col s12 m5">
          <p class="white-text" style="font-size: 17px">Súper Market Parque Costazul: (0295) 265.21.48 / 265.21.79 <br> 
          Mini Market, Home Market y Bodegón Parque Costazul: (0295) 265.21.48 / 265.21.79</p>
        </div>
        <div class="col s12 m1 center"><img class="iconos_sucursales" src="img/sucursales/horario.png" alt="" width="12%" ></div>
        <div class="col s12 m5">
          <p class="white-text horario_sucursales" style="font-size: 17px">
          Horario: Lunes a Sábado 10:00 a.m. a 8:00 p.m. Domingo, 12:00 a.m. a 8:00 p.m. </p>
        </div>
      </div>
    </div>
  </div>
  <!-- end: Sambil Margarita -->


  <!-- begin: Barcelona -->
  <div class="container" id="barcelona">
    <div class="row">
      <div class="col s12 m12">
        <h4><span class="right" style="margin-top: 6%">Centro Comercial Sigo</span><img class="sucursales_titulos2" src="img/sucursales/barcelona_titulo_sucursales.png" alt=""></h4>
      </div>
      <div class="col s12 m6" style="font-size: 17px">
        <p>La sucursal de Sigo Barcelona ha sido ampliada hasta convertirse actualmente en un centro comercial donde encontrarás nuestro Súper Market y Bodegón Sigo. </p>
      </div>
      <div class="col s12 m6" style="font-size: 17px">
        <p>Además, disfrutarás de otros servicios como bancos, tiendas de decoración, ropa, entre otros.   </p>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="row">
      <div class="col s12 m6" style="margin: 0; padding: 0">
        <iframe class="proveduria_margarita_mapas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3753.9616019287946!2d-64.67540728533461!3d10.111284292774956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2d6d7e3ded2117%3A0x24a2be78c7a41af1!2sSigo%2C+La+Proveeduria!5e1!3m2!1sen!2sve!4v1503971703618" width="100%"  frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>   
      <div class="col s12 m6 proveduria_barcelona" style="margin: 0; padding: 0">
      </div>
    </div> 
  </div>

  <div class="container">
    <div class="row">
      <div class="col s12 m12">
        <p style="font-size: 17px">Dirección: Av. Juan Bautista Arismendi, Edif. Sigo. Porlamar. <br>Estado Nueva Esparta.</p>
      </div>
    </div>
  </div>

  <div class=" localizador_proveduria">
    <div class="container">
      <div class="row">
        <div class="col s12 m1 center"><img class="iconos_sucursales1" style="vertical-align: middle;" src="img/sucursales/telefono.png" alt="" width="12%" ></div>
        <div class="col s12 m5">
          <p class="white-text" style="font-size: 17px; margin-top: 8%"> Teléfonos:  (0281) 420.25.04 – 420.25.05</p>
        </div>
        <div class="col s12 m1 center"><img class="iconos_sucursales1" style="vertical-align: middle;" src="img/sucursales/horario.png" alt="" width="12%" ></div>
        <div class="col s12 m5">
          <p class="white-text" style="font-size: 17px">
            Horario: Lunes a Sábado, 10:00 a.m. a 7:00 p.m. <br>Domingo, 8:00 a.m. a 5:00 p.m.
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- end: Barcelona -->


  <!-- begin: Maturin -->
  <div class="container" id="maturin">
    <div class="row">
      <div class="col s12 m12">
        <h4>Centro Comercial Sigo<img class="sucursales_titulos2" src="img/sucursales/maturín_titulo_sucursales.png" alt=""></h4>
      </div>
      <div class="col s12 m6" style="font-size: 17px">
        <p>Sigo Maturín ofrece al visitante una experiencia de compra diferente, con una amplia oferta de productos de alimentación, bodegón, hogar y lencería, entre otros.</p>
      </div>
      <div class="col s12 m6" style="font-size: 17px">
        <p>Todo englobado en un solo formato de tienda.</p>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="row">
      <div class="col s12 m6 proveduria_maturin" style="margin: 0; padding: 0">
      </div>
      <div class="col s12 m6" style="margin: 0; padding: 0">
        <iframe class="proveduria_margarita_mapas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2619.4172709860045!2d-63.156614307004624!3d9.725194046795858!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c3346d8ef308503%3A0xffc151fb5abda60e!2sSigo+Matur%C3%ADn+-+HiperMarket!5e1!3m2!1sen!2sve!4v1503971778332" width="100%"  frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>      
    </div> 
  </div>

  <div class="container">
    <div class="row">
      <div class="col s12 m12">
        <p style="font-size: 17px">Dirección: Final Avenida Raúl Leoni, prolongación sur. Centro Comercial Sigo. Maturín. <br> Estado Monagas.</p>
      </div>
    </div>
  </div>

  <div class=" localizador_maturin">
    <div class="container">
      <div class="row">
        <div class="col s12 m1 center"><img class="iconos_sucursales1" style="vertical-align: middle;" src="img/sucursales/telefono.png" alt="" width="12%" ></div>
        <div class="col s12 m5">
          <p class="white-text" style="font-size: 17px; margin-top: 8%"> Teléfonos: (0291) 300.26.10 – 300.26.09  </p>
        </div>
        <div class="col s12 m1 center"><img class="iconos_sucursales1" style="vertical-align: middle;" src="img/sucursales/horario.png" alt="" width="12%" ></div>
        <div class="col s12 m5">
          <p class="white-text" style="font-size: 17px">
            Horario: Lunes a Sábado, 10:00 a.m. a 7:00 p.m. Domingo, 8:00 a.m. a 5:00 p.m.
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- end: Maturin -->


  <!-- begin: Paraguana-->
  <div class="container" id="paraguana">
    <div class="row">
      <div class="col s12 m12">
        <h4><span  class="right" style="margin-top: 4%; margin-bottom: 12px">Centro Comercial Las Virtudes</span><img class="sucursales_titulos3" src="img/sucursales/paraguana_titulo_sucursales.png" alt="">  </h4>
      </div>
      <div class="col s12 m6" style="font-size: 17px">
        <p>En el Centro Comercial Las Virtudes podrán encontrar Bodegón Sigo y nuestra tienda de electrónica, donde los clientes obtienen gran variedad de los mejores productos.  </p>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="row">
      <div class="col s12 m6" style="margin: 0; padding: 0">
        <iframe class="proveduria_margarita_mapas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3734.5311736567055!2d-70.20727158532019!3d11.657479691727428!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e85edc87583b1fb%3A0xfcbf973cd3fedaca!2sSigo+Bodeg%C3%B3n!5e1!3m2!1sen!2sve!4v1503971824740" width="100%"  frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>   
      <div class="col s12 m6 proveduria_paraguana" style="margin: 0; padding: 0">
      </div>
    </div> 
  </div>

  <div class="container">
    <div class="row">
      <div class="col s12 m12">
        <p style="font-size: 17px">Dirección: Centro Comercial Las Virtudes, Urbanización Las Virtudes. <br>Punta Maraven, Sector Los 7 Tanques.</p>
      </div>
    </div>
  </div>

  <div class=" localizador_paraguana">
    <div class="container">
      <div class="row">
        <div class="col s12 m1 center"><img class="iconos_sucursales1" style="vertical-align: middle;" src="img/sucursales/telefono.png" alt="" width="12%" ></div>
        <div class="col s12 m5">
          <p class="white-text" style="font-size: 17px; margin-top: 8%"> Teléfonos: (0269) 248.56.70 / (0269) 415.64.83 </p>
        </div>
        <div class="col s12 m1 center"><img class="iconos_sucursales1" style="vertical-align: middle;" src="img/sucursales/horario.png" alt="" width="12%" ></div>
        <div class="col s12 m5">
          <p class="white-text" style="font-size: 17px">
            Horario: Lunes a Domingo 10:00 a.m. a 7:00 p.m.
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- end: Paraguaná -->


  <!-- begin: Maracay -->
  <div class="container">
    <div class="row">
      <div class="col s12 m12">
        <h4>Centro Comercial Parque Los Aviadores<img class="sucursales_titulos4" src="img/sucursales/maracay_titulo_sucursales.png" alt=""></h4>
      </div>     
    </div>
  </div>

  <div class="section" id="maracay">
    <div class="row">
      <div class="col s12 m6 proveduria_maracay" style="margin: 0; padding: 0">
      </div>
      <div class="col s12 m6" style="margin: 0; padding: 0">
        <iframe class="proveduria_margarita_mapas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3752.3594042171935!2d-67.58198699763294!3d10.186804419294834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6c9502b75f935b81!2sSigo+MiniMarket!5e1!3m2!1sen!2sve!4v1503971900564" width="100%"  frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>      
    </div> 
  </div>

  <div class="container">
    <div class="row">
      <div class="col s12 m12">
        <p style="font-size: 17px">Dirección:Centro Comercial Parque Los Aviadores, Autopista Los Aviadores, Sector Camburito, Palo Negro, Maracay, estado Aragua. </p>
      </div>
    </div>
  </div>

  <div class=" localizador_maracay">
    <div class="container">
      <div class="row">
        <div class="col s12 m1 center"><img class="iconos_sucursales1" style="vertical-align: middle;" src="img/sucursales/telefono.png" alt="" width="12%" ></div>
        <div class="col s12 m5">
          <p class="white-text" style="font-size: 17px; margin-top: 8%"> Teléfonos: (0269) 248.56.70 – 415.64.83</p>
        </div>
        <div class="col s12 m1 center"><img class="iconos_sucursales1" style="vertical-align: middle;" src="img/sucursales/horario.png" alt="" width="12%" ></div>
        <div class="col s12 m5">
          <p class="white-text" style="font-size: 17px">
            Horario: Lunes a Sábado 11:00 a 8:00 p.m. Domingo 12:00 p.m. a 8:00 p.m.
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- end: Maracay -->


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
