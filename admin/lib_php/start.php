<?php
// Iniciar sesión
session_start();
// Configure Error Displaying
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//Indicador de Ejecución en Web o Local
$publicado=true;

//Determinar carpeta root dependiendo de sitio de ejecución
if($publicado){

	/*
	//
	//	Credenciales para direccionamiento de admin.php (en www.sdeyf.com)
	//
	$apl_sroot="";
	$apl_root="http://sigo.com/$apl_sroot";
	*/

	//
	//	Credenciales para direccionamiento de admin.php (en dev.ecopublicidadco.com)
	//
	$apl_sroot="sigo/";
	$apl_root="http://dev.ecopublicidadco.com/$apl_sroot";

} else {

	//
	//	Credenciales para direccionamiento de admin.php y google recaptcha (en Dell de Flavio)
	//
	$apl_sroot="/sigo.com/";
	$apl_root="http://localhost$apl_sroot";

}

// Validate FROM of Execution
if(strpos($_SERVER['HTTP_REFERER'],$apl_root)===false&&$_SERVER['HTTP_REFERER']==""&&$_SERVER['PHP_SELF']!=$apl_sroot."admin.php"&&$_SERVER['PHP_SELF']!="/admin.php"){
	echo("*&nbsp;*&nbsp;*&nbsp;&nbsp;&nbsp;&nbsp;Ejecuci&oacute;n Detenida<br>");
	echo("*<br>");
	echo("*&nbsp;&nbsp;Se est&aacute; intentando ejecutar el Sistema de forma indebida.<br>");
	echo("*<br>");
	echo("*&nbsp;&nbsp;Si persiste el problema, notifique a Flavio G&oacute;mez al tel&eacute;fono (0414) 161.10.00<br>");
	echo("*<br>");
	echo("*&nbsp;*&nbsp;*<br>");
	echo("PHP_SELF  [".$_SERVER['PHP_SELF']."]<br>");
	echo("REQUEST_URI  [".$_SERVER['REQUEST_URI']."]<br>");
	echo("HTTP_REFERER  [".$_SERVER['HTTP_REFERER']."]<br>");
	exit;
}
// Estimate address of include folder
$pre=str_replace($apl_sroot, "", $_SERVER['PHP_SELF']);
if($publicado) $pre=substr($pre, 1);

$pre_inc="";
if(($_SERVER['PHP_SELF']!=$apl_root."admin.php")&&($_SERVER['PHP_SELF']!="/admin.php")){
	$pre_inc=str_repeat( "../",  substr_count( $pre , "/") );
}

//	Configure Page headers
header('P3P: CP="CAO PSA OUR"');
header("Cache-control: private");

//	Load Basic Configuration, Database & General Rutines
include_once $pre_inc."admin/lib_php/config.php";
include_once $pre_inc."admin/lib_php/general.php"; 

/*
echo(" POST Collection <br>");
echo(" ----------------- <br>");
foreach ($_POST as $cmp => $val){
	echo(" $cmp [$val] <br>");
}
echo(" ----------------- <br>");
//   Display GET Collection
echo(" GET Collection <br>");
echo(" ---------------- <br>");
foreach ($_GET as $cmp => $val) {
	echo(" $cmp [$val] <br>");
}
echo(" ---------------- <br>");
*/
?>
