<?php

class object2form
{
	var $dbo;
	var $maxtext;
	var $maxpassword;

	function object2form($dbobj, $reg = undef) {
		$this->maxtext = 15;
		$this->maxpassword = 10;
		$this->dbo = $dbobj;
		if(isset($reg)) $this->registro = $reg;
	}

	function form_text($tabla, $tam = 8) {
		$size = $tam > $this->maxtext ? $this->maxtext : $tam;
		$value = $this->varval;
		if(isset($this->registro)) $value = $this->registro[$tabla];
		echo "<input type=\"text\" name=\"$tabla\" size=\"$size\" maxlength=\"$tam\" value=\"$value\">";
	}

	function form_textlarge($tabla, $tam = undef) {
		if(!preg_match("/\d+x\d+/", $tam)) $tam = $this->maxtext . "x3";
		if(isset($this->registro)) $value = $this->registro[$tabla];
		$cols=40; $rows=4;
		echo "<textarea name=\"$tabla\" rows=\"$rows\" cols=\"$cols\">$value</textarea>";
	}

	function form_textlarge_xl($tabla, $tam = undef) {
		if(!preg_match("/\d+x\d+/", $tam)) $tam = $this->maxtext . "x10";
		if(isset($this->registro)) $value = $this->registro[$tabla];
		$cols=100; $rows=10;
		echo "<textarea name=\"$tabla\" rows=\"$rows\" cols=\"$cols\">$value</textarea>";
	}

	function form_password($variable, $tabla = undef, $tam = 10) {
		if(!isset($tabla)) $tabla = $variable;
		if(isset($this->registro)) $value = $this->registro[$tabla];
		$size = $tam > $this->maxpassword ? $this->maxpassword : $tam;
		echo "<input type=\"password\" name=\"$variable\" size=\"$size\" maxlength=\"$tam\" value=\"$value\">";
	}

	function formulario_telefono($campo) {
		if(isset($this->registro)) $value = $this->registro[$campo];
		if($value == "")
			$value = $def;
		if(is_array($value))
			$teléfono = $value;
		else {
			/*echo "$value<br>";*/
			/*$teléfono[0] = $value / 10000000;*/
			$teléfono[0] = substr_replace($value, '', 4, -1);
			/*$teléfono[1] = $value - $teléfono[0];*/
			$teléfono[1] = substr_replace($value, '', -10, -7);
			$teléfono[0] = $teléfono[0] == 0 ? "" : $teléfono[0];
			$teléfono[1] = $teléfono[1] == 0 ? "" : $teléfono[1];
		}
		?>(0<input type="text" name="<?php echo($campo); ?>[0]" size="3" maxlength="3" value="<?php echo($teléfono[0]); ?>" />)-<input type="text" name="<?php echo($campo); ?>[1]" size="7" maxlength="7" value="<?php echo($teléfono[1]); ?>" /> <?php }

	function form_email($tabla, $tam = 50) {
		$size = $tam > $this->maxtext ? $this->maxtext : $tam;
		if(isset($this->registro)) $value = $this->registro[$tabla];
		echo "<input type=\"text\" name=\"$tabla\" size=\"$size\" maxlength=\"$tam\" value=\"$value\">";
	}

	function form_boolean($variable, $text, $tabla = undef, $def = undef) {
		if(!isset($tabla)) $tabla = $variable;
		if(isset($def)) $value = $def;
		else
			if(isset($this->registro)) $value = $this->registro[$tabla];
		$value = ($value == 't') ? " checked" : "";
		echo "<input type=\"checkbox\" name=\"$variable\"$value>&nbsp;$text";
	}

	function form_select($tabla, $ref_tabla = undef, $ord = undef, $add = "") {
		if($ref_tabla == undef) $ref_tabla = $tabla;
		if(isset($this->registro)) $value = $this->registro[$tabla];
?>
<select name="<?php echo $tabla ?>" <?php echo($add); ?>>
<?php $t = split(";", $this->dbo->obtener_info_tabla($ref_tabla, $ord));
		foreach($t as $i) {
			$tt = split(":", $i);
			$sel = ($tt[0] == $value) ? "selected" : "";
?>
  <option <?php echo $sel?> value="<?php echo $tt[0] ?>"><?php echo $tt[1] ?></option>
<?php }
?>
</select>
<?php }

	function form_select_static($tabla, $arr, $add = "") {
		if(isset($this->registro)) $value = $this->registro[$tabla];
?>
<select name="<?php echo $tabla ?>" <?php echo($add); ?>>
<?php foreach($arr as $var => $val) {
			 $sel = ($var == $value) ? "selected " : "";
?>
  <option <?php echo $sel?> value="<?php echo($var); ?>"><?php echo($val); ?></option>
<?php }
?>
</select>
<?php }

	function form_radio_static($tabla, $arr, $add = "") {
		if($ref_tabla == undef) $ref_tabla = $tabla;
		if(isset($this->registro)) $value = $this->registro[$tabla];
		foreach($arr as $var => $val) {
			$sel = ($var == $value) ? "checked " : "";
?><?php echo($val); ?><input type="radio" <?php echo($sel); ?>name="<?php echo($tabla); ?>" value="<?php echo($var); ?>" />&nbsp;<?php }
	}

	function form_radio_static_rol($tabla, $arr, $add = "") {
		if($ref_tabla == undef) $ref_tabla = $tabla;
		if(isset($this->registro)) $value = $this->registro[$tabla];
		foreach($arr as $var => $val) {
			$sel = ($var == $value) ? "checked " : "";
?><input type="radio" <?php echo $sel?>name="<?php echo($tabla); ?>" value="<?php echo($var); ?>" /><?php echo($val); ?><br><?php }
	}

	function form_radio($tabla, $def = 0)   {
		if(isset($this->registro))
			$value = $this->registro[$tabla];
		else
			$value = $def;
		$t = split(";", $this->dbo->obtener_info_tabla($tabla));
		foreach($t as $i) {
			$tt = split(":", $i);
			$sel = ($tt[0] == $value) ? "checked" : "";
?>
<?php echo($tt[1]); ?><input type="radio" <?php echo $sel ?> name="<?php echo($tabla); ?>" value="<?php echo($tt[0]); ?>" />&nbsp;<!-- <br> -->
<?php }
	}

	function form_checkbox($tabla, $def = 0) {
		if (isset($this->registro))
			$value = $this->registro[$tabla];
		else
			$value = $def;
		$t = split(";", $this->dbo->obtener_info_tabla($tabla));
		foreach($t as $i) {
			$sel="";
			$tt = split(":", $i);
?>
<?php echo($tt[1]); ?><input type="checkbox" <?php echo($sel); ?> name="<?php echo($tabla . "[" . $tt[0] . "]"); ?>">&nbsp;<!-- <br> -->
<?php }
	}
	
	function form_date_text($tabla) {
		$value = $this->varval;
		if(isset($this->registro)) $value = $this->registro[$tabla];
		if($value == "") $value = $def;
		if(is_array($value))
			$fecha = $value;
		else
			$fecha = explode("-", $value);
		$fecha2=$fecha[2];  $fecha1=$fecha[1];  $fecha0=$fecha[0]; 
		?>
		<input type="text" name="<?php echo($tabla); ?>[2]" size="2" maxlength="2" value="<?php echo($fecha2); ?>">/
					<input type="text" name="<?php echo($tabla); ?>[1]" size="2" maxlength="2" value="<?php echo($fecha1); ?>">/
					<input type="text" name="<?php echo($tabla); ?>[0]" size="4" maxlength="4" value="<?php echo($fecha0); ?>">
		<?php }

	function form_date($tabla, $def = '1900-1-1', $def_ini = '1900', $def_fin = '2006') {
		$mes_t[1] = "Enero";
		$mes_t[2] = "Febrero";
		$mes_t[3] = "Marzo";
		$mes_t[4] = "Abril";
		$mes_t[5] = "Mayo";
		$mes_t[6] = "Junio";
		$mes_t[7] = "Julio";
		$mes_t[8] = "Agosto";
		$mes_t[9] = "Septiembre";
		$mes_t[10] = "Octubre";
		$mes_t[11] = "Noviembre";
		$mes_t[12] = "Diciembre";
		if(isset($this->registro)) $value = $this->registro[$tabla];
		if($value == "") $value = $def;
		if(is_array($value))
			$fecha = $value;
		else
			$fecha = explode("-", $value);
?>
<script language="JavaScript">
<!--

  function <?php echo $tabla ?>_handler(s) {
/*
    var maxd = new Array();
    maxd[1] = "31"
    if(this.<?php echo $tabla ?>
*/
  }
//-->
</script>
  
<select name="<?php echo $tabla ?>[2]">
<?php for($i = 1; $i <= 31; $i++) {
				$sel = ($fecha[2] == $i) ? " selected" : "";
?>
  <option<?php echo $sel ?>><?php echo $i ?></option>
<?php }
?>
</select>/<select name="<?php echo($tabla); ?>[1]" onChange="<?php echo($tabla); ?>_handler(this)">
<?php for($i = 1; $i <= 12; $i++) {
			$sel = ($fecha[1] == $i) ? "selected " : "";
?>
  <option <?php echo $sel ?>value="<?php echo $i ?>"><?php echo $mes_t[$i] ?></option>
<?php }
?>
</select>/<select name="<?php echo $tabla ?>[0]" onChange="<?php echo $tabla ?>_handler(this)">
<?php for($i = $def_fin; $i >= $def_ini; $i--) {
			$sel = ($fecha[0] == $i) ? " selected" : "";
?>
  <option<?php echo $sel ?>><?php echo $i ?></option>
<?php }
?>
</select>
<?php }
	  
	function form_date_corta($tabla, $def = '2005-1-1', $def_ini = '2005', $def_fin = '2006') {
		$mes_t[1] = "Enero";
		$mes_t[2] = "Febrero";
		$mes_t[3] = "Marzo";
		$mes_t[4] = "Abril";
		$mes_t[5] = "Mayo";
		$mes_t[6] = "Junio";
		$mes_t[7] = "Julio";
		$mes_t[8] = "Agosto";
		$mes_t[9] = "Septiembre";
		$mes_t[10] = "Octubre";
		$mes_t[11] = "Noviembre";
		$mes_t[12] = "Diciembre";
		if(isset($this->registro))$value = $this->registro[$tabla];
		if($value == "")$value = $def;
		if(is_array($value))
			$fecha = $value;
		else
			$fecha = explode("-", $value);
?>
<script language="JavaScript">
<!--

  function <?php echo $tabla ?>_handler(s){
/*
    var maxd = new Array();
    maxd[1] = "31"
    if(this.<?php echo $tabla ?>
*/
  }
//-->
</script>
  
<select name="<?php echo $tabla ?>[2]">
<?php for($i = 1; $i <= 31; $i++) {
			$sel = ($fecha[2] == $i) ? " selected" : "";
?>
  <option<?php echo $sel ?>><?php echo $i ?></option>
<?php }
?>
</select>/<select name="<?php echo $tabla ?>[1]" onChange="<?php echo $tabla ?>_handler(this)">
<?php for($i = 1; $i <= 12; $i++) {
			$sel = ($fecha[1] == $i) ? "selected " : "";
?>
  <option <?php echo $sel ?>value="<?php echo $i ?>"><?php echo $mes_t[$i] ?></option>
<?php }
?>
</select>/<select name="<?php echo $tabla ?>[0]" onChange="<?php echo $tabla ?>_handler(this)">
<?php for($i = $def_fin; $i >= $def_ini; $i--) {
			$sel = ($fecha[0] == $i) ? " selected" : "";
?>
  <option<?php echo $sel ?>><?php echo $i ?></option>
<?php }
?>
</select>
<?php }
	  
}

class object2text {
	var $dbo;

	function object2text($dbobj, $reg = undef) {
		$this->maxtext = 40;
		$this->maxpassword = 30;
		$this->dbo = $dbobj;
		if(isset($reg)) $this->registro = $reg;
	}

	function text($reg) {
		if(isset($this->registro)) $value = $this->registro[$reg];
		return $value;
	}

	function textrel($reg, $tablarel = undef, $tabla_original = undef, $tablarel_campo = undef) {
		if($tablarel == undef) $tablarel = $reg;
		if($tablarel_campo == undef) $tablarel_campo = $reg;
		if(isset($this->registro)) $value = $this->registro[$reg];
		$query = "SELECT $tablarel.$tablarel_campo AS valor FROM $tabla_original WHERE $tabla_original.$reg=$tablarel.id_$tablarel_campo AND $reg='$value'";
		$this->dbo->db->query($query);
		$t = $this->dbo->db->next();
		return $t->valor;
	}
}

?>
