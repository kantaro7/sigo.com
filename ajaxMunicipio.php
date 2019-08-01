<?php
    header("Content-Type: text/html;charset=utf-8");
    
    //Load Basic Configuration, Database & General Rutines
    include_once "admin/lib_php/config.php";          // Constantes Globales
    include_once "admin/lib_php/general.php";         // Funciones varias

    //Connect to Database
    $db_pdo=new PDO("mysql:host=$host;dbname=$base", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
    $acentos = $db_pdo->query("SET NAMES 'utf8'");
    
    $st=$db_pdo->prepare("SELECT * FROM us_municipios WHERE id_estado = ".$_POST['id']." ORDER BY municipio ASC");
    $st->execute();
    $municipios = $st->fetchAll();
    
    if(count($municipios) > 0){
        echo '<option value="0">Seleccione una opción</option>';
        foreach($municipios as $muni){
            echo '<option value="'.$muni['id'].'">'.utf8_decode($muni['municipio']).'</option>';
        }
    }else{
        echo '<option value="-1">Municipios no disponibles</option>';
    }

?>