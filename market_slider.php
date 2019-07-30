  <div class="slider" style="margin-top: -110px; z-index: -2">
    <ul class="slides">

    <?php
    //Buscar datos de Rotador
    $tabla="mr_slider";
    $ruta="upld_$tabla";
    $stmt1=$db_pdo->prepare("SELECT id_$tabla, name_foto  FROM $tabla  WHERE shown='$vlr_bd_si' and deleted='$vlr_bd_no'  ORDER BY orden");
    if($stmt1===false) {
      trigger_error($db_pdo->error, E_USER_ERROR);
    }
    $stmt1->execute();    
    if($status===false) {
      trigger_error($stmt1->error, E_USER_ERROR);
    }

    if($stmt1->rowCount()>0){
      $filas=0;
      while($imagen=$stmt1->fetch()){
        $img_pth="admin/$ruta/ft_".$imagen["id_".$tabla].".".str_replace(".", "", substr($imagen["name_foto"], -4))."?vrbl=".$random;
        ?>

      <li>
        <img src="<?php echo($img_pth); ?>"> <!-- random image -->        
      </li>

        <?php
        $filas++;
      }
    }
    ?>

    </ul>
  </div>

  <div class="container">
    <div class="row" style="margin-top: -110px; z-index: 999">
      <div class="col s12 m12" >
        <h4 class="white-text" style="/*text-shadow: 2px 2px 2px #020202*/">Market</h4>

        <?php
        //Buscar datos de Markets
        $tabla="mr_markts";
        $ruta="upld_$tabla";
        $stmt1=$db_pdo->prepare("SELECT id_$tabla, nombre  FROM $tabla  WHERE shown='$vlr_bd_si' and deleted='$vlr_bd_no'  ORDER BY orden");
        if($stmt1===false) {
          trigger_error($db_pdo->error, E_USER_ERROR);
        }
        $stmt1->execute();    
        if($status===false) {
          trigger_error($stmt1->error, E_USER_ERROR);
        }

        if($stmt1->rowCount()>0){
          $filas=0;
          while($markets=$stmt1->fetch()){
            $color="orange-text";
            if($filas>0) $color="white-text";
            ?>

        <a class="menu_internas <?php echo($color); ?>" href="#<?php echo($markets["id_mr_markts"]); ?>" style="/*text-shadow: 2px 2px 2px #020202*/">● <?php echo(html_encode($markets["nombre"])); ?></a>

            <?php
            $filas++;
          }
        }
        ?>

      </div>
    </div>
  </div>
