<?php
// Iniciar sesión
session_start();

// Configure Error Displaying
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//Configure Page headers
header('P3P: CP="CAO PSA OUR"');
header("Cache-control: private");

//Load Basic Configuration, Database & General Rutines
include_once "../lib_php/config.php";					// Constantes Globales
include_once "../lib_php/general.php";					// Funciones varias

include_once "../lib_php/recaptchalib.php";

//Connect to Database
$db_pdo=new PDO("mysql:host=$host;dbname=$base", $user, $pass);

$apl_cod=$apl_cod_web;

//Read & Process Parameters
$code=str_replace("'", "", str_replace('"', '', $_GET["code"]));
$pass=md5(str_replace("'", "", str_replace('"', '', $_GET["pass"])));
$cpch=$_GET["cpch"];

//echo("SELECT id_sc_users, user_name, nivel_admin, status  FROM sc_users  WHERE user_email=$code and user_pass=$pass <br>");

if($cpch!=""){
	//Search Usuario in Database
	$stmt1=$db_pdo->prepare("SELECT id_sc_users, user_name, nivel_admin, status  FROM sc_users  WHERE user_email=:code and user_pass=:pass");
	if($stmt1===false){
		trigger_error($db_pdo->error, E_USER_ERROR);
	}
	$stmt1->bindParam(":code", $code, PDO::PARAM_STR);
	$stmt1->bindParam(":pass", $pass, PDO::PARAM_STR);
	$stmt1->execute();		
	if($status===false){
		trigger_error($stmt1->error, E_USER_ERROR);
	}
	if($stmt1->rowCount()>0){
		$user_data=$stmt1->fetch();
		if($user_data["status"]==$vlr_chkbx_si){
			
			//Creando Variables de Sesión
			$_SESSION["user_id"]=$user_data["id_sc_users"];
			$_SESSION["user_nme"]=$user_data["user_name"];
			$_SESSION["user_lvl"]="m";
			if($user_data["nivel_admin"]==$vlr_chkbx_si) $_SESSION["user_lvl"]="a";
			$_SESSION["menu_opc"]=0;
			
			echo("<input id='rslt' name='rslt' type='hidden' value='".$_SESSION["user_id"]."'>");
		} else {
			echo("Este usuario no está autorizado");
		}
	} else {
		echo("Usuario errado / Contraseña errada");
	}
} else {
	echo("Debe indicar que no es un Robot");
}

?>
