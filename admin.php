<?php
// Iniciar sesión
session_start();

// Configure Error Displaying
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//Configure Page headers
header('P3P: CP="CAO PSA OUR"');
header("Cache-control: private");

//Load Basic Configuration, Database & General Rutines
include_once "admin/lib_php/config.php";
include_once "admin/lib_php/general.php";

//Conectar con Base de Datos
$db_pdo=new PDO("mysql:host=$host;dbname=$base", $user, $pass);

set_time_limit(600);

if(!isset($_SESSION["modulo"]))	$_SESSION["modulo"]="";
if(!isset($_SESSION["opcion"]))	$_SESSION["opcion"]="";

$auto_exec="init_usr_ssn";
if($_SESSION["modulo"]!="" && $_SESSION["opcion"]!="") $auto_exec="main_load";

//Inicializar opción seleccionada del Menú
if(!isset($_SESSION["menu_opc"]))	$_SESSION["menu_opc"]=0;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
  ~ jquery.mb.components
  ~ Copyright (c) 2001-2010. Matteo Bicocchi (Pupunzi); Open lab srl, Firenze - Italy
  ~ email: info@pupunzi.com
  ~ site: http://pupunzi.com
  ~
  ~ Licences: MIT, GPL
  ~ http://www.opensource.org/licenses/mit-license.php
  ~ http://www.gnu.org/licenses/gpl.html
  -->
<html>
<head>
	<title><?php echo(html_encode($apl_name)); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="admin/css/general.css"    rel="stylesheet" 	type="text/css">
	<link href="admin/css/mbMenu.css"     rel="stylesheet" 	type="text/css" media="screen" />
	<link href="admin/css/nyroModal.css"  rel="stylesheet" 	type="text/css" media="screen" />

  <!-- Favicons-->
  <link href="img/fav.png"              rel="icon"        type="image/x-icon" />

	<script type="text/javascript" src="admin/lib_js/general.js"></script>
	<script type="text/javascript" src="admin/lib_js/jquery.js"></script>
  <script type="text/javascript" src="admin/mb_menu/inc/jquery.metadata.js"></script>
  <script type="text/javascript" src="admin/mb_menu/inc/jquery.hoverIntent.js"></script>
  <script type="text/javascript" src="admin/mb_menu/inc/mbMenu.js"></script>
	<script type="text/javascript" src="admin/lib_js/index.js"></script>
	<script type="text/javascript" src="admin/lib_js/frm_chck_actual.js"></script>
	<script type="text/javascript" src="admin/lib_js/frm_vldt.js"></script>
  <script type="text/javascript" src="admin/lib_js/jquery.nyroModal-1.6.2.js"></script>

  <script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>

  <style type="text/css">
    body a.style{
      color:#AF3002;
      font-family:sans-serif;
      font-size:13px;
      text-decoration:none;
    }
    .wrapper{
      font-family:Arial, Helvetica, sans-serif;
      margin-top:0px;
      margin-left:0px;
    }
    .wrapper h1{
      font-family:Arial, Helvetica, sans-serif;
      font-size:26px;
    }
    button{
      padding:4px;
      display:inline-block;
      cursor:pointer;
      font:12px/14px Arial, Helvetica, sans-serif;
      color:#666;
      border:1px solid #999;
      background-color:#eee;
      -moz-border-radius:10px;
      -webkit-border-radius:10px;
      -moz-box-shadow:#999 2px 0px 3px;
      -webkit-box-shadow:#999 2px 0px 3px;
      margin-bottom:4px;
    }
    button:hover{
      color:#aaa;
      background-color:#000;
    }
    :focus {
      outline: 0;
    }
    span.btn{
      padding:10px;
      display:inline-block;
      cursor:pointer;
      font:12px/14px Arial, Helvetica, sans-serif;
      color:#aaa;
      background-color:#eee;
      -moz-border-radius:10px;
      -webkit-border-radius:10px;
      -moz-box-shadow:#999 2px 0px 3px;
      -webkit-box-shadow:#999 2px 0px 3px;
    }
    span.btn:hover{
      background-color:#000;
    }
    .msgBox{
      position:absolute;
      width:250px;
      height:60px;
      background:black;
      -moz-box-shadow:#999 2px 0px 3px;
      -webkit-box-shadow:#999 2px 0px 3px;    
      -moz-border-radius:10px;
      -webkit-border-radius:10px;
      padding:10px;
      padding-top:30px;
      top:10px;
      right:10px;
      font:20px/24px Arial, Helvetica, sans-serif;
    }
  </style>
	<script language="JavaScript">
  <!-- hide from none JavaScript Browsers
		Image1= new Image(10,10)
		Image1.src = "images/bullets/bullet_2.png"
		Image2 = new Image(10,10)
		Image2.src = "images/bullets/bullet_6.png"
  // End Hiding -->
  </script>
	<style type="text/css">
		#blocker {
			width: 300px;
			height: 300px;
			background: red;
			padding: 30px;
			border: 5px solid green;
		}
	</style>
  <script type="text/javascript">
    $(function(){
      $(".myMenu").buildMenu({
        template:"menuVoices.html",
        additionalData:"pippo=1",
        menuWidth:240,
        openOnRight:true,
        menuSelector: ".menuContainer",
        iconPath:"ico/",
        hasImages:true,
        fadeInTime:100,
        fadeOutTime:300,
        adjustLeft:2,
        minZindex:"auto",
        adjustTop:10,
        opacity:.90,
        shadow:false,
        shadowColor:"#ccc",
        hoverIntent:0,
        openOnClick:false,
        closeOnMouseOut:true,
        closeAfter:500,
        submenuHoverIntent:0
      });
    });
    function recallcMenu(el){
      if (!el) el= $.mbMenu.lastContextMenuEl;
      var cmenu=+$(el).attr("cmenu");
      $(cmenu).remove();
    }
  </script>
	<script type="text/javascript">
		$(function() {
			$.nyroModalSettings({
				debug: false, modal: true,
			});
			function preloadImg(image){
				var img = new Image();
				img.src = image;
			}
			preloadImg('admin/images/nyroModal/ajaxLoader.gif');
			preloadImg('admin/images/nyroModal/prev.gif');
			preloadImg('admin/images/nyroModal/next.gif');
		});
	</script>
  <style type="text/css">
		#top_nav {
			float: left;
			width: 100%;
			height: 64px;
			color: #ffffff;
			line-height: 56px;
			background-color: #424242;
			box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.16), 0px 2px 10px 0px rgba(0, 0, 0, 0.12);
	  }
		#left-nav{
			float: left;
			width: 240px;
			top: 64px;
			margin-top: 0px;
			margin-right: 0px;
			margin-bottom: 0px;
			margin-left: 0px;
			height: auto;
			background-color: #ffffff;
			box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.16), 0px 2px 10px 0px rgba(0, 0, 0, 0.12);
		}
		#main_container{
			float: right;
			
			/* Firefox */
			width: -moz-calc(100% - 280px);
			/* WebKit */
			width: -webkit-calc(100% - 280px);
			/* Opera */
			width: -o-calc(100% - 280px);
			/* Standard */
			width: calc(100% - 280px);

			height: calc(100%);
			margin-top: 20px;
			margin-right: 20px;
		}
		#optn_title{
			float: right;
			min-width: 400px;
			height: 26px;
			margin-top: -10px;
			margin-right: 20px;
			color: #ffffff;
			font-family: Calibri, Arial;
			font-size: 24px;
			font-weight: 300;
			text-align: right;
		}
		#user_data{
			float: left;
			width: 180px;
			height: 60px;
			margin-top: 12px;
			margin-left: 54px;
			color: #FFF;
			font-family: Calibri, Arial;
			font-size: 20px;
			font-weight: 500;
			text-align: justify;
		}

		.emrgnt_wndw_css {
			display: none;
		}
	</style>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
  <!--  B a r r a   S u p e r i o r  -->
  <div id="top_nav">
    <img src="img/logo_admin.png" width="259" height="56" alt="Logo" style="float: left; margin-left: 6px; margin-top: 5px;" />
    <div id="optn_title"></div>
  </div>
  <!--  B a r r a   I z q u i e r d a  -->
  <div id="left-nav">
		<?php include_once "admin/menu.php"; ?>
  </div>
  <!--   C o n t e n e d o r   P r i n c i p a l   -->
  <div id="main_container">
  </div>
  
  <a id="emrgnt_wndw" class="nyroModal emrgnt_wndw_css" href="admin/login.php">Ventana Emergente</a>
  <div id="div_inv" style="display: none;"></div>
</body>
</html>


<?php if($_SESSION["user_id"]<1 || !isset($_SESSION["user_id"])){		// Caso de que la sesión no esté activa o haya caducado 	?>
	<script language="JavaScript">
		call_lgn();
	</script>
<?php } else if($auto_exec=="init_usr_ssn"){ ?>
	<script language="JavaScript">
		init_usr_ssn();
  </script>
<?php } else if($auto_exec=="main_load"){ ?>
	<script language="JavaScript">
		main_load(<?php echo($_SESSION["modulo"]); ?>, <?php echo($_SESSION["opcion"]); ?>);
  </script>
<?php } ?>


<?php 
//echo("error [ ".$_SESSION["msg_error"]." ] <br>");
if($_SESSION["msg_error"]!=""){
	?>
	<script language="javascript">
		alert("No se actualizó la información debido a:\n\n<?php echo($_SESSION["msg_error"]); ?>");
  </script>
	<?php 
}
$_SESSION["msg_error"]="";

//echo("warning [ ".$_SESSION["msg_warng"]." ] <br>");
if($_SESSION["msg_warng"]!=""){
  ?>
  <script language="javascript">
    alert("<?php echo($_SESSION["msg_warng"]); ?>");
  </script>
  <?php 
}
$_SESSION["msg_warng"]="";
?>
