  <div class="slider" style="margin-top: -110px; z-index: -2">
    <ul class="slides">

    <?php
    //Buscar datos de Rotador
    $tabla="su_slider";
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
        <h4 class="white-text" style="/*text-shadow: 2px 2px 2px #020202*/">Sucursales</h4>
        <a class="menu_internas" href="#margarita" style="/*text-shadow: 2px 2px 2px #020202;*/ color: #2962ff blue">● Margarita</a>
        <a class="menu_internas white-text" href="#barcelona" style="/*text-shadow: 2px 2px 2px #020202*/">● Barcelona</a>
        <a class="menu_internas white-text" href="#maturin" style="/*text-shadow: 2px 2px 2px #020202*/">● Maturín</a>
        <a class="menu_internas white-text" href="#paraguana" style="/*text-shadow: 2px 2px 2px #020202*/">● Paraguaná</a>
        <a class="menu_internas white-text" href="#maracay" style="/*text-shadow: 2px 2px 2px #020202*/">● Maracay</a>
      </div>
    </div>
  </div>
