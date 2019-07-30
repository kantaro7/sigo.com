  <div class="section" style="margin-top: 20px"> 
    <div class="container"> 
      <div class="row">    

    <?php
    //Buscar datos de Rotador
    $tabla="sr_servic";
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
      while($servicio=$stmt1->fetch()){
        $img_pth="admin/$ruta/ft_1_".$servicio["id_".$tabla].".".str_replace(".", "", substr($servicio["name_foto_1"], -4))."?vrbl=".$random;
        ?>

        <div class="col s6 m3">
          <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="<?php echo($img_pth); ?>">
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4" style="font-size: 18px; font-family: dosis"><?php echo(html_encode(nl2br($servicio["nombre"]))); ?><i class="material-icons right">more_vert</i></span>
              <p style="font-size: 13px"><a href="<?php echo($servicio["link_url"]); ?>?srv=<?php echo(base64_encode($servicio["id_sr_servic"])); ?>">Más Información</a></p>
            </div>
            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4" style="font-size: 18px"><?php echo(html_encode($servicio["nombre"])); ?><i class="material-icons right">close</i></span>
              <p style="font-size: 13px"><?php echo(html_encode(nl2br($servicio["texto"]))); ?></p> <br>
              <a style="margin-left: 12px" href="<?php echo($servicio["link_url"]); ?>?srv=<?php echo(base64_encode($servicio["id_sr_servic"])); ?>" class="waves-effect waves-light btn center #01579b light-blue darken-4">Más info</a>
            </div>
          </div>
        </div>   

        <?php
        $filas++;
      }
    }
    ?>

      </div>
    </div>
  </div>
