<?php
// Iniciar sesión
session_start();

// Configure Error Displaying
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//Configure Page headers
header('P3P: CP="CAO PSA OUR"');
header("Cache-control: private");

//Load Basic Configuration, Database & General Rutines
include_once "../../lib_php/config.php";
include_once "../../lib_php/general.php";

//Conectar con Base de Datos
$db_pdo=new PDO("mysql:host=$host;dbname=$base", $user, $pass);

set_time_limit(600);

$accn=base64_decode($_POST["prm_axn"]);

$adm_chk=$vlr_chkbx_si;
if($_POST["adm_chk"]!=$vlr_chkbx_si) $adm_chk=$vlr_chkbx_no;
$act_chk=$vlr_chkbx_si;
if($_POST["act_chk"]!=$vlr_chkbx_si) $act_chk=$vlr_chkbx_no;
/*
echo("accn [".$accn."] <br>");
echo("adm_chk [".$_POST["adm_chk"]."]  [".$adm_chk."] <br>");
echo("act_chk [".$_POST["act_chk"]."]  [".$act_chk."] <br>");
*/
switch ($accn) {
	case "i": 
		//Modificar (vía PDO) la tabla correspondiente
		$sql="INSERT INTO ".$schema_pub.$_SESSION["tabla"]." (user_name, user_pass, user_email, user_phone, nivel_admin, status) VALUES ('".$_POST["user_name"]."', '".md5($_POST["user_pass"])."', '".$_POST["user_email"]."', '".$_POST["user_phone"]."', '$adm_chk', '$act_chk')";
		//echo("sql [".$sql."] <br>");
		$stmt1=$db_pdo->prepare($sql);
		if($stmt1===false){
			trigger_error($db_pdo->error, E_USER_ERROR);
		}
		$stmt1->execute();		
		if($status===false){
			trigger_error($stmt1->error, E_USER_ERROR);
		}
		break;
	case "m":
		//En caso de cambio de contraseña
		$contra=$_POST["user_pass"];
		if(strlen($contra)!=0){
			$cadena_contra=", user_pass='".md5($contra)."'";
		} else {
			$cadena_contra="";
		}
		//Modificar (vía PDO) la tabla correspondiente
		$clave=base64_decode($_POST["prm_elm"]);
		$sql="UPDATE ".$schema_pub.$_SESSION["tabla"]."  SET user_name='".$_POST["user_name"]."', user_email='".$_POST["user_email"]."', user_phone='".$_POST["user_phone"]."', nivel_admin='$adm_chk', status='$act_chk'  $cadena_contra  WHERE id_".$_SESSION["tabla"]."=$clave";
		//echo("sql [".$sql."] <br>");
		$stmt1=$db_pdo->prepare($sql);
		if($stmt1===false){
			trigger_error($db_pdo->error, E_USER_ERROR);
		}
		$stmt1->execute();		
		if($status===false){
			trigger_error($stmt1->error, E_USER_ERROR);
		}
		break;
	case "e":
		//Modificar (vía PDO) la tabla correspondiente
		$clave=base64_decode($_POST["prm_elm"]);
		$sql="UPDATE ".$schema_pub.$_SESSION["tabla"]."  SET sw_deleted='$vlr_chkbx_si'  WHERE id_".$_SESSION["tabla"]."=$clave";
		//echo("sql [".$sql."] <br>");
		$stmt1=$db_pdo->prepare($sql);
		if($stmt1===false){
			trigger_error($db_pdo->error, E_USER_ERROR);
		}
		$stmt1->execute();		
		if($status===false){
			trigger_error($stmt1->error, E_USER_ERROR);
		}
		break;
}
header('Location: ../../../admin.php');?>