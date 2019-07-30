<?php
// Iniciar sesión
session_start();

// Configure Error Displaying
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//Configure Page headers
header('P3P: CP="CAO PSA OUR"');
header("Cache-control: private");

//Load Basic Configuration, Database & General Rutines
include_once "../lib_php/config.php";
include_once "../lib_php/general.php";

//Conectar con Base de Datos
$db_pdo=new PDO("mysql:host=$host;dbname=$base", $user, $pass);


$tabla=$_GET['tabla'];
$id=$_GET['id'];
$cmp=$_GET['cmp'];
$val=$_GET['val'];

if($val==$vlr_bd_no) $valor=$vlr_bd_si;
if($val==$vlr_bd_si) $valor=$vlr_bd_no;

$random=md5(uniqid(rand(), 1));

$shwn_icon="activ_36.png?vrbl=".$random;
$shwn_titl="Activ".$_SESSION["letra_final"];
if($valor==$vlr_chkbx_no){
	$shwn_icon="inactiv_36.png?vrbl=".$random;
	$shwn_titl="Inactiv".$_SESSION["letra_final"];
}

$sql="UPDATE ".$schema_pub.$tabla."  SET $cmp='$valor'  WHERE id_".$tabla."=$id";
//echo("sql [".$sql."] <br>");
$stmt1=$db_pdo->prepare($sql);
if($stmt1===false){
	trigger_error($db_pdo->error, E_USER_ERROR);
}
$stmt1->execute();		
if($status===false){
	trigger_error($stmt1->error, E_USER_ERROR);
}
?>

<img id="img_mat_right" src="admin/images/mat_icons/<?php echo($shwn_icon); ?>" onclick="swtch_activ(<?php echo("'$tabla', $id, '$cmp', $valor") ?>)" width="30" height="30" style="margin-top: 4px;" title="<?php echo(html_encode($_SESSION["titulo"]." $shwn_titl")); ?>" />
