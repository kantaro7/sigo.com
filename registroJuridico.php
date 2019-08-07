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
$db_pdo = new PDO("mysql:host=$host;dbname=$base", $user, $pass);

//Establecer variable random para evitar cache de fotos
$random = md5(uniqid(rand(), 1));
if (isset($_POST['usuario'])) {
  $usuarioLog = $_POST['usuario'];
} else {
  $usuarioLog = 0;
}
//Indicador de Lenguaje
$lng = "esp";

//Indicador de Menú
$act_menu = 0;
//Configuración de Footer
$ftr_clr = "page-footer #b71c1c red darken-4";
$ftr_img = "img/producto/sigo_rojo.png";

//Incorporar Emisión de Emails
include_once "registro_empresas.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
  <title>SIGO</title>

  <!-- CSS  -->
  <link href="css/Material+Icons.css" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="css/Roboto.css" rel="stylesheet">
  <link href="css/DroidSans.css" rel="stylesheet">
  <link href="css/Dosis.css" rel="stylesheet">
  <link href="css/ResponsiveTotal.css" rel="stylesheet">
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="img/fav.png" type="image/x-icon" />
  <link href="css/Icon.css" rel="stylesheet">
  <style type="text/css">
    .swal2-select {
      display: none !important;
    }
  </style>
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
      <div class="col s12 m4" id="imagenContactoDiv">
        <img src="img/contacto/image.jpg" width="100%" alt="">
      </div>
      <div class="col s12 m8">

        <!-- begin: Formulario Registro -->
        <div class="row">
          <form class="formValidate" id="empleate" name="empleate" method="post" action="" enctype="multipart/form-data">

            <div class="col s12 m12 l12">
              <div class="row" style="display:flex;">
                <div class="col s10 m10 l10" id="sigoclub">
                  <h4>
                    <img style="vertical-align: -36px; margin-left: 42px" src="img/contacto/icono_1.png" alt="">
                    <span> Regístrate en SIGOCLUB (Empresas) </span>
                  </h4>
                </div>
                <div class="input-field col s2 m2 l2" id="checkValDiv" style="display:none;">
                  <input type="checkbox" id="validar" name="validar" />
                  <label for="validar">Validación</label>
                </div>
                <input name="usuario" id="usuario" type="hidden" value="0" />
              </div>
            </div>
            <div class="col s12 m12 l12">
              <div class="row" id="cedulaRow">
                <div class="input-field col l2 m3 s12">
                  <i class="material-icons prefix tooltipped" id="trif" data-position="top" data-tooltip="Documento de identidad de la empresa"> chrome_reader_mode</i>
                  <select id="tipo" name="tipo" class="validate" aria-required="true">
                    <optgroup label="Empresa">
                      <option <?php echo (($_GET["tipo"] == "Ve") ? "selected" : ""); ?> value="Ve">V</option>
                      <option <?php echo (($_GET["tipo"] == "J") ? "selected" : ""); ?> value="J">J</option>
                      <option <?php echo (($_GET["tipo"] == "G") ? "selected" : ""); ?> value="G">G</option>
                    </optgroup>
                    <optgroup label="Persona Natural">
                      <option <?php echo (($_GET["tipo"] == "V") ? "selected" : ""); ?> value="V">V</option>
                      <option <?php echo (($_GET["tipo"] == "E") ? "selected" : ""); ?> value="E">E</option>
                    </optgroup>
                  </select>
                </div>
                <div class="input-field col l7 m6 s10 offset-s2">
                  <input id="rif" onkeyup="mascara('########-#',this,event,true)" name="rif" type="text" class="validate" aria-required="true" maxlength="10" minlength="7" value="<?php echo ($_POST["rif"]); ?>">
                  <label id="rifLabel" for="rif" class="black-text">Rif <span style="color:red">*</span></label>
                </div>
                <div class="input-field col l3 m3 s3" id="checkBuscarDiv" style="display:none;">
                  <a id="check" class="btn waves-effect waves-light" name="check" value="check"><i class="material-icons right">search</i>Buscar</a>
                </div>
              </div>
            </div>
            <div class="col s12 m12 l12">
              <div class="row">
                <div class="input-field col s12 m12 l12">
                  <i class="material-icons prefix tooltipped" id="trazonSocial" data-position="top" data-tooltip="Razón social de la empresa">account_circle</i>
                  <input maxlength="80" minlength="3" id="razonSocial" name="razonSocial" type="text" class="validate materialize" aria-required="true" value="<?php echo ($_POST["razonSocial"]); ?>">
                  <label id="razonSocialLabel" for="razonSocial" class="black-text">Razón social <span style="color:red">*</span></label>
                </div>
              </div>
            </div>
            <div class="col s12 m12 l12">
              <div class="row">
                <div class="input-field col s12 m12 l12">
                  <i class="material-icons prefix tooltipped" id="trazonComercial" data-position="top" data-tooltip="Razón comercial de la empresa">account_circle</i>
                  <input maxlength="80" minlength="3" id="razonComercial" name="razonComercial" type="text" class="validate" aria-required="true" value="<?php echo ($_POST["razonComercial"]); ?>">
                  <label id="razonComercialLabel" for="razonComercial" class="black-text">Razón comercial <span style="color:red">*</span></label>
                </div>
              </div>
            </div>
            <div class="col s12 m12">
              <div class="row">
                <div class="input-field col l6 m12 s12">
                  <i class="material-icons prefix tooltipped" id="testado" data-position="top" data-tooltip="Estado, Municipio">location_on</i>
                  <select name="estado" id="estado" aria-required="true">
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
                <div class="input-field col l6 m11 offset-m1 s10 offset-s2">
                  <select name="municipio" id="municipio" aria-required="true">
                    <option value="0" disabled selected>Seleccione una opción</option>
                  </select>
                  <label>Municipio <span style="color:red">*</span></label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col l6 m12 s12">
                  <i class="material-icons prefix tooltipped" id="tciudad" data-position="top" data-tooltip="Ciudad, Parroquia">location_on</i>
                  <select name="ciudad" id="ciudad" aria-required="true">
                    <option value="0" disabled selected>Seleccione una opción</option>
                  </select>
                  <label>Ciudad <span style="color:red">*</span></label>
                </div>
                <div class="input-field col l6 m11 offset-m1 s10 offset-s2">
                  <select name="parroquia" id="parroquia" aria-required="true">
                    <option value="0" disabled selected>Seleccione una opción</option>
                  </select>
                  <label>Parroquia <span style="color:red">*</span></label>
                </div>
              </div>
            </div>
            <div class="col s12 m12">
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix tooltipped" id="tdireccion" data-position="top" data-tooltip="Dirección detallada de la empresa">location_on</i>
                  <textarea id="direccion" maxlength="500" minlength="10" data-length="500" name="direccion" class="materialize-textarea validate" aria-required="true"><?php echo ($_POST["direccion"]); ?></textarea>
                  <label id="direccionLabel" for="direccion" class="black-text">Detalles de la dirección <span style="color:red">*</span></label>
                </div>
              </div>
            </div>
            <div class="col s12 m6 l6">
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix tooltipped" id="ttelefono" data-position="top" data-tooltip="Teléfono de preferencia (058-4XX.XXX.XX.XX)">phone</i>
                  <input id="telefono1" name="telefono1" onkeyup="mascara('###-###.###.##.##',this,event,true)" maxlength="17" minlength="17" type="text" class="validate materialize'textarea" aria-required="true" value="<?php echo ($_POST["telefono1"]); ?>">
                  <label id="telefono1Label" for="telefono1" class="black-text">Número de teléfono <span style="color:red">*</span></label>
                </div>
              </div>
            </div>
            <div class="col s12 m6 l6">
              <div class="row">
                <div class="input-field col l12 s10 offset-s2">
                  <input id="telefono2" name="telefono2" onkeyup="mascara('###-###.###.##.##',this,event,true)" maxlength="17" minlength="17" type="text" class="materialize'textarea" value="<?php echo ($_POST["telefono2"]); ?>">
                  <label id="telefono2Label" for="telefono2" class="black-text">Número de teléfono</label>
                </div>
              </div>
            </div>
            <!-- ///////////////////////////////////////   -->
            <div class="col s12 m12 l12">
              <div class="row" style="margin-bottom: 0px;">
                <input name="rep" id="rep" type="hidden" value="0" />
                <input name="auxCedrep" id="auxCedrep" type="hidden" value="" />
                <div class="col l12 m12 s12" style="margin-left: 45px;">
                  <h6 class="black-text">Representante legal</h6>
                </div>
              </div>
              <div class="row">
                <div class="input-field col l2 m3 s12">
                  <i class="material-icons prefix tooltipped" id="tcedularl" data-position="top" data-tooltip="Cédula venezolana natural o extranjera"> chrome_reader_mode</i>
                  <select id="tipo1" name="tipo1">
                    <option <?php echo (($_GET["tipo"] == "V") ? "selected" : ""); ?> value="V">V</option>
                    <option <?php echo (($_GET["tipo"] == "E") ? "selected" : ""); ?> value="E">E</option>
                  </select>
                </div>
                <div class="input-field col l7 m6 s12">
                  <input id="cedularl" onkeypress="return soloNumeros(event)" name="cedularl" type="text" maxlength="10" minlength="7" value="<?php echo ($_POST["cedularl"]); ?>">
                  <label id="cedularlLabel" for="cedularl" class="black-text">Documento de identidad <span style="color:red">*</span></label>
                </div>
                <div class="input-field col l1 m1 s12" id="checkrlPadre">
                  <a id="checkrl" class="btn waves-effect waves-light" name="checkrl" value="checkrl" disabled="disabled"><i class="material-icons right" style="margin: 0 auto;">search</i></a>
                </div>
              </div>
              <div class="row" id="datosRepresentanteRow" style="display:none;">
                <div class="col l12 m12 s12">
                  <div class="row">
                    <div class="col l6 m6 s6 input-field">
                      <input id="datosRepresentanteNombre" name="datosRepresentanteNombre" type="text" maxlength="10" minlength="7" disabled="disabled">
                      <label for="datosRepresentanteNombre" id="datosRepresentanteNombreLabel">Nombre </label>
                    </div>
                    <div class="col l6 m6 s6 input-field">
                      <input id="datosRepresentanteApellido" name="datosRepresentanteApellido" type="text" maxlength="10" minlength="7" disabled="disabled">
                      <label for="datosRepresentanteApellido" id="datosRepresentanteApellidoLabel">Apellido </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col s12 m12 l12">
              <div class="row" style="margin-bottom: 0px;">
                <input name="aut1" id="aut1" type="hidden" value="0" />
                <input name="auxCedpa1" id="auxCedpa1" type="hidden" value="" />
                <div class="col l12 m12 s12" style="margin-left: 45px;">
                  <h6 class="black-text">Personal autorizado 1</h6>
                </div>
              </div>
              <div class="row">
                <div class="input-field col l2 m3 s12">
                  <i class="material-icons prefix tooltipped" id="tcedulapa1" data-position="top" data-tooltip="Cédula venezolana natural o extranjera"> chrome_reader_mode</i>
                  <select id="tipo2" name="tipo2">
                    <option <?php echo (($_GET["tipo"] == "V") ? "selected" : ""); ?> value="V">V</option>
                    <option <?php echo (($_GET["tipo"] == "E") ? "selected" : ""); ?> value="E">E</option>
                  </select>
                </div>
                <div class="input-field col l7 m6 s12">
                  <input id="cedulapa1" onkeypress="return soloNumeros(event)" name="cedulapa1" type="text" maxlength="10" minlength="7" value="<?php echo ($_POST["cedulapa1"]); ?>">
                  <label id="cedulapa1Label" for="cedulapa1" class="black-text">Documento de identidad </label>
                </div>
                <div class="input-field col l3 m3 s12" id="checkpa1Padre">
                  <a id="checkpa1" class="btn waves-effect waves-light" name="checkpa1" value="checkpa1" disabled="disabled"><i class="material-icons right" style="margin: 0 auto;">search</i></a>
                </div>
              </div>
              <div class="row" id="datosAutorizado1Row" style="display:none;">
                <div class="col l12 m12 s12">
                  <div class="row">
                    <div class="col l4 m4 s4 input-field">
                      <input id="datoAutorizado1Nombre" name="datoAutorizado1Nombre" type="text" maxlength="10" minlength="7" disabled="disabled">
                      <label for="datoAutorizado1Nombre" id="datoAutorizado1NombreLabel">Nombre </label>
                    </div>
                    <div class="col l4 m4 s4 input-field">
                      <input id="datosAutorizado1Apellido" name="datosAutorizado1Apellido" type="text" maxlength="10" minlength="7" disabled="disabled">
                      <label for="datosAutorizado1Apellido" id="datosAutorizado1ApellidoLabel">Apellido </label>
                    </div>
                    <div class="col l4 m4 s4 input-field">
                      <input id="datosAutorizado1Tlf" name="datosAutorizado1Tlf" type="text" maxlength="10" minlength="7" disabled="disabled">
                      <label for="datosAutorizado1Tlf" id="datosAutorizado1TlfLabel">Teléfono </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col s12 m12 l12">
              <div class="row" style="margin-bottom: 0px;">
                <input name="aut2" id="aut2" type="hidden" value="0" />
                <input name="auxCedpa2" id="auxCedpa2" type="hidden" value="" />
                <div class="col l12 m12 s12" style="margin-left: 45px;">
                  <h6 class="black-text">Personal autorizado 2</h6>
                </div>
              </div>
              <div class="row">
                <div class="input-field col l2 m3 s12">
                  <i class="material-icons prefix tooltipped" id="tcedulapa2" data-position="top" data-tooltip="Cédula venezolana natural o extranjera"> chrome_reader_mode</i>
                  <select id="tipo3" name="tipo3">
                    <option <?php echo (($_GET["tipo"] == "V") ? "selected" : ""); ?> value="V">V</option>
                    <option <?php echo (($_GET["tipo"] == "E") ? "selected" : ""); ?> value="E">E</option>
                  </select>
                </div>
                <div class="input-field col l7 m6 s12">
                  <input id="cedulapa2" onkeypress="return soloNumeros(event)" name="cedulapa2" type="text" maxlength="10" minlength="7" value="<?php echo ($_POST["cedulapa2"]); ?>">
                  <label id="cedulapa2Label" for="cedulapa2" class="black-text">Documento de identidad </label>
                </div>
                <div class="input-field col l3 m3 s12" id="checkpa2Padre">
                  <a id="checkpa2" class="btn waves-effect waves-light" name="checkpa2" value="checkpa2" disabled="disabled"><i class="material-icons right" style="margin: 0 auto;">search</i></a>
                </div>
              </div>
              <div class="row" id="datosAutorizado2Row" style="display:none;">
                <div class="col l12 m12 s12">
                  <div class="row">
                    <div class="col l4 m4 s4 input-field">
                      <input id="datoAutorizado2Nombre" name="datoAutorizado2Nombre" type="text" maxlength="10" minlength="7" disabled="disabled">
                      <label for="datoAutorizado2Nombre" id="datoAutorizado2NombreLabel">Nombre </label>
                    </div>
                    <div class="col l4 m4 s4 input-field">
                      <input id="datosAutorizado2Apellido" name="datosAutorizado2Apellido" type="text" maxlength="10" minlength="7" disabled="disabled">
                      <label for="datosAutorizado2Apellido" id="datosAutorizado2ApellidoLabel">Apellido </label>
                    </div>
                    <div class="col l4 m4 s4 input-field">
                      <input id="datosAutorizado2Tlf" name="datosAutorizado2Tlf" type="text" maxlength="10" minlength="7" disabled="disabled">
                      <label for="datosAutorizado2Tlf" id="datosAutorizado2TlfLabel">Teléfono </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ///////////////////////////////////////   -->

            <input name="prcs" id="prcs" type="hidden" value="S" />
            <!-- ///////////////////////////////////////   -->
            <div class="row" id="terminosRow">
              <div class="col s12 m12 center" style="margin-top: 6px">
                <a class="waves-effect waves-light btn modal-trigger" data-target="condiciones">Ver términos y condiciones</a>
                <div class="input-field col s12 m12 l12">
                  <input type="checkbox" id="okCondiciones" name="okCondiciones" value="false" />
                  <label id="okCondicionesLabel" for="okCondiciones">He leído, entendido y aceptado los términos y condiciones aquí establecidos</label>
                </div>
              </div>
            </div>
            <!-- ///////////////////////////////////////   -->
            <div class="row" id="#divRegistrar">
              <div class="col s12 m12 center" style="margin-top: 6px">
                <button class="btn waves-effect waves-light" id="registrar" type="submit" onclick="return frm_vld_emplea();" disabled="disabled"><i class="material-icons right">send</i>Registrar</button>
              </div>
            </div>

          </form>
        </div>
        <!-- end: Formulario SigoClub -->
      </div>

    </div>
  </div>
  <!-- end: Formularios -->

  <!-- ///////////////////////////////////////   -->
  <div id="condiciones" class="modal" style="text-align: justify;">
    <div class="modal-content">
      <h5 style="text-align:center;">TÉRMINOS Y CONDICIONES DE AFILIACIÓN AL PROGRAMA “SIGO CLUB”</h5>
      <div>
        <br><br> Estos términos y condiciones regulan la afiliación de los clientes en el programa SIGO CLUB, y a su vez la compra en los establecimientos SIGO PRECIOS BAJOS CERCA DE TI. Los cuales comprenden los siguientes aspectos:
        <br><br> A. Generalidades
        <br><br> La actividad de los clientes afiliados al programa SIGO CLUB se regirá por estos Términos y Condiciones, por lo que cualquier persona interesada en adquirir productos a bajos costos en los establecimientos SIGO PRECIOS BAJOS CERCA DE TI, deberá aceptar estos Términos y Condiciones; los cuales tienen carácter vinculante.

        <br><br> B. Definiciones

        <br><br> A fin de facilitar una correcta comprensión de los términos que son utilizados, se detalla a continuación la definición de aquellos que son especialmente relevantes:
        <br>a. SIGO CLUB es un programa que va dirigido a todos nuestros clientes, cuyo propósito es compensar la fidelidad y lealtad con la organización SIGO, S.A., en el que el afiliado podrá adquirir productos a bajos costos en los establecimientos SIGO PRECIOS BAJOS CERCA DE TI.
        <br>b. Clientes SIGO CLUB son aquellas personas naturales y jurídicas, que previo cumplimiento de los requisitos de afiliación, se encuentran autorizados a la compra o adquisición de productos en las tiendas o establecimientos “SIGO PRECIOS BAJOS CERCA DE TI”.
        <br>c. SIGO PRECIOS BAJOS CERCA DE TI son establecimientos comerciales en los suburbios de la región insular (en las zonas más alejadas y necesitadas del territorio neoespartano), en el cual las personas de dichas localidades podrán comprar productos a precios más económicos, que los estándares del mercado nacional.
        <br>d. SIGO CRÉDITOS es una herramienta a favor de los Clientes SIGO CLUB, para abonar cantidades de dinero a una cuenta asociada al número de cédula del Cliente SIGO CLUB, a través del depósito bancario o abono por transferencia electrónica a las cuentas de SIGO, S.A., dicho monto será acreditado a su cuenta personal y podrá ser canjeado a través de las tiendas y/o sucursales SIGO en el territorio insular.

        <br><br>C. Declaraciones

        <br><br>a. SIGO PRECIOS BAJOS CERCA DE TI es un programa de la exclusiva propiedad de la sociedad mercantil SIGO, S.A. (en adelante denominada SIGO).
        <br>b. SIGO manifiesta que la afiliación al programa SIGO CLUB, corresponde exclusivamente a los clientes que cumplan con los requisitos de afiliación, y que sean aprobados por el comité de afiliación.
        <br>c. SIGO se reserva el derecho de modificar el contenido del programa de afiliación SIGO CLUB, ya sea en forma permanente o transitoria, sin aviso previo y/o consentimiento de los Clientes SIGO CLUB, en cualquier momento y a su exclusivo criterio.

        <br><br>D. Registro de los Clientes SIGO CLUB

        <br><br>La afiliación a SIGO CLUB, se realiza gratuitamente a través de la página web www.sigo.com.ve, los interesados deberán completar el formulario de afiliación establecido en dicho sitio web.
        <br>Las personas interesadas deberán realizar su registro o afiliación de forma personal, asimismo deberán cumplir con los requisitos de afiliación al Programa SIGO CLUB, previa aprobación del comité de afiliación. La aceptación de las solicitudes de registro es una decisión exclusiva de SIGO, quien en cualquier momento podrá determinar el rechazo o cancelación de la afiliación, por situaciones como: brindar información falsa en el registro, realizar actos o acciones que vulneren y/o afecten las instalaciones de la empresa, su operación o las normas legales en general; estar vinculado en investigaciones penales en contra de SIGO, entre otras.
        <br>Toda la información que los clientes proporcionen al momento de su registro deberá ser verdadera, exacta y completa. Los clientes son los únicos y exclusivos responsables de la información que brindan y de las consecuencias que generen con la inexactitud o falsedad de la información suministrada.

        <br><br>E. Procedimiento de compra en los establecimientos “SIGO PRECIOS BAJOS CERCA DE TI”.
        <br><br>La compra o adquisición de productos en los establecimientos “SIGO PRECIOS BAJOS CERCA DE TI”, se realizará de la siguiente forma:

        <br><br>a. El Cliente SIGO CLUB deberá presentar su cédula de identidad laminada.
        <br>b. El Cliente SIGO CLUB podrá pagar su compra de una manera rápida, cómoda y segura, con tarjetas de débito, a través de puntos de venta y SIGO CRÉDITOS.
        <br>c. No será aceptado el pago en dinero efectivo, ello en aras de incentivar las medidas del ejecutivo nacional del uso e implementación de la banca electrónica y pago a través de puntos de venta, y como una medida de seguridad y reducción de robos en general contra los establecimientos, clientes, trabajadores y población aledaña a las tiendas o establecimientos “SIGO PRECIOS BAJOS CERCA DE TI”.
        <br>d. No existen limitantes en cuanto a la cantidad del monto abonar en el programa SIGO CRÉDITOS. Asimismo los montos acreditados o abonados a SIGO CRÉDITOS, no poseen fecha de vencimiento, por lo que el Cliente SIGO CLUB está en la libertad de disponer de su saldo de acuerdo a sus necesidades de compra.
        <br>e. El Cliente SIGO CLUB deberá realizar personalmente la compra, ya que su afiliación es personal e intransferible.
        <br>f. Para efectos de garantizar la seguridad de los abonos efectuados en el programa SIGO CRÉDITOS, y en aras del bienestar del Cliente SIGO CLUB, solo éste podrá efectuar los consumos acreditados en su cuenta con la presentación de la cédula de Identidad, por lo que el uso de los SIGO CRÉDITOS es intransferible.

        <br><br>F. Privacidad de la Información
        <br><br>La información personal que el Cliente SIGO CLUB proporciona a SIGO cuando realiza la afiliación o al utilizar nuestros página web www.sigo.com.ve para el registro, son considerados datos privados, es decir, no están disponibles al público. SIGO se compromete a no compartir ni revelar esta información, salvo que el Cliente SIGO CLUB autorice a compartir dicha información, o esté obligado legalmente a responder a citaciones judiciales y/o cualquier requerimiento de las autoridades administrativas.

        <br><br>G. Responsabilidades

        <br><br>a. Al realizar la afiliación al programa SIGO CLUB, los Clientes SIGO CLUB aceptan en forma expresa que el registro se realiza bajo su consentimiento y voluntad. Ni SIGO, ni sus directores, empleados o representantes garantizan que el acceso indefinido al programa de afiliación.
        <br>b. Bajo ningún concepto los directores, empleados o representantes de SIGO serán responsables por cualquier daño directo, indirecto, incidental, especial o punitivo que pudiera ser causado por:

        <br><br>i. Daños de cualquier naturaleza a la persona o a la propiedad emergentes de su acceso a las instalaciones de las tiendas o establecimientos “SIGO PRECIOS BAJOS CERCA DE TI”.
        <br>ii. Cualquier interrupción o cese temporal o definitivo del programa SIGO CLUB, que corresponda a fallas en el sistema, como por ejemplo interrupción en la transmisión de datos del Cliente SIGO CLUB y/o SIGO CREDITOS.
        <br>iii. Cualquier acceso no autorizado a nuestros servidores seguros y/o toda información almacenada en dicho servidor.
        <br>iv. El contenido de términos de uso distinto al establecido y publicado en la página web www.sigo.com.ve.
        <br>v. La conducta no adecuada o ilícita de cualquier Cliente SIGO CLUB o sus trabajadores.
        <br>vi. Errores, omisiones, interrupciones, supresiones, defectos, demoras en la operación o transmisión, desperfectos en las líneas de comunicación, robo o destrucción, acceso no autorizado a cualquier comunicación de los Cliente SIGO CLUB o su alteración, ni por errores humanos o acciones deliberadas de terceros que pudieran interrumpir o alterar el normal desarrollo del programa SIGO CLUB.

        <br><br>c. Los Clientes SIGO CULB se comprometen a indemnizar y mantener indemne y libre de daños a SIGO, sus subsidiarias, empresas vinculadas contra toda y cualquier acción o juicio de responsabilidad, reclamo, denuncia, penalidad, intereses, costos, gastos, honorarios y/o multas iniciado por terceros debido a conductas ilícitas o no adecuadas en los establecimientos “SIGO PRECIOS BAJOS CERCA DE TI”.

        <br><br>H. Otras Consideraciones

        <br><br>a. La oferta de los productos en los establecimientos “SIGO PRECIOS BAJOS CERCA DE TI” se encuentra sujeta a la disponibilidad de stock al momento de las compras en las tiendas, así como a la vigencia en las ofertas que establezca SIGO. De esta manera los precios, disponibilidad, y ofertas contenidas en dichas tiendas pueden variar sin previo aviso.
        <br>b. Los clientes afiliados a SIGO CLUB manifiestan que la información que han entregado es de carácter público y corresponde a información estrictamente comercial que no está sujeta a reserva alguna.
        <br>c. SIGO, se reserva el derecho de modificar los Términos y Condiciones, a fin de adaptarlos a nuevos requerimientos establecidos en las leyes y demás normativas que rigen en el país, o por cualquier otro motivo que le permita mejorar el uso del programa SIGO CLUB. Por lo que el Cliente SIGO CLUB, deberá revisar periódicamente estos Términos y Condiciones.
        <br>d. Los presentes Términos y Condiciones se regirán e interpretarán de acuerdo con las leyes de la República Bolivariana de Venezuela. Cualquier controversia que derive de este documento se someterá a los jueces de la jurisdicción del Estado Nueva Esparta.

      </div>
    </div>
    <div class="modal-footer" style="text-align:center;">
      <div class="row">
        <div class="col s12" style="display: flex;">
          <a href="#divRegistrar" class="modal-action modal-close btn waves-effect waves-light" style="margin: 5px auto !important;">Cerrar</a>
        </div>
      </div>
    </div>
  </div>
  <!-- ///////////////////////////////////////   -->


  <!-- begin: Footer -->
  <?php include_once "inc_footer.php"; ?>
  <!-- end: Footer -->

  <!--  Scripts-->
  <script src="js/jquery-2.1.1.min.js"></script>
  <!-- <script src="js/jquery.validate.js"></script> -->
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/sweetalert2.js"></script>
  <script src="js/mascara.js"></script>
  <script src="js/moment.js"></script>
  <!-- <script src="js/datePicker.js"></script> -->

  <!-- inicio slider-->
  <script>
    $(document).ready(function() {
      $('.slider').slider({
        full_width: true
      });
    });
  </script>
  <!-- fin slider-->

  <script type="text/javascript">
    $(document).ready(function() {

      <?php if (isset($_GET['val'])) { ?>
        var validacion = <?php echo ($_GET['val']) ?>;
      <?php } else { ?>
        var validacion = 0;
      <?php } ?>

      <?php if (isset($usuarioLog)) { ?>
        var usuario = <?php echo ($usuarioLog) ?>;
      <?php } else { ?>
        <?php if (isset($_GET['chi'])) { ?>
          var validacion = <?php echo ($_GET['val']) ?>;
        <?php } else { ?>
          var usuario = 0;
        <?php } ?>
      <?php } ?>




      $("#direccion").keypress(function(e) {
        if (e.keyCode != 13) return;
        return false;
      });

      $('#tipo').on('change', function() {
        var tipo = $(this).val();
        if (tipo == "V" && usuario != 0) {
          window.location.href = "registro.php?tipo=V&val=8254327&chi=" + usuario;
        } else if (tipo == "V" && usuario != 0) {
          window.location.href = "registro.php?tipo=E&val=8254327&chi" + usuario;
        } else if (tipo == "V") {
          window.location.href = "registro.php?tipo=V";
        } else if (tipo == "E") {
          window.location.href = "registro.php?tipo=E";
        }
      });




      var cadena22 = formatNumber.new($('#cedulapa2').val().replace('.', '').replace('.', '').replace('.', ''));
      if (cadena22.length < 7 && cadena22.length >= 1) {
        $('#cedulapa2').removeClass("valid").addClass("invalid");
        $('#checkpa2').attr("disabled", "disabled");
      } else {
        $('#cedulapa2').removeClass("invalid").addClass("valid");
        $('#checkpa2').removeAttr("disabled");
      }

      if (cadena22 == "") {
        $('#checkpa2').attr("disabled", "disabled");
      } else {
        $('#checkpa2').removeAttr("disabled");
      }

      cadena22 = formatNumber.new($('#cedulapa1').val().replace('.', '').replace('.', '').replace('.', ''));

      if (cadena22.length < 7 && cadena22.length >= 1) {
        $('#cedulapa1').removeClass("valid").addClass("invalid");
        $('#checkpa1').attr("disabled", "disabled");
      } else {
        $('#cedulapa1').removeClass("invalid").addClass("valid");
        $('#checkpa1').removeAttr("disabled");
      }

      if (cadena22 == "") {
        $('#checkpa1').attr("disabled", "disabled");
      } else {
        $('#checkpa1').removeAttr("disabled");
      }
      cadena22 = formatNumber.new($('#cedularl').val().replace('.', '').replace('.', '').replace('.', ''));

      if (cadena22.length < 7 && cadena22.length >= 1) {
        $('#cedularl').removeClass("valid").addClass("invalid");
        $('#checkrl').attr("disabled", "disabled");
      } else {
        $('#cedularl').removeClass("invalid").addClass("valid");
        $('#checkrl').removeAttr("disabled");
      }

      if (cadena22 == "") {
        $('#checkrl').attr("disabled", "disabled");
      } else {
        $('#checkrl').removeAttr("disabled");
      }

      if (!document.getElementById("okCondiciones").checked) {
        document.getElementById("registrar").disabled = true;
      } else {
        document.getElementById("registrar").disabled = false;
      }

      ////////////////////////
      $('#rif').on('blur', function() {
        if ($("#prcs").val() == "S") {
          var rif = $('#tipo').val() + '-' + $('#rif').val();
          $.ajax({
            type: 'POST',
            encoding: "UTF-8",
            url: 'ajaxEmpresas.php',
            data: 'rif=' + rif,
            async: true,
            success: function(existe) {
              existe = JSON.parse(existe);
              console.log(existe);
              if (existe.length > 1) {
                $('#rif').val('');
                swal.fire({
                  type: 'warning',
                  title: 'Advertencia',
                  html: "Este rif ya existe en el sistema"
                });
              }
            }
          });
        }
      });
      ///// 

      /////     check validar  /////////////////////////
      $('#validar').on('change', function() {

        if ($('#validar').is(':checked')) {
          $("#prcs").val("V");
          swal.fire({
            type: 'warning',
            title: 'Advertencia',
            html: 'Debe ingresar credenciales válidas para continuar.<br>' +
              '<div class="input-field col s2 m2 l2">' +
              ' <input type="text" id="swal-input1" name="swal-input1" maxlength="50" />' +
              ' <label for="swal-input1">Usuario</label>' +
              '</div>' +
              '<div class="input-field col s2 m2 l2">' +
              '  <input type="password" id="swal-input2" name="swal-input2" maxlength="50" />' +
              '  <label for="swal-input2">Contraseña</label>' +
              '</div>' +
              '<label id="error1" style="display:none;">Debe ingresar ambos campos para continuar</label>',
            showConfirmButton: true,
            confirmButtonText: "Continuar",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            allowOutsideClick: false,
            allowEscapeKey: false,
            preConfirm: (login) => {
              var ced = $('#tipo').val() + '-' + $('#cedula').val();
              var user = $("#swal-input1").val();
              var pass = $("#swal-input2").val();
              if (user == "" || pass == "") {
                Swal.showValidationMessage(
                  `Debe ingresar ambos campos para continuar.`
                )
              } else {
                /////////////////////
                $.ajax({
                  type: 'POST',
                  encoding: "UTF-8",
                  url: 'ajaxVerificadores.php',
                  data: {
                    usuario: user,
                    pass: pass
                  },
                  success: function(result2) {
                    console.log(result2);
                    if (result2 != 0) {
                      $('#checkBuscarDiv').attr('style', 'display:block');
                      $('#terminosRow').attr('style', 'display:none');
                      $("#okCondiciones").prop('checked', true);
                      document.getElementById("registrar").disabled = false;
                      $('#registrar').html('<i class="material-icons right">send</i>Validar');
                      $("#usuario").val(result2);
                      usuario = result2;
                    } else {
                      swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: "Credenciales incorrectas"
                      })
                      $("#validar").prop('checked', false);
                    }
                  }
                });
                ////////////////////
              }
            },
          }).then((result) => {
            if (!result.value) {
              $("#validar").prop('checked', false);
              $("#prcs").val("S");
            }
          })
        } else {
          $('#checkBuscarDiv').attr('style', 'display:none');
          $('#terminosRow').attr('style', 'display:block');
          $("#okCondiciones").prop('checked', false);
          document.getElementById("registrar").disabled = true;
          $('#registrar').html('<i class="material-icons right">send</i>Registrar');
          $("#prcs").val("S");
        }
      });

      //////////////////////////////

      $('#condiciones').modal();

      $('#rif').on('focus', function() {
        $('#trif').trigger('mouseover');
      });
      $('#rif').on('blur', function() {
        $('#trif').trigger('mouseout');
      });

      $('#razonSocial').on('focus', function() {
        $('#trazonSocial').trigger('mouseover');
      });
      $('#razonSocial').on('blur', function() {
        $('#trazonSocial').trigger('mouseout');
      });

      $('#razonComercial').on('focus', function() {
        $('#trazonComercial').trigger('mouseover');
      });
      $('#razonComercial').on('blur', function() {
        $('#trazonComercial').trigger('mouseout');
      });

      $('#telefono1').on('focus', function() {
        $('#ttelefono').trigger('mouseover');
        var tel = $('#telefono1').val();
        if (tel == '') {
          $('#telefono1').val('058-').trigger('change');
        }
      });
      $('#telefono1').on('blur', function() {
        $('#ttelefono').trigger('mouseout');
      });
      $('#telefono2').on('focus', function() {
        $('#ttelefono').trigger('mouseover');
        var tel = $('#telefono2').val();
        if (tel == '') {
          $('#telefono2').val('058-').trigger('change');
        }
      });
      $('#telefono2').on('blur', function() {
        $('#ttelefono').trigger('mouseout');
      });

      $('#direccion').on('focus', function() {
        $('#tdireccion').trigger('mouseover');

      });
      $('#direccion').on('blur', function() {
        $('#tdireccion').trigger('mouseout');
      });

      $('#cedularl').on('focus', function() {
        $('#tcedularl').trigger('mouseover');
      });
      $('#cedularl').on('blur', function() {
        $('#tcedularl').trigger('mouseout');
      });

      $('#cedulapa1').on('focus', function() {
        $('#tcedulapa1').trigger('mouseover');
      });
      $('#cedulapa1').on('blur', function() {
        $('#tcedulapa1').trigger('mouseout');
      });

      $('#cedulapa2').on('focus', function() {
        $('#tcedulapa2').trigger('mouseover');
      });
      $('#cedulapa2').on('blur', function() {
        $('#tcedulapa2').trigger('mouseout');
      });

      $('#telefono1').on('blur', function() {
        var telefono = $(this).val();

        if (telefono != $('#telefono2').val()) {
          $.ajax({
            type: 'POST',
            encoding: "UTF-8",
            url: 'ajaxTelefono.php',
            data: 'telefono=' + telefono,
            async: true,
            success: function(existe) {
              if (existe == 1) {
                $('#telefono1').val('');
                swal.fire({
                  type: 'warning',
                  title: 'Advertencia',
                  html: "Este número de teléfono no es válido o ya existe en el sistema"
                });
              }
            }
          });
        } else {
          $('#telefono1').val('');
          swal.fire({
            type: 'warning',
            title: 'Advertencia',
            html: "Los números de teléfono deben ser distintos"
          });
        }
      });

      $('#telefono2').on('blur', function() {
        var telefono = $(this).val();
        if (telefono != $('#telefono1').val()) {
          $.ajax({
            type: 'POST',
            encoding: "UTF-8",
            url: 'ajaxTelefono.php',
            data: 'telefono=' + telefono,
            async: true,
            success: function(existe) {
              if (existe == 1) {
                $('#telefono1').val('');
                swal.fire({
                  type: 'warning',
                  title: 'Advertencia',
                  html: "Este número de teléfono no es válido o ya existe en el sistema"
                });
              }
            }
          });
        } else {
          $('#telefono2').val('');
          swal.fire({
            type: 'warning',
            title: 'Advertencia',
            html: "Los números de teléfono deben ser distintos"
          });
        }
      });



      $('#estado').on('change', function() {
        console.log($(this).val());
        var estadoID = $(this).val();
        if (estadoID) {
          $.ajax({
            type: 'POST',
            encoding: "UTF-8",
            url: 'ajaxMunicipio.php',
            data: 'id=' + estadoID,
            success: function(html) {
              $('#municipio').html(html);
              console.log(html);
              document.getElementById('parroquia').value = 0;
              $('select').material_select();
            }
          });
        }
      });

      $('#estado').on('change', function() {
        console.log($(this).val());
        var estadoID = $(this).val();
        if (estadoID) {
          $.ajax({
            type: 'POST',
            encoding: "UTF-8",
            url: 'ajaxCiudad.php',
            data: 'id=' + estadoID,
            success: function(html) {
              $('#ciudad').html(html);
              $('#ciudad').material_select();
            }
          });
        }
      });

      $('#municipio').on('change', function() {
        var municipioID = $(this).val();
        if (municipioID) {
          $.ajax({
            type: 'POST',
            encoding: "UTF-8",
            url: 'ajaxParroquia.php',
            data: 'id=' + municipioID,
            success: function(html) {
              $('#parroquia').html(html);
              $('#parroquia').material_select();
            }
          });
        }
      });


      $('select').material_select();

      $('#okCondiciones').on('change', function(event) {
        if (!document.getElementById("okCondiciones").checked) {
          document.getElementById("registrar").disabled = true;
        } else {
          document.getElementById("registrar").disabled = false;
        }
      });

      if (validacion == 8254327 && usuario == 0) {
        $('#checkValDiv').removeAttr('style').attr('style', 'display: block;');
        $('#validar').trigger('click');
      } else if (validacion == 8254327 && usuario != 0) {
        $('#checkValDiv').removeAttr('style').attr('style', 'display: block;');
        $('#validar').prop('checked', 'true');
        $('#checkBuscarDiv').attr('style', 'display:block');
        $('#terminosRow').attr('style', 'display:none');
        $("#okCondiciones").prop('checked', true);
        $("#registrar").removeAttr('disabled');
        $('#registrar').html('<i class="material-icons right">send</i>Validar');
        $("#usuario").val(usuario);
        $("#prcs").val("V");
      }
    });


    ///////////////////////////////////////////////////////////////
    /////////////   busqueda para la validacion    ////////////
    $('#check').on('click', function() {
      var rif = $('#tipo').val()[0] + '-' + $('#rif').val();
      var numerosRif = $('#rif').val();

      if (numerosRif == "") {
        swal.fire({
          type: 'warning',
          title: 'Advertencia',
          html: "Ingrese un rif válido para realizar la búsqueda.",
          showConfirmButton: true,
          confirmButtonText: "Si",
        });
      } else {
        if (rif != "") {
          $.ajax({
            type: 'POST',
            encoding: "UTF-8",
            url: 'ajaxEmpresas.php',
            data: 'rif=' + rif,
            success: function(e) {
              e = JSON.parse(e);
              console.log(e);
              if (e.length > 0 && e.length < 4) {
                $("rif").attr('readonly', 'readonly');
                $('#razonSocial').val(e[0].social);
                $('#razonSocialLabel').addClass('active');
                $('#razonComercial').val(e[0].comercial);
                $('#razonComercialLabel').addClass('active');
                console.log(e[0].id_ciudad);
                $.ajax({
                  type: 'POST',
                  encoding: "UTF-8",
                  url: 'ajaxEstado.php',
                  data: 'id=' + e[0].id_parroquia,
                  success: function(a) {
                    a = JSON.parse(a);
                    // estado
                    $('#estado').val(a[0].id_estado).trigger('change');
                    $('select').material_select();
                    // municipio
                    setTimeout(function() {
                      $('#municipio').val(a[0].id_municipio).trigger('change');
                      $('select').material_select();
                      $('#ciudad').val(e[0].id_ciudad).trigger('change');
                      $('select').material_select();
                      setTimeout(function() {
                        $('#parroquia').val(e[0].id_parroquia).trigger('change');
                        $('select').material_select();
                      }, 200);
                    }, 500);
                  }
                });
                $('#direccion').val(decodeURIComponent(escape(e[0].direccion)));
                $('#direccionLabel').addClass('active');
                $('#telefono1').val(e[0].telefono1);
                $('#telefono1Label').addClass('active');
                if (e[0].telefono2 == "" || e[0].telefono2 == "N/A") {
                  $('#telefono2').val("");
                } else {
                  $('#telefono2').val(e[0].telefono2);
                  $('#telefono2Label').addClass('active');
                }

                for (let i = 0; i < e.length; i++) {
                  if (e[i].tipo == 1) {
                    $('#cedularl').val(e[i].cedula.substring(2, e[i].cedula.length));
                    $('#cedularlLabel').addClass('active');
                    $('#checkrl').trigger('click');
                  } else {
                    $('#cedulapa' + i).val(e[i].cedula.substring(2, e[i].cedula.length));
                    $('#cedulapa' + i + 'Label').addClass('active');
                    $('#checkpa' + i).trigger('click');
                  }
                }

                //$('select').material_select();
              } else {
                swal.fire({
                  type: 'warning',
                  title: 'Advertencia',
                  html: "El rif que busca no está registrado.",
                  showConfirmButton: true,
                  confirmButtonText: "Si",
                });
              }
              var resultId = 0;
              return resultId;
            }
          });
        }
      }
    });


    ////////////////////////

    ///////////////////////////////////////////////////////

    function soloLetras(e) {
      key = e.keyCode || e.which;
      tecla = String.fromCharCode(key).toLowerCase();
      letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
      especiales = "8-37-39-46";

      tecla_especial = false
      for (var i in especiales) {
        if (key == especiales[i]) {
          tecla_especial = true;
          break;
        }
      }

      if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
      }
    }

    function soloNumeros(e) {
      key = e.keyCode || e.which;
      tecla = String.fromCharCode(key).toLowerCase();
      letras = "1234567890";
      especiales = "8-37-39-46";

      tecla_especial = false
      for (var i in especiales) {
        if (key == especiales[i]) {
          tecla_especial = true;
          break;
        }
      }

      if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
      }
    }

    $('#telefono').on('change', function() {
      if ($('#telefono').val().length < 15) {
        $('#telefono').removeClass("valid").addClass("invalid");
      } else {
        $('#telefono').removeClass("invalid").addClass("valid");
      }

    })


    var formatNumber = {
      separador: ".", // separador para los miles
      sepDecimal: ',', // separador para los decimales
      formatear: function(num) {
        num += '';
        var splitStr = num.split('.');
        var splitLeft = splitStr[0];
        var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
        var regx = /(\d+)(\d{3})/;
        while (regx.test(splitLeft)) {
          splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
        }
        return this.simbol + splitLeft + splitRight;
      },
      new: function(num, simbol) {
        this.simbol = simbol || '';
        return this.formatear(num);
      }
    }

    /////////////////////////////////
    $('#cedulapa2').on('change', function() {
      var cadena0 = $('#cedularl').val();
      var cadenaAux = $('#auxCedpa2').val();
      var cadena1 = $('#cedulapa1').val();
      var cadena2 = $('#cedulapa2').val();

      if (cadena2.length > 0) {
        if (cadena2 == cadena0 || cadena2 == cadena1) {
          swal.fire({
            type: 'warning',
            title: 'Advertencia',
            html: "La cédula que ingresó ya se encuentra en el formulario<br>"
          });
          $('#cedulapa2').val("");
        }

        if (cadena2 != cadenaAux) {
          $('#datosAutorizado2Row').removeAttr('style');
          $('#datosAutorizado2Row').attr('style', 'display:none !important;');
          $('#aut2').val(0);
        }
      }
    });

    $('#cedulapa1').on('change', function() {
      var cadena0 = $('#cedularl');
      var cadenaAux = $('#auxCedpa1').val();
      var cadena1 = $('#cedulapa1').val();
      var cadena2 = $('#cedulapa2').val();

      if (cadena1.length > 0) {
        if (cadena1 == cadena0 || cadena1 == cadena2) {
          swal.fire({
            type: 'warning',
            title: 'Advertencia',
            html: "La cédula que ingresó ya se encuentra en el formulario<br>"
          });
          $('#cedulapa1').val("");
        }

        if (cadena1 != cadenaAux) {
          $('#datosAutorizado1Row').removeAttr('style');
          $('#datosAutorizado1Row').attr('style', 'display:none !important;');
          $('#aut1').val(0);
        }
      }
    });

    $('#cedularl').on('change', function() {
      var cadena0 = $('#cedularl').val();
      var cadenaAux = $('#auxCedrep').val();
      var cadena1 = $('#cedulapa1').val();
      var cadena2 = $('#cedulapa2').val();

      if (cadena0.length > 0) {
        if (cadena0 == cadena1 || cadena0 == cadena2) {
          swal.fire({
            type: 'warning',
            title: 'Advertencia',
            html: "La cédula que ingresó ya se encuentra en el formulario<br>"
          });
          $('#cedularl').val("");
        }

        if (cadena0 != cadenaAux) {
          $('#datosRepresentanteRow').removeAttr('style');
          $('#datosRepresentanteRow').attr('style', 'display:none !important;');
          $('#rep').val(0);
        }
      } else {
        $('#checkrl').attr("disabled", "disabled");
      }
    });

    /////////////////////////////////
    $('#cedulapa2').on('keyup', function() {
      var cadena = formatNumber.new($('#cedulapa2').val().replace('.', '').replace('.', '').replace('.', ''));
      $('#cedulapa2').val(cadena);

      if (cadena.length < 7 && cadena.length > 0) {
        $('#cedulapa2').removeClass("valid").addClass("invalid");
        $('#checkpa2').attr("disabled", "disabled");
      } else {
        $('#cedulapa2').removeClass("invalid").addClass("valid");
        $('#checkpa2').removeAttr("disabled");
      }
    });

    $('#cedulapa2').on('blur', function() {
      var cadena = formatNumber.new($('#cedulapa2').val().replace('.', '').replace('.', '').replace('.', ''));
      if (cadena.length < 7 && cadena.length > 0) {
        $('#cedulapa2').removeClass("valid").addClass("invalid");
        $('#checkpa2').attr("disabled", "disabled");
      } else {
        $('#cedulapa2').removeClass("invalid").addClass("valid");
        $('#checkpa2').removeAttr("disabled");
      }
    });

    $('#cedulapa1').on('keyup', function() {
      var cadena = formatNumber.new($('#cedulapa1').val().replace('.', '').replace('.', '').replace('.', ''));
      $('#cedulapa1').val(cadena);

      if (cadena.length < 7 && cadena.length > 0) {
        $('#cedulapa1').removeClass("valid").addClass("invalid");
        $('#checkpa1').attr("disabled", "disabled");
      } else {
        $('#cedulapa1').removeClass("invalid").addClass("valid");
        $('#checkpa1').removeAttr("disabled");
      }
    });

    $('#cedulapa1').on('blur', function() {
      var cadena = formatNumber.new($('#cedulapa1').val().replace('.', '').replace('.', '').replace('.', ''));
      if (cadena.length < 7 && cadena.length > 0) {
        $('#cedulapa1').removeClass("valid").addClass("invalid");
        $('#checkpa1').attr("disabled", "disabled");
      } else {
        $('#cedulapa1').removeClass("invalid").addClass("valid");
        $('#checkpa1').removeAttr("disabled");
      }
    });

    $('#cedularl').on('keyup', function() {
      var cadena = formatNumber.new($('#cedularl').val().replace('.', '').replace('.', '').replace('.', ''));
      $('#cedularl').val(cadena);

      if (cadena.length < 7 && cadena.length > 0) {
        $('#cedularl').removeClass("valid").addClass("invalid");
        $('#checkrl').attr("disabled", "disabled");
      } else {
        $('#cedularl').removeClass("invalid").addClass("valid");
        $('#checkrl').removeAttr("disabled");
      }
    });

    $('#cedularl').on('blur', function() {
      var cadena = formatNumber.new($('#cedularl').val().replace('.', '').replace('.', '').replace('.', ''));
      if (cadena.length < 7 && cadena.length > 0) {
        $('#cedularl').removeClass("valid").addClass("invalid");
        $('#checkrl').attr("disabled", "disabled");
      } else {
        $('#cedularl').removeClass("invalid").addClass("valid");
        $('#checkrl').removeAttr("disabled");
      }
    });
    /////////////////////////////////
  </script>

  <!-- Scroll Smoot -->
  <script>
    $(function() {
      $('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
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
  <script language="JavaScript">
    $(window).load(function() {
      $("#status").fadeOut("slow");
      $("#preloader").delay(500).fadeOut("slow").remove();
    })
  </script>

  <script>
    function toggle_chckbx(vlr, id_dstn) {
      $("#" + id_dstn).attr('checked', !vlr);
    }
  </script>

  <!-- Validación Formulario 1 y 2 -->
  <script language="JavaScript">
    function frm_vld_emplea() {
      var mnsj = ""

      if (document.getElementById("rif").value.length == 0) mnsj += " - Debe indicar el Rif de la empresa.<br>";
      if (document.getElementById("rif").value.length < 7) mnsj += " - Debe ingresar un Rif válido.<br>";
      if (document.getElementById("cedularl").value.length == 0) mnsj += " - Debe indicar una cédula para el representante legal.<br>";
      if (document.getElementById("cedularl").value.length < 7) mnsj += " - Debe ingresar una cédula válida para el representante legal.<br>";
      if (document.getElementById("cedularl").value.length > 0 && document.getElementById("rep").value == 0) mnsj += " - Debe confirmar la cédula del representante legal haciendo click en la lupa.<br>";
      if (document.getElementById("cedularl").value.length == 0 && document.getElementById("rep").value != 0) mnsj += " - Debe indicar la cédula del representante legal haciendo click en la lupa.<br>";
      if (document.getElementById("cedulapa1").value.length > 0 && document.getElementById("aut1").value == 0) mnsj += " - Debe confirmar la cédula del primer personal autorizado haciendo click en la lupa.<br>";
      if (document.getElementById("cedulapa1").value.length == 0 && document.getElementById("aut1").value != 0) mnsj += " - Debe indicar la cédula del primer personal autorizado haciendo click en la lupa.<br>";
      if (document.getElementById("cedulapa2").value.length > 0 && document.getElementById("aut2").value == 0) mnsj += " - Debe confirmar la cédula del segundo personal autorizado haciendo click en la lupa.<br>";
      if (document.getElementById("cedulapa2").value.length == 0 && document.getElementById("aut2").value != 0) mnsj += " - Debe indicar la cédula del segundo personal autorizado haciendo click en la lupa.<br>";
      if (document.getElementById("razonSocial").value.length == 0) mnsj += " - Debe indicar la razón social de la empresa.<br>";
      if (document.getElementById("razonComercial").value.length == 0) mnsj += " - Debe indicar la razón comercial de la empresa.<br>";
      if (document.getElementById("telefono1").value.length == 0) mnsj += " - Debe indicar un teléfono de contacto.<br>";
      if (document.getElementById("telefono1").value.length < 17) mnsj += " - Debe indicar un teléfono de contacto válido.<br>";
      if (document.getElementById("telefono2").value.length > 0 && document.getElementById("telefono2").value.length < 17) mnsj += " - Debe indicar su teléfono secundario válido.<br>";
      if (document.getElementById("estado").value == 0) mnsj += " - Debe indicar un estado.<br>";
      if (document.getElementById("municipio").value == 0) mnsj += " - Debe indicar un municipio.<br>";
      if (document.getElementById("parroquia").value == 0) mnsj += " - Debe indicar una parroquia.<br>";
      if (document.getElementById("ciudad").value == 0) mnsj += " - Debe indicar una ciudad.<br>";
      if (document.getElementById("direccion").value.length == 0) mnsj += " - Debe indicar los detalles de la dirección.<br>";
      if (document.getElementById("direccion").value.length < 10) mnsj += " - Debe indicar una dirección más detallada.<br>";

      if (mnsj != "") {
        swal.fire({
          type: 'warning',
          title: 'Advertencia',
          html: "Debe verificar las siguientes condiciones:<br>" + mnsj
        })
      }

      if (mnsj != "") return false;

      return true;
    }

    function frm_vld_contac() {
      var mnsj = ""
      if (mnsj != "") {
        swal.fire({
          type: 'warning',
          title: 'Advertencia',
          html: "Debe verificar las siguientes condiciones:<br>" + mnsj
        })
      }

      if (mnsj != "") return false;

      return true;
    }

    $('#checkrl').on('click', function() {
      var rif = $('#tipo1').val() + '-' + $('#cedularl').val();
      console.log(rif);

      if (rif) {
        $.ajax({
          type: 'POST',
          encoding: "UTF-8",
          url: 'ajaxSigoclub.php',
          data: 'cedula=' + rif,
          success: function(e) {
            e = JSON.parse(e);
            if (e.length == 1) {
              $('#rep').val(e[0].id);
              $('#auxCedrep').val(e[0].cedula.substring(2, e[0].cedula.length));
              $('#datosRepresentanteNombre').val(decodeURIComponent(escape(e[0].nombre1)));
              $('#datosRepresentanteApellido').val(decodeURIComponent(escape(e[0].apellido1)));
              $('#datosRepresentanteNombreLabel').addClass('active');
              $('#datosRepresentanteApellidoLabel').addClass('active');
              $('#datosRepresentanteRow').removeAttr('style');
              $('#datosRepresentanteRow').attr('style', 'display:block !important;');
            } else {
              $('#datosRepresentanteRow').removeAttr('style');
              $('#datosRepresentanteRow').attr('style', 'display:none !important;');
              swal.fire({
                type: 'warning',
                title: 'Advertencia',
                html: "La cédula que busca no está registrada.<br>¿Desea registrarla?",
                showConfirmButton: true,
                confirmButtonText: "Si",
                showCancelButton: true,
                cancelButtonText: "No",
              }).then((result) => {
                if (result.value) {
                  window.open('registro.php?cedula=' + $('#cedularl').val() + '&tipo=' + $('#tipo1').val(), '_blank');
                }
              })
            }
          }
        });
      }
    });
    ///////////
    $('#checkpa1').on('click', function() {
      var ced = $('#tipo2').val() + '-' + $('#cedulapa1').val();
      if (ced) {
        $.ajax({
          type: 'POST',
          encoding: "UTF-8",
          url: 'ajaxSigoclub.php',
          data: 'cedula=' + ced,
          success: function(e) {
            e = JSON.parse(e);
            if (e.length == 1) {
              $('#aut1').val(e[0].id);
              $('#auxCedpa1').val(e[0].cedula.substring(2, e[0].cedula.length));
              $('#datoAutorizado1Nombre').val(e[0].nombre1);
              $('#datoAutorizado1NombreLabel').addClass('active');
              $('#datosAutorizado1Apellido').val(e[0].apellido1);
              $('#datosAutorizado1ApellidoLabel').addClass('active');
              $('#datosAutorizado1Tlf').val(e[0].celular);
              $('#datosAutorizado1TlfLabel').addClass('active');
              $('#datosAutorizado1Row').removeAttr('style');
              $('#datosAutorizado1Row').attr('style', 'display:block !important;');
            } else {
              $('#datosAutorizado1Row').removeAttr('style');
              $('#datosAutorizado1Row').attr('style', 'display:none !important;');
              swal.fire({
                type: 'warning',
                title: 'Advertencia',
                html: "La cédula que busca no está registrada.<br>¿Desea registrarla?",
                showConfirmButton: true,
                confirmButtonText: "Si",
                showCancelButton: true,
                cancelButtonText: "No",
              }).then((result) => {
                if (result.value) {
                  window.open('registro.php?cedula=' + $('#cedulapa1').val() + '&tipo=' + $('#tipo2').val(), '_blank');
                }
              })
            }
          }
        });
      }
    });
    //////////////
    $('#checkpa2').on('click', function() {
      var ced2 = $('#tipo3').val() + '-' + $('#cedulapa2').val();
      if (ced2) {
        $.ajax({
          type: 'POST',
          encoding: "UTF-8",
          url: 'ajaxSigoclub.php',
          data: 'cedula=' + ced2,
          success: function(e) {
            e = JSON.parse(e);
            if (e.length == 1) {
              $('#aut2').val(e[0].id);
              $('#auxCedpa2').val(e[0].cedula.substring(2, e[0].cedula.length));
              $('#datoAutorizado2Nombre').val(e[0].nombre1);
              $('#datoAutorizado2NombreLabel').addClass('active');
              $('#datosAutorizado2Apellido').val(e[0].apellido1);
              $('#datosAutorizado2ApellidoLabel').addClass('active');
              $('#datosAutorizado2Tlf').val(e[0].celular);
              $('#datosAutorizado2TlfLabel').addClass('active');
              $('#datosAutorizado2Row').removeAttr('style');
              $('#datosAutorizado2Row').attr('style', 'display:block !important;');
            } else {
              $('#datosAutorizado2Row').removeAttr('style');
              $('#datosAutorizado2Row').attr('style', 'display:none !important;');
              swal.fire({
                type: 'warning',
                title: 'Advertencia',
                html: "La cédula que busca no está registrada.<br>¿Desea registrarla?",
                showConfirmButton: true,
                confirmButtonText: "Si",
                showCancelButton: true,
                cancelButtonText: "No",
              }).then((result) => {
                if (result.value) {
                  window.open('registro.php?cedula=' + $('#cedulapa2').val() + '&tipo=' + $('#tipo3').val(), '_blank');
                }
              })
            }
          }
        });
      }
    });
  </script>


  <!-- Reportar resultado de envío de Emails -->
  <?php

  if ($_SESSION["save_error"] == "OK") {
    ?>
    <script language="javascript">
      swal.fire({
        type: 'success',
        title: 'Éxito',
        html: "Registro almacenado exitosamente"
      });
    </script>
  <?php
} else if ($_SESSION["save_error"] != "" && $_SESSION["save_error"] != "OK") {
  ?>
    <script language="javascript">
      swal.fire({
        type: 'warning',
        title: 'Advertencia',
        html: "Debe verificar las siguientes condiciones:<br><?php echo (html_encode($_SESSION["save_error"])); ?>"
      });
    </script>
  <?php
}
$_SESSION["save_error"] = "";
?>


</body>

</html>