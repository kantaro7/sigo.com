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

//Incorporar Emisión de Emails
include_once "contacto_email.php";

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
  <?php include_once "contacto_slider.php"; ?>
  <!-- end: Slider -->


  <!-- begin: Formularios -->
  <div class="section" style="padding: 0">
    <div class="row">

      <div class="col s12 m8">

        <!-- begin: Formulario Empléate -->
        <div class="row">
          <form class="formValidate" id="empleate" name="empleate" method="post" action="" enctype="multipart/form-data">

            <div class="col s12 m12">
              <h4 ><img style="vertical-align: -36px; margin-left: 42px" src="img/contacto/icono_1.png" alt=""> Empléate</h4>
            </div>
            <div class="col s12 m6">
              <div class="row">
                <div class="input-field col s12">
                  <input id="nombre_emplea" name="nombre_emplea" type="text" class="validate" required="" aria-required="true" value="<?php echo($_POST["nombre_emplea"]); ?>">
                  <label for="nombre_emplea" class="black-text">Nombre y Apellido</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12" style="margin-top: -12px">
                  <input id="fecha_emplea" name="fecha_emplea" type="date" class="datepicker validate" required="" aria-required="true">
                  <label for="fecha_emplea" class="black-text">Fecha de Naciemiento</label>
                </div>
              </div>          
            </div>
            <div class="col s12 m6">
              <div class="row">
                <div class="col s12 m4">
                  <p>
                    <input id="sexo_f" name="sexo_f" type="checkbox" onchange="toggle_chckbx(this.value, 'sexo_m');" <?php if($_POST["sexo_f"]!="") echo("checked"); ?> />
                    <label for="sexo_f">F</label>
                  </p>
                  <p>
                  <input id="sexo_m" name="sexo_m" type="checkbox" onchange="toggle_chckbx(this.value, 'sexo_f');" <?php if($_POST["sexo_m"]!="") echo("checked"); ?> />
                    <label for="sexo_m">M</label>
                  </p>
                </div>
                <div class="col s12 m8">
                  <div class="file-field input-field">
                    <div class="btn" style="background-color: #b0b0b0">
                      <span>Adjunta tu CV</span>
                      <input type="file" id="cv_file" name="cv_file" class="validate" required="" aria-required="true">
                    </div>
                    <div class="file-path-wrapper">
                      <input id="file_n" name="file_n" class="file-path" type="text">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col s12 m12">
              <div class="row" style="margin-left: 12px">
                <div class="input-field col s12" style="margin-top: -12px">
                  <input id="correo_emplea" name="correo_emplea" type="email" type="email" class="validate" required="" aria-required="true" value="<?php echo($_POST["correo_emplea"]); ?>">
                  <label for="correo_emplea" class="black-text" >Email</label>
                </div>
              </div>
            </div>
            <div class="col s12 m4"><p></p></div>
            <div class="col s12 m3">
            </div>
            <div class="col s12 m3">
            </div>
            <div class="col s12 m12 center" style="margin-top: 6px">
              <input name="prcs" id="prcs" type="hidden" value="S" />
              <input name="tprcs" id="tprcs" type="hidden" value="emplea" />          
              <button class="waves-effect waves-light btn" type="submit" style="background-color: #b0b0b0" onclick="return frm_vld_emplea();">Enviar</button>
            </div>

          </form>
        </div>
        <!-- end: Formulario Empléate -->

        <!-- begin: Formulario Contacto -->
        <div class="row">
          <form class="formValidate" id="contacto" name="contacto" method="post" action="" enctype="multipart/form-data">

            <div class="col s12 m12">
              <h4 ><img style="vertical-align: -36px; margin-left: 42px" src="img/contacto/icono_2.png" alt=""> Contacto</h4>
            </div>
            <div class="col s12 m6">
              <div class="row col s12">
                <div class="input-field col s12">
                  <input id="nombre_contac" name="nombre_contac" type="text" class="validate" required="" aria-required="true" value="<?php echo($_POST["nombre_contac"]); ?>">
                  <label for="nombre_contac" class="black-text">Nombre y Apellido</label>
                </div>
              </div>
            </div>
            <div class="col s12 m6">
              <div class="row" style="margin-left: 12px">
                <div class="input-field col s12" >
                  <input id="correo_contac" name="correo_contac" type="email" class="validate" required="" aria-required="true" value="<?php echo($_POST["correo_contac"]); ?>">
                  <label for="correo_contac" class="black-text" >Email</label>
                </div>
              </div>  
            </div>
            <div class="col s12 m12">
              <div class="row">
                <div class="row">
                  <div class="input-field col s12">
                    <textarea id="mensaje" name="mensaje" class="materialize-textarea validate" required="" aria-required="true"><?php echo($_POST["mensaje"]); ?></textarea>
                    <label for="mensaje" class="black-text">Mensaje</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col s12 m12 center" >
              <input name="prcs" id="prcs" type="hidden" value="S" />
              <input name="tprcs" id="tprcs" type="hidden" value="contac" />          
              <button class="waves-effect waves-light btn" type="submit" style="background-color: #b0b0b0">Enviar</button>
            </div>

          </form>
        </div>
        <!-- end: Formulario Contacto -->

      </div>
      <div class="col s12 m4">
        <img src="img/contacto/image.jpg" width="100%" alt="">
      </div>
    </div>
  </div>
  <!-- end: Formularios -->


  <!-- begin: Footer -->
  <?php include_once "inc_footer.php"; ?>
  <!-- end: Footer -->


  <!--  Scripts-->
  <script src="js/jquery-2.1.1.min.js"></script>
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

  <!-- Date Picker -->
  <script>
    $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 120,    // Creates a dropdown of 15 years to control year
      //max: true,          // Limits the date to 'today'

      // The title label to use for the month nav buttons
      labelMonthNext: 'Mes siguiente',
      labelMonthPrev: 'Mes anterior',

      // The title label to use for the dropdown selectors
      labelMonthSelect: 'Seleccione un mes',
      labelYearSelect: 'Seleccione un año',

      // Months and weekdays
      monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
      monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
      weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado' ],
      weekdaysShort: [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],

      // Materialize modified
      weekdaysLetter: [ 'D', 'L', 'M', 'X', 'J', 'V', 'S' ],

      // Today and clear
      today: 'Hoy',
      clear: 'Limpiar',
      close: 'Cerrar',

      //Otros ajustes
      format: 'dd/mm/yyyy',
      formatSubmit: 'dd/mm/yyyy',

      closeOnSelect: true,

      onSet: function( arg ){
        if ( 'select' in arg ){   //prevent closing on selecting month/year
          this.close();
        }
      }

    });
  </script>

  <?php if(isset($_POST["fecha"]) && $_POST["fecha"]!=""){ ?>
  <script>
    var date = new Date(<?php echo(substr($_POST["fecha"], 6, 4).", ".( intval( substr($_POST["fecha"], 3, 2) ) -1 ).", ".substr($_POST["fecha"], 0, 2)); ?>);
    var picker = $('#fecha_emplea').pickadate('picker');
    picker.set('select', date);
  </script>
  <?php } ?>

  <!-- Date Picker -->

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

  <script>
    function toggle_chckbx(vlr, id_dstn){
      $("#"+id_dstn).attr('checked', !vlr);
    }
  </script>

  <!-- Validación Formulario 1 y 2 -->
  <script language="JavaScript">
    function frm_vld_emplea(){
      var mnsj=""

      if( (!document.getElementById("sexo_f").checked) && (!document.getElementById("sexo_m").checked) ) mnsj+=" - Debe seleccionar su Sexo.\n";
      if(document.getElementById("fecha_emplea").value.length==0) mnsj+=" - Debe indicar su Fecha de Nacimiento.\n";

      if(mnsj!=""){
        alert("Debe verificar las siguientes condiciones:\n\n"+mnsj);
      }
      
      if(mnsj!="") return false;

      return true;
    }

    function frm_vld_contac(){
      var mnsj=""


      if(mnsj!=""){
        alert("Debe verificar las siguientes condiciones:\n\n"+mnsj);
      }
      
      if(mnsj!="") return false;

      return true;
    }
  </script>


  <!-- Reportar resultado de envío de Emails -->
  <?php 
  //echo("error [ ".$_SESSION["email_error"]." ] <br>");
  if($_SESSION["email_error"]=="OK"){
    ?>
    <script language="javascript">
      Materialize.toast('<b>Correo enviado exitosamente!</b>', 8000, 'green');
    </script>
    <?php 
  } else if($_SESSION["email_error"]!="" && $_SESSION["email_error"]!="OK"){
    ?>
    <script language="javascript">
      Materialize.toast('<b>No se pudo enviar el Correo, Revise y trate de nuevo!</b>', 8000, 'red');
      alert("Debe verificar las siguientes condiciones:\n\n<?php echo(html_encode($_SESSION["email_error"])); ?>");
    </script>
    <?php 
  }
  $_SESSION["email_error"]="";
  ?>


</body>
</html>
