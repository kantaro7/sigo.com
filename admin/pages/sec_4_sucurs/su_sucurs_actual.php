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
$act_ico="check_un1_36.png";
if($reg_data["shown"]=="$vlr_chkbx_si") $act_ico="check1_36.png";
?>

<style type="text/css">
	#actual_contenedor {
		width: 750px;
		height: auto;
		overflow: hidden;
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
		min-height: 24px;
		margin-top: 06px;
		margin-right: 0px;
		border-bottom: 1px #999 solid;
	}
	#elmnt_case_sl {
		float: right;
		width: 590px;
		min-height: 26px;
		margin-top: 04px;
		margin-right: 0px;
		/* border-bottom: 1px #999 solid; */
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
		min-height: 50px;
		margin-top: 20px;
		margin-left: 185px;
		margin-bottom: 20px;
		color: #F00;
		font-family: Calibri, Arial;
		font-size: 18px;
		font-weight: 500;
		line-height: 21px;
		text-align: center;
	}
	.elmnt_foto {
		float: left;
		width: 150px;
		height: 26px;
		overflow: hidden;
		margin-top: 0px;
		margin-left: 0px;
		margin-right: 0px;
		margin-bottom: 0px;
		background-image: url(admin/images/fondos/btn_file_3.png);
		cursor:pointer;
	}

	.elmnt_file {
		cursor:pointer;
		filter: alpha(opacity=0);
		opacity: 0;
	}

	.msg_image{
		float: left;
		width: 400px;
		min-height: 16px;
		margin-top: 2px;
		margin-left: 10px;
		margin-bottom: 20px;
		color: #F00;
		font-family: Calibri, Arial;
		font-size: 12px;
		font-weight: 500;
		line-height: 16px;
		text-align: left;
	}
</style>

  <!--  C o n t e n e d o r   P r i n c i p a l  -->
<div id="actual_contenedor">
  <div id="actual_titulo"><?php echo(html_encode($tit_acc[$accn]." ".$_SESSION["titulo"])); ?></div>
  <div>
    <form id="frm_actual" name="frm_actual" method="post" action="<?php echo("admin/pages/".$_SESSION["carpeta"]."/".$_SESSION["rprog"]."_actual_db.php"); ?>" onsubmit="return frm_vldt_<?php echo($_SESSION["rprog"]."('$accn');"); ?>" enctype="multipart/form-data" accept-charset="UTF-8">
			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/label_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("Nombre")); ?></div>
        <div id="elmnt_case">
        	<input type="text" name="nombre" id="nombre" class="elmnt_elmnt" size="70" maxlength="100" placeholder="<?php echo(html_encode("Indique el Nombre")); ?>" value="<?php echo(html_encode($reg_data["nombre"])); ?>" tabindex="01" onKeyPress="if(event.keyCode==13){ document.getElementById('introduccion').focus(); } return frmt_alpha(event);" >
        </div>
			</div>
			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/list_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("Ciudad")); ?></div>
        <div id="elmnt_case_sl">
					<?php
					$tabla="su_ciudad";
          $sql="SELECT * FROM $tabla  WHERE shown='$vlr_bd_si' and deleted='$vlr_bd_no'  ORDER BY orden";
          //echo("sql  [".$sql."]<br>");
          $stmt2=$db_pdo->prepare($sql);
          if($stmt2 === false){
            trigger_error($db_pdo->error, E_NOTICE);
          }
          $status=$stmt2->execute();
          if ($status === false){
            trigger_error($stmt2->error, E_NOTICE);
          }
          ?>
          <select name='id_<?php echo($tabla); ?>' id='id_<?php echo($tabla); ?>' class='selectParent'>
          <option value=><?php echo(html_encode("Seleccione la Cuidad...")); ?></option>
          <?php
          if($stmt2->rowCount()>0){
            $filas=0;
            while($fila=$stmt2->fetch()){
              $sele="";
              if($fila["id_".$tabla]==$reg_data["id_".$tabla]) $sele="selected";
              echo "<option value=".$fila["id_".$tabla]." $sele>".html_encode($fila["nombre"])."</option>";
              $filas++;
            }
          }
          ?>
        </select>          
        </div>
			</div>
			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/text_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("Texto Superior (Izquierdo)")); ?></div>
        <div id="elmnt_case">
					<textarea name="texto_sup_1" id="texto_sup_1" cols="58" rows="2" class="elmnt_elmnt" placeholder="<?php echo(html_encode("Indique el texto superior (izquierdo)")); ?>" style="color: #444444; font-family: Calibri, Arial font-size: 18px; font-weight: 300; line-height: 22px;" onKeyPress="return frmt_alpha(event);" ><?php echo(html_encode($reg_data["texto_sup_1"])); ?></textarea>
        </div>
			</div>
			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/text_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("Texto Superior (Derecho)")); ?></div>
        <div id="elmnt_case">
					<textarea name="texto_sup_2" id="texto_sup_2" cols="58" rows="2" class="elmnt_elmnt" placeholder="<?php echo(html_encode("Indique el texto superior (derecho)")); ?>" style="color: #444444; font-family: Calibri, Arial font-size: 18px; font-weight: 300; line-height: 22px;" onKeyPress="return frmt_alpha(event);" ><?php echo(html_encode($reg_data["texto_sup_2"])); ?></textarea>
        </div>
			</div>
			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/place_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("Dirección")); ?></div>
        <div id="elmnt_case">
					<textarea name="direccion" id="direccion" cols="58" rows="2" class="elmnt_elmnt" placeholder="<?php echo(html_encode("Indique la dirección")); ?>" style="color: #444444; font-family: Calibri, Arial font-size: 18px; font-weight: 300; line-height: 22px;" onKeyPress="return frmt_alpha(event);" ><?php echo(html_encode($reg_data["direccion"])); ?></textarea>
        </div>
			</div>
			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/phone_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("Teléfonos")); ?></div>
        <div id="elmnt_case">
					<textarea name="telefonos" id="telefonos" cols="58" rows="1" class="elmnt_elmnt" placeholder="<?php echo(html_encode("Indique los teléfonos")); ?>" style="color: #444444; font-family: Calibri, Arial font-size: 18px; font-weight: 300; line-height: 22px;" onKeyPress="return frmt_alpha(event);" ><?php echo(html_encode($reg_data["telefonos"])); ?></textarea>
        </div>
			</div>
			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/clock_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("Horario")); ?></div>
        <div id="elmnt_case">
					<textarea name="horario" id="horario" cols="58" rows="1" class="elmnt_elmnt" placeholder="<?php echo(html_encode("Indique el horario")); ?>" style="color: #444444; font-family: Calibri, Arial font-size: 18px; font-weight: 300; line-height: 22px;" onKeyPress="return frmt_alpha(event);" ><?php echo(html_encode($reg_data["horario"])); ?></textarea>
        </div>
			</div>
			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/link_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("URL Asociado del Mapa")); ?></div>
        <div id="elmnt_case">
        	<input type="text" name="map_url" id="map_url" class="elmnt_elmnt" size="70" maxlength="300" placeholder="<?php echo(html_encode("Indique el URL asociado del mapa")); ?>" value="<?php echo(html_encode($reg_data["map_url"])); ?>" tabindex="01" onKeyPress="if(event.keyCode==13){ document.getElementById('act_chk').focus(); } return frmt_alpha(event);" >
        </div>
			</div>
			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/order_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("Orden")); ?></div>
        <div id="elmnt_case">
        	<input type="text" name="orden" id="orden" class="elmnt_elmnt" size="50" maxlength="3" placeholder="<?php echo(html_encode("Indique el orden")); ?>" value="<?php echo($reg_data["orden"]); ?>" tabindex="01" onKeyPress="if(event.keyCode==13){ document.getElementById('act_chk').focus(); } return frmt_nmbr_int(event);" >
        </div>
			</div>
 			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/ok_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("Activa?")); ?></div>
				<img id="act_ico" class="elmnt_ic_chk" src="admin/images/mat_icons/<?php echo($act_ico); ?>" onclick="swtch_chkbox(this.id, 'act_chk');" alt="" width="34" height="34" />
        <input name="act_chk" id="act_chk" type="checkbox" value="<?php echo($vlr_chkbx_si); ?>" <?php if($reg_data["shown"]=="$vlr_chkbx_si") echo(" checked "); ?> style="display: none;" />
			</div>     
 			<div id="elmnt_block">
        <div id="elmnt_image"><img id="img_mat_right" src="admin/images/mat_icons/image_36.png" width="30" height="30" style=" float: left; margin-top: 3px; margin-left: 3px;" /></div>
        <div id="elmnt_title"><?php echo(html_encode("Imagen")); ?></div>
        <div id="elmnt_case_sl">
          <div class="elmnt_foto"><input type="file" name="img_foto" id="img_foto" class="elmnt_file" size="2" maxlength="150" style="float: left;" ></div>
      		<div class="msg_image"><?php echo(html_encode("(Dimensiones: 640 x 350 pixeles. Peso no mayor de 300 Kb. Tipo: JPG o PNG.)")); ?></div>
        </div>
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

<script language="JavaScript">
	//CKEDITOR.replace( 'descripcion' );
</script>
