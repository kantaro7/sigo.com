<?php
include_once "../../lib_php/start.php";

//Conectar con Base de Datos
$db_pdo=new PDO("mysql:host=$host;dbname=$base", $user, $pass);

//Validar Sesión
$indent="../../../";
include_once "../../lib_php/chk_ssn.php";
if($ok_ssn){

	//Estableciendo parametros básicos de la opción para el proceso de actualización
	$_SESSION["carpeta"]		="sec_4_sucurs";
	$_SESSION["rprog"]			="su_sucurs";
	$_SESSION["rimag"]			="su_sucurs";
	$_SESSION["modulo"]			="4";
	$_SESSION["opcion"]			="3";
	
	$_SESSION["tabla"]			="su_sucurs";
	$_SESSION["elemento"]		="su_sucurs";
	$_SESSION["titulo"]			="Sucursal";
	$_SESSION["titulos"]		="Sucursales";
	$_SESSION["letra_final"]="a";

	//Obtener el número de página a mostrar de la colección $_GET
	if(!isset($_SESSION["row_pag"])) $_SESSION["row_pag"]=10;
	if(!isset($_SESSION["num_pag"])) $_SESSION["num_pag"]=1;

	//Inicializar Información de Criterios de Búsqueda
	$_SESSION["crt_bsq"]="";
	$_SESSION["crt_tit"]="";
	$_SESSION["crt_ord"]="orden";
	?>
  <style type="text/css">
		#gran_contenedor {
			width: 100%;
			height: auto;
			background-color: #ffffff;
			color: #444444;
			font-family: Calibri, Arial;
			font-size: 18px;
			font-weight: 300;
			line-height: 22px;
	  }
		#sec_sub_menu {
			width: 100%;
			height: 40px;
	  }
		#btn_mat {
			float: left;
			width: 36px;
			height: 36px;
			margin-top: 02px;
			margin-right: 10px;
			background-image: none;
			cursor: pointer;
	  }
		.btn_mat_right {
			float: right;
			width: 36px;
			height: 36px;
			margin-top: 02px;
			margin-right: 10px;
			background-image: none;
			cursor: pointer;
	  }
		#btn_mat:hover, .btn_mat_right:hover {
			background-image: url(admin/images/fondos/btn_bckgrnd_36.png);
	  }
		#sh_criter_select{
			width: 100%;
			height: 38px;
			margin-top: -30px;
			background-color: #ffffff;
			border-bottom: 2px #09F solid;
		}
		#criter_select{
			width: 100%;
			min-height: 80px;
			margin-top: 02px;
			background-color: #ffffff;
			border: 1px #D3D3D3 solid;
			display: none;
		}
		#general_grid{
			width: 100%;
			min-height: 400px;
			margin-top: 20px;
			margin-bottom: 40px;
		}
		#data_header{
			width: 100%;
			min-height: 30px;
			margin-top: 10px;
			background-color: #ffffff;
		}
		#data_body{
			width: 100%;
			min-height: 60px;
			margin-top: 04px;
			background-color: #ffffff;
		}
		#data_footer{
			width: 100%;
			min-height: 40px;
			margin-top: 06px;
			background-color: #ffffff;
			border-top: 1px #333 solid;
		}
		#no_data{
			width: 100%;
			color: #F00;
			font-family: Calibri, Arial;
			font-size: 24px;
			font-weight: 500;
			line-height: 40px;
			text-align: center;
		}
	</style>

  <!--  C o n t e n e d o r   P r i n c i p a l  -->
  <div id="gran_contenedor">
    <!--  Menu de regreso y nuevo elemento  -->
    <div id="sec_sub_menu">
      <div id="btn_mat"><img src="admin/images/mat_icons/goto_main_36.png" width="36" height="36" title=" Cerrar Ventana " onClick="init_usr_ssn();" /></div>
      <div id="btn_mat"><img src="admin/images/mat_icons/add2_36.png" width="36" height="36" onClick="nyro_exec('<?php echo(substr($_SESSION["carpeta"], 4)."', '".$_SESSION["rprog"]."', 'acc=i&dreg='"); ?>);" title=" Agregar Nuev<?php	echo($_SESSION["letra_final"]." ".$_SESSION["titulo"]); ?> " /></div>
    </div>
    <!--  Criterios de Selección  -->
    <div id="sh_criter_select">
    	<!--
      <div id="btn_mat_right"><img id="img_mat_right" src="admin/images/mat_icons/show_down_36.png" width="36" height="36" onclick="sh_crt_bsq();" title=" Mostrar Criterios de Búsqueda " style="float: right;" /></div>
      <div style="float: right; margin-right: 10px; margin-top: 10px; text-align: right;">Criterios de Búsqueda</div>
      -->
    </div>
    <div id="criter_select">
    </div>
    <!--  Tabla General  -->
    <div id="general_grid">
    </div>
  </div>
<?php	} ?>
