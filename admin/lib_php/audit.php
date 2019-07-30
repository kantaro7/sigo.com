<?php
$tit_acc=array(i => "Agregando ", m => "Modificando ", e => "Eliminando ", apl_entry => "Ingresando a la Aplicación ", apl_exit => "Saliendo de la Aplicación ");
$axn=html_encode($tit_acc[$_POST["sub_accion"]]);
if(strpos('i.m.e',$_POST["sub_accion"])!==false){
	$axn=$axn.html_encode($titulo.'.  sql: '.str_replace("'","<==>",$sql));
}
$sql="INSERT INTO ".$schema_1."access_profiles_audit (id_access_profiles, ap_roles, ap_opcion, ap_tabla, ap_fecha, ap_hora, ap_accion)  VALUES ('".$_SESSION["user_id"]."', '".$_SESSION["user_nivel"]."', '".$_POST["transac"]."', '".$tabla."', '".date("Y-m-d")."', '".date("G:i:s")."', '$axn')";
//echo("sql [".$sql."] <br>");
$db_sgc->db_insert($sql, $db_type);
?>