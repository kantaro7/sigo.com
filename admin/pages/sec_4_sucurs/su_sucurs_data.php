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

$_SESSION["num_pag"]=$_GET["pgn"];

//Hacer query sobre la tabla principal para determinar total de registros
$stmt1=$db_pdo->prepare("SELECT suc.*, ciu.nombre as ciudad  FROM ".$_SESSION["tabla"]." suc  INNER JOIN su_ciudad ciu ON suc.id_su_ciudad=ciu.id_su_ciudad  WHERE suc.deleted='$vlr_chkbx_no'  :crt_bsq");
if($stmt1===false){
	trigger_error($db_pdo->error, E_USER_ERROR);
}
// Bind params
$stmt1->bindParam(':crt_bsq', $_SESSION["crt_bsq"], PDO::PARAM_STR);
$stmt1->execute();		
if($status===false){
	trigger_error($stmt1->error, E_USER_ERROR);
}
$reg_tot=$stmt1->rowCount();
$tot_pag=ceil($reg_tot/$_SESSION["row_pag"]);

if($reg_tot>0){
	//Calcular el desplazamiento en la tabla
	$prm_lmt=$_SESSION["row_pag"];
	$prm_off=($_SESSION["num_pag"]-1)*$_SESSION["row_pag"];

	//Hacer query sobre la tabla principal para poblar la página
	$stmt2=$db_pdo->prepare("SELECT suc.*, ciu.nombre as ciudad  FROM ".$_SESSION["tabla"]." suc  INNER JOIN su_ciudad ciu ON suc.id_su_ciudad=ciu.id_su_ciudad  WHERE suc.deleted='$vlr_chkbx_no'  :crt_bsq  ORDER BY ciu.orden, suc.orden  LIMIT $prm_lmt  OFFSET $prm_off ;");
	if($stmt2===false){
		trigger_error($db_pdo->error, E_USER_ERROR);
	}
	//Bind params
	$stmt2->bindParam(':crt_bsq', $_SESSION["crt_bsq"], PDO::PARAM_STR);
	$stmt2->execute();		
	if($status===false){
		trigger_error($stmt2->error, E_USER_ERROR);
	}
	$reg_pag=$stmt2->rowCount();

	if($tot_pag>1){
		$frst=1;
		$prev=$_SESSION["num_pag"]-1;
		if($prev<1) $prev=1;
		$next=$_SESSION["num_pag"]+1;
		if($next>$tot_pag) $next=$tot_pag;
		$last=$tot_pag;
	}
	?>
  <!--  Encabezado de la página  -->
  <div id="data_header">
    <table width="100%" align="center" cellspacing="0" cellpadding="0">
      <tr>
        <td width="05%" height="20"></td>
        <td width="15%" align="left"	 valign="middle"><b><?php echo(html_encode("")); ?></b></td>
        <td width="30%" align="left"	 valign="middle"><b><?php echo(html_encode("Ciudad")); ?></b></td>
        <td width="35%" align="left"	 valign="middle"><b><?php echo(html_encode("Nombre")); ?></b></td>
        <td width="05%" align="center" valign="middle"><b><?php echo(html_encode("Orden")); ?></b></td>
        <td width="05%"></td>
        <td width="05%"></td></tr>
      <tr>
        <td height="04" colspan="7"></td></tr>
      <tr>
        <td height="01" colspan="7" bgcolor="#333333"></td></tr>
    </table>
  </div>
  <!--  Cuerpo de la página  -->
  <div id="data_body">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php
	$filas=1;
	while($main_data=$stmt2->fetch()){
		//Definir Color de Fondo de Línea
		if(pow(-1,$filas)==1){
			$color="#F1F1F1";
		} else {
			$color="#FFFFFF";
		}
		//Definir Activo/Inactivo
		$sta_text="Activ".$_SESSION["letra_final"];
		$sta_icon="activ_36.png";
		if($main_data["shown"]==$vlr_chkbx_no){
			$sta_text="Inactiv".$_SESSION["letra_final"];
			$sta_icon="inactiv_36.png";
		}
		$dreg=base64_encode($main_data["id_".$_SESSION["elemento"]]);

    $im_pth="admin/upld_".$_SESSION["rimag"]."/ft_".$main_data["id_".$_SESSION["elemento"]].".".str_replace(".", "", substr($main_data["name_foto"], -4))."?vrbl=".$random;
		?>
    <tr style="background-color: <?php echo($color); ?>;">
      <td width="05%" align="center" height="80"><div id="activ_<?php echo($main_data["id_".$_SESSION["elemento"]]); ?>" class="btn_mat_right"><img id="img_mat_right" src="admin/images/mat_icons/<?php echo($sta_icon); ?>" onclick="swtch_activ(<?php echo("'".$_SESSION["elemento"]."', ".$main_data["id_".$_SESSION["elemento"]].", 'shown', ".$main_data["shown"]) ?>)" width="30" height="30" style="margin-top: 4px;" title="<?php echo(html_encode($_SESSION["titulo"]." $sta_text")); ?>" /></div></td>
      <td width="15%" align="left"	 valign="middle"><img src="<?php echo($im_pth); ?>" width="110" height="60" alt="img" style="" /></td>
      <td width="30%" align="left"	 valign="middle"><?php echo(html_encode($main_data["ciudad"])); ?></td>
      <td width="35%" align="left"	 valign="middle"><?php echo(html_encode($main_data["nombre"])); ?></td>
      <td width="05%" align="center" valign="middle"><?php echo(html_encode($main_data["orden"])); ?></td>
      <td width="05%" align="center"><div id="btn_mat_right"><img class="img_mat_right" src="admin/images/mat_icons/edit1_36.png" width="30" height="30" onClick="nyro_exec('<?php echo(substr($_SESSION["carpeta"], 4)."', '".$_SESSION["rprog"]."', 'acc=m&dreg=$dreg'"); ?>);" style="margin-top: 4px;" title="<?php echo(html_encode("Modificar ".$_SESSION["titulo"])); ?>" /></div></td>
      <td width="05%" align="center"><div class="btn_mat_right"><img id="img_mat_right" src="admin/images/mat_icons/del3_36.png" width="30" height="30" onClick="nyro_exec('<?php echo(substr($_SESSION["carpeta"], 4)."', '".$_SESSION["rprog"]."', 'acc=e&dreg=$dreg'"); ?>);" style="margin-top: 4px;" title="<?php echo(html_encode("Eliminar ".$_SESSION["titulo"])); ?>" /></div></td></tr>
    <tr>
      <td height="01" colspan="7" bgcolor="#D3D3D3"></td></tr>
		<?php
		$filas++;
	}
	?>
    </table>
  </div>
  <!--  Pié de página  -->
  <div id="data_footer">
		<div style="float: left; margin-left: 10px; margin-top: 10px; text-align: left; font-size: 18px; font-weight: 500;"><?php echo(html_encode("Página ".$_SESSION["num_pag"]." de $tot_pag")); ?></div>
    
		<div style="float: left; margin-left: 30px; margin-top: 10px; text-align: left; font-size: 18px; font-weight: 500;"><?php echo(html_encode("$reg_pag de $reg_tot ".$_SESSION["titulos"]."  encontrad".$_SESSION["letra_final"]."s")); ?></div>

		<?php if($tot_pag>1){ ?>
		<div style="float: right; margin-right: 10px; margin-top: 02px;">
			<div class="btn_mat_right"><img id="img_mat_right" src="admin/images/nav/last_page1_36.png" width="30" height="30" onclick="shw_data('<?php echo($_SESSION["rprog"]."-".$_SESSION["modulo"]); ?>', <?php echo($last); ?>);" style="margin-top: 4px; margin-left: 2px;" title=" Última Página " /></div>
			<div class="btn_mat_right"><img id="img_mat_right" src="admin/images/nav/next1_36.png" width="30" height="30" onclick="shw_data('<?php echo($_SESSION["rprog"]."-".$_SESSION["modulo"]); ?>', <?php echo($next); ?>);" style="margin-top: 4px; margin-left: 2px;" title=" Próxima Página " /></div>
			<div class="btn_mat_right"><img id="img_mat_right" src="admin/images/nav/prev1_36.png" width="30" height="30" onclick="shw_data('<?php echo($_SESSION["rprog"]."-".$_SESSION["modulo"]); ?>', <?php echo($prev); ?>);" style="margin-top: 4px; margin-left: 2px;" title=" Página Previa " /></div>
			<div class="btn_mat_right"><img id="img_mat_right" src="admin/images/nav/frst_page1_36.png" width="30" height="30" onclick="shw_data('<?php echo($_SESSION["rprog"]."-".$_SESSION["modulo"]); ?>', <?php echo($frst); ?>);" style="margin-top: 4px; margin-left: 2px;" title=" Primera Página " /></div>
		</div>
    <?php } ?>
  </div>
<?php } else { ?>
  <div id="no_data">
		<?php echo(html_encode("No hay ".$_SESSION["titulos"]." registrad".$_SESSION["letra_final"]."s para estos Criterios de Búsqueda")); ?>
  </div>
<?php } ?>
