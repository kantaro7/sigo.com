<?php
session_start();
header('P3P: CP="CAO PSA OUR"');
header("Cache-control: private"); 

//Destruyendo Variables de Sesi�n
session_unset();

//Destruyendo Sesi�n
session_destroy();

//Generando indicador de flujo
echo("<input id='rslt' name='rslt' type='hidden' value='OK'>");
?>