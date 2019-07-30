  <div class="section">
    <div class="container">

    <?php
    //Buscar datos de contenido
    $tabla="sr_servic_3";
    $ruta="upld_$tabla";
    $stmt1=$db_pdo->prepare("SELECT *  FROM $tabla  WHERE shown='$vlr_bd_si' and deleted='$vlr_bd_no'  ORDER BY fila, orden");
    if($stmt1===false) {
      trigger_error($db_pdo->error, E_USER_ERROR);
    }
    $stmt1->execute();    
    if($status===false) {
      trigger_error($stmt1->error, E_USER_ERROR);
    }

    if($stmt1->rowCount()>0){
      $filas=0;
      $fila=0;
      while($contenido=$stmt1->fetch()){
        $img_pth="admin/$ruta/ft_".$contenido["id_".$tabla].".".str_replace(".", "", substr($contenido["name_foto"], -4))."?vrbl=".$random;
        $img_lng="s6 m3";
        if($contenido["tamano"]==$vlr_chkbx_si) $img_lng="s12 m6";
        if($fila!=$contenido["fila"]){
          $fila=$contenido["fila"];
          if($filas!=0){
            ?>

      </div>

            <?php
          }
          ?>

      <div class="row">

        <?php
        }
        ?>

        <div class="col <?php echo($img_lng); ?>" style="margin-bottom: 12px">
          <img class="materialboxed" src="<?php echo($img_pth); ?>" alt="" width="100%">
        </div>

        <?php
        $filas++;
      }
    }
    ?>

      </div>

    </div>
  </div>
