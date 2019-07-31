<?php

    //Load Basic Configuration, Database & General Rutines
    include_once "admin/lib_php/config.php";          // Constantes Globales
    include_once "admin/lib_php/general.php";         // Funciones varias

    //Connect to Database
    $db_pdo=new PDO("mysql:host=$host;dbname=$base", $user, $pass);

    if(isset($_POST["id"]) && !empty($_POST["id"])){
        //Obtiene todas las parroquias
	    $st=$db_pdo->prepare("SELECT * FROM us_parroquias WHERE id_municipio = ".$_POST['id']." ORDER BY parroquia ASC");
        
        $st->execute();
        $parroquias = $st->fetchAll();
        //Count total number of rows
        // $rowCount = $parroquias->num_rows;
        
        //Display cities list
        if(count($parroquias) > 0){
            echo '<option value="0">Seleccione una opción</option>';
            foreach($parroquias as $pa){
            // while($row = $parroquias->fetch_assoc()){ 
                echo '<option value="'.$pa['id'].'">'.$pa['parroquia'].'</option>';
            }
        }else{
            echo '<option value="">Parroquias no disponibles</option>';
        }
    }

?>