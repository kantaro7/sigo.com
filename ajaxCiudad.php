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
        
        $st1=$db_pdo->prepare("SELECT * FROM us_ciudades WHERE id_estado = ".$_POST['id']." ORDER BY ciudad ASC");
        $st1->execute();
        $ciudades = $st1->fetchAll();
        
        if(count($ciudades) > 0){
            echo '<option value="0">Seleccione una opción</option>';
            foreach($ciudades as $ciu){
            // while($row = $ciudades->fetch_assoc()){ 
                echo '<option value="'.$ciu['id'].'">'.$ciu['ciudad'].'</option>';
            }
        }else{
            echo '<option value="">Ciudades no disponibles</option>';
        }
    // }

?>