  <div class="revista">
    <div class="row" style="margin: 0">

      <div class="col s12 m6 center texto_revista">
        <h3 style="margin-bottom: -40px">Tu Revista<img style="vertical-align: middle;" src="img/sigo.png"  alt="">   </h3>                
      </div>

      <div class="col s12 m6 center" style="margin-bottom: 6%; margin-top: 20px">
        <div class="carousel">

        <?php
        //Buscar datos de Rotador
        $tabla="pp_mirevi";
        $ruta="upld_$tabla";
        $stmt1=$db_pdo->prepare("SELECT id_$tabla, link_url, name_foto  FROM $tabla  WHERE shown='$vlr_bd_si' and deleted='$vlr_bd_no'  ORDER BY orden");
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

          <a class="carousel-item" href="http://<?php echo($imagen["link_url"]); ?>" target="_blank"><img src="<?php echo($img_pth); ?>"></a>

            <?php
            $filas++;
          }
        }
        ?>

        </div>
      </div>       

    </div>
  </div>
