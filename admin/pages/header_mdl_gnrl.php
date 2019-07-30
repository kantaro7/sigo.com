<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo(html_encode($apl_name.$ttl_html)); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="../../css/general.css"     	rel="stylesheet" type="text/css">
	<link href="../../css/nyroModal.css"  	rel="stylesheet" type="text/css" media="screen" />
  <link href="../../images/favicon.ico"		rel="icon"       type="image/x-icon" style="height:10; width:32px;"/> 
	<script type="text/javascript" src="../../library_js/general.js"></script>
	<script type="text/javascript" src="../../library_js/frm_vldt.js"></script>
	<script type="text/javascript" src="../../library_js/jquery.js"></script>
  <script type="text/javascript" src="../../library_js/jquery.nyroModal-1.6.2.js"></script>
	<style type="text/css">
		#blocker {
			width: 300px;
			height: 300px;
			background: red;
			padding: 30px;
			border: 5px solid green;
		}
	</style>
  <style type="text/css">
    #dhtmltooltip{
    position: absolute;
    width: 150px;
    border: 1px solid black;
    padding: 2px;
    background-color: lightyellow;
    visibility: hidden;
    z-index: 100;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 10px;
    font-style: normal;
    line-height: normal;
    color: #000000;
    /*Remove below line to remove shadow. Below line should always appear last within this CSS*/
    filter: progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);
  }
  #formulario table tr td table tr td {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
  }
  </style>
	<script type="text/javascript">
    function cargarElementoAjaxValorLgout(url, valor, area_carga, elemento_ajax){
      elemento_ajax=nuevoAjax();
      var aleatorio=Math.random();
      elemento_ajax.open("GET", url+"?seleccionado="+valor+"&aleatorio="+aleatorio, true);
      elemento_ajax.onreadystatechange=function(){
        if(elemento_ajax.readyState==1){ document.getElementById(area_carga).innerHTML="Cargando...";	}
        if(elemento_ajax.readyState==4){
          document.getElementById(area_carga).innerHTML=elemento_ajax.responseText;
          var txtBox=document.getElementById("txt_ok");
          if(txtBox!=null) window.location='/tiuna/';
        } 
      }
      elemento_ajax.send(null);
    }
  </script>
	<script type="text/javascript">
		$(function() {
			$.nyroModalSettings({
				debug: false, modal: true, autoSizable: true,
			});
			function preloadImg(image){
				var img = new Image();
				img.src = image;
			}
			preloadImg('images/nyroModal/ajaxLoader.gif');
			preloadImg('images/nyroModal/prev.gif');
			preloadImg('images/nyroModal/next.gif');
		});
	</script>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" style="background-image:url(../../imagenes/fondo_dgrd.jpg)">
<div id="dhtmltooltip"></div>
<script type="text/javascript">
/***********************************************
* Cool DHTML tooltip script-  Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var offsetxpoint=-60 //Customize x offset of tooltip
var offsetypoint=20 //Customize y offset of tooltip
var ie=document.all
var ns6=document.getElementById && !document.all
var enabletip=false
if (ie||ns6)
var tipobj=document.all? document.all["dhtmltooltip"] : document.getElementById? document.getElementById("dhtmltooltip") : ""
function ietruebody(){
	return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}
function ddrivetip(thetext, thecolor, thewidth){
	if (ns6||ie)	{
		if (typeof thewidth!="undefined") tipobj.style.width=thewidth+"px"
		if (typeof thecolor!="undefined" && thecolor!="") tipobj.style.backgroundColor=thecolor
		tipobj.innerHTML=thetext
		enabletip=true
		return false
	}
}
function positiontip(e){
	if (enabletip){
		var curX=(ns6)?e.pageX : event.clientX+ietruebody().scrollLeft;
		var curY=(ns6)?e.pageY : event.clientY+ietruebody().scrollTop;
		//Find out how close the mouse is to the corner of the window
		var rightedge=ie&&!window.opera? ietruebody().clientWidth-event.clientX-offsetxpoint : window.innerWidth-e.clientX-offsetxpoint-20
		var bottomedge=ie&&!window.opera? ietruebody().clientHeight-event.clientY-offsetypoint : window.innerHeight-e.clientY-offsetypoint-20
		var leftedge=(offsetxpoint<0)? offsetxpoint*(-1) : -1000
		//if the horizontal distance isn't enough to accomodate the width of the context menu
		if (rightedge<tipobj.offsetWidth)
		//move the horizontal position of the menu to the left by it's width
		tipobj.style.left=ie? ietruebody().scrollLeft+event.clientX-tipobj.offsetWidth+"px" : window.pageXOffset+e.clientX-tipobj.offsetWidth+"px"
		else if(curX<leftedge)
		tipobj.style.left="5px"
		else
		//position the horizontal position of the menu where the mouse is positioned
		tipobj.style.left=curX+offsetxpoint+"px"
		//same concept with the vertical position
		if (bottomedge<tipobj.offsetHeight)
		tipobj.style.top=ie? ietruebody().scrollTop+event.clientY-tipobj.offsetHeight-offsetypoint+"px" : window.pageYOffset+e.clientY-tipobj.offsetHeight-offsetypoint+"px"
		else
		tipobj.style.top=curY+offsetypoint+"px"
		tipobj.style.visibility="visible"
	}
}
function hideddrivetip(){
	if (ns6||ie){
		enabletip=false
		tipobj.style.visibility="hidden"
		tipobj.style.left="-1000px"
		tipobj.style.backgroundColor=''
		tipobj.style.width=''
	}
}
document.onmousemove=positiontip
</script>
<form name="main_form" id="main_form" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<center>
<a name="top_of_page"></a>
<div style="width: 1050px; height: 108px; margin-top: 5px; background-image: url(../../images/header_monitor.png); background-repeat: no-repeat;">
	<div style="float: left; width: 1050px; margin-left: 0px; margin-top: 76px; clear: both;">
		<div style="float: left; width: 200px; height: 14px; margin-top: 12px; margin-left: 10px; color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; text-align: left;"><?php echo('Caracas, '.date("d").' de '.$array_month[date("m")-1].' de '.date("Y")); ?></div>
		<div style="float: right; width: 700px; height: 16px; margin-top: 9px; margin-right: 10px; color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; font-size: 16px; font-weight: bold; text-align: right;"><?php echo(html_encode($module_name)); ?></div>
	</div>
</div>