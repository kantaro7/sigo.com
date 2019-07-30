function nuevoAjax() { 
	var xmlhttp=false; 
	try{ 
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e){ 
		try{ 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E){ xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 
	return xmlhttp; 
}

function cargarElementoAjax(url, obj, area_carga, elemento_ajax) {
	var valor=obj.options[obj.selectedIndex].value;
	elemento_ajax=nuevoAjax();
	var aleatorio=Math.random();
	elemento_ajax.open("GET", url+"?seleccionado="+valor+"&aleatorio="+aleatorio+"&id="+document.getElementById("campo_seleccion").value, true);
	elemento_ajax.onreadystatechange=function() { 
		if (elemento_ajax.readyState==1){ document.getElementById(area_carga).innerHTML="Cargando..."; }
		if (elemento_ajax.readyState==4){ document.getElementById(area_carga).innerHTML=elemento_ajax.responseText; } 
	}
	elemento_ajax.send(null);
}

function cargarElementoAjaxUrl(url, area_carga, elemento_ajax) {
	elemento_ajax=nuevoAjax();
	var aleatorio=Math.random();
	elemento_ajax.open("GET", url+"&aleatorio="+aleatorio, true);
	elemento_ajax.onreadystatechange=function() { 
		if (elemento_ajax.readyState==1) {
			// Mientras carga elimino la opcion "Selecciona la ciudad" y pongo una que dice "Cargando"
			document.getElementById(area_carga).innerHTML="Cargando...";	
		}
		if (elemento_ajax.readyState==4) { document.getElementById(area_carga).innerHTML=elemento_ajax.responseText; } 
	}
	elemento_ajax.send(null);
}

function cargarElementoAjaxValor(url, valor, area_carga, elemento_ajax) {
	elemento_ajax=nuevoAjax();
	var aleatorio=Math.random();
	elemento_ajax.open("GET", url+"?seleccionado="+valor+"&aleatorio="+aleatorio, true);
	elemento_ajax.onreadystatechange=function() { 
		if (elemento_ajax.readyState==1) { document.getElementById(area_carga).innerHTML="Cargando...";	}
		if (elemento_ajax.readyState==4) { document.getElementById(area_carga).innerHTML=elemento_ajax.responseText; } 
	}
	elemento_ajax.send(null);
}