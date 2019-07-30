<?php
putenv("TZ=America/Caracas");
date_default_timezone_set("America/Caracas");

//Indicar t�tulo HTML de la PW y el AC
$pag_name="SIGO";
$apl_name="SIGO | Administrador Contenido";

//Indicar prefijo de variables de sesi�n de la PW y el AC
$apl_cod_web="sg_web_";
$apl_cod_adm="sg_adm_";

//Indicador de Ejecuci�n en Web o Local
$publicado=false;

//Determinar carpeta root dependiendo de sitio de ejecuci�n
if($publicado){

	/*
	//	Credenciales para direccionamiento de admin.php y google recaptcha (en www.sdeyf.com)
	//
	$apl_sroot="";
	$apl_root="http://fgc-research.com/$apl_sroot";
	//Register API keys at https://www.google.com/recaptcha/admin
	$grc_siteKey = "6Lch3DMUAAAAANggBA13ychFVU0NQ6nBM75YeVUb";
	$grc_secret = "6Lch3DMUAAAAAFwE36ni98CO5vJTHfZ2RVy3mA44";
	*/

	//
	//	Credenciales para direccionamiento de admin.php y google recaptcha (en dev.ecopublicidadco.com)
	//
	$apl_sroot="sigo/";
	$apl_root="http://dev.ecopublicidadco.com/$apl_sroot";
	//Register API keys at https://www.google.com/recaptcha/admin
	$grc_siteKey = "6Lca-CYTAAAAAC9sT_-mRTTCQkUPlqhPdN3WRVmP";
	$grc_secret = "6Lca-CYTAAAAANSmaGxvwXpv7ip_R7aWkn108ox2";

} else {
	//	Credenciales para direccionamiento de admin.php y google recaptcha (en localhost)
	//
	$apl_sroot="/sigo.com/";
	$apl_root="http://localhost$apl_sroot";
	//Register API keys at https://www.google.com/recaptcha/admin
	$grc_siteKey = "6Lft5SQTAAAAAGJ2RbEhG3qujg9GvQVyGdiq2BFF";
	$grc_secret = "6Lft5SQTAAAAAEknTNtjv1nRO3nu3HCq1j11HEWM";
}


$email_host="p3plcpnl0895.prod.phx3.secureserver.net";
$email_user="contacto@sigo.com";
$email_pass="Cambiar2017!";

$email_addr=array("conta" => "flaviog3000@gmail.com");   


//Credenciales de conexi�n a la BD dependiendo del sitio de conexi�n
if($publicado){
	$host="localhost";
	$port="3306";
	$base="sigo_db_web";
	$user="sigo_usr_048";
	$pass="Passw0rd01";
	/*
	$host="qym722.sdeyf.com";
	$port="3306";
	$base="qym722";
	$user="qym722";
	$pass="Madrid1";
	*/
} else {
	$host="localhost";
	$port="5432";
	$base="sigo_db_web";
	$user="root";
	$pass="";
}


$array_week_days[0]="Domingo";
$array_week_days[1]="Lunes";
$array_week_days[2]="Martes";
$array_week_days[3]="Mi�rcoles";
$array_week_days[4]="Jueves";
$array_week_days[5]="Viernes";
$array_week_days[6]="S�bado";

$array_month[0]="Enero";
$array_month[1]="Febrero";
$array_month[2]="Marzo";
$array_month[3]="Abril";
$array_month[4]="Mayo";
$array_month[5]="Junio";
$array_month[6]="Julio";
$array_month[7]="Agosto";
$array_month[8]="Septiembre";
$array_month[9]="Octubre";
$array_month[10]="Noviembre";
$array_month[11]="Diciembre";


$vlr_chkbx_si=1;
$vlr_chkbx_no=0;
$vlr_bd_si=1;
$vlr_bd_no=0;
$schema_public="";
$schema_secure="";
$schema_useext="";


$rows_per_page=20;


$clr_tbl_1="01017C";
$clr_tbl_2="0000FB";
$clr_tbl_3="C0ECCF";
$clr_tbl_4="D6D7D7";
$clr_btn_1="1966b3";
$clr_btn_2="e0e0e0";
$clr_brr_1="b6b5b5";
$clr_brr_2="b6b5b5";


$clr_tt_1="#fff6a6"; 
$cls_tt_1="verdana_10_black_bold"; 


$class_caja_texto="verdana_11_black";
$class_titulo_caja_texto="verdana_11_black";
$class_boton_1="Boton";
?>