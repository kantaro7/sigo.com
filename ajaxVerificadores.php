<?php
header("Content-Type: text/html;charset=utf-8");

//Load Basic Configuration, Database & General Rutines
include_once "admin/lib_php/config.php";          // Constantes Globales
include_once "admin/lib_php/general.php";         // Funciones varias

//Connect to Database
$db_pdo = new PDO("mysql:host=$host;dbname=$base", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
$acentos = $db_pdo->query("SET NAMES 'utf8'");

$st1 = $db_pdo->prepare("SELECT id FROM us_verificadores WHERE usuario = '" . $_POST['usuario'] . "' AND pass = '" . $_POST['pass'] . "' limit 1");
$st1->execute();

if ($st1->rowCount() == 0) {
    echo 0;
}

$cedula = $st1->fetchAll();

echo ($cedula[0][0]);
