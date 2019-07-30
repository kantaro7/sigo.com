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
include_once "registro_sigoclub.php";

?>

<!DOCTYPE html>
<html lang="es">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>SIGO</title>

  <!-- CSS  -->
  <link href="css/Material+Icons.css" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/Roboto.css" rel="stylesheet">
  <link href="css/DroidSans.css" rel="stylesheet">
  <link href="css/Dosis.css" rel="stylesheet">
  <link rel="icon" href="favicon.ico" type="image/x-icon"/>
  <link rel="shortcut icon" href="img/fav.png" type="image/x-icon"/>
  <link href="css/Icon.css" rel="stylesheet">

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
      <div class="col s12 m4">
        <img src="img/contacto/image.jpg" width="100%" alt="">
      </div>
      <div class="col s12 m8">

        <!-- begin: Formulario Registro -->
        <div class="row">
          <form class="formValidate" id="empleate" name="empleate" method="post" action="" enctype="multipart/form-data">

            <div class="col s12 m12 l12">
              <div class="row">
                <div class="col s10 m10 l10">
                  <h4><img style="vertical-align: -36px; margin-left: 42px" src="img/contacto/icono_1.png" alt=""> Regístrate en SIGOCLUB</h4>
                </div>
                <div class="input-field col s2 m2 l2">
                  <input type="checkbox" id="validar" name="validar" />
                  <label for="validar">Validación</label>
                </div>
              </div>
             
            </div>
            <div class="col s12 m12 l12">
              <div class="row">
                <div class="input-field col l2 m3 s4">
                  <i class="material-icons prefix tooltipped" data-position="top" data-tooltip="Cedula venezolana natural, juridíca o extranjera"> chrome_reader_mode</i>
                  <select id="tipo" name="tipo" class="validate" required aria-required="true">
                    <option value="V">V</option>
                    <option value="E">E</option>
                    <option value="J">J</option>
                  </select>
                </div>
                <div class="input-field col l7 m6 s5">
                  <input id="cedula" onkeypress="return soloNumeros(event)" name="cedula" type="text" class="validate" required aria-required="true" maxlength="10" minlength="7" value="<?php echo($_POST["cedula"]); ?>">
                  <label for="cedula" class="black-text">Documento de Identidad <span style="color:red">*</span></label>
                </div>
                <div class="input-field col l3 m3 s3">
                  <button id="check" onClick="Buscar()" class="btn waves-effect waves-light" name="check" value="check"><i class="material-icons right">search</i>Buscar</button>
                </div>
              </div>
            </div>
            <div class="col s12 m9 l9">
              <div class="row">
                <div class="input-field col s12 m6 l6">
                  <i class="material-icons prefix tooltipped" data-position="top" data-tooltip="Ambos nombres si los posee">account_circle</i>
                  <input maxlength="20" minlength="3" onkeypress="return soloLetras(event)" id="nombre1" name="nombre1" type="text" class="validate materialize" required="" aria-required="true" value="<?php echo($_POST["nombre1"]); ?>">
                  <label for="nombre1" class="black-text">Primer Nombre <span style="color:red">*</span></label>
                </div>
                <div class="input-field col s12 m6 l6">
                  <input maxlength="20" minlength="3" onkeypress="return soloLetras(event)" id="nombre2" name="nombre2" type="text" value="<?php echo($_POST["nombre2"]); ?>">
                  <label for="nombre2" class="black-text">Segundo Nombre</label>
                </div>
              </div>        
            </div>
            <div class="col s12 m12 l9">
              <div class="row">
                <div class="input-field col s12 m6 l6">
                  <i class="material-icons prefix tooltipped" data-position="top" data-tooltip="Ambos apellidos si los posee">account_circle</i>
                  <input maxlength="20" minlength="3" onkeypress="return soloLetras(event)" id="apellido1" name="apellido1" type="text" class="validate" required="" aria-required="true" value="<?php echo($_POST["apellido1"]); ?>">
                  <label for="apellido1" class="black-text">Primer Apellido <span style="color:red">*</span></label>
                </div>
                <div class="input-field col s12 m6 l6">
                  <input maxlength="20" minlength="3" onkeypress="return soloLetras(event)" id="apellido2" name="apellido2" type="text" value="<?php echo($_POST["apellido2"]); ?>">
                  <label for="apellido2" class="black-text">Segundo Apellido</label>
                </div>
              </div>        
            </div>
            <div class="col s12 m3 l3">
              <div class="row">
                <div class="col s12 m6">
                  <p>
                    <input id="sexo_f" name="sexo_f" type="checkbox" onchange="toggle_chckbx(this.value, 'sexo_m');" <?php if($_POST["sexo_f"]!="") echo("checked"); ?> />
                    <label for="sexo_f">F</label>
                  </p>
                </div>
                <div class="col s12 m6">
                  <p>
                  <input id="sexo_m" name="sexo_m" type="checkbox" onchange="toggle_chckbx(this.value, 'sexo_f');" <?php if($_POST["sexo_m"]!="") echo("checked"); ?> />
                    <label for="sexo_m">M</label>
                  </p>
                </div>
               
              </div>
            </div>
            
            <div class="col s12 m12">
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix tooltipped" data-position="top" data-tooltip="Fecha de nacimiento del usuario (dd/mm/AAAA)">date_range</i>
                  <input id="fecha_emplea" name="fecha_nac" type="text" class="datepicker validate" required aria-required="true">
                  <label for="fecha_emplea" class="black-text">Fecha de Nacimiento <span style="color:red">*</span></label>
                </div>
              </div>
            </div>
            <div class="col s12 m12">
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix tooltipped" data-position="top" data-tooltip="Telefono celular de preferencia (058-4XX.XXX.XX.XX)">phone</i>
                  <input id="telefono" name="telefono" onkeyup="mascara('###-###.###.##.##',this,event,true)" maxlength="17" minlength="17" type="text" class="validate materialize'textarea" required aria-required="true" value="<?php echo($_POST["telefono"]); ?>">
                  <label for="telefono" class="black-text">Numero de Telefono Celular <span style="color:red">*</span></label>
                </div>
              </div>
            </div>
            <div class="col s12 m12">
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix tooltipped" data-position="top" data-tooltip="Opcional: dirección de correo personal (usuarioCorreo12@email.com)">mail</i>
                  <input id="correo" name="correo" type="email" class="validate" value="<?php echo($_POST["correo"]); ?>">
                  <label for="correo" class="black-text" >Email</label>
                </div>
              </div>
            </div>
            <div class="col s12 m12">
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix tooltipped" data-position="top" data-tooltip="Estado,Municipio,Avenida/Calle,Urbanización/Barrio/Sector,Edificio/Casa,N0 Apto/Casa,Punto de referencia">location_on</i>
                  <textarea id="direccion" maxlength="500" minlength="10" data-length="500" name="direccion" class="materialize-textarea validate" required="" aria-required="true"><?php echo($_POST["direccion"]); ?></textarea>
                  <label  for="direccion" class="black-text">Dirección Principal <span style="color:red">*</span></label>
                </div>
              </div>
            </div>
            <input name="prcs" id="prcs" type="hidden" value="S" />   
            <div class="col s12 m12 center" style="margin-top: 6px">
                    
              <button class="btn waves-effect waves-light" type="submit" onclick="return frm_vld_emplea();"><i class="material-icons right">send</i>Registrar</button>
            </div>

          </form>
        </div>
        <!-- end: Formulario SigoClub -->
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
  <script src="js/sweetalert2.js"></script>
  <script src="js/mascara.js"></script>

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
      $('textarea#direccion').characterCounter();
    });
 //Date Picker
    var fecha = new Date();
    $('select').material_select();
    $('#fecha_emplea').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 120,    // Creates a dropdown of 15 years to control year
      //max: true,          // Limits the date to 'today'

      // The title label to use for the month nav buttons
      labelMonthNext: 'Mes siguiente',
      labelMonthPrev: 'Mes anterior',

      // The title label to use for the dropdown selectorsdfdfd mi mama
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
      minDate: new Date(1900,1-1,1), maxDate: '-18Y',
      yearRange: '-110:-18',

      onSet: function(){
        if(validarFormatoFecha($('#fecha_emplea').val())){
          $('#fecha_emplea').removeClass("invalid").addClass("valid");
        }
      }

    });
    
    $('.datepicker').on('mousedown',function(event){
      event.preventDefault();
    })
    function validarFormatoFecha(campo) {
      var RegExPattern = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
      if ((campo.match(RegExPattern)) && (campo!='')) {
            return true;
      } else {
            return false;
      }
    }

    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
    function soloNumeros(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "1234567890";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
    
    $('#telefono').on('change', function(){
      if($('#telefono').val().length < 15){
        $('#telefono').removeClass("valid").addClass("invalid");
      }else{
        $('#telefono').removeClass("invalid").addClass("valid");
      }

    })
    var formatNumber = {
      separador: ".", // separador para los miles
      sepDecimal: ',', // separador para los decimales
      formatear:function (num){
        num +='';
        var splitStr = num.split('.');
        var splitLeft = splitStr[0];
        var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
        var regx = /(\d+)(\d{3})/;
        while (regx.test(splitLeft)) {
        splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
        }
        return this.simbol + splitLeft +splitRight;
        },
        new:function(num, simbol){
        this.simbol = simbol ||'';
        return this.formatear(num);
      }
    }

    $('#cedula').on('keyup', function(){
      var cadena = formatNumber.new($('#cedula').val().replace('.','').replace('.','').replace('.',''));
      $('#cedula').val(cadena);

      if(cadena.length < 7){
        $('#cedula').removeClass("valid").addClass("invalid");
      }else{
         $('#cedula').removeClass("invalid").addClass("valid");
      }
    });

    $('#cedula').on('blur', function(){
      var cadena = formatNumber.new($('#cedula').val().replace('.','').replace('.','').replace('.',''));
      if(cadena.length < 7){
        $('#cedula').removeClass("valid").addClass("invalid");
      }else{
         $('#cedula').removeClass("invalid").addClass("valid");
      }
    });
  </script>

  <?php if(isset($_POST["fecha"]) && $_POST["fecha"]!=""){ ?>
  <script>
    var date = new Date(<?php echo(substr($_POST["fecha_nac"], 6, 4).", ".( intval( substr($_POST["fecha_nac"], 3, 2) ) -1 ).", ".substr($_POST["fecha_nac"], 0, 2)); ?>);
    $('#fecha_emplea').set('select', date);
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
      if(document.getElementById("nombre1").value.length==0) mnsj+=" - Debe indicar su nombre.\n";
      if(document.getElementById("apellido1").value.length==0) mnsj+=" - Debe indicar su apellido.\n";
      if(document.getElementById("cedula").value.length==0) mnsj+=" - Debe indicar su cedula.\n";
      if(document.getElementById("cedula").value.length<7) mnsj+=" - Debe ingresar una cedula valida.\n";
      if(document.getElementById("telefono").value.length==0) mnsj+=" - Debe indicar su telefono celular.\n";
      if(document.getElementById("direccion").value.length==0) mnsj+=" - Debe indicar su direccion.\n";

      if(mnsj!=""){
        swal.fire({
          type: 'warning',
          title: 'Advertencia',
          text: "Debe verificar las siguientes condiciones:\n\n"+mnsj
        })
      }
      
      if(mnsj!="") return false;

      return true;
    }

    function frm_vld_contac(){
      var mnsj=""


      if(mnsj!=""){
        swal.fire({
          type: 'warning',
          title: 'Advertencia',
          text: "Debe verificar las siguientes condiciones:\n\n"+mnsj
        })
        //alert("Debe verificar las siguientes condiciones:\n\n"+mnsj);
      }
      
      if(mnsj!="") return false;

      return true;
    }
  </script>


  <!-- Reportar resultado de envío de Emails -->
  <?php 

  if($_SESSION["save_error"]=="OK"){
    ?>
    <script language="javascript">
      swal.fire({
          type: 'success',
          title: 'Exito',
          text: "Registro almacenado exitosamente"
        })
    </script>
    <?php 
  } else if($_SESSION["save_error"]!="" && $_SESSION["save_error"]!="OK"){
    ?>
    <script language="javascript">
      Materialize.toast('<b>No se pudo guardar el registro, Revise y trate de nuevo!</b>', 8000, 'red');
      swal.fire({
          type: 'warning',
          title: 'Advertencia',
          text: "Debe verificar las siguientes condiciones:\n\n<?php echo(html_encode($_SESSION["save_error"])); ?>"
        })
    </script>
    <?php 
  }
  $_SESSION["save_error"]="";
  ?>


</body>
</html>
