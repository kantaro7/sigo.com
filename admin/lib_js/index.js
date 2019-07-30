// JavaScript Document


function main_load(mdl,opc){
	//Preparando los arreglos de los módulos, títulos y programa a escoger
	var modulos = ['Inicio', 'P\xE1gina Principal', 'Nosotros', 'Markets', 'Sucursales', 'Servicios', '', 'Contacto', 'Usuarios'];
	var secciones = ['', 'pagpri', 'nosotr', 'market', 'sucurs', 'servic', '', 'contac', 'secure'];
	var programas = [[''], ['pp_slider', 'pp_market', 'pp_bodega', 'pp_farmac', 'pp_mirevi'], ['ns_slider', 'ns_prirec'], ['mr_slider', 'mr_markts'], ['su_slider', 'su_ciudad', 'su_sucurs'], ['sr_servic', 'sr_servic_1', 'sr_servic_2', 'sr_servic_3', 'sr_servic_4'], [''], ['cn_slider'], ['sc_users']];
	var titulos = [[''], ['Slider Superior', 'Market', 'Bodeg\xF3n', 'Farmacia', 'Mi Revista'], ['Slider Superior', 'Principios Rectores'], ['Slider Superior', 'Secciones Markets'], ['Slider Superior', 'Ciudades', 'Sucursales'], ['Cards de Servicios', 'Contenido de Servicio 1', 'Contenido de Servicio 2', 'Contenido de Servicio 3', 'Contenido de Servicio 4'], [''], ['Slider Superior'], ['Perfiles de Acceso']];
	
	//Colocar el Título de la opción escogida
	ReplaceContentInContainer('optn_title', '<b>'+modulos[mdl]+'</b> / '+titulos[mdl][opc-1]);
	
	//Cargar el Programa correspondiente a la opción escogida
	//ajax_async("admin/sections/"+mdl+"_"+secciones[mdl]+"/"+programas[mdl][opc-1]+".php?a=0", 'main_container', programas[mdl][opc-1]+'-'+mdl);
	ajax_async("admin/pages/sec_"+mdl+"_"+secciones[mdl]+"/"+programas[mdl][opc-1]+".php?a=0", 'main_container', programas[mdl][opc-1]+"-"+mdl);
}

//Ejecutar asíncronamente
function ajax_async(url, area_carga, elemento_ajax){
	//alert("[ "+url+" ]  [ "+area_carga+" ]  [ "+elemento_ajax+" ]");
	elem_ajax=elemento_ajax;
	elemento_ajax=nuevoAjax();
	var aleatorio=Math.random();
	elemento_ajax.open("GET", url+"&aleatorio="+aleatorio, true);
	elemento_ajax.onreadystatechange=function(){ 
		if(elemento_ajax.readyState==1){
			document.getElementById(area_carga).innerHTML="Cargando...";	
		}
		if(elemento_ajax.readyState==4){
			document.getElementById(area_carga).innerHTML=elemento_ajax.responseText;

			if(area_carga=='lgn_rslt'){
				//Iniciar la sesión
				var txtBox=document.getElementById("rslt");
				if(txtBox!=null){
					window.location='admin.php';
				}

			} else if(area_carga=='div_inv' && elem_ajax=="logout"){
				//Cerrar la sesión
				window.location='admin.php';

			} else if(area_carga=='div_inv'){
				//Resetear index.PHP
				window.location='admin.php';

			} else if(area_carga=='main_container' && elem_ajax!="main"){
				//Ejecutar la opción del menú
				shw_data(elem_ajax, 1);

			} else if(area_carga=='ttls_crtr_bsqd' && elem_ajax=="set_crtr_ev"){
				shw_data('pp_events-1', 1);
			} else if(area_carga=='ttls_crtr_bsqd' && elem_ajax=="set_crtr_lc"){
				shw_data('dr_locals-3', 1);
			} else if(area_carga=='ttls_crtr_bsqd' && elem_ajax=="set_crtr_cm"){
				shw_data('cm_notics-4', 1);
			} else if(area_carga=='ttls_crtr_bsqd' && elem_ajax=="set_crtr_gl"){
				shw_data('gl_galery-5', 1);
			} else if(area_carga=='ttls_crtr_bsqd' && elem_ajax=="set_crtr_cn"){
				shw_data('cn_actual-6', 1);

			}
		} 
	}
	elemento_ajax.send(null);
}

//Poblar la div 'data_body' con los registros de cada opción
function shw_data(mdl, pgn){
	//Preparando los arreglos de los módulos, títulos y programa a escoger
	var secciones = ['', 'pagpri', 'nosotr', 'market', 'sucurs', 'servic', '', 'contac', 'secure'];

	var datos = mdl.split("-");

	//Ejecutar opción del menú
	ajax_async("admin/pages/sec_"+datos[1]+"_"+secciones[datos[1]]+"/"+datos[0]+"_data.php?pgn="+pgn, 'general_grid', 'pp_rotadr_grid');
}



//Cargar la ventana MODEL de actualización de la opción deseada
function nyro_exec(sdir, nprg, lprm){
	if(lprm===undefined) lprm='a=0';
	var nref="admin/pages/sec_"+sdir+"/"+nprg+"_actual.php?"+lprm;
	$("#emrgnt_wndw").attr("href", nref);
	$(function(){
		$('.nyroModal').nyroModal();
		$(".emrgnt_wndw_css").click();
	});
}

function call_lgn(){
	$("#emrgnt_wndw").attr("href", "admin/login.php");
	$(function(){
		$('.nyroModal').nyroModal();
		$(".emrgnt_wndw_css").click();
	});
}

function init_usr_ssn(){
	//Mostrar Pantalla Principal
	ajax_async("admin/pages/main.php?a=0", 'main_container', 'main');
}

function clse_usr_ssn(){
  var rslt=confirm("\u00BFEst\xE1 seguro de cerrar la sesi\xF3n actual?");
  if(rslt==true){
		ajax_async("admin/pages/sesion_des.php?a=0", 'div_inv', 'cls_ssn');
	}
}


//Mostrar/Ocultar el panel de búsqueda de cada opción
function sh_crt_bsq(){
	if($("#criter_select").css("display")=="none"){
		$("#criter_select").css("display", "block");
		$("#img_mat_right").attr("src", "admin/images/mat_icons/show_up_36.png");
		$("#img_mat_right").attr("title", " Ocultar Criterios de B\xFAsqueda ");
	} else {
		$("#criter_select").css("display", "none");
		$("#img_mat_right").attr("src", "admin/images/mat_icons/show_down_36.png");
		$("#img_mat_right").attr("title", " Mostrar Criterios de B\xFAsqueda ");
	}
}

//Switchar cheqckbox usando iconos
function swtch_chkbox(id_ico, id_chkbox){
	if( $("#"+id_chkbox).attr('checked')==true ){
		$("#"+id_chkbox).attr('checked', false);
		$("#"+id_ico).attr("src", "admin/images/mat_icons/check_un1_36.png");
	} else {
		$("#"+id_chkbox).attr('checked', true);
		$("#"+id_ico).attr("src", "admin/images/mat_icons/check1_36.png");
	}
}

//Switchar activo-inactivo de cada opción
function swtch_activ(tabla, id, cmp, val){
	ajax_async('admin/pages/swtch_activ.php?tabla='+tabla+'&id='+id+'&cmp='+cmp+'&val='+val,'activ_'+id,'shown');
}



//Download Registros depending on file's format
function mgrt_file(tipo){
	location.href="admin/pages/sec_6_contac/cn_actual_mgrt.php?tipo="+tipo+"&nom="+document.getElementById("cn_nombre").value+"&ape="+document.getElementById("cn_apeldo").value+"&men="+document.getElementById("cn_mesage").value;
}



//---------
//Preparar la búsqueda de eventos en base a los criterios
function prcsr_crt_bsq_ev(){
	if(document.getElementById("ev_titulo").value.length==0 && document.getElementById("ev_texto").value.length==0 && document.getElementById("ev_lugar").value.length==0 && document.getElementById("ev_fecha").value.length==0){
    alert("Debe especificar al menos un criterio.");
  } else if(document.getElementById("ev_fecha").value.length!=0 && !isDate(document.getElementById("ev_fecha").value)){
    alert("Error: Fecha inv\xE1lida.");
  } else {
		ajax_async('admin/pages/set_crtr_bsqd.php?mdl=pp_events&axn=b&tit='+document.getElementById("ev_titulo").value+'&tex='+document.getElementById("ev_texto").value+'&lug='+document.getElementById("ev_lugar").value+'&fec='+document.getElementById("ev_fecha").value,'ttls_crtr_bsqd','set_crtr_ev');
  }
}

//Eliminar la búsqueda de eventos en base a los criterios
function reset_crt_bsq_ev(){
	document.getElementById("ev_titulo").value="";
	document.getElementById("ev_texto").value="";
	document.getElementById("ev_lugar").value="";
	document.getElementById("ev_fecha").value="";
	ajax_async('admin/pages/set_crtr_bsqd.php?mdl=pp_events&axn=r','ttls_crtr_bsqd','set_crtr_ev');
}


//---------
//Preparar la búsqueda de locales en base a los criterios
function prcsr_crt_bsq_lc(){
	if(document.getElementById("lc_nombre").value.length==0 && document.getElementById("lc_texto").value.length==0 && document.getElementById("lc_catego").value.length==0 && document.getElementById("lc_zonass").value.length==0){
    alert("Debe especificar al menos un criterio.");
  } else {
		ajax_async('admin/pages/set_crtr_bsqd.php?mdl=dr_locals&axn=b&nom='+document.getElementById("lc_nombre").value+'&tex='+document.getElementById("lc_texto").value+'&cat='+document.getElementById("lc_catego").value+'&zon='+document.getElementById("lc_zonass").value,'ttls_crtr_bsqd','set_crtr_lc');
  }
}

//Eliminar la búsqueda de locales en base a los criterios
function reset_crt_bsq_lc(){
	document.getElementById("lc_nombre").value="";
	document.getElementById("lc_texto").value="";
	document.getElementById("lc_catego").value="";
	document.getElementById("lc_zonass").value="";
	ajax_async('admin/pages/set_crtr_bsqd.php?mdl=dr_locals&axn=r','ttls_crtr_bsqd','set_crtr_lc');
}


//---------
//Preparar la búsqueda de contactos en base a los criterios
function prcsr_crt_bsq_cm(){
	if(document.getElementById("cm_titulo").value.length==0 && document.getElementById("cm_introd").value.length==0 && document.getElementById("cm_categs").value.length==0 && document.getElementById("cm_hashtg").value.length==0 && document.getElementById("cm_fecha").value.length==0){
    alert("Debe especificar al menos un criterio.");
  } else if(document.getElementById("cm_fecha").value.length!=0 && !isDate(document.getElementById("cm_fecha").value)){
    alert("Error: Fecha inv\xE1lida.");
  } else {
		ajax_async('admin/pages/set_crtr_bsqd.php?mdl=cm_notics&axn=b&tit='+document.getElementById("cm_titulo").value+'&ntr='+document.getElementById("cm_introd").value+'&cat='+document.getElementById("cm_categs").value+'&hsh='+document.getElementById("cm_hashtg").value+'&fec='+document.getElementById("cm_fecha").value,'ttls_crtr_bsqd','set_crtr_cm');
  }
}

//Eliminar la búsqueda de contactos en base a los criterios
function reset_crt_bsq_cm(){
	document.getElementById("cm_titulo").value="";
	document.getElementById("cm_introd").value="";
	document.getElementById("cm_categs").value="";
	document.getElementById("cm_hashtg").value="";
	document.getElementById("cm_fecha").value="";
	ajax_async('admin/pages/set_crtr_bsqd.php?mdl=cm_notics&axn=r','ttls_crtr_bsqd','set_crtr_cm');
}


//---------
//Preparar la búsqueda de imágenes de galería en base a los criterios
function prcsr_crt_bsq_gl(){
	if(document.getElementById("gl_titulo").value.length==0){
    alert("Debe especificar al menos un criterio.");
  } else {
		ajax_async('admin/pages/set_crtr_bsqd.php?mdl=gl_galery&axn=b&tit='+document.getElementById("gl_titulo").value,'ttls_crtr_bsqd','set_crtr_gl');
  }
}

//Eliminar la búsqueda de imágenes de galería en base a los criterios
function reset_crt_bsq_gl(){
	document.getElementById("gl_titulo").value="";
	ajax_async('admin/pages/set_crtr_bsqd.php?mdl=gl_galery&axn=r','ttls_crtr_bsqd','set_crtr_gl');
}


//---------
//Preparar la búsqueda de contactos en base a los criterios
function prcsr_crt_bsq_cn(){
	if(document.getElementById("cn_nombre").value.length==0 && document.getElementById("cn_apeldo").value.length==0 && document.getElementById("cn_mesage").value.length==0){
    alert("Debe especificar al menos un criterio.");
  } else {
		ajax_async('admin/pages/set_crtr_bsqd.php?mdl=cn_actual&axn=b&nom='+document.getElementById("cn_nombre").value+'&ape='+document.getElementById("cn_apeldo").value+'&mes='+document.getElementById("cn_mesage").value,'ttls_crtr_bsqd','set_crtr_cn');
  }
}

//Eliminar la búsqueda de contactos en base a los criterios
function reset_crt_bsq_cn(){
	document.getElementById("cn_nombre").value="";
	document.getElementById("cn_apeldo").value="";
	document.getElementById("cn_mesage").value="";
	ajax_async('admin/pages/set_crtr_bsqd.php?mdl=cn_actual&axn=r','ttls_crtr_bsqd','set_crtr_cn');
}
