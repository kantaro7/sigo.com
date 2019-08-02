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
  <meta charset="utf-8">
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
                <!-- <div class="input-field col s2 m2 l2">
                  <input type="checkbox" id="validar" name="validar" />
                  <label for="validar">Validación</label>
                </div> -->
              </div>
             
            </div>
            <div class="col s12 m12 l12">
              <div class="row">
                <div class="input-field col l2 m3 s4">
                  <i class="material-icons prefix tooltipped" id="tcedula" data-position="top" data-tooltip="Cédula venezolana natural o extranjera"> chrome_reader_mode</i>
                  <select id="tipo" name="tipo" class="validate" required aria-required="true">
                    <option value="V">V</option>
                    <option value="E">E</option>
                  </select>
                </div>
                <div class="input-field col l7 m6 s5">
                  <input id="cedula" onkeypress="return soloNumeros(event)" name="cedula" type="text" class="validate" required aria-required="true" maxlength="10" minlength="7" value="<?php echo($_POST["cedula"]); ?>">
                  <label for="cedula" class="black-text">Documento de identidad <span style="color:red">*</span></label>
                </div>
                <!-- <div class="input-field col l3 m3 s3">
                  <button id="check" onClick="Buscar()" class="btn waves-effect waves-light" name="check" value="check"><i class="material-icons right">search</i>Buscar</button>
                </div> -->
              </div>
            </div>
            <div class="col s12 m12 l9">
              <div class="row">
                <div class="input-field col s12 m6 l6">
                  <i class="material-icons prefix tooltipped" id="tnombres" data-position="top" data-tooltip="Ambos nombres si los posee">account_circle</i>
                  <input maxlength="20" minlength="3" onkeypress="return soloLetras(event)" id="nombre1" name="nombre1" type="text" class="validate materialize" required="" aria-required="true" value="<?php echo($_POST["nombre1"]); ?>">
                  <label for="nombre1" class="black-text">Primer nombre <span style="color:red">*</span></label>
                </div>
                <div class="input-field col s12 m6 l6">
                  <input maxlength="20" minlength="3" onkeypress="return soloLetras(event)" id="nombre2" name="nombre2" type="text" value="<?php echo($_POST["nombre2"]); ?>">
                  <label for="nombre2" class="black-text">Segundo nombre</label>
                </div>
              </div>        
            </div>
            <div class="col s12 m12 l9">
              <div class="row">
                <div class="input-field col s12 m6 l6">
                  <i class="material-icons prefix tooltipped" id="tapellidos" data-position="top" data-tooltip="Ambos apellidos si los posee">account_circle</i>
                  <input maxlength="20" minlength="3" onkeypress="return soloLetras(event)" id="apellido1" name="apellido1" type="text" class="validate" required="" aria-required="true" value="<?php echo($_POST["apellido1"]); ?>">
                  <label for="apellido1" class="black-text">Primer apellido <span style="color:red">*</span></label>
                </div>
                <div class="input-field col s12 m6 l6">
                  <input maxlength="20" minlength="3" onkeypress="return soloLetras(event)" id="apellido2" name="apellido2" type="text" value="<?php echo($_POST["apellido2"]); ?>">
                  <label for="apellido2" class="black-text">Segundo apellido</label>
                </div>
              </div>        
            </div>
            <div class="col s12 m3 l3">
              <div class="row">
                <div class="col s12 m3">
                  <p>
                    <input id="sexo_f" name="sexo_f" type="checkbox" onchange="toggle_chckbx(this.value, 'sexo_m');" <?php if($_POST["sexo_f"]!="") echo("checked"); ?> />
                    <label for="sexo_f">F</label>
                  </p>
                </div>
                <div class="col s12 m3">
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
                  <i class="material-icons prefix tooltipped" id="tfecha" data-position="top" data-tooltip="Fecha de nacimiento del usuario (dd/mm/AAAA)">date_range</i>
                  <input id="fecha_emplea" name="fecha_nac" type="text" class="datepicker validate" required aria-required="true">
                  <label for="fecha_emplea" class="black-text">Fecha de nacimiento <span style="color:red">*</span></label>
                </div>
              </div>
            </div>
            <div class="col s12 m12">
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix tooltipped" id="ttelefono" data-position="top" data-tooltip="Teléfono celular de preferencia (058-4XX.XXX.XX.XX)">phone</i>
                  <input id="telefono" name="telefono" onkeyup="mascara('###-###.###.##.##',this,event,true)" maxlength="17" minlength="17" type="text" class="validate materialize'textarea" required aria-required="true" value="<?php echo($_POST["telefono"]); ?>">
                  <label for="telefono" class="black-text">Numero de teléfono celular <span style="color:red">*</span></label>
                </div>
              </div>
            </div>
            <div class="col s12 m12">
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix tooltipped" id="tcorreo" data-position="top" data-tooltip="Opcional: dirección de correo personal (usuarioCorreo12@email.com)">mail</i>
                  <input id="correo" name="correo" type="email" class="validate" value="<?php echo($_POST["correo"]); ?>">
                  <label for="correo" class="black-text" >Email</label>
                </div>
              </div>
            </div>
            <div class="col s12 m12">
              <div class="row">
                <div class="input-field col l4 m12 s12">
                <i class="material-icons prefix tooltipped" id="testado" data-position="top" data-tooltip="Estado, Municipio, Ciudad">location_on</i>
                  <select name="estado" id="estado" required aria-required="true">
                    <option value="0" disabled selected>Seleccione una opción</option>
                    <option value="1">Amazonas</option>
                    <option value="2">Anzoátegui</option>
                    <option value="3">Apure</option>
                    <option value="4">Aragua</option>
                    <option value="5">Barinas</option>
                    <option value="6">Bolívar</option>
                    <option value="7">Carabobo</option>
                    <option value="8">Cojedes</option>
                    <option value="9">Delta Amacuro</option>
                    <option value="25">Dependencias Federales</option>
                    <option value="24">Distrito Capital</option>
                    <option value="10">Falcón</option>
                    <option value="11">Guárico</option>
                    <option value="12">Lara</option>
                    <option value="13">Mérida</option>
                    <option value="14">Miranda</option>
                    <option value="15">Monagas</option>
                    <option value="16">Nueva Esparta</option>
                    <option value="17">Portuguesa</option>
                    <option value="18">Sucre</option>
                    <option value="19">Táchira</option>
                    <option value="20">Trujillo</option>
                    <option value="21">Vargas</option>
                    <option value="22">Yaracuy</option>
                    <option value="23">Zulia</option>
                  </select>
                  <label>Estado <span style="color:red">*</span></label>
                </div>
                <div class="input-field col l4 m12 s12">
                  <select name="municipio" id="municipio" required aria-required="true">
                    <option value="0" disabled selected>Seleccione una opción</option>
                  </select>
                  <label>Municipio <span style="color:red">*</span></label>
                </div>
                <div class="input-field col l4 m12 s12">
                  <select name="parroquia" id="parroquia" required aria-required="true">
                    <option value="0" disabled selected>Seleccione una opción</option>
                  </select>
                  <label>Parroquia <span style="color:red">*</span></label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col l4 m12 s12">
                 <i class="material-icons prefix tooltipped" id="tciudad" data-position="top" data-tooltip="Ciudad, Zona residencial, Tipo de residencia">location_on</i>
                  <select name="ciudad" id="ciudad" required aria-required="true">
                    <option value="0" disabled selected>Seleccione una opción</option>
                  </select>
                  <label>Ciudad <span style="color:red">*</span></label>
                </div>
                <div class="input-field col l4 m6 s12">
                  <select name="zona" id="zona" required aria-required="true">
                    <option value="0" disabled selected>Seleccione una opción</option>
                     <?php
                        foreach($zona as $zo){
                          $cadenaZo = '<option value="'.$zo['id'].'">'.utf8_decode($zo['nombre']).'</option>';
                          var_dump($cadenaZo);
                        }
                     ?>
                  </select>
                  <label>Zona residencial <span style="color:red">*</span></label>
                </div>
                <div class="input-field col l4 m6 s12">
                  <select name="vivienda" id="vivienda" required aria-required="true">
                  <option value="0" disabled selected>Seleccione una opción</option>
                  <?php
                      foreach($vivienda as $vivi){
                        $cadenaVivi = '<option value="'.$vivi['id'].'">'.utf8_decode($vivi['nombre']).'</option>';
                        var_dump($cadenaVivi);
                      }
                    ?>
                  </select>
                  <label>Tipo de residencia <span style="color:red">*</span></label>
                </div>
              </div>
            </div>
            <div class="col s12 m12">
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix tooltipped" id="tdireccion" data-position="top" data-tooltip="Edificio/Casa, N° Apto/Casa, Punto de referencia">location_on</i>
                  <textarea id="direccion" maxlength="500" minlength="10" data-length="500" name="direccion" class="materialize-textarea validate" required="" aria-required="true"><?php echo($_POST["direccion"]); ?></textarea>
                  <label for="direccion" class="black-text">Detalles de la dirección <span style="color:red">*</span></label>
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
  <script src="js/jquery.validate.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/sweetalert2.js"></script>
  <script src="js/mascara.js"></script>
  <script src="js/moment.js"></script>
  <!-- <script src="js/datePicker.js"></script> -->

  <!-- inicio slider-->
  <script>
    $(document).ready(function(){
      $('.slider').slider({full_width: true});
    });        
  </script>
  <!-- fin slider-->

<script type="text/javascript">
$(document).ready(function(){

  $('#cedula').on('focus',function(){
    $('#tcedula').trigger('mouseover');
  });
  $('#cedula').on('blur',function(){
    $('#tcedula').trigger('mouseout');
  });

  $('#nombre1').on('focus',function(){
    $('#tnombres').trigger('mouseover');
  });
  $('#nombre1').on('blur',function(){
    $('#tnombres').trigger('mouseout');
  });

  $('#nombre2').on('focus',function(){
    $('#tnombres').trigger('mouseover');
  });
  $('#nombre2').on('blur',function(){
    $('#tnombres').trigger('mouseout');
  });

  $('#apellido1').on('focus',function(){
    $('#tapellidos').trigger('mouseover');
  });
  $('#apellido1').on('blur',function(){
    $('#tapellidos').trigger('mouseout');
  });

  $('#apellido2').on('focus',function(){
    $('#tapellidos').trigger('mouseover');
  });
  $('#apellido2').on('blur',function(){
    $('#tapellidos').trigger('mouseout');
  });

  $('#telefono').on('focus',function(){
    $('#ttelefono').trigger('mouseover');
  });
  $('#telefono').on('blur',function(){
    $('#ttelefono').trigger('mouseout');
  });

  $('#correo').on('focus',function(){
    $('#tcorreo').trigger('mouseover');
  });
  $('#correo').on('blur',function(){
    $('#tcorreo').trigger('mouseout');
  });

  $('#direccion').on('focus',function(){
    $('#tdireccion').trigger('mouseover');
  });
  $('#direccion').on('blur',function(){
    $('#tdireccion').trigger('mouseout');
  });

  
    $('#estado').on('change',function(){
      console.log($(this).val());
        var estadoID = $(this).val();
        if(estadoID){
            $.ajax({
                type:'POST',
                encoding:"UTF-8",
                url:'ajaxMunicipio.php',
                data:'id='+estadoID,
                success:function(html){
                    $('#municipio').html(html);
                    console.log(html);
                    document.getElementById('parroquia').value=0;
                    $('select').material_select();
                }
            }); 
          }
    });
    
    $('#estado').on('change',function(){
      console.log($(this).val());
        var estadoID = $(this).val();
        if(estadoID){
            $.ajax({
                type:'POST',
                encoding:"UTF-8",
                url:'ajaxCiudad.php',
                data:'id='+estadoID,
                success:function(html){
                    $('#ciudad').html(html);
                    $('select').material_select();
                }
            }); 
          }
    });

    $('#municipio').on('change',function(){
        var municipioID = $(this).val();
        if(municipioID){
            $.ajax({
                type:'POST',
                encoding:"UTF-8",
                url:'ajaxParroquia.php',
                data:'id='+municipioID,
                success:function(html){
                    $('#parroquia').html(html);
                    $('select').material_select();
                }
            }); 
          }
    });
});
</script>

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
      selectYears: 150,    // Creates a dropdown of 15 years to control year
      max: true,          // Limits the date to 'today'

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

      onSet: function(){
        if(validarFormatoFecha($('#fecha_emplea').val())){
          $('#fecha_emplea').removeClass("invalid").addClass("valid");
        }
      }

    });


///////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////

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

    function validarFecha(fecha){
      if(fecha.length==0){
        return false;
      }
      var fechanacimiento = moment(fecha, "DD-MM-YYYY");
      if(!fechanacimiento.isValid())
          return false;
      var years = moment().diff(fechanacimiento, 'years');
      console.log(years);
      return years > 18;
    }

    function frm_vld_emplea(){
      var mnsj=""
      
      if(document.getElementById("cedula").value.length==0) mnsj+=" - Debe indicar su cédula.<br>";
      if(document.getElementById("cedula").value.length<7) mnsj+=" - Debe ingresar una cédula válida.<br>";
      if(document.getElementById("nombre1").value.length==0) mnsj+=" - Debe indicar su nombre.<br>";
      if(document.getElementById("apellido1").value.length==0) mnsj+=" - Debe indicar su apellido.<br>";
      if( (!document.getElementById("sexo_f").checked) && (!document.getElementById("sexo_m").checked) ) mnsj+=" - Debe seleccionar su sexo.<br>";
      if(document.getElementById("fecha_emplea").value.length==0) mnsj+=" - Debe indicar su fecha de nacimiento.<br>";
      if(!validarFecha(document.getElementById("fecha_emplea").value)) mnsj+=" - Debe ser mayor de edad.<br>";
      if(document.getElementById("telefono").value.length==0) mnsj+=" - Debe indicar su teléfono celular.<br>";
      if(document.getElementById("estado").value==0) mnsj+=" - Debe indicar un estado.<br>";
      if(document.getElementById("municipio").value==0) mnsj+=" - Debe indicar un municipio.<br>";
      if(document.getElementById("parroquia").value==0) mnsj+=" - Debe indicar una parroquia.<br>";
      if(document.getElementById("ciudad").value==0) mnsj+=" - Debe indicar una ciudad.<br>";
      if(document.getElementById("zona").value==0) mnsj+=" - Debe indicar una zona residencial.<br>";
      if(document.getElementById("vivienda").value==0) mnsj+=" - Debe indicar su tipo de vivienda.<br>";
      if(document.getElementById("direccion").value.length==0) mnsj+=" - Debe indicar los detalles de su dirección.<br>";
      if(document.getElementById("direccion").value.length<10) mnsj+=" - Debe indicar su dirección más detallada.<br>";

      if(mnsj!=""){
        swal.fire({
          type: 'warning',
          title: 'Advertencia',
          html: "Debe verificar las siguientes condiciones:<br>"+mnsj
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
          html: "Debe verificar las siguientes condiciones:<br>"+mnsj
        })
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
          title: 'Éxito',
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
          html: "Debe verificar las siguientes condiciones:<br/><?php echo(html_encode($_SESSION["save_error"])); ?>"
        })
    </script>
    <?php 
  }
  $_SESSION["save_error"]="";
  ?>


</body>
</html>
