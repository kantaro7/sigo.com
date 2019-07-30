  <?php
  //Buscar datos de contenido
  $tabla="sr_servic_1";
  $ruta="upld_$tabla";
  $stmt1=$db_pdo->prepare("SELECT *  FROM $tabla  WHERE shown='$vlr_bd_si' and deleted='$vlr_bd_no'  ORDER BY orden");
  if($stmt1===false) {
    trigger_error($db_pdo->error, E_USER_ERROR);
  }
  $stmt1->execute();    
  if($status===false) {
    trigger_error($stmt1->error, E_USER_ERROR);
  }

  if($stmt1->rowCount()>0){
    $filas=0;
    while($contenido=$stmt1->fetch()){
      $img_pth="admin/$ruta/ft_".$contenido["id_".$tabla].".".str_replace(".", "", substr($contenido["name_foto"], -4))."?vrbl=".$random;
      ?>


      <div class="row" <?php if($filas==0){ echo(" style='margin-top: 40px' "); } ?> >
        <div class="col s12 m6">
          <img src="<?php echo($img_pth); ?>" width="100%" alt="">
        </div>    
        <div class="col s12 m6">
          <hr>
          <h6 class="titulos_responsabilidad_valoramos"><?php echo(html_encode($contenido["nombre"])); ?></h6>
          <hr>
          <p><?php echo(html_encode(nl2br($contenido["texto"]))); ?></p>
          <hr>
        </div>
      </div>


      <?php
      $filas++;
    }
  }
  ?>
