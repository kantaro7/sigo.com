  <?php
  //Arreglo de Estilos
  //$estilos=array('', 'supermarket', 'homemarket', 'minimarket', 'bodegon', 'farmacia');
  //Buscar datos de Markets
  $tabla="mr_markts";
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
    while($markets=$stmt1->fetch()){
      $img_pth="admin/$ruta/ft_".$markets["id_".$tabla].".".str_replace(".", "", substr($markets["name_foto"], -4))."?vrbl=".$random;
      if($filas>0){
        echo("<div class='container'>");
        echo("<hr width='80%'>");
        echo("</div>");
      }
      if($markets["orientacion"]=="$vlr_chkbx_si"){
      ?>

  <div class="section">
    <div class="container">
      <div class="row" style="margin-top: 20px">
        <div class="col s12 m4" id="<?php echo($markets["id_".$tabla]); ?>">
          <h4><?php echo(html_encode($markets["nombre"])); ?></h4>
          <p style="font-size: 22px"><?php echo(html_encode(nl2br($markets["texto_1"]))); ?></p>
        </div>
        <div class="col s12 m8">
          <img class="responsive-img" src="<?php echo($img_pth); ?>" width="100%" alt="">
        </div>
        <div class="col s12 m12">
          <p style="font-size: 22px"><?php echo(html_encode(nl2br($markets["texto_2"]))); ?></p>
        </div>
      </div>
    </div>
  </div>

      <?php } else { ?>

  <div class="section" id="<?php echo($markets["id_".$tabla]); ?>">
    <div class="container">
      <div class="row">
        <div class="col s12 m12">
          <h4><?php echo(html_encode($markets["nombre"])); ?></h4>
        </div>
        <div class="col s12 m6">
          <img class="responsive-img" src="<?php echo($img_pth); ?>" width="100%" alt="">
        </div>
        <div class="col s12 m6">
          <p style="font-size: 22px"><?php echo(html_encode(nl2br($markets["texto_1"]))); ?></p>
        </div>      
      </div>
    </div>
  </div>

      <?php
      }
      $filas++;
    }
  }
  ?>
