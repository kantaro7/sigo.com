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
                  <i class="material-icons prefix tooltipped" id="trif" data-position="top" data-tooltip="Documento de identidad de la empresa"> chrome_reader_mode</i>
                  <select id="tipo" name="tipo" class="validate" required aria-required="true">
                    <option value="V">V</option>
                    <option value="J">J</option>
                    <option value="G">G</option>
                  </select>
                </div>
                <div class="input-field col l7 m6 s5">
                  <input id="rif" onkeyup="mascara('########-#',this,event,true)" name="rif" type="text" class="validate" required aria-required="true" maxlength="10" minlength="7" value="<?php echo($_POST["rif"]); ?>">
                  <label for="rif" class="black-text">Rif <span style="color:red">*</span></label>
                </div>
                <!-- <div class="input-field col l3 m3 s3">
                  <button id="check" onClick="Buscar()" class="btn waves-effect waves-light" name="check" value="check"><i class="material-icons right">search</i>Buscar</button>
                </div> -->
              </div>
            </div>
            <div class="col s12 m12 l12">
              <div class="row">
                <div class="input-field col s12 m12 l12">
                  <i class="material-icons prefix tooltipped" id="trazonSocial" data-position="top" data-tooltip="Razón social de la empresa">account_circle</i>
                  <input maxlength="20" minlength="3" id="razonSocial" name="razonSocial" type="text" class="validate materialize" required="" aria-required="true" value="<?php echo($_POST["razonSocial"]); ?>">
                  <label for="razonSocial" class="black-text">Razón social <span style="color:red">*</span></label>
                </div>
              </div>        
            </div>
            <div class="col s12 m12 l12">
              <div class="row">
                <div class="input-field col s12 m12 l12">
                  <i class="material-icons prefix tooltipped" id="trazonComercial" data-position="top" data-tooltip="Razón comercial de la empresa">account_circle</i>
                  <input maxlength="20" minlength="3" id="razonComercial" name="razonComercial" type="text" class="validate" required="" aria-required="true" value="<?php echo($_POST["razonComercial"]); ?>">
                  <label for="razonComercial" class="black-text">Razón comercial <span style="color:red">*</span></label>
                </div>
              </div>        
            </div>
            <div class="col s12 m12">
              <div class="row">
                <div class="input-field col l6 m12 s12">
                <i class="material-icons prefix tooltipped" id="testado" data-position="top" data-tooltip="Estado, Municipio, Parroquia">location_on</i>
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
                <div class="input-field col l6 m12 s12">
                  <select name="municipio" id="municipio" required aria-required="true">
                    <option value="0" disabled selected>Seleccione una opción</option>
                  </select>
                  <label>Municipio <span style="color:red">*</span></label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col l6 m12 s12">
                 <i class="material-icons prefix tooltipped" id="tciudad" data-position="top" data-tooltip="Ciudad, Zona residencial, Tipo de residencia">location_on</i>
                  <select name="ciudad" id="ciudad" required aria-required="true">
                    <option value="0" disabled selected>Seleccione una opción</option>
                  </select>
                  <label>Ciudad <span style="color:red">*</span></label>
                </div>
                <div class="input-field col l6 m12 s12">
                  <select name="parroquia" id="parroquia" required aria-required="true">
                    <option value="0" disabled selected>Seleccione una opción</option>
                  </select>
                  <label>Parroquia <span style="color:red">*</span></label>
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
            <div class="col s6 m6 l6">
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix tooltipped" id="ttelefono" data-position="top" data-tooltip="Teléfono de preferencia (058-4XX.XXX.XX.XX)">phone</i>
                  <input id="telefono1" name="telefono1" onkeyup="mascara('###-###.###.##.##',this,event,true)" maxlength="17" minlength="17" type="text" class="validate materialize'textarea" required aria-required="true" value="<?php echo($_POST["telefono1"]); ?>">
                  <label for="telefono1" class="black-text">Número de teléfono <span style="color:red">*</span></label>
                </div>
              </div>
            </div>
            <div class="col s6 m6 l6">
              <div class="row">
                <div class="input-field col s12">
                  <input id="telefono2" name="telefono2" onkeyup="mascara('###-###.###.##.##',this,event,true)" maxlength="17" minlength="17" type="text" class="validate materialize'textarea" required aria-required="true" value="<?php echo($_POST["telefono2"]); ?>">
                  <label for="telefono2" class="black-text">Número de teléfono</label>
                </div>
              </div>
            </div>
            <!-- ///////////////////////////////////////   -->
            <div class="col s12 m12 l12"> 
                <div class="row" style="margin-bottom: 0px;">
                  <input name="rep" id="rep" type="hidden" value="0" /> 
                  <div class="col l12 m12 s12" style="margin-left: 45px;">
                    <h6 class="black-text" >Representante Legal</h6>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col l2 m3 s4">
                    <i class="material-icons prefix tooltipped" id="tcedularl" data-position="top" data-tooltip="Cédula venezolana natural o extranjera"> chrome_reader_mode</i>
                    <select id="tipo1" name="tipo1" class="validate" required aria-required="true">
                      <option value="V">V</option>
                      <option value="E">E</option>
                    </select>
                  </div>
                  <div class="input-field col l7 m6 s5">
                    <input id="cedularl" onkeypress="return soloNumeros(event)" name="cedularl" type="text" class="validate" required aria-required="true" maxlength="10" minlength="7" value="<?php echo($_POST["cedularl"]); ?>">
                    <label for="cedularl" class="black-text">Documento de identidad <span style="color:red">*</span></label>
                  </div>
                  <div class="input-field col l3 m3 s3">
                    <button id="checkrl" onClick="Buscar()" class="btn waves-effect waves-light" name="checkrl" value="checkrl"><i class="material-icons right">search</i>Buscar</button>
                  </div>
                </div>
                <div class="row" id="datosRepresentanteRow" style="display:none;">
                  <div class="col l2 m3 s4">
                    <div class="row">
                      <div class="col l3 m3 s3">
                        <span id="datosRepresentanteCedula"></span>                      
                      </div>
                      <div class="col l4 m4 s4">
                        <span id="datosRepresentanteNombre"></span>
                      </div>
                      <div class="col l4 m4 s4">
                        <span id="datosRepresentanteApellido"></span>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

            <div class="col s12 m12 l12"> 
                <div class="row" style="margin-bottom: 0px;">
                  <input name="aut1" id="aut1" type="hidden" value="0" /> 
                  <div class="col l12 m12 s12" style="margin-left: 45px;">
                    <h6 class="black-text" >Personal autorizado 1</h6>
                  </div>
                </div>
              <div class="row">
                <div class="input-field col l2 m3 s4">
                  <i class="material-icons prefix tooltipped" id="tcedulapa1" data-position="top" data-tooltip="Cédula venezolana natural o extranjera"> chrome_reader_mode</i>
                  <select id="tipo2" name="tipo2" class="validate" required aria-required="true">
                    <option value="V">V</option>
                    <option value="E">E</option>
                  </select>
                </div>
                <div class="input-field col l7 m6 s5">
                  <input id="cedulapa1" onkeypress="return soloNumeros(event)" name="cedulapa1" type="text" class="validate" required aria-required="true" maxlength="10" minlength="7" value="<?php echo($_POST["cedulapa1"]); ?>">
                  <label for="cedulapa1" class="black-text">Documento de identidad <span style="color:red">*</span></label>
                </div>
                <div class="input-field col l3 m3 s3">
                  <button id="checkpa1" onClick="Buscar()" class="btn waves-effect waves-light" name="checkpa1" value="checkpa1"><i class="material-icons right">search</i>Buscar</button>
                </div>
              </div>
              <div class="row" id="datosAutorizado1Row" style="display:none;">
                  <div class="col l2 m3 s4">
                    <div class="row">
                      <div class="col l3 m3 s3">
                        <span id="datoAutorizado1Cedula"></span>                      
                      </div>
                      <div class="col l3 m3 s3">
                        <span id="datoAutorizado1Nombre"></span>
                      </div>
                      <div class="col l3 m3 s3">
                        <span id="datosAutorizado1Apellido"></span>
                      </div>
                      <div class="col l3 m3 s3">
                        <span id="datosAutorizado1Tlf"></span>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

            <div class="col s12 m12 l12"> 
                <div class="row" style="margin-bottom: 0px;">
                  <input name="aut2" id="aut2" type="hidden" value="0" /> 
                  <div class="col l12 m12 s12" style="margin-left: 45px;">
                    <h6 class="black-text" >Personal autorizado 2</h6>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col l2 m3 s4">
                    <i class="material-icons prefix tooltipped" id="tcedulapa2" data-position="top" data-tooltip="Cédula venezolana natural o extranjera"> chrome_reader_mode</i>
                    <select id="tipo3" name="tipo3" class="validate" required aria-required="true">
                      <option value="V">V</option>
                      <option value="E">E</option>
                    </select>
                  </div>
                  <div class="input-field col l7 m6 s5">
                    <input id="cedulapa2" onkeypress="return soloNumeros(event)" name="cedulapa2" type="text" class="validate" required aria-required="true" maxlength="10" minlength="7" value="<?php echo($_POST["cedulapa2"]); ?>">
                    <label for="cedulapa2" class="black-text">Documento de identidad <span style="color:red">*</span></label>
                  </div>
                  <div class="input-field col l3 m3 s3">
                    <button id="checkpa2" onClick="Buscar()" class="btn waves-effect waves-light" name="checkpa2" value="checkpa2"><i class="material-icons right">search</i>Buscar</button>
                  </div>
                </div>
                <div class="row" id="datosAutorizado2Row" style="display:none;">
                  <div class="col l2 m3 s4">
                    <div class="row">
                      <div class="col l3 m3 s3">
                        <span id="datoAutorizado2Cedula"></span>                      
                      </div>
                      <div class="col l3 m3 s3">
                        <span id="datoAutorizado2Nombre"></span>
                      </div>
                      <div class="col l3 m3 s3">
                        <span id="datosAutorizado2Apellido"></span>
                      </div>
                      <div class="col l3 m3 s3">
                        <span id="datosAutorizado2Tlf"></span>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <!-- ///////////////////////////////////////   -->
         
            <input name="prcs" id="prcs" type="hidden" value="S" /> 
            <!-- ///////////////////////////////////////   -->
            <div class="row">
                <div class="col s12 m12 center" style="margin-top: 6px">
                  <a class="waves-effect waves-light btn modal-trigger" data-target="condiciones">Ver términos y condiciones</a>
                  <div class="input-field col s12 m12 l12">
                    <input type="checkbox" id="okCondiciones" name="okCondiciones" />
                    <label for="okCondiciones">He leído, entendido y aceptado los términos y condiciones aquí establecidos</label>
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
        <br><br> A.	Generalidades
        <br><br> La actividad de los clientes afiliados al programa SIGO CLUB se regirá por estos Términos y Condiciones, por lo que cualquier persona interesada en adquirir productos a bajos costos en los establecimientos SIGO PRECIOS BAJOS CERCA DE TI, deberá aceptar estos Términos y Condiciones; los cuales tienen carácter vinculante. 

        <br><br> B.	Definiciones

        <br><br> A fin de facilitar una correcta comprensión de los términos que son utilizados, se detalla a continuación la definición de aquellos que son especialmente relevantes:
        <br>a.	SIGO CLUB es un programa que va dirigido a todos nuestros clientes, cuyo propósito es compensar la fidelidad y lealtad con la organización SIGO, S.A., en el que el afiliado podrá adquirir productos a bajos costos en los establecimientos SIGO PRECIOS BAJOS CERCA DE TI.  
        <br>b.	Clientes SIGO CLUB son aquellas personas naturales y jurídicas, que previo cumplimiento de los requisitos de afiliación, se encuentran autorizados a la compra o adquisición de productos en las tiendas o establecimientos “SIGO PRECIOS BAJOS CERCA DE TI”.
        <br>c.	SIGO PRECIOS BAJOS CERCA DE TI son establecimientos comerciales en los suburbios de la región insular (en las zonas más alejadas y necesitadas del territorio neoespartano), en el cual las personas de dichas localidades podrán comprar productos a precios más económicos, que los estándares del mercado nacional.
        <br>d.	SIGO CRÉDITOS es una herramienta a favor de los Clientes SIGO CLUB, para abonar cantidades de dinero a una cuenta asociada al número de cédula del Cliente SIGO CLUB, a través del depósito bancario o abono por transferencia electrónica a las cuentas de SIGO, S.A., dicho monto será acreditado a su cuenta personal y podrá ser canjeado a través de las tiendas y/o sucursales SIGO en el territorio insular.

        <br><br>C.	Declaraciones

        <br><br>a.	SIGO PRECIOS BAJOS CERCA DE TI es un programa de la exclusiva propiedad de la sociedad mercantil SIGO, S.A. (en adelante denominada SIGO).
        <br>b.	SIGO manifiesta que la afiliación al programa SIGO CLUB, corresponde exclusivamente a los clientes que cumplan con los requisitos de afiliación, y que sean aprobados por el comité de afiliación.
        <br>c.	SIGO se reserva el derecho de modificar el contenido del programa de afiliación SIGO CLUB, ya sea en forma permanente o transitoria, sin aviso previo y/o consentimiento de los Clientes SIGO CLUB, en cualquier momento y a su exclusivo criterio.

        <br><br>D.	Registro de los Clientes SIGO CLUB

        <br><br>La afiliación a SIGO CLUB, se realiza gratuitamente a través de la página web www.sigo.com.ve, los interesados deberán completar el formulario de afiliación establecido en dicho sitio web.
        <br>Las personas interesadas deberán realizar su registro o afiliación de forma personal, asimismo deberán cumplir con los requisitos de afiliación al Programa SIGO CLUB, previa aprobación del comité de afiliación. La aceptación de las solicitudes de registro es una decisión exclusiva de SIGO, quien en cualquier momento podrá determinar el rechazo o cancelación de la afiliación, por situaciones como: brindar información falsa en el registro, realizar actos o acciones que vulneren y/o afecten las instalaciones de la empresa, su operación o las normas legales en general; estar vinculado en investigaciones penales en contra de SIGO, entre otras.
        <br>Toda la información que los clientes proporcionen al momento de su registro deberá ser verdadera, exacta y completa. Los clientes son los únicos y exclusivos responsables de la información que brindan y de las consecuencias que generen con la inexactitud o falsedad de la información suministrada. 

        <br><br>E.	Procedimiento de compra en los establecimientos “SIGO PRECIOS BAJOS CERCA DE TI”.
        <br><br>La compra o adquisición de productos en los establecimientos “SIGO PRECIOS BAJOS CERCA DE TI”, se realizará de la siguiente forma:

        <br><br>a.	El Cliente SIGO CLUB deberá presentar su cédula de identidad laminada.
        <br>b.	El Cliente SIGO CLUB podrá pagar su compra de una manera rápida, cómoda y segura, con tarjetas de débito, a través de puntos de venta y SIGO CRÉDITOS.
        <br>c.	No será aceptado el pago en dinero efectivo, ello en aras de incentivar las medidas del ejecutivo nacional del uso e implementación de la banca electrónica y pago a través de puntos de venta, y como una medida de seguridad y reducción de robos en general contra los establecimientos, clientes, trabajadores y población aledaña a las tiendas o establecimientos “SIGO PRECIOS BAJOS CERCA DE TI”.
        <br>d.	No existen limitantes en cuanto a la cantidad del monto abonar en el programa SIGO CRÉDITOS. Asimismo los montos acreditados o abonados a SIGO CRÉDITOS, no poseen fecha de vencimiento, por lo que el Cliente SIGO CLUB está en la libertad de disponer de su saldo de acuerdo a sus necesidades de compra.
        <br>e.	El Cliente SIGO CLUB deberá realizar personalmente la compra, ya que su afiliación es personal e intransferible. 
        <br>f.	Para efectos de garantizar la seguridad de los abonos efectuados en el programa SIGO CRÉDITOS, y en aras del bienestar del Cliente SIGO CLUB, solo éste podrá efectuar los consumos acreditados en su cuenta con la presentación de la cédula de Identidad, por lo que el uso de los SIGO CRÉDITOS es intransferible.

        <br><br>F.	Privacidad de la Información
        <br><br>La información personal que el Cliente SIGO CLUB proporciona a SIGO cuando realiza la afiliación o al utilizar nuestros página web www.sigo.com.ve para el registro, son considerados  datos privados, es decir, no están disponibles al público. SIGO se compromete a no compartir ni revelar esta información, salvo que el Cliente SIGO CLUB autorice a compartir dicha información, o esté obligado legalmente a responder a citaciones judiciales y/o cualquier requerimiento de las autoridades administrativas.

        <br><br>G.	Responsabilidades 

        <br><br>a.	Al realizar la afiliación al programa SIGO CLUB, los Clientes SIGO CLUB aceptan en forma expresa que el registro se realiza bajo su consentimiento y voluntad. Ni SIGO, ni sus directores, empleados o representantes garantizan que el acceso indefinido al programa de afiliación.
        <br>b.	Bajo ningún concepto los directores, empleados o representantes de SIGO serán responsables por cualquier daño directo, indirecto, incidental, especial o punitivo que pudiera ser causado por:

        <br><br>i.	Daños de cualquier naturaleza a la persona o a la propiedad emergentes de su acceso a las instalaciones de las tiendas o establecimientos “SIGO PRECIOS BAJOS CERCA DE TI”.
        <br>ii.	Cualquier interrupción o cese temporal o definitivo del programa SIGO CLUB, que corresponda a fallas en el sistema, como por ejemplo interrupción en la transmisión de datos del Cliente SIGO CLUB y/o SIGO CREDITOS. 
        <br>iii.	Cualquier acceso no autorizado a nuestros servidores seguros y/o toda información almacenada en dicho servidor.
        <br>iv.	El contenido de términos de uso distinto al establecido y publicado en la página web  www.sigo.com.ve.
        <br>v.	La conducta no adecuada o ilícita de cualquier Cliente SIGO CLUB o sus trabajadores.
        <br>vi.	Errores, omisiones, interrupciones, supresiones, defectos, demoras en la operación o transmisión, desperfectos en las líneas de comunicación, robo o destrucción, acceso no autorizado a cualquier comunicación de los Cliente SIGO CLUB o su alteración, ni por errores humanos o acciones deliberadas de terceros que pudieran interrumpir o alterar el normal desarrollo del programa SIGO CLUB.

        <br><br>c.	Los Clientes SIGO CULB se comprometen a indemnizar y mantener indemne y libre de daños a SIGO, sus subsidiarias, empresas vinculadas contra toda y cualquier acción o juicio de responsabilidad, reclamo, denuncia, penalidad, intereses, costos, gastos, honorarios y/o multas iniciado por terceros debido a conductas ilícitas o no adecuadas en los establecimientos “SIGO PRECIOS BAJOS CERCA DE TI”.

        <br><br>H.	Otras Consideraciones

        <br><br>a.	La oferta de los productos en los establecimientos “SIGO PRECIOS BAJOS CERCA DE TI” se encuentra sujeta a la disponibilidad de stock al momento de las compras en las tiendas, así como a la vigencia en las ofertas que establezca SIGO. De esta manera los precios, disponibilidad, y ofertas contenidas en dichas tiendas pueden variar sin previo aviso.
        <br>b.	Los clientes afiliados a SIGO CLUB manifiestan que la información que han entregado es de carácter público y corresponde a información estrictamente comercial que no está sujeta a reserva alguna.
        <br>c.	SIGO, se reserva el derecho de modificar los Términos y Condiciones, a fin de adaptarlos a nuevos requerimientos establecidos en las leyes y demás normativas que rigen en el país, o por cualquier otro motivo que le permita mejorar el uso del programa SIGO CLUB. Por lo que el Cliente SIGO CLUB, deberá revisar periódicamente estos Términos y Condiciones.
        <br>d.	Los presentes Términos y Condiciones se regirán e interpretarán de acuerdo con las leyes de la República Bolivariana de Venezuela. Cualquier controversia que derive de este documento se someterá a los jueces de la jurisdicción del Estado Nueva Esparta.

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
    $(document).ready(function(){
      $('.slider').slider({full_width: true});
    });        
  </script>
  <!-- fin slider-->

<script type="text/javascript">
$(document).ready(function(){

  $('#condiciones').modal();



  $('#rif').on('focus',function(){
    $('#trif').trigger('mouseover');
  });
  $('#rif').on('blur',function(){
    $('#trif').trigger('mouseout');
  });

  $('#razonSocial').on('focus',function(){
    $('#trazonSocial').trigger('mouseover');
  });
  $('#razonSocial').on('blur',function(){
    $('#trazonSocial').trigger('mouseout');
  });

  $('#razonComercial').on('focus',function(){
    $('#trazonComercial').trigger('mouseover');
  });
  $('#razonComercial').on('blur',function(){
    $('#trazonComercial').trigger('mouseout');
  });

  $('#telefono1').on('focus',function(){
    $('#ttelefono').trigger('mouseover');
  });
  $('#telefono1').on('blur',function(){
    $('#ttelefono').trigger('mouseout');
  });
  $('#telefono2').on('focus',function(){
    $('#ttelefono').trigger('mouseover');
  });
  $('#telefono2').on('blur',function(){
    $('#ttelefono').trigger('mouseout');
  });

  $('#direccion').on('focus',function(){
    $('#tdireccion').trigger('mouseover');
  });
  $('#direccion').on('blur',function(){
    $('#tdireccion').trigger('mouseout');
  });

  $('#cedularl').on('focus',function(){
    $('#tcedularl').trigger('mouseover');
  });
  $('#cedularl').on('blur',function(){
    $('#tcedularl').trigger('mouseout');
  });

  $('#cedulapa1').on('focus',function(){
    $('#tcedulapa1').trigger('mouseover');
  });
  $('#cedulapa1').on('blur',function(){
    $('#tcedulapa1').trigger('mouseout');
  });

  $('#cedulapa2').on('focus',function(){
    $('#tcedulapa2').trigger('mouseover');
  });
  $('#cedulapa2').on('blur',function(){
    $('#tcedulapa2').trigger('mouseout');
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
      
      $('select').material_select();

        $('#okCondiciones').on('change',function(event){
          if( !document.getElementById("okCondiciones").checked){
              document.getElementById("registrar").disabled = true;
            } else {
              document.getElementById("registrar").disabled = false;
            }
        });

    });


///////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////

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

    

    /////////////////////////////////
    $('#cedulapa2').on('keyup', function(){
      var cadena = formatNumber.new($('#cedulapa2').val().replace('.','').replace('.','').replace('.',''));
      $('#cedulapa2').val(cadena);

      if(cadena.length < 7){
        $('#cedulapa2').removeClass("valid").addClass("invalid");
      }else{
         $('#cedulapa2').removeClass("invalid").addClass("valid");
      }
    });

    $('#cedulapa2').on('blur', function(){
      var cadena = formatNumber.new($('#cedulapa2').val().replace('.','').replace('.','').replace('.',''));
      if(cadena.length < 7){
        $('#cedulapa2').removeClass("valid").addClass("invalid");
      }else{
         $('#cedulapa2').removeClass("invalid").addClass("valid");
      }
    });

     $('#cedulapa1').on('keyup', function(){
      var cadena = formatNumber.new($('#cedulapa1').val().replace('.','').replace('.','').replace('.',''));
      $('#cedulapa1').val(cadena);

      if(cadena.length < 7){
        $('#cedulapa1').removeClass("valid").addClass("invalid");
      }else{
         $('#cedulapa1').removeClass("invalid").addClass("valid");
      }
    });

    $('#cedulapa1').on('blur', function(){
      var cadena = formatNumber.new($('#cedulapa1').val().replace('.','').replace('.','').replace('.',''));
      if(cadena.length < 7){
        $('#cedulapa1').removeClass("valid").addClass("invalid");
      }else{
         $('#cedulapa1').removeClass("invalid").addClass("valid");
      }
    });

     $('#cedularl').on('keyup', function(){
      var cadena = formatNumber.new($('#cedularl').val().replace('.','').replace('.','').replace('.',''));
      $('#cedularl').val(cadena);

      if(cadena.length < 7){
        $('#cedularl').removeClass("valid").addClass("invalid");
      }else{
         $('#cedularl').removeClass("invalid").addClass("valid");
      }
    });

    $('#cedularl').on('blur', function(){
      var cadena = formatNumber.new($('#cedularl').val().replace('.','').replace('.','').replace('.',''));
      if(cadena.length < 7){
        $('#cedularl').removeClass("valid").addClass("invalid");
      }else{
         $('#cedularl').removeClass("invalid").addClass("valid");
      }
    });
    /////////////////////////////////
  </script>

  <?php if(isset($_POST["fecha"]) && $_POST["fecha"]!=""){ ?>
  <script>
    var date = new Date(<?php echo(substr($_POST["fecha_nac"], 6, 4).", ".( intval( substr($_POST["fecha_nac"], 3, 2) ) -1 ).", ".substr($_POST["fecha_nac"], 0, 2)); ?>);
    $('#fecha_emplea').set('select', date);
  </script>
  <?php } ?>



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
  <script language="JavaScript">
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
      
      if(document.getElementById("cedula").value.length==0) mnsj+=" - Debe indicar el Rif de la empresa.<br>";
      if(document.getElementById("cedula").value.length<7) mnsj+=" - Debe ingresar un Rif válido.<br>";

      if(document.getElementById("cedula").value.length==0) mnsj+=" - Debe indicar una cédula para el representante legal.<br>";
      if(document.getElementById("cedula").value.length<7) mnsj+=" - Debe ingresar una cédula válida para el representante legal.<br>";
      if(document.getElementById("cedula").value.length==0) mnsj+=" - Debe indicar una cédula para el personal autorizado 1.<br>";
      if(document.getElementById("cedula").value.length<7) mnsj+=" - Debe ingresar una cédula válida para el personal autorizado 1.<br>";
      if(document.getElementById("cedula").value.length==0) mnsj+=" - Debe indicar una cédula para el personal autorizado 2.<br>";
      if(document.getElementById("cedula").value.length<7) mnsj+=" - Debe ingresar una cédula válida para el personal autorizado 2.<br>";

      if(document.getElementById("razonSocial").value.length==0) mnsj+=" - Debe indicar la razón social de la empresa.<br>";
      if(document.getElementById("razonComercial").value.length==0) mnsj+=" - Debe indicar la razón comercial de la empresa.<br>";
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