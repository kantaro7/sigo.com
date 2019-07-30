<?php
$clave=base64_decode($_GET["srv"]);

//Buscar en base de datos
$tabla="sr_servic";
$ruta="upld_$tabla";
$sql="SELECT *  FROM $tabla  WHERE shown='$vlr_bd_si' and deleted='$vlr_bd_no' and id_$tabla = $clave";
$stmt2=$db_pdo->prepare($sql);
if($stmt2===false) {
  trigger_error($db_pdo->error, E_USER_ERROR);
}
$stmt2->execute();    
if($status===false) {
  trigger_error($stmt2->error, E_USER_ERROR);
}
$img_pth="";
if($stmt2->rowCount()>0){
  $elmnt_data=$stmt2->fetch();

  $img_pth="admin/$ruta/ft_2_".$elmnt_data["id_$tabla"].".".str_replace(".", "", substr($elmnt_data["name_foto_2"], -4))."?vrbl=".$random;
}
?>

  <div class="slider" style="margin-top: -110px; z-index: -2">
    <ul class="slides">
      <li>
        <img src="<?php echo($img_pth); ?>"> <!-- random image -->        
      </li>      
    </ul>
  </div>
