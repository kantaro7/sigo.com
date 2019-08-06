<?php
header("Content-Type: text/html;charset=utf-8");

//Load Basic Configuration, Database & General Rutines
include_once "admin/lib_php/config.php";          // Constantes Globales
include_once "admin/lib_php/general.php";         // Funciones varias

//Connect to Database
$db_pdo = new PDO("mysql:host=$host;dbname=$base", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
$acentos = $db_pdo->query("SET NAMES 'utf8'");

$st1 = $db_pdo->prepare("SELECT e.id as id, e.razon_social as social, e.rif as rif, e.razon_comercial as comercial, est.id as id_estado, mun.id as id_municipio, e.id_parroquia as id_parroquia, e.id_ciudad as id_ciudad, e.direccion as direccion, e.telefono1 as telefono1, e.telefono2 as telefono2, club.id as id_sigoclub, club.nombre1 as nombre, club.apellido1 as apellido, club.cedula as cedula, pivot.tipo as tipo
        FROM us_empresas e 
        INNER join us_pivot_sigoclub_empresas pivot on pivot.id_empresa = e.id
        INNER JOIN us_sigoclub club on club.id = pivot.id_sigoclub
        INNER JOIN us_parroquias parr on parr.id = e.id_parroquia
        INNER JOIN us_municipios mun on mun.id = parr.id_municipio
        INNER JOIN us_estados est on est.id = mun.id_estado
        WHERE e.rif = '" . $_POST['rif'] . "' ");
$st1->execute();
$empresa = $st1->fetchAll();

echo json_encode($empresa);
