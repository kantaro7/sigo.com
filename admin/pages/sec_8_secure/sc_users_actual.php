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

$accn=$_GET["acc"];
$dreg=$_GET["dreg"];

if($_SESSION["letra_final"]=="o"){
	$tit_acc=array(i => "Agregar un Nuevo ", m => "Modificar el ", e => "Eliminar el ");
} else {
	$tit_acc=array(i => "Agregar una Nueva ", m => "Modificar la ", e => "Eliminar la ");
}

if($dreg!="" && $accn!=""){
	$clave=base64_decode($dreg);
	//Hacer query sobre la tabla principal para determinar total de registros
	$stmt1=$db_pdo->prepare("SELECT *  FROM ".$_SESSION["tabla"]."  WHERE id_".$_SESSION["elemento"]."=:id_reg");
	if($stmt1===false){
		trigger_error($db_pdo->error, E_USER_ERROR);
	}
	// Bind params
	$stmt1->bindParam(':id_reg', $clave, PDO::PARAM_INT);
	$stmt1->execute();		
	if($status===false){
		trigger_error($stmt1->error, E_USER_ERROR);
	}
	$reg_data=$stmt1->fetch();
}
$adm_ico="check_un1_36.png";
if($reg_data["nivel_admin"]=="$vlr_chkbx_si") $adm_ico="check1_36.png";
$act_ico="check_un1_36.png";
if($reg_data["status"]=="$vlr_chkbx_si") $act_ico="check1_36.png";
?>

<style type="text/css">
	#actual_contenedor {
		width: 750px;
		min-height: 720px;
		background-color: #ffffff;
		color: #444444;
		font-family: Calibri, Arial;
		font-size: 18px;
		font-weight: 300;
		line-height: 22px;
	}
	#actual_titulo{
		float: left;
		width: 650px;
		height: 28px;
		margin-top: 25px;
		margin-left: 50px;
		font-size: 24px;
		background-color: #ffffff;
		border-bottom: 2px #09F solid;
	}
	#elmnt_block{
		float: left;
		width: 650px;
		min-height: 60px;
		margin-top: 15px;
		margin-left: 50px;
		background-color: #ffffff;
	}
	#elmnt_image {
		float: left;
		width: 48px;
		height: 58px;
		margin-top: 0px;
		margin-left: 0px;
	}
	#elmnt_title {
		float: right;
		width: 590px;
		height: 24px;
		margin-top: 0px;
		margin-right: 0px;
		color: #545455;
		font-size: 15px;
		font-weight: 300;
	}
	#elmnt_case {
		float: right;
		width: 590px;
		height: 24px;
		margin-top: 06px;
		margin-right: 0px;
		border-bottom: 1px #999 solid;
	}
	.elmnt_elmnt {
		text-align: left;
		font-size: 16px;
		font-weight: 300;
		border: none;
	}
	.elmnt_ic_chk {
		text-align: left;
		margin-top: 06px;
		margin-left: 08px;
		cursor: pointer;
		border: none;
	}
	input[type=submit] {
		float: right;
		width: 150px;
		height: 36px;
		margin-top: 20px;
		margin-right: 180px;
		padding:5px 15px;
		color: #FFF;
		font-size: 17px;
		letter-spacing: 1px;
		background:#00BCD4;
		border:0 none;
		cursor:pointer;
		-webkit-border-radius: 3px;
		border-radius: 3px;
	}
	input[type=button] {
		float: right;
		width: 150px;
		height: 36px;
		margin-top: 20px;
		margin-right: 70px;
		padding:5px 15px;
		color: #FFF;
		font-size: 17px;
		letter-spacing: 1px;
		background:#FF4081;
		border:0 none;
		cursor:pointer;
		-webkit-border-radius: 3px;
		border-radius: 3px;
	}
	#error_actual{
		float: left;
		width: 400px;
		min-height: 100px;
		margin-top: 20px;
		margin-left: 185px;
		color: #F00;
		font-family: Calibri, Arial;
		font-size: 18px;
		font-weight: 500;
		line-height: 21px;
		text-align: center;
	}
</style>

  <!--  C o n t e n e d o r   P r i n c i p a l  -->
<div id="actual_contenedor">
  <div id="actual_titulo"><?php echo(html_encode($tit_acc[$accn]." ".$_SESSION["titulo"])); ?></div>
  <div>
    <form id="frm_actual" name="frm_actual" method="post" action="<?php echo("admin/pages/".$_SESSION["carpeta"]."/".$_SESSION["rprog"]."_actual_db.php"); ?>" onsubmit="return frm_vldt_<?php echo($_SESSION["rprog"]."('$accn');"); ?>" enctype="multipart/form-data" accept-charset="UTF-8">
			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/user_accn_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("Nombre y Apellido")); ?></div>
        <div id="elmnt_case">
        	<input type="text" name="user_name" id="user_name" class="elmnt_elmnt" size="50" maxlength="50" placeholder="<?php echo(html_encode("Indique el nombre")); ?>" value="<?php echo(html_encode($reg_data["user_name"])); ?>" tabindex="01" onKeyPress="if(event.keyCode==13){ document.getElementById('user_pass').focus(); } return frmt_alpha_betic(event);" >
        </div>
			</div>
			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/login_pass_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("Contraseña")); ?></div>
        <div id="elmnt_case">
        	<input type="password" name="user_pass" id="user_pass" class="elmnt_elmnt" size="50" maxlength="50" placeholder="<?php echo(html_encode("Indique la contraseña secreta")); ?>" value="" tabindex="02" onKeyPress="if(event.keyCode==13){ document.getElementById('user_email').focus(); } return frmt_alpha(event);" >
        </div>
			</div>
			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/email_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("Correo Electrónico (Email)")); ?></div>
        <div id="elmnt_case">
        	<input type="text" name="user_email" id="user_email" class="elmnt_elmnt" size="50" maxlength="50" placeholder="<?php echo(html_encode("Indique el correo electrónico")); ?>" value="<?php echo(html_encode($reg_data["user_email"])); ?>" tabindex="03" onKeyPress="if(event.keyCode==13){ document.getElementById('user_phone').focus(); } return frmt_email(event);" >
        </div>
			</div>
			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/phone_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("Teléfono")); ?></div>
        <div id="elmnt_case">
        	<input type="text" name="user_phone" id="user_phone" class="elmnt_elmnt" size="50" maxlength="20" placeholder="<?php echo(html_encode("Indique el teléfono")); ?>" value="<?php echo(html_encode($reg_data["user_phone"])); ?>" tabindex="04" onKeyPress="if(event.keyCode==13){ document.getElementById('user_level').focus(); } return frmt_phone(event);" >
        </div>
			</div>
 			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/setup_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("Es Administrador?")); ?></div>
				<img id="adm_ico" class="elmnt_ic_chk" src="admin/images/mat_icons/<?php echo($adm_ico); ?>" onclick="swtch_chkbox(this.id, 'adm_chk');" alt="" width="34" height="34" />
        <input name="adm_chk" id="adm_chk" type="checkbox" value="<?php echo($vlr_chkbx_si); ?>" <?php if($reg_data["nivel_admin"]=="$vlr_chkbx_si") echo(" checked "); ?> style="display: none;" />
			</div>
 			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/ok_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("Usuario Activo?")); ?></div>
				<img id="act_ico" class="elmnt_ic_chk" src="admin/images/mat_icons/<?php echo($act_ico); ?>" onclick="swtch_chkbox(this.id, 'act_chk');" alt="" width="34" height="34" />
        <input name="act_chk" id="act_chk" type="checkbox" value="<?php echo($vlr_chkbx_si); ?>" <?php if($reg_data["status"]=="$vlr_chkbx_si") echo(" checked "); ?> style="display: none;" />
			</div>
     
			<!--  Botones de Cancelar y Actualizar  -->
      <input name="btn_enviar" id="btn_enviar" type="submit" value="<?php echo(trim(substr($tit_acc[$accn], 0, strpos($tit_acc[$accn], " ")))); ?>">
      <input name="btn_cerrar" id="btn_cerrar" type="button" class="nyroModalClose" value="Cancelar">   
    
    	<div id="error_actual"></div>

			<input name="prm_axn" id="prm_axn" type="hidden" value="<?php echo(base64_encode($accn)); ?>" />
			<input name="prm_elm" id="prm_elm" type="hidden" value="<?php echo(base64_encode($clave)); ?>" />

    </form>

  </div>
</div>
