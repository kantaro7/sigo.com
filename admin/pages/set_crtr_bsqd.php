<?php
// Iniciar sesión
session_start();

// Configure Error Displaying
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//Load Basic Configuration, Database & General Rutines
include_once "../../admin/library_php/config.php";
include_once "../../admin/library_php/general.php";

//Connect to Database
$db_pdo=new PDO("mysql:host=$host;dbname=$base",$user,$pass);

//Inicializar Variables de resultado
$_SESSION["crt_bsq"]="";
$_SESSION["crt_tit"]="";

//Recibir parámetros de ejecución
switch ($_GET["mdl"]){

	case 'pp_events':
		if($_GET["axn"]=="b"){
			if(isset($_GET["tit"]) && $_GET["tit"]!=""){
				$_SESSION["crt_bsq"].=" and UPPER(titulo) LIKE '%".strtoupper($_GET["tit"])."%'";
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Título: <b>".$_GET["tit"]."</b> ";
			}
			if(isset($_GET["tex"]) && $_GET["tex"]!=""){
				$_SESSION["crt_bsq"].=" and UPPER(comentario) LIKE '%".strtoupper($_GET["tex"])."%'";
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Texto: <b>".$_GET["tex"]."</b> ";
			}
			if(isset($_GET["lug"]) && $_GET["lug"]!=""){
				$_SESSION["crt_bsq"].=" and UPPER(lugar) LIKE '%".strtoupper($_GET["lug"])."%'";
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Lugar: <b>".$_GET["lug"]."</b> ";
			}
			if(isset($_GET["fec"]) && $_GET["fec"]!=""){
				$fecha=substr($_GET["fec"], 3, 2)."/".substr($_GET["fec"], 0, 2)."/".substr($_GET["fec"], 6, 4);
				$fecha=date("Y-m-d", strtotime ($fecha));
				$_SESSION["crt_bsq"].=" and fecha='".$fecha."'";
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Fecha: <b>".$_GET["fec"]."</b> ";
			}
		} else if($_GET["axn"]=="r"){
			$_SESSION["crtr_bsqd_ev_titulo"]="";
			$_SESSION["crtr_bsqd_ev_texto"]="";
			$_SESSION["crtr_bsqd_ev_lugar"]="";
			$_SESSION["crtr_bsqd_ev_fecha"]="";
		}
		break;

	case 'dr_locals':
		if($_GET["axn"]=="b"){
			if(isset($_GET["cat"]) && $_GET["cat"]!=""){
				$_SESSION["crt_bsq"].=" and loc.id_dr_categs=".$_GET["cat"];
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Categoría: <b>".$_GET["cat"]."</b> ";
			}
			if(isset($_GET["zon"]) && $_GET["zon"]!=""){
				$_SESSION["crt_bsq"].=" and loc.id_dr_zonass=".$_GET["zon"];
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Zona: <b>".$_GET["zon"]."</b> ";
			}
			if(isset($_GET["nom"]) && $_GET["nom"]!=""){
				$_SESSION["crt_bsq"].=" and UPPER(loc.nombre) LIKE '%".strtoupper($_GET["nom"])."%'";
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Nombre: <b>".$_GET["nom"]."</b> ";
			}
			if(isset($_GET["tex"]) && $_GET["tex"]!=""){
				$_SESSION["crt_bsq"].=" and UPPER(loc.comentario) LIKE '%".strtoupper($_GET["tex"])."%'";
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Texto: <b>".$_GET["tex"]."</b> ";
			}
		} else if($_GET["axn"]=="r"){
			$_SESSION["crtr_bsqd_lc_catego"]="";
			$_SESSION["crtr_bsqd_lc_nivels"]="";
			$_SESSION["crtr_bsqd_lc_nombre"]="";
			$_SESSION["crtr_bsqd_lc_texto"]="";
		}
		break;

	case 'cm_notics':
		if($_GET["axn"]=='b'){
			if(isset($_GET["tit"]) && $_GET["tit"]!=""){
				$_SESSION["crt_bsq"].=" and UPPER(ntc.titulo) LIKE '%".strtoupper($_GET["tit"])."%'";
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Título: <b>".$_GET["tit"]."</b> ";
			}
			if(isset($_GET["ntr"]) && $_GET["ntr"]!=""){
				$_SESSION["crt_bsq"].=" and UPPER(ntc.introduccion) LIKE '%".strtoupper($_GET["ntr"])."%'";
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Introducción: <b>".$_GET["ntr"]."</b> ";
			}
			if(isset($_GET["cat"]) && $_GET["cat"]!=""){
				$_SESSION["crt_bsq"].=" and ntc.id_cm_categs=".$_GET["cat"];
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Categoría: <b>".$_GET["cat"]."</b> ";
			}
			if(isset($_GET["hsh"]) && $_GET["hsh"]!=""){
				$_SESSION["crt_bsq"].=" and UPPER(ntc.hashtags) LIKE '%".strtoupper($_GET["hsh"])."%'";
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Hashtags: <b>".$_GET["hsh"]."</b> ";
			}
			if(isset($_GET["fec"]) && $_GET["fec"]!=""){
				$fecha=substr($_GET["fec"], 3, 2)."/".substr($_GET["fec"], 0, 2)."/".substr($_GET["fec"], 6, 4);
				$fecha=date("Y-m-d", strtotime ($fecha));
				$_SESSION["crt_bsq"].=" and ntc.fecha='".$fecha."'";
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Fecha: <b>".$_GET["fec"]."</b> ";
			}
		} else if($_GET["axn"]=="r"){
			$_SESSION["crtr_bsqd_bl_titulo"]="";
			$_SESSION["crtr_bsqd_bl_introd"]="";
			$_SESSION["crtr_bsqd_bl_catego"]="";
			$_SESSION["crtr_bsqd_bl_hashtg"]="";
			$_SESSION["crtr_bsqd_bl_fecha"]="";
		}
		break;

	case 'gl_galery':
		if($_GET["axn"]=="b"){
			if(isset($_GET["tit"]) && $_GET["tit"]!=""){
				$_SESSION["crt_bsq"].=" and UPPER(titulo) LIKE '%".strtoupper($_GET["tit"])."%'";
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Título: <b>".$_GET["tit"]."</b> ";
			}
		} else if($_GET["axn"]=="r"){
			$_SESSION["crtr_bsqd_gl_titulo"]="";
		}
		break;

	case 'cn_actual':
		if($_GET["axn"]=='b'){
			if(isset($_GET["nom"]) && $_GET["nom"]!=""){
				$_SESSION["crt_bsq"].=" and UPPER(nombre) LIKE '%".strtoupper($_GET["nom"])."%'";
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Nombre: <b>".$_GET["nom"]."</b> ";
			}
			if(isset($_GET["ape"]) && $_GET["ape"]!=""){
				$_SESSION["crt_bsq"].=" and UPPER(apellido) LIKE '%".strtoupper($_GET["ape"])."%'";
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Apellido: <b>".$_GET["ape"]."</b> ";
			}
			if(isset($_GET["mes"]) && $_GET["mes"]!=""){
				$_SESSION["crt_bsq"].=" and UPPER(mensaje) LIKE '%".strtoupper($_GET["mes"])."%'";
				if($_SESSION["crt_tit"]!="") $_SESSION["crt_tit"].=" - ";
				$_SESSION["crt_tit"].="  Mensaje: <b>".$_GET["mes"]."</b> ";
			}
		} else if($_GET["axn"]=="r"){
			$_SESSION["crtr_bsqd_cn_nombre"]="";
			$_SESSION["crtr_bsqd_cn_apeldo"]="";
			$_SESSION["crtr_bsqd_cn_mesage"]="";
		}
		break;

	default:
		break;

}

if($_SESSION["crt_tit"]=="")
	$_SESSION["crt_tit"]="No se han aplicado Criterios de Búsqueda";
else
	$_SESSION["crt_tit"]="<b>Criterios de Búsqueda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>".$_SESSION["crt_tit"];
echo($_SESSION["crt_tit"]);

?>
