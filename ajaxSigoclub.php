<?php
    header("Content-Type: text/html;charset=utf-8");
   
    //Load Basic Configuration, Database & General Rutines
    include_once "admin/lib_php/config.php";          // Constantes Globales
    include_once "admin/lib_php/general.php";         // Funciones varias

    //Connect to Database
    $db_pdo=new PDO("mysql:host=$host;dbname=$base", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
    $acentos = $db_pdo->query("SET NAMES 'utf8'");
    
    $st1=$db_pdo->prepare("SELECT * FROM us_sigoclub WHERE cedula = '".$_POST['cedula']."' limit 1");
    $st1->execute();
    $cedula = $st1->fetchAll();

    echo json_encode($cedula);
