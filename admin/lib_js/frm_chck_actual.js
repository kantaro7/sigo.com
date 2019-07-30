// JavaScript Document

function isNormalInteger(str) {
    var n = Math.floor(Number(str));
    return String(n) === str && n >= 0;
}


//Validar form de login
function vldt_lgn(){
  var mnsj="";
	ReplaceContentInContainer('lgn_rslt','');
	
	if(document.getElementById("lgn_usr").value.length==0){
    mnsj+="Debe indicar el C\xF3digo de Usuario.<br>"
	} else if(!isEmail(document.getElementById("lgn_usr").value)){
		mnsj+="El formato del C\xF3digo de Usuario es errado.<br>"
	}
	if(document.getElementById("lgn_pss").value.length==0){
    mnsj+="Debe indicar la Contrase\xF1a.<br>"
  }
	
	var v=grecaptcha.getResponse();
	if(v.length == 0) {
		mnsj+="Debe indicar que no es un Robot."
	}
	
  if(mnsj!=""){
    ReplaceContentInContainer('lgn_rslt', mnsj);
  } else {
		ajax_async("admin/pages/sesion_inc.php?code="+document.getElementById("lgn_usr").value+"&pass="+document.getElementById("lgn_pss").value+'&cpch='+document.getElementById("g-recaptcha-response").value, 'lgn_rslt', 'lgn_rslt');
  }
}



//-------------------------------------------------------------------
//Validar form de actualización de slider superior (página principal)
function frm_vldt_pp_slider(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("orden").value.length==0){
    mnsj+="Debe indicar el Orden.<br>"
  } else if(!isNormalInteger(document.getElementById("orden").value)){
    mnsj+="El Orden debe ser num\xE9rico.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto").value.length==0){
    mnsj+="Debe seleccionar la Imagen.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}

//Validar form de actualización de market (página principal)
function frm_vldt_pp_market(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("nombre").value.length==0){
    mnsj+="Debe indicar el Nombre.<br>"
  }
	if(document.getElementById("titulo").value.length==0){
    mnsj+="Debe indicar el T\xEDtulo.<br>"
  }
	if(document.getElementById("texto").value.length==0){
    mnsj+="Debe indicar el Texto.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto_1").value.length==0){
    mnsj+="Debe seleccionar la Imagen Principal.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto_2").value.length==0){
    mnsj+="Debe seleccionar la Imagen para Móvil.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}

//Validar form de actualización de bodegón (página principal)
function frm_vldt_pp_bodega(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("nombre").value.length==0){
    mnsj+="Debe indicar el Nombre.<br>"
  }
	if(document.getElementById("titulo").value.length==0){
    mnsj+="Debe indicar el T\xEDtulo.<br>"
  }
	if(document.getElementById("texto").value.length==0){
    mnsj+="Debe indicar el Texto.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto").value.length==0){
    mnsj+="Debe seleccionar la Imagen.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}

//Validar form de actualización de farmacia (página principal)
function frm_vldt_pp_farmac(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("nombre").value.length==0){
    mnsj+="Debe indicar el Nombre.<br>"
  }
	if(document.getElementById("titulo").value.length==0){
    mnsj+="Debe indicar el T\xEDtulo.<br>"
  }
	if(document.getElementById("texto").value.length==0){
    mnsj+="Debe indicar el Texto.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto_1").value.length==0){
    mnsj+="Debe seleccionar la Imagen Principal.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto_2").value.length==0){
    mnsj+="Debe seleccionar la Imagen para Móvil.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}

//Validar form de actualización de revista (página principal)
function frm_vldt_pp_mirevi(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("link_url").value.length==0){
    mnsj+="Debe indicar el URL de Redireccionamiento.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto").value.length==0){
    mnsj+="Debe seleccionar la Imagen.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}



//-------------------------------------------------------------------
//Validar form de actualización de slider superior (nosotros)
function frm_vldt_ns_slider(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("orden").value.length==0){
    mnsj+="Debe indicar el Orden.<br>"
  } else if(!isNormalInteger(document.getElementById("orden").value)){
    mnsj+="El Orden debe ser num\xE9rico.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto").value.length==0){
    mnsj+="Debe seleccionar la Imagen.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}

//Validar form de actualización de principios rectores (nosotros)
function frm_vldt_ns_prirec(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("nombre").value.length==0){
    mnsj+="Debe indicar el Nombre.<br>"
  }
	if(document.getElementById("texto").value.length==0){
    mnsj+="Debe indicar el Texto.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto").value.length==0){
    mnsj+="Debe seleccionar la Imagen.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}



//-------------------------------------------------------------------
//Validar form de actualización de slider superior (markets)
function frm_vldt_mr_slider(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("orden").value.length==0){
    mnsj+="Debe indicar el Orden.<br>"
  } else if(!isNormalInteger(document.getElementById("orden").value)){
    mnsj+="El Orden debe ser num\xE9rico.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto").value.length==0){
    mnsj+="Debe seleccionar la Imagen.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}


//Validar form de actualización de markets (markets)
function frm_vldt_mr_markts(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("nombre").value.length==0){
    mnsj+="Debe indicar el Nombre.<br>"
  }
	if(document.getElementById("texto_1").value.length==0){
    mnsj+="Debe indicar el Texto Lateral.<br>"
  }
	if(document.getElementById("orden").value.length==0){
    mnsj+="Debe indicar el Orden.<br>"
  } else if(!isNormalInteger(document.getElementById("orden").value)){
    mnsj+="El Orden debe ser num\xE9rico.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto").value.length==0){
    mnsj+="Debe seleccionar la Imagen.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}



//-------------------------------------------------------------------
//Validar form de actualización de slider superior (sucursales)
function frm_vldt_su_slider(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("orden").value.length==0){
    mnsj+="Debe indicar el Orden.<br>"
  } else if(!isNormalInteger(document.getElementById("orden").value)){
    mnsj+="El Orden debe ser num\xE9rico.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto").value.length==0){
    mnsj+="Debe seleccionar la Imagen.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}

//Validar form de actualización de ciudades (sucursales)
function frm_vldt_su_ciudad(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("nombre").value.length==0){
    mnsj+="Debe indicar el Nombre.<br>"
  }
	if(document.getElementById("orden").value.length==0){
    mnsj+="Debe indicar el Orden.<br>"
  } else if(!isNormalInteger(document.getElementById("orden").value)){
    mnsj+="El Orden debe ser num\xE9rico.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto").value.length==0){
    mnsj+="Debe seleccionar la Imagen.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}

//Validar form de actualización de sucursal (sucursales)
function frm_vldt_su_sucurs(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("nombre").value.length==0){
    mnsj+="Debe indicar el Nombre.<br>"
  }
	if(document.getElementById("id_su_ciudad").value.length==0){
    mnsj+="Debe seleccionar la Ciudad.<br>"
  }
	if(document.getElementById("direccion").value.length==0){
    mnsj+="Debe indicar la Direcci\xF3n.<br>"
  }
	if(document.getElementById("telefonos").value.length==0){
    mnsj+="Debe indicar los Tel\xE9fonos.<br>"
  }
	if(document.getElementById("horario").value.length==0){
    mnsj+="Debe indicar el Horario.<br>"
  }
	if(document.getElementById("map_url").value.length==0){
    mnsj+="Debe indicar el URL asociado del Mapa.<br>"
  }
	if(document.getElementById("orden").value.length==0){
    mnsj+="Debe indicar el Orden.<br>"
  } else if(!isNormalInteger(document.getElementById("orden").value)){
    mnsj+="El Orden debe ser num\xE9rico.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto").value.length==0){
    mnsj+="Debe seleccionar la Imagen.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}



//-------------------------------------------------------------------
//Validar form de actualización de card de servicio (servicios)
function frm_vldt_sr_servic(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("nombre").value.length==0){
    mnsj+="Debe indicar el Nombre.<br>"
  }
	if(document.getElementById("texto_1").value.length==0){
    mnsj+="Debe indicar el Texto de Card.<br>"
  }
	if(document.getElementById("link_url").value.length==0){
    mnsj+="Debe indicar el URL de Redireccionamiento.<br>"
  }
	if(document.getElementById("orden").value.length==0){
    mnsj+="Debe indicar el Orden.<br>"
  } else if(!isNormalInteger(document.getElementById("orden").value)){
    mnsj+="El Orden debe ser num\xE9rico.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto_1").value.length==0){
    mnsj+="Debe seleccionar la Imagen de Card.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto_2").value.length==0){
    mnsj+="Debe seleccionar la Imagen del Banner Superior Interno.<br>"
  }
	if(document.getElementById("texto_2").value.length==0){
    mnsj+="Debe indicar el Texto de Contenido Interno.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}

//Validar form de actualización de contenido de servicio 1 (servicios)
function frm_vldt_sr_servic_1(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("nombre").value.length==0){
    mnsj+="Debe indicar el Nombre.<br>"
  }
	if(document.getElementById("texto").value.length==0){
    mnsj+="Debe indicar el Texto.<br>"
  }
	if(document.getElementById("orden").value.length==0){
    mnsj+="Debe indicar el Orden.<br>"
  } else if(!isNormalInteger(document.getElementById("orden").value)){
    mnsj+="El Orden debe ser num\xE9rico.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto").value.length==0){
    mnsj+="Debe seleccionar la Imagen.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}

//Validar form de actualización de contenido de servicio 2 (servicios)
function frm_vldt_sr_servic_2(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("programa").value==0){
    mnsj+="Debe indicar el Programa.<br>"
  }
	if(document.getElementById("nombre").value.length==0){
    mnsj+="Debe indicar el Nombre.<br>"
  }
	if(document.getElementById("texto").value.length==0){
    mnsj+="Debe indicar el Texto.<br>"
  }
	if(document.getElementById("orden").value.length==0){
    mnsj+="Debe indicar el Orden.<br>"
  } else if(!isNormalInteger(document.getElementById("orden").value)){
    mnsj+="El Orden debe ser num\xE9rico.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto").value.length==0){
    mnsj+="Debe seleccionar la Imagen.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}

//Validar form de actualización de contenido de servicio 3 (servicios)
function frm_vldt_sr_servic_3(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("descripcion").value.length==0){
    mnsj+="Debe indicar la Referencia.<br>"
  }
	if(document.getElementById("fila").value.length==0){
    mnsj+="Debe indicar el N\xFAmero de Fila.<br>"
  } else if(!isNormalInteger(document.getElementById("fila").value)){
    mnsj+="El N\xFAmero de Fila debe ser num\xE9rico.<br>"
  }
	if(document.getElementById("orden").value.length==0){
    mnsj+="Debe indicar el Orden.<br>"
  } else if(!isNormalInteger(document.getElementById("orden").value)){
    mnsj+="El Orden debe ser num\xE9rico.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto").value.length==0){
    mnsj+="Debe seleccionar la Imagen.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}

//Validar form de actualización de contenido de servicio 2 (servicios)
function frm_vldt_sr_servic_4(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("descripcion").value.length==0){
    mnsj+="Debe indicar la Referencia.<br>"
  }
	if(document.getElementById("orden").value.length==0){
    mnsj+="Debe indicar el Orden.<br>"
  } else if(!isNormalInteger(document.getElementById("orden").value)){
    mnsj+="El Orden debe ser num\xE9rico.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto").value.length==0){
    mnsj+="Debe seleccionar la Imagen.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}



//-------------------------------------------------------------------
//Validar form de actualización de slider superior (contacto)
function frm_vldt_cn_slider(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("orden").value.length==0){
    mnsj+="Debe indicar el Orden.<br>"
  } else if(!isNormalInteger(document.getElementById("orden").value)){
    mnsj+="El Orden debe ser num\xE9rico.<br>"
  }
	if(accn=='i' && document.getElementById("img_foto").value.length==0){
    mnsj+="Debe seleccionar la Imagen.<br>"
  }
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}



//--------------------------------------
//Validar form de actualización de users
function frm_vldt_sc_users(accn){
  var mnsj="";
	ReplaceContentInContainer('error_actual','');
	
	if(document.getElementById("user_name").value.length==0){
    mnsj+="Debe indicar el Nombre.<br>"
  }
	if(accn=="i" && document.getElementById("user_pass").value.length==0){
    mnsj+="Debe indicar la Contrase\xF1a.<br>"
  } else if(accn!="i" && document.getElementById("user_pass").value.length>0 && document.getElementById("user_pass").value.length<6){
    mnsj+="La Contrase\xF1a debe tener al menos 6 caracteres.<br>"
  }
	if(document.getElementById("user_email").value.length==0){
    mnsj+="Debe indicar el Correo Electr\xF3nico (Email).<br>"
	} else if(!isEmail(document.getElementById("user_email").value)){
		mnsj+="El formato del Correo Electr\xF3nico (Email) es errado.<br>"
	}
	if(document.getElementById("user_phone").value.length==0){
    mnsj+="Debe indicar el N\xFAmero de Tel\xE9fono.<br>"
	} else if(document.getElementById("user_phone").value.length<11){
    mnsj+="El N\xFAmero de Tel\xE9fono debe tener al menos 11 caracteres.<br>"
	}
	
  if(mnsj!=""){
    ReplaceContentInContainer('error_actual', mnsj);
		return false;
  } else {
		if(accn=="e"){
			var mensaje=confirm("Est\xE1 seguro de eliminar el elemento selecionado?");
			if(mensaje==true){
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
  }
}
