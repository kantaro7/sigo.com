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


function vrfy_upld_fl($nme_img, $ttl_img, $accn, $tp_size){
	global $msg, $wrn;
	
	if($_FILES[$nme_img]['name']==''){
		if($accn=="i") $msg.="- No se ha especificado imagen de $ttl_img.\\n";
	} else {	
		//Check size
		if($_FILES[$nme_img]['size'] > $tp_size) $wrn="La imagen cargada es muy pesada: ".round($_FILES[$nme_img]['size']/1024, 2)." Kb. (Peso recomendado: ".ceil($tp_size/1024)." Kb.)\\n";
		//Check type
		$allowedTypes=array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
		$detectedType=exif_imagetype($_FILES[$nme_img]['tmp_name']);
		$error=!in_array($detectedType, $allowedTypes);
		if($error!="") $msg.=$error;
	}
}


function upld_image($nme_img, $ttl_img, $id_img, $s_trg){
	global $msg;
	
	//Obtain Extension
	$exten=str_replace(".", "", substr($_FILES[$nme_img]['name'], -4));
	//Establish target path
	$trgt_img = "../../upld_".$_SESSION["rimag"]."/".$s_trg."_".$id_img.".".$exten; 
	if(!move_uploaded_file($_FILES[$nme_img]['tmp_name'], $trgt_img)){ 
		$msg.="No se pudo subir imagen de $ttl_img.\\n"; 
	} 
}


$msg=""; 
$wrn=""; 

$accn=base64_decode($_POST["prm_axn"]);

$act_chk=$vlr_chkbx_si;
if($_POST["act_chk"]!=$vlr_chkbx_si) $act_chk=$vlr_chkbx_no;
$sombra=$vlr_chkbx_si;
if($_POST["sombra"]!=$vlr_chkbx_si) $sombra=$vlr_chkbx_no;

vrfy_upld_fl("img_foto", "Foto", $accn, 512000);

if($msg!=""){
	$_SESSION["msg_error"]=$msg;
} else {
	switch ($accn) {
		case "i":
			//Modificar (vía PDO) la tabla correspondiente
			$sql="INSERT INTO ".$_SESSION["tabla"]." (orden, name_foto, shown) VALUES (".$_POST["orden"].", '".$_FILES['img_foto']['name']."', '$act_chk')";
			//echo("sql [".$sql."] <br>");
			$stmt1=$db_pdo->prepare($sql);
			if($stmt1===false){
				trigger_error($db_pdo->error, E_USER_ERROR);
			}
			$stmt1->execute();		
			if($status===false){
				trigger_error($stmt1->error, E_USER_ERROR);
			} else {
				$id_lcl = $db_pdo->lastInsertId();
				$rslt_3 = upld_image("img_foto", "Foto", $id_lcl, "ft");
			}
			break;
		case "m":
			//En caso de cambio de imágenes
			$str_img="";
			if($_FILES['img_foto']['name']!="") $str_img.=", name_foto='".$_FILES['img_foto']['name']."' ";
			//Modificar (vía PDO) la tabla correspondiente
			$clave=base64_decode($_POST["prm_elm"]);
			$sql="UPDATE ".$_SESSION["tabla"]."  SET orden=".$_POST["orden"].", shown='$act_chk'  $str_img  WHERE id_".$_SESSION["tabla"]."=$clave";
			//echo("sql [".$sql."] <br>");
			$stmt1=$db_pdo->prepare($sql);
			if($stmt1===false){
				trigger_error($db_pdo->error, E_USER_ERROR);
			}
			$stmt1->execute();		
			if($status===false){
				trigger_error($stmt1->error, E_USER_ERROR);
			} else {
				if($_FILES['img_foto']['name']!="") $rslt_3 = upld_image("img_foto", "Foto", $clave, "ft");
			}
			break;
		case "e":
			//Modificar (vía PDO) la tabla correspondiente
			$clave=base64_decode($_POST["prm_elm"]);
			$sql="UPDATE ".$_SESSION["tabla"]."  SET deleted='$vlr_chkbx_si'  WHERE id_".$_SESSION["tabla"]."=$clave";
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
	if($msg!="") $_SESSION["msg_error"]=$msg;
	if($wrn!="") $_SESSION["msg_warng"]=$wrn;
}

header('Location: ../../../admin.php');?>