<?php
//Iniciar Sesión y Chequear Variables de Entorno
include_once "lib_php/start.php";

include_once "lib_php/recaptchalib.php";		// Librerías de Google One Click ReCaptcha

// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$lang = "es";

// The response from reCAPTCHA
$resp = null;

// The error code from reCAPTCHA, if any
$error = null;
$reCaptcha = new ReCaptcha($grc_secret);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<title><?php echo(html_encode($apl_name)); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
	<link href="admin/css/general.css"		rel="stylesheet"  type="text/css">
	<link href="admin/css/nyroModal.css"  rel="stylesheet"  type="text/css" media="screen" />

  <!-- Favicons-->
  <link href="img/fav.png"             rel="icon"        type="image/png">

  <script type="text/javascript" src="admin/lib_js/jquery.nyroModal-1.6.2.js"></script>

  <style type="text/css">
		#access_box {
			width: 332px;
			height: 540px;
			font-family: Calibri, Arial;
			font-weight: normal;
			font-size:18px;
			color: #444444;
			background-color: #ffffff;
			/*box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.16), 0px 2px 10px 0px rgba(0, 0, 0, 0.12);*/
	  }
	</style>
  
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
  <center>
    <div id="access_box">
    	<form id="frm_login" action="#" method="post">
        <img src="img/logo_login.png" width="293" height="109" alt="Logo" style="margin-left: 0px; margin-top: 20px;" />
        <div style="float: left; width: 330px; height: 40px; clear: both;"></div>
        <img src="admin/images/mat_icons/login_user_36.png" width="36" height="36" alt="Logo" style="float: left; margin-left: 0px;" />
        <div style="float:left; margin-left: 10px; margin-top: 16px;"><input name="lgn_usr" id="lgn_usr" type="text" size="28" maxlength="60" class="input_outlineless" placeholder="Escriba su email"  onkeypress="if(event.keyCode==13){ document.getElementById('lgn_pss').focus(); }  return frmt_email(event);"></div>
        <div style="float: left; width: 330px; height: 01px; clear: both;"></div>
        <div style="float: left; width: 280px; height: 01px; margin-left: 48px; background-color: #A7A8A8;"></div>
        <div style="float: left; width: 330px; height: 25px; clear: both;"></div>
        <img src="admin/images/mat_icons/login_pass_36.png" width="36" height="36" alt="Logo" style="float: left; margin-left: 0px;" />
        <div style="float:left; margin-left: 10px; margin-top: 16px;"><input name="lgn_pss" id="lgn_pss" type="password" size="20" maxlength="20" class="input_outlineless" placeholder="Escriba su clave secreta"  onkeypress="return frmt_login(event);"></div>
        <div style="float: left; width: 330px; height: 01px; clear: both;"></div>
        <div style="float: left; width: 280px; height: 01px; margin-left: 48px; background-color: #A7A8A8;"></div>
  
        <div style="float: left; width: 330px; height: 30px; clear: both;"></div>
        <div class="g-recaptcha" data-sitekey="<?php echo $grc_siteKey;?>" style="float: left; margin-left: 18px;"></div>
        <script type="text/javascript"
            src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang;?>">
        </script>
  
        <div style="float: left; width: 330px; height: 30px; clear: both;"></div>
        <a id="iniciar" href="#" style="float: left; margin-left: 40px; width: 262px; height: 40px; text-decoration: none;" onclick="vldt_lgn();"><div style="width: 262px; height: 40px; background-image: url(admin/images/btn_lgn.png);"><div style="font-family: Calibri, Arial; font-size: 19px; font-weight: 400; color: #FFFFFF; text-align: center; padding-top: 06px;">Entrar</div></div></a>
  
        <div id="lgn_rslt" style="float:left; margin-top: 20px; margin-left: 10px; width:310px; height: 30px; font-family: Calibri, Arial; font-size: 14px; font-weight: bold; color: #ff0214; text-align: center;"></div>
  
        <a id="continuar" href="#" style="text-decoration: none; display: none;" class="nyroModalClose"></a>
  		</form>
    </div>
  </center>
</body>
</html>
<script language="JavaScript"> document.getElementById("lgn_usr").focus(); </script>

