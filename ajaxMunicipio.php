<?php
    header("Content-Type: text/html;charset=utf-8");
    //Load Basic Configuration, Database & General Rutines
    include_once "admin/lib_php/config.php";          // Constantes Globales
    include_once "admin/lib_php/general.php";         // Funciones varias

    //Connect to Database
    $db_pdo=new PDO("mysql:host=$host;dbname=$base", $user, $pass);
    $acentos = $db_pdo->query("SET NAMES 'utf8'");
    // if(isset($_POST["municipio"]) && !empty($_POST["municipio"])){
        //Get all city data
	    $st=$db_pdo->prepare("SELECT * FROM us_municipios WHERE id_estado = ".$_POST['id']." ORDER BY municipio ASC");
        $st->execute();
        $municipios = $st->fetchAll();
        
        //Display cities list
        if(count($municipios) > 0){
            echo '<option value="0">Seleccione una opción</option>';
            foreach($municipios as $muni){
            // while($row = $municipios->fetch_assoc()){ 
                echo '<option value="'.$muni['id'].'">'.utf8_decode($muni['municipio']).'</option>';
            }
        }else{
            echo '<option value="">Municipios no disponibles</option>';
        }
    // }

?>