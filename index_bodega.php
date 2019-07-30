<?php
//Buscar en base de datos
$tabla="pp_bodega";
$ruta="upld_$tabla";
$stmt2=$db_pdo->prepare("SELECT id_$tabla, nombre, titulo, texto  FROM $tabla  WHERE shown='$vlr_bd_si' and deleted='$vlr_bd_no'  ORDER BY id_$tabla DESC  LIMIT 1  OFFSET 0;");
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
?>

  <div class="bodegon">
    <div class="section">
      <div class="container">
        <div class="row">

          <div class="col s12 m6 center">

            <div class="card white medium" style="margin-top: 40px">
              <div class="card-content black-text">
                <a href="market.php#bodegon"><p class="card-title" style="margin-top: 60px; font-size: 32px; color: #d50000 " ><?php echo(html_encode($element["nombre"])); ?></p></a> 
                <p class="card-title" style=" font-size: 20px; font-family: dosis" ><?php echo(html_encode($element["titulo"])); ?></p>
                <p style="margin-top: 24px; font-size: 18px"><?php echo(html_encode(nl2br($element["texto"]))); ?></p>
              </div>            
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
