<?php

function sys_audit($modulo, $opcion, $id_opcion, $accion, $sql_query){
	global $db_sgc, $db_type, $schema_secure, $apl_cod;	
	$sql_audit="INSERT INTO ".$schema_secure."users_activity (id_users, estacion, modulo, opcion, id_opcion, accion, fecha, hora, sql_query)  VALUES (".$_SESSION["user_id"].", '".gethostbyaddr($_SERVER['REMOTE_ADDR'])."', '$modulo', '$opcion', $id_opcion, $accion, '".date("Y-m-d")."', '".date("G:i:s")."', '$sql_query')";
	//echo("sql_audit [".$sql_audit."] <br>");
	return $db_sgc->db_insert($sql_audit, $db_type);
}

function db_descri($schema, $table, $descri, $id){
	global $db_sgc, $db_type;
	$sql_descri="SELECT $descri FROM ".$schema.$table." WHERE id_$table=$id";
	//echo("sql_descri [".$sql_descri."] <br>");
	$sql_descri=$db_sgc->db_query($sql_descri, $db_type);
	$matriz_descri=$db_sgc->db_fetch_rows($sql_descri, $db_type);
	return $matriz_descri[$descri];
}

function sys_audit_fnd($subsistema, $modulo, $id_modulo, $descripcion){
	global $db_sgc, $db_type, $schema_pub, $apl_cod;
	$audit="";
	$sql_audit="SELECT trn.*, usr.user_name  FROM ".$schema_secure."users_activity trn  INNER JOIN ".$schema_public."users usr ON trn.id_users=usr.id_users  WHERE trn.subsistema='$subsistema' and  trn.modulo='$modulo' and id_modulo=$id_modulo and descripcion='$descripcion'  ORDER BY trn.fecha DESC  LIMIT 1 OFFSET 0";
	//echo("sql_audit [".$sql_audit."] <br>");
	$num_audit=$db_sgc->db_number_of_rows($sql_audit, $db_type);
	if($num_audit>0){
		$sql_audit=$db_sgc->db_query($sql_audit, $db_type);
		$audit=$db_sgc->db_fetch_rows($sql_audit, $db_type);
	}
	return $audit;
}
?>