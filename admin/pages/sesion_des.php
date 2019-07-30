<?php
session_start();
header('P3P: CP="CAO PSA OUR"');
header("Cache-control: private"); 

//Destruyendo Variables de Sesión
session_unset();

//Destruyendo Sesión
session_destroy();

//Generando indicador de flujo
echo("<input id='rslt' name='rslt' type='hidden' value='OK'>");
?>