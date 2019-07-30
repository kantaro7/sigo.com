<?php
$ok_ssn=true;
if($_SESSION["user_id"]=="" || $_SESSION["user_id"]<1 || !isset($_SESSION["user_id"])){
	//Destruyendo Variables de Sesión
	unset($_SESSION["user_id"]);
	unset($_SESSION["user_lvl"]);
	unset($_SESSION["user_nme"]);
	
	//Destruyendo Sesión
	session_destroy();
	
	//Reiniciar admin.php
	header('Location: ".$indent."admin.php');
	
	$ok_ssn=false;
}
?>