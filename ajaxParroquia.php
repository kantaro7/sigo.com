<?php
    header("Content-Type: text/html;charset=utf-8");
   
    //Load Basic Configuration, Database & General Rutines
    include_once "admin/lib_php/config.php";          // Constantes Globales
    include_once "admin/lib_php/general.php";         // Funciones varias

    //Connect to Database
    $db_pdo=new PDO("mysql:host=$host;dbname=$base", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
    $acentos = $db_pdo->query("SET NAMES 'utf8'");
    
    $st=$db_pdo->prepare("SELECT * FROM us_parroquias WHERE id_municipio = ".$_POST['id']." ORDER BY parroquia ASC");
    $st->execute();
    $parroquias = $st->fetchAll();
    
    if(count($parroquias) > 0){
        echo '<option value="0">Seleccione una opción</option>';
        foreach($parroquias as $pa){
            echo '<option value="'.$pa['id'].'">'.utf8_decode($pa['parroquia']).'</option>';
        }
    }else{
        echo '<option value="-1">Parroquias no disponibles</option>';
    }

?>