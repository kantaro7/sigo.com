<?php
//Buscar en base de datos
$tabla="ns_prirec";
$ruta="upld_$tabla";
$stmt2=$db_pdo->prepare("SELECT id_$tabla, nombre, texto, name_foto  FROM $tabla  WHERE shown='$vlr_bd_si' and deleted='$vlr_bd_no'  ORDER BY id_$tabla DESC  LIMIT 1  OFFSET 0;");
if($stmt2===false) {
  trigger_error($db_pdo->error, E_USER_ERROR);
}
$stmt2->execute();    
if($status===false) {
  trigger_error($stmt2->error, E_USER_ERROR);
}
if($stmt2->rowCount()>0){
  $element=$stmt2->fetch();
}

$img_pth="admin/$ruta/ft_".$element["id_".$tabla].".".str_replace(".", "", substr($element["name_foto"], -4))."?vrbl=".$random;
?>

  <div class="section">
    <div class="container">
      <dov class="row">
        <div class="col s12 m12">
          <h4><?php echo(html_encode($element["nombre"])); ?></h4>
        </div>
        <div class="col s12 m6" style="margin-top: 26px">
          <img src="<?php echo($img_pth); ?>" width="100%" alt="">
        </div>
        <div class="col s12 m6">
          <p style="font-size: 20px"><?php echo(html_encode(nl2br($element["texto"]))); ?></p>
        </div>
      </dov>
    </div>
  </div>
