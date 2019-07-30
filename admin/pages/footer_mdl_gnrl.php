<table width="1050" align="center" border="0" cellspacing="0" cellpadding="0"> 
  <tr>
    <td height="5"></td></tr>
  <tr>
    <td class="verdana_10_black">
    <div style="float:left; margin-top:0px; color: #000; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight: normal; font-style: normal; line-height:16px;"><?php echo("Total de $titulos encontrad".$letra_final."s: ".number_format($numero_registros, 0, ',', '.')); ?></div>
    <?php
    // Navegación
    $paginas=ceil($numero_registros/$linxpag);
    if($paginas>1){  // Caso de múltiples páginas 
    ?>
      <div style="float:left; margin-top:0px; margin-left: 80px; color: #000; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight: normal; font-style: normal; line-height:16px;">
        <?php
        if($linxpag==10) $selected_10=' selected ';
        if($linxpag==15) $selected_15=' selected ';
        if($linxpag==20) $selected_20=' selected ';
        if($linxpag==25) $selected_25=' selected ';
        if($linxpag==30) $selected_30=' selected ';
        $choose_size="<select name='linxpag' id='linxpag' class='CajaTexto_10' title='".html_encode("Seleccione el tamaño de la página")."' onChange='refrescar()' ><option value='10' $selected_10>10 $titulos x página</option><option value='15' $selected_15>15 $titulos x página</option><option value='20' $selected_20>20 $titulos x página</option><option value='25' $selected_25>25 $titulos x página</option><option value='30' $selected_30>30 $titulos x página</option></select>";
        echo($choose_size);
        ?>
      </div>
      <div style="float:right; margin-top:0px; color: #000; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight: normal; font-style: normal; line-height:16px;">
        <?php
        echo("Ir a la página".":&nbsp;<select name='paginador' id='paginador' class='CajaTexto_10' title='Seleccione a que ".html_encode("página")." desea ir' onChange='refrescar()'>");
        for($i=1; $i<=$paginas; $i++){
          if($pagina==$i){
            echo "<option value='$i' selected>$i</option>";
          } else {
            echo "<option value='$i'>$i</option>";
          }
        }
        echo("</select>&nbsp;/&nbsp;$paginas<input name='sin_registro' id='sin_registro' type='hidden' value='1'>");
        ?>
      </div>
      <div style="float:right; margin-top: 2px; margin-right: 80px; color: #000; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight: normal; font-style: normal; line-height:16px;">
        <?php
        $first=1;
        $prev=$pagina-1;
        if($prev<1) $prev=1;
        $next=$pagina+1;
        if($next>$paginas) $next=$paginas;
        $last=$paginas;
        $nav_arrows="<img src='../../images/nav/nav_first.png' title='Ir a la primera página' onClick='navegar($first); refrescar();' width='14' height='14' alt='primera página' style='margin-left: 10px; cursor: pointer;'><img src='../../images/nav/nav_prev.png' onClick='navegar($prev); refrescar();' title='Ir a la página anterior' width='14' height='14' alt='página anterior' style='margin-left: 10px; cursor: pointer;'><img src='../../images/nav/nav_next.png' width='14' onClick='navegar($next); refrescar();' title='Ir a la próxima página' height='14' alt='próxima página' style='margin-left: 10px; cursor: pointer;'><img src='../../images/nav/nav_last.png' onClick='navegar($last); refrescar();' title='Ir a la última página' width='14' height='14' alt='última  página' style='margin-left: 10px; cursor: pointer;'>";
        echo($nav_arrows);
        ?>
      </div>
    <?php } else {  // Caso de una sola página ?>
      <div style="float: right; margin-top:0px; line-height:16px;"><input name='paginador' id='paginador' type='hidden' value='1'><input name='linxpag' id='linxpag' type='hidden' value="<?php echo($linxpag) ?>"><input name='sin_registro' id='sin_registro' type='hidden' value='0'></div>
    <?php }	
		// Fin de navegación ?>
		</td></tr>
</table>
<?php 
