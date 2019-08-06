<?php

$pattern = "/^(0?[1-9]|[12][0-9]|[3][01])[\/|-](0?[1-9]|[1][12])[\/|-]((19|20)?[0-9]{2})$/";

$st1 = $db_pdo->prepare("SELECT * FROM us_vivienda");
$st1->execute();
$vivienda = $st1->fetchAll();

$st2 = $db_pdo->prepare("SELECT * FROM us_zona");
$st2->execute();
$zona = $st2->fetchAll();

if ($_POST["prcs"] == "S") {
	$cedula = $_POST["tipo"] . "-" . $_POST["cedula"];
	$cedulas = $db_pdo->prepare("SELECT id  FROM us_sigoclub WHERE cedula = '" . $cedula . "' limit 1");
	if ($cedulas === false) {
		trigger_error($db_pdo->error, E_USER_ERROR);
	}
	$cedulas->execute();
	if ($status === false) {
		trigger_error($stmt1->error, E_USER_ERROR);
	}

	if ($cedulas->rowCount() > 0) {
		$cedulaV = false;
	} else {
		$cedulaV = true;
	}

	$celulares = $db_pdo->prepare("SELECT id  FROM us_sigoclub WHERE celular = '" . $_POST["telefono"] . "' limit 1");
	if ($celulares === false) {
		trigger_error($db_pdo->error, E_USER_ERROR);
	}
	$celulares->execute();
	if ($status === false) {
		trigger_error($stmt1->error, E_USER_ERROR);
	}
	if ($celulares->rowCount() > 0) {
		$celularV = false;
	} else {
		$celularV = true;
	}
	$date = $_POST["fecha_nac"];

	$values = preg_split('/(\/|-)/', $date);
	$values[0] = (strlen($values[0]) == 2 ? $values[0] : "0" . $values[0]);
	$values[1] = (strlen($values[1]) == 2 ? $values[1] : "0" . $values[1]);
	$values[2] = (strlen($values[2]) == 4 ? $values[2] : substr(date("Y"), 0, 2) . $values[4]);
	$date = $values[2] . $values[1] . $values[0];

	$fecha = new DateTime($date);
	$hoy = new DateTime("now");

	$futuro = $fecha > $hoy;

	$diff = $fecha->diff($hoy);

	if ($cedulaV && $celularV && !$futuro && ($diff->y >= 18)) {
		$sexo = "I";
		if (isset($_POST["sexo_f"])) $sexo = "F";
		if (isset($_POST["sexo_m"])) $sexo = "M";

		$sql = "INSERT INTO us_sigoclub (nombre1, nombre2, apellido1, apellido2, cedula, sexo, fecha_nac, celular, correo, id_ciudad, id_parroquia, id_vivienda, id_zona, direccion) 
			VALUES ('" . $_POST["nombre1"] . "', '" . $_POST["nombre2"] . "', '" . $_POST["apellido1"] . "', '" . $_POST["apellido2"] . "', '" . $cedula . "', '" . $sexo . "', '" . $date . "', '" . $_POST["telefono"] . "', '" . $_POST["correo"] . "', '" . $_POST["ciudad"] . "', '" . $_POST["parroquia"] . "', '" . $_POST["vivienda"] . "', '" . $_POST["zona"] . "', '" . $_POST["direccion"] . "')";

		$stmt1 = $db_pdo->prepare($sql);
		if ($stmt1 === false) {
			trigger_error($db_pdo->error, E_USER_ERROR);
		}
		$stmt1->execute();
		if ($status === false) {
			trigger_error($stmt1->error, E_USER_ERROR);
			$_POST["prcs"] = "";
			$_SESSION["save_error"] = $msg;
		} else {
			$_SESSION["save_error"] = "OK";
			$_POST = array();
		}
	} elseif (!$celularV && !$celularV) {
		$_POST["prcs"] = "";
		$_SESSION["save_error"] = "El teléfono y la cédula ingresados ya existen en nuestra base de datos";
	} elseif (!$celularV) {
		$_POST["prcs"] = "";
		$_SESSION["save_error"] = "El teléfono ingresado ya existe en nuestra base de datos";
	} elseif ($futuro) {
		$_POST["prcs"] = "";
		$_SESSION["save_error"] = "La fecha de nacimiento no puede ser mayor a la de hoy";
	} elseif ($diff->y < 18) {
		$_POST["prcs"] = "";
		$_SESSION["save_error"] = "Debe de ser mayor de edad para registrarse en el sistema";
	} else {
		$_POST["prcs"] = "";
		$_SESSION["save_error"] = "La cédula ingresada ya existe en nuestra base de datos";
	}
}

if ($_POST["prcs"] == "V") {
	$cedula = $_POST["tipo"] . "-" . $_POST["cedula"];
	$cedulas = $db_pdo->prepare("SELECT id  FROM us_sigoclub WHERE cedula = '" . $cedula . "' limit 1");
	if ($cedulas === false) {
		trigger_error($db_pdo->error, E_USER_ERROR);
	}
	$cedulas->execute();
	if ($status === false) {
		trigger_error($stmt1->error, E_USER_ERROR);
	}

	if ($cedulas->rowCount() > 0) {
		$cedulaV = false;
	} else {
		$cedulaV = true;
	}

	$celulares = $db_pdo->prepare("SELECT id  FROM us_sigoclub WHERE celular = '" . $_POST["telefono"] . "' limit 2");
	if ($celulares === false) {
		trigger_error($db_pdo->error, E_USER_ERROR);
	}
	$celulares->execute();
	if ($status === false) {
		trigger_error($stmt1->error, E_USER_ERROR);
	}
	if ($celulares->rowCount() > 1) {
		$celularV = false;
	} else {
		$celularV = true;
	}
	$date = $_POST["fecha_nac"];

	$values = preg_split('/(\/|-)/', $date);
	$values[0] = (strlen($values[0]) == 2 ? $values[0] : "0" . $values[0]);
	$values[1] = (strlen($values[1]) == 2 ? $values[1] : "0" . $values[1]);
	$values[2] = (strlen($values[2]) == 4 ? $values[2] : substr(date("Y"), 0, 2) . $values[4]);
	$date = $values[2] . $values[1] . $values[0];

	$fecha = new DateTime($date);
	$hoy = new DateTime("now");

	$diff = $fecha->diff($hoy);

	if ($celularV && ($diff->y >= 18)) {
		$sexo = "I";
		if (isset($_POST["sexo_f"])) $sexo = "F";
		if (isset($_POST["sexo_m"])) $sexo = "M";

		$sql = $cedulaV ? "UPDATE us_sigoclub set nombre1 = '" . $_POST["nombre1"] . "', nombre2 = '" . $_POST["nombre2"] . "', apellido1 = '" . $_POST["apellido1"] . "', apellido2 = '" . $_POST["apellido2"] . "', sexo = '" . $sexo . "', fecha_nac = '" . $date . "', celular = '" . $_POST["telefono"] . "', correo = '" . $_POST["correo"] . "', id_ciudad = '" . $_POST["ciudad"] . "', id_parroquia = '" . $_POST["parroquia"] . "', id_vivienda = '" . $_POST["vivienda"] . "', id_zona = '" . $_POST["zona"] . "', direccion = '" . $_POST["direccion"] . "', verificado = CURRENT_TIMESTAMP, verificador= '" . $_POST["usuario"] . "'"
			: "INSERT INTO us_sigoclub (nombre1, nombre2, apellido1, apellido2, cedula, sexo, fecha_nac, celular, correo, id_ciudad, id_parroquia, id_vivienda, id_zona, direccion, verificado, verificador) 
			VALUES ('" . $_POST["nombre1"] . "', '" . $_POST["nombre2"] . "', '" . $_POST["apellido1"] . "', '" . $_POST["apellido2"] . "', '" . $cedula . "', '" . $sexo . "', '" . $date . "', '" . $_POST["telefono"] . "', '" . $_POST["correo"] . "', '" . $_POST["ciudad"] . "', '" . $_POST["parroquia"] . "', '" . $_POST["vivienda"] . "', '" . $_POST["zona"] . "', '" . $_POST["direccion"] . "', CURRENT_TIMESTAMP, '" . $_POST["usuario"] . "')";

		$stmt1 = $db_pdo->prepare($sql);
		if ($stmt1 === false) {
			trigger_error($db_pdo->error, E_USER_ERROR);
		}
		$stmt1->execute();
		if ($status === false) {
			trigger_error($stmt1->error, E_USER_ERROR);
			$_POST["prcs"] = "";
			$_SESSION["save_error"] = $msg;
		} else {
			$_SESSION["save_error"] = "OK";
			$_POST = array();
		}
	} elseif (!$celularV) {
		$_POST["prcs"] = "";
		$_SESSION["save_error"] = "El teléfono ingresado ya existe en nuestra base de datos";
	} elseif ($futuro) {
		$_POST["prcs"] = "";
		$_SESSION["save_error"] = "La fecha de nacimiento no puede ser mayor a la de hoy";
	} elseif ($diff->y < 18) {
		$_POST["prcs"] = "";
		$_SESSION["save_error"] = "Debe de ser mayor de edad para registrarse en el sistema";
	} else {
		$_POST["prcs"] = "";
		$_SESSION["save_error"] = "Error en el sistema";
	}
}
