<?php

$pattern = "/^(0?[1-9]|[12][0-9]|[3][01])[\/|-](0?[1-9]|[1][12])[\/|-]((19|20)?[0-9]{2})$/";

if ($_POST["prcs"] == "S") {
	$rif = $_POST["tipo"] . "-" . $_POST["rif"];
	$idR = $_POST["rep"];
	$idA1 = $_POST["aut1"];
	$idA2 = $_POST["aut2"];

	$rifes = $db_pdo->prepare("SELECT id FROM us_empresas WHERE rif = '" . $rif . "' limit 1");
	if ($rifes === false) {
		trigger_error($db_pdo->error, E_USER_ERROR);
	}
	$rifes->execute();
	if ($status === false) {
		trigger_error($stmt1->error, E_USER_ERROR);
	}

	if ($rifes->rowCount() > 0) {
		$rifesV = false;
	} else {
		$rifesV = true;
	}

	$celulares1 = $db_pdo->prepare("SELECT id FROM us_empresas WHERE telefono1 = '" . $_POST["telefono1"] . "' OR telefono2 = '" . $_POST["telefono1"] . "' limit 1");
	$celulares2 = $db_pdo->prepare("SELECT id FROM us_empresas WHERE telefono2 = '" . $_POST["telefono2"] . "' OR telefono2 = '" . $_POST["telefono2"] . "' limit 1");
	if ($celulares1 === false || $celulares2 === false) {
		trigger_error($db_pdo->error, E_USER_ERROR);
	}
	$celulares1->execute();
	$celulares2->execute();
	if ($status === false) {
		trigger_error($stmt1->error, E_USER_ERROR);
	}

	$celular1 = ($celulares1->rowCount() > 0) ? false : true;
	$celular2 = ($celulares2->rowCount() > 0) ? false : true;

	if ($rifesV && $celular1 && $celular2) {
		$telefono2 = ($_POST["telefono2"] == "") ? "N/A" : $_POST["telefono2"];
		$sql = "INSERT INTO us_empresas (razon_social, rif, razon_comercial, id_parroquia, id_ciudad, direccion, telefono1, telefono2)
			VALUES ('" . $_POST["razonSocial"] . "', '" . $rif . "', '" . $_POST["razonComercial"] . "', '" . $_POST["parroquia"] . "', '" . $_POST["ciudad"] . "', '" . $_POST["direccion"] . "', '" . $_POST["telefono1"] . "', '" . $telefono2  . "')";
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
		$st1 = $db_pdo->prepare("SELECT id FROM us_empresas WHERE rif = '" . $rif . "' limit 1");
		$st1->execute();
		$id = $st1->fetchAll();
		$id = $id[0][0];


		$sql = "INSERT INTO us_pivot_sigoclub_empresas (id_empresa, id_sigoclub, tipo) 
			VALUES ('" . $id . "', '" . $idR . "', 1)";
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

		if ($idA1 != 0) {
			$sql = "INSERT INTO us_pivot_sigoclub_empresas (id_empresa, id_sigoclub, tipo) 
			VALUES ('" . $id . "', '" . $idA1 . "', 2)";
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
		}

		if ($idA2 != 0) {
			$sql = "INSERT INTO us_pivot_sigoclub_empresas (id_empresa, id_sigoclub, tipo) 
			VALUES ('" . $id . "', '" . $idA2 . "', 2)";
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
		}
	} elseif (!$celular1) {
		$_POST["prcs"] = "";
		$_SESSION["save_error"] = "El teléfono principal ingresado ya existe en nuestra base de datos";
	} elseif (!$celular2) {
		$_POST["prcs"] = "";
		$_SESSION["save_error"] = "El teléfono secundario ingresado ya existe en nuestra base de datos";
	} else {
		$_POST["prcs"] = "";
		$_SESSION["save_error"] = "El rif ingresado ya existe en nuestra base de datos";
	}
}



if ($_POST["prcs"] == "V") {
	$rif = $_POST["tipo"] . "-" . $_POST["rif"];
	$idR = $_POST["rep"];
	$idA1 = $_POST["aut1"];
	$idA2 = $_POST["aut2"];

	$rifes = $db_pdo->prepare("SELECT id FROM us_empresas WHERE rif = '" . $rif . "' limit 1");
	if ($rifes === false) {
		trigger_error($db_pdo->error, E_USER_ERROR);
	}
	$rifes->execute();
	if ($status === false) {
		trigger_error($stmt1->error, E_USER_ERROR);
	}

	$rifesV = ($rifes->rowCount() > 0) ? true : false;


	$celulares1 = $db_pdo->prepare("SELECT id FROM us_empresas WHERE telefono1 = '" . $_POST["telefono1"] . "' OR telefono2 = '" . $_POST["telefono1"] . "'");
	$celulares2 = $db_pdo->prepare("SELECT id FROM us_empresas WHERE telefono2 = '" . $_POST["telefono2"] . "' OR telefono2 = '" . $_POST["telefono2"] . "'");
	if ($celulares1 === false || $celulares2 === false) {
		trigger_error($db_pdo->error, E_USER_ERROR);
	}
	$celulares1->execute();
	$celulares2->execute();
	if ($status === false) {
		trigger_error($stmt1->error, E_USER_ERROR);
	}

	$celular1 = (($celulares1->rowCount() == 0) || ($celulares1->rowCount() == 1 && $rifes)) ? true : false;
	$celular2 = (($celulares2->rowCount() == 0) || ($celulares2->rowCount() == 1 && $rifes)) ? true : false;

	if ($celular1 && $celular2) {
		$telefono2 = ($_POST["telefono2"] == "") ? "N/A" : $_POST["telefono2"];
		$sql = ($rifesV) ? "UPDATE us_empresas set razon_social = '" . $_POST["razonSocial"] . "', razon_comercial = '" . $_POST["razonComercial"] . "', id_parroquia= '" . $_POST["parroquia"] . "', id_ciudad ='" . $_POST["ciudad"] . "', direccion = '" . $_POST["direccion"] . "', telefono1 = '" . $_POST["telefono1"] . "', telefono2 ='" . $telefono2 . "', verificado = CURRENT_TIMESTAMP, verificador = '" . $_POST["usuario"] . "' WHERE rif = '" . $rif . "'"
			: "INSERT INTO us_empresas (razon_social, rif, razon_comercial, id_parroquia, id_ciudad, direccion, telefono1, telefono2)
			VALUES ('" . $_POST["razonSocial"] . "', '" . $rif . "', '" . $_POST["razonComercial"] . "', '" . $_POST["parroquia"] . "', '" . $_POST["ciudad"] . "', '" . $_POST["direccion"] . "', '" . $_POST["telefono1"] . "', '" . $telefono2  . "')";
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
		$st1 = $db_pdo->prepare("SELECT id FROM us_empresas WHERE rif = '" . $rif . "' limit 1");
		$st1->execute();
		$id = $st1->fetchAll();
		$id = $id[0][0];

		$sql = "DELETE FROM us_pivot_sigoclub_empresas WHERE id_empresa = " . $id;
		var_dump($sql);

		$s = $db_pdo->prepare($sql);
		if ($s === false) {
			trigger_error($db_pdo->error, E_USER_ERROR);
		}
		$s->execute();



		$sql = "INSERT INTO us_pivot_sigoclub_empresas (id_empresa, id_sigoclub, tipo) 
			VALUES ('" . $id . "', '" . $idR . "', 1)";
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

		if ($idA1 != 0) {
			$sql = "INSERT INTO us_pivot_sigoclub_empresas (id_empresa, id_sigoclub, tipo) 
			VALUES ('" . $id . "', '" . $idA1 . "', 2)";
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
		}

		if ($idA2 != 0) {
			$sql = "INSERT INTO us_pivot_sigoclub_empresas (id_empresa, id_sigoclub, tipo) 
			VALUES ('" . $id . "', '" . $idA2 . "', 2)";
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
		}
	} elseif (!$celular1) {
		$_POST["prcs"] = "";
		$_SESSION["save_error"] = "El teléfono principal ingresado ya existe en nuestra base de datos";
	} elseif (!$celular2) {
		$_POST["prcs"] = "";
		$_SESSION["save_error"] = "El teléfono secundario ingresado ya existe en nuestra base de datos";
	} else {
		$_POST["prcs"] = "";
		$_SESSION["save_error"] = "El rif ingresado ya existe en nuestra base de datos";
	}
}
