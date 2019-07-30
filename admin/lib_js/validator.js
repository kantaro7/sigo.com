// ---------------------------------------------------------------------- //
//       
//   Funciones definidas por Flavio Gómez
//        
// ---------------------------------------------------------------------- //

function check_form(check_code){
	switch(check_code){
		// Autenticar Acceso al Sistema
		case "auth": 
			sw_acceso=check_access();
			if(sw_acceso==1){
				return false;
			}
			break;
	}
}

function check_access(){
	var mensaje_buscador="Verifique los siguientes detalles:\n\n";
	sw_buscador=0;
	auth_user=0;
	clave=0;
	document.getElementById("auth_user").style.backgroundColor="#FFFFFF";
	document.getElementById("auth_pass").style.backgroundColor="#FFFFFF";
	if(document.getElementById("auth_user").value.length==0){
		mensaje_buscador+=" - Indique el Código de Usuario\n";
		document.getElementById("auth_user").style.backgroundColor="#fffd5e";
		usuario=1;
		sw_buscador=1;
	}
	if(document.getElementById("auth_pass").value.length==0){
		mensaje_buscador+=" - Indique la Contraseña Secreta\n";
		document.getElementById("auth_pass").style.backgroundColor="#fffd5e";
		clave=1;
		sw_buscador=1;
	}
	if(sw_buscador==1){
		if(usuario==1 && clave==0){
			document.getElementById("auth_user").focus();
		}
		if(usuario==0 && clave==1){
			document.getElementById("auth_pass").focus();
		}
		if(usuario==1 && clave==1){
			document.getElementById("auth_user").focus();
		}
		alert(mensaje_buscador);
	}
	else{
		document.getElementById("big_opc").value="i";
		//cargarModulo(modulo);
		//enviar_informacion();
	}
	return sw_buscador;
}

// ---------------------------------------------------------------------------

function validar_email(valor) {
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(valor)) {
		return (true);
	} else {
		return (false);
	}
}
function validar_fecha_mayor(fecha_mayor, fecha_menor) {
	separador="/";
	if(InStr(0, fecha_mayor, "-")!=0) separador="-";
	matriz_fecha_mayor = fecha_mayor.split("-");   
	matriz_fecha_menor = fecha_menor.split("-");
	fecha_mayor_val=new Date(matriz_fecha_mayor[2],matriz_fecha_mayor[1],matriz_fecha_mayor[0]);
	fecha_menor_val=new Date(matriz_fecha_menor[2],matriz_fecha_menor[1],matriz_fecha_menor[0]);
	diferencia=fecha_mayor_val.getTime()-fecha_menor_val.getTime();
	diferencia = diferencia/86400000;
	if(diferencia>0) {
		return (true);
	} else {
		return (false);
	}
}

function isHora(hora){
	ok=true;
	if((hora.length!=5)||(hora.substr(0,2)>23)||(hora.substr(3,2)>59)||(hora.substr(2,1)!=":")||(hora.indexOf(":")!=hora.lastIndexOf(":"))) ok=false;
	return ok;
}
function isDate(dtStr){
	var daysInMonth = DaysArray(12)
	var pos1=dtStr.indexOf(dtCh)
	var pos2=dtStr.indexOf(dtCh,pos1+1)
	var strDay=dtStr.substring(0,pos1)
	var strMonth=dtStr.substring(pos1+1,pos2)
	var strYear=dtStr.substring(pos2+1)
	strYr=strYear
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	month=parseInt(strMonth)
	day=parseInt(strDay)
	year=parseInt(strYr)
	if (pos1==-1 || pos2==-1){
		//alert("The date format should be : dd/mm/yyyy")
		return false
	}
	if (strMonth.length<1 || month<1 || month>12){
		//alert("Please enter a valid month")
		return false
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		//alert("Please enter a valid day")
		return false
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		//alert("Please enter a valid 4 digit year between "+minYear+" and "+maxYear)
		return false
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
		//alert("Please enter a valid date")
		return false
	}
	return true
}
function isEmpty(s) {
	return ((s == null) || (s.length == 0))
}
function isWhitespace (s) {
	var i;
	if (isEmpty(s)) return true;
	for (i = 0; i < s.length; i++) {   
		var c = s.charAt(i);
		// si el caracter en que estoy no aparece en whitespace,
		// entonces retornar falso
		if (whitespace.indexOf(c) == -1) return false;
	}
	return true;
}
function isLetter (c) {
	return( ( uppercaseLetters.indexOf( c ) != -1 ) ||
					( lowercaseLetters.indexOf( c ) != -1 ) )
}
function isDigit (c) { 
	return ((c >= "0") && (c <= "9"))
}
function isLetterOrDigit (c) {
	return (isLetter(c) || isDigit(c))
}
function isInteger (s) {   var i;
	if (isEmpty(s)) 
	if (isInteger.arguments.length == 1) return defaultEmptyOK;
	else return (isInteger.arguments[1] == true);
	for (i = 0; i < s.length; i++) {   
		var c = s.charAt(i);
		if( i != 0 ) {
			if (!isDigit(c)) return false;
		} else { 
			if (!isDigit(c) && (c != "-") || (c == "+")) return false;
		}
	}
	return true;
}
function isNumber (s){
	var i;
	var dotAppeared;
	dotAppeared = false;
	if (isEmpty(s)) 
	 if (isNumber.arguments.length == 1) return defaultEmptyOK;
	 else return (isNumber.arguments[1] == true);
	for (i = 0; i < s.length; i++) {   
		var c = s.charAt(i);
		if( i != 0 ) {
			if ( c == "." ) {
				if( !dotAppeared )
						dotAppeared = true;
				else
						return false;
			} else     
					if (!isDigit(c)) return false;
		} else { 
			if ( c == "." ) {
				if( !dotAppeared )
						dotAppeared = true;
				else
						return false;
			} else     
					if (!isDigit(c) && (c != "-") || (c == "+")) return false;
		}
	}
	return true;
}
function isAlphabetic (s) {   var i;
	if (isEmpty(s)) 
	 if (isAlphabetic.arguments.length == 1) return defaultEmptyOK;
	 else return (isAlphabetic.arguments[1] == true);
	for (i = 0; i < s.length; i++) {   
		var c = s.charAt(i);
		if (!isLetter(c))
		return false;
	}
	return true;
}
function isAlphanumeric (s) {   var i;
	if (isEmpty(s)) 
	 if (isAlphanumeric.arguments.length == 1) return defaultEmptyOK;
	 else return (isAlphanumeric.arguments[1] == true);
	for (i = 0; i < s.length; i++) {   
		var c = s.charAt(i);
		if (! (isLetter(c) || isDigit(c) ) )
		return false;
	}
	return true;
}
function isName (s) {
	if (isEmpty(s)) 
	 if (isName.arguments.length == 1) return defaultEmptyOK;
	 else return (isAlphanumeric.arguments[1] == true);
	return( isAlphanumeric( stripCharsInBag( s, whitespace ) ) );
}
function isPhoneNumber (s) {   var modString;
	if (isEmpty(s)) 
	 if (isPhoneNumber.arguments.length == 1) return defaultEmptyOK;
	 else return (isPhoneNumber.arguments[1] == true);
	modString = stripCharsInBag( s, phoneChars );
	return (isInteger(modString))
}
function isEmail (s){
	if (isEmpty(s)) 
	 if (isEmail.arguments.length == 1) return defaultEmptyOK;
	 else return (isEmail.arguments[1] == true);
	if (isWhitespace(s)) return false;
	var i = 1;
	var sLength = s.length;
	while ((i < sLength) && (s.charAt(i) != "@"))
	{ i++
	}
	if ((i >= sLength) || (s.charAt(i) != "@")) return false;
	else i += 2;
	while ((i < sLength) && (s.charAt(i) != "."))
	{ i++
	}
	if ((i >= sLength - 1) || (s.charAt(i) != ".")) return false;
	else return true;
}
function isNice(s){
	var i = 1;
	var sLength = s.length;
	var b = 1;
	while(i<sLength) {
					if( (s.charAt(i) == "\"") || (s.charAt(i) == "'" ) ) b = 0;
					i++;
	}
	return b;
}
