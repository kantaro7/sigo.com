<?php

class db_object
{
	var $db_server;
	var $db_port;
	var $db_name;
	var $db_user;
	var $db_pass;
	var $db_conector;
	var $db_view;
	var $db_rows_number;
	
	function db_object($prm_server, $prm_port, $prm_database_name, $prm_user, $prm_pass){
		$this->db_server=$prm_server;
		$this->db_port=$prm_port;
		$this->db_name=$prm_database_name;
		$this->db_user=$prm_user;
		$this->db_pass=$prm_pass;
	}
	
	function db_connect($db_type){
		switch ($db_type){
			case "PostgreSQL":
				return $this->db_conector=pg_connect("host=".$this->db_server." port=".$this->db_port." dbname=".$this->db_name." user=".$this->db_user." password=".$this->db_pass);
				break;
			case "MySQL":
				$this->db_conector=mysql_connect($this->db_server, $this->db_user, $this->db_pass);
				if(!$this->db_conector) die('Trató de conectar a la Base de Datos: ' . mysql_error());
				$this->seleccion_bd=mysql_select_db($this->db_name, $this->db_conector);
				if(!$this->seleccion_bd) die ('No se pudo utilizar '.$this->db_name.' : ' . mysql_error());
				return $this->db_conector;
				break;
			case "ODBC":
				return $this->db_conector=odbc_connect ($this->db_server, $this->db_user, $this->db_pass);
				break;
		}
	}
	
	function db_disconnect($db_type){
		switch ($db_type){
			case "PostgreSQL":
				pg_Close();
				break;
			case "MySQL":
				mysql_close($this->db_conector);
				break;
			case "ODBC":
				odbc_close($this->db_conector);
				break;
		}
	}
	
	function seleccion_bd($base_dato){
			mysql_select_db($base_dato, $this->db_conector);
	}	
	
	function db_number_of_rows($query_text, $db_type){
		switch ($db_type){
			case "PostgreSQL":
				return $this->db_rows_number=pg_num_rows(pg_query($this->db_conector, $query_text));
				break;
			case "MySQL":
				return $this->db_rows_number=mysql_num_rows(mysql_query($query_text, $this->db_conector));
				break;
			case "ODBC":
				$this->db_rows_number=odbc_num_rows(odbc_exec($this->db_conector, $query_text));
				if($this->db_rows_number==-1) die ('No se pudo acceder a SQL (MS ACCESS) ['.$query_text.'] : ' . odbc_error());
				return $this->db_rows_number;
				break;
		}
	}
	
	function db_query($query_text, $db_type){
		switch ($db_type){
			case "PostgreSQL":
				return $this->db_view=pg_query($this->db_conector, $query_text);
				break;
			case "MySQL":
				return $this->db_view=mysql_query($query_text, $this->db_conector);
				break;
			case "ODBC":
				return $this->db_view=odbc_exec($this->db_conector, $query_text);
				break;
		}
	}
	
	function db_insert($query_text, $db_type){
		switch ($db_type){
			case "PostgreSQL":
				$rslt=pg_query($this->db_conector, $query_text);
				if(!$rslt){
					echo pg_last_error($rslt);
					exit;
				}
				break;
			case "MySQL":
				$rslt=mysql_query($query_text, $this->db_conector);
				break;
			case "ODBC":
				$rslt=odbc_exec($this->db_conector, $query_text);
				break;
		}
		return $rslt;
	}
	
	function db_edit($query_text, $db_type){
		switch ($db_type){
			case "PostgreSQL":
				$rslt=pg_query($this->db_conector, $query_text);
				break;
			case "MySQL":
				$rslt=mysql_query($query_text, $this->db_conector);
				break;
			case "ODBC":
				$rslt=odbc_exec($this->db_conector, $query_text);
				break;
		}
		return $rslt;
	}
	
	function db_delete($query_text, $db_type){
		switch ($db_type){
			case "PostgreSQL":
				$rslt=pg_query($this->db_conector, $query_text);
				break;
			case "MySQL":
				$rslt=mysql_query($query_text, $this->db_conector);
				break;
			case "ODBC":
				$rslt=odbc_exec($this->db_conector, $query_text);
				break;
		}
		return $rslt;
	}
	
	function db_fetch_rows($apuntador, $db_type){
		switch ($db_type){
			case "PostgreSQL":
				return pg_Fetch_Array($apuntador);
				break;
			case "MySQL":
				return mysql_fetch_array($apuntador);
				break;
			case "ODBC":
				return odbc_fetch_array($apuntador);
				break;
		}
	}

	function db_integrity($esquema, $tabla, $campo, $tipo, $valor, $id, $db_type){
		$validar_id="";
		if($id!=0) $validar_id=" id_".$tabla."<>".$id." and ";
		if($tipo=="C"){
			$query_text="SELECT $campo FROM $esquema$tabla WHERE $validar_id $campo='$valor'";
		} else {
			$query_text="SELECT $campo FROM $esquema$tabla WHERE $validar_id $campo=$valor";
		}
		switch ($db_type){
			case "PostgreSQL":
				$numero_registro=pg_num_rows(pg_query($this->db_conector, $query_text));
				break;
			case "MySQL":
				$numero_registro=mysql_num_rows(mysql_query($query_text, $this->db_conector));
				break;
			case "ODBC":
				$numero_registro=odbc_num_rows(odbc_exec($this->db_conector, $query_text));
				break;
		}
		return ($numero_registro);
	}

	function db_integrity2($esquema, $tabla, $campo1, $campo2, $tipo1, $tipo2, $valor1, $valor2, $id, $db_type){
		$validar_id="";
		if($id!=0) $validar_id=" id_".$tabla."<>".$id." and ";
		
		$where1="$campo1='$valor1'";
		if($tipo1=="N") $where1="$campo1=$valor1";
		$where2="$campo2='$valor2'";
		if($tipo2=="N") $where2="$campo2=$valor2";

		$query_text="SELECT $campo FROM $esquema$tabla WHERE $validar_id $where1 and $where2";
		
		switch ($db_type){
			case "PostgreSQL":
				$numero_registro=pg_num_rows(pg_query($this->db_conector, $query_text));
				break;
			case "MySQL":
				$numero_registro=mysql_num_rows(mysql_query($query_text, $this->db_conector));
				break;
			case "ODBC":
				$numero_registro=odbc_num_rows(odbc_exec($this->db_conector, $query_text));
				break;
		}
		return ($numero_registro);
	}
}

?>