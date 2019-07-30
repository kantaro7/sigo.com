
// Esta variable indica si está bien dejar las casillas
// en blanco como regla general
var defaultEmptyOK = false

// Esta variable indica si se debe verificar la presencia de comillas
// u otros símbolos extraños en un campo, por omisión no, porque
// siempre crea problemas con las bases de datos o programas CGI
var checkNiceness = true;

// listas de caracteres
var digits = "0123456789";
var lowercaseLetters = "abcdefghijklmnopqrstuvwxyzáéíóúñü "
var uppercaseLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZÁÉÍÓÚÑ "
var whitespace = " \t\n\r";

// caracteres admitidos en nos de telefono
var phoneChars = "()-+ ";

// ---------------------------------------------------------------------- //
//                     TEXTOS PARA LOS MENSAJES                           //
// ---------------------------------------------------------------------- //

// m abrevia "missing" (faltante)
var mMessage = "Error: no puede dejar este espacio vacio"

// p abrevia "prompt"
var pPrompt = "Error: ";
var pAlphanumeric = "ingrese un texto que contenga solo letras y/o numeros";
var pAlphabetic   = "ingrese un texto que contenga solo letras";
var pInteger = "ingrese un numero entero";
var pNumber = "ingrese un numero";
var pPhoneNumber = "ingrese un número de teléfono";
var pEmail = "ingrese una dirección de correo electrónico válida";
var pName = "ingrese un texto que contenga solo letras, numeros o espacios";
var pNice = "no puede utilizar comillas aqui";

// ---------------------------------------------------------------------- //
//                FUNCIONES PARA MANEJO DE ARREGLOS                       //
// ---------------------------------------------------------------------- //

// JavaScript 1.0 (Netscape 2.0) no tenia un constructor para arreglos,
// asi que ellos tenian que ser hechos a mano. Desde JavaScript 1.1 
// (Netscape 3.0) en adelante, las funciones de manejo de arreglos no
// son necesarias.

function makeArray(n){
//*** BUG: If I put this line in, I get two error messages:
//(1) Window.length can't be set by assignment
//(2) daysInMonth has no property indexed by 4
//If I leave it out, the code works fine.
//   this.length = n;
   for (var i = 1; i <= n; i++){
      this[i] = 0
   } 
   return this
}

// Quita todos los caracteres que que estan en "bag" del string "s" s.
function stripCharsInBag (s, bag){   var i;
    var returnString = "";

    // Buscar por el string, si el caracter no esta en "bag", 
    // agregarlo a returnString
    
    for (i = 0; i < s.length; i++){   var c = s.charAt(i);
        if(bag.indexOf(c) == -1) returnString += c;
    }

    return returnString;
}

// Lo contrario, quitar todos los caracteres que no estan en "bag" de "s"
function stripCharsNotInBag (s, bag){   var i;
    var returnString = "";
    for (i = 0; i < s.length; i++){   
        var c = s.charAt(i);
        if(bag.indexOf(c) != -1) returnString += c;
    }

    return returnString;
}

// Quitar todos los espacios en blanco de un string
function stripWhitespace (s){   return stripCharsInBag (s, whitespace)
}

// La rutina siguiente es para cubrir un bug en Netscape
// 2.0.2 - seria mejor usar indexOf, pero si se hace
// asi stripInitialWhitespace() no funcionaria

function charInString (c, s){   for (i = 0; i < s.length; i++){   if(s.charAt(i) == c) return true;
    }
    return false
}

// Quita todos los espacios que antecedan al string
function stripInitialWhitespace (s){   var i = 0;
    while ((i < s.length) && charInString (s.charAt(i), whitespace))
       i++;
    return s.substring (i, s.length);
}

// ---------------------------------------------------------------------- //
//                  FUNCIONES PARA RECLAMARLE AL USUARIO                  //
// ---------------------------------------------------------------------- //

// pone el string s en la barra de estado
function statBar (s){   window.status = s
}

// notificar que el campo theField esta vacio
function warnEmpty (theField){   theField.focus()
    alert(mMessage)
    statBar(mMessage)
    return false
}

// notificar que el campo theField es invalido
function warnInvalid (theField, s){   theField.focus()
    theField.select()
    alert(s)
    statBar(pPrompt + s)
    return false
}

// el corazon de todo: checkField
function checkField (theField, theFunction, emptyOK, s){   
    var msg;
    if(checkField.arguments.length < 3) emptyOK = defaultEmptyOK;
    if(checkField.arguments.length == 4){
        msg = s;
    } else {
        if( theFunction == isAlphabetic ) msg = pAlphabetic;
        if( theFunction == isAlphanumeric ) msg = pAlphanumeric;
        if( theFunction == isInteger ) msg = pInteger;
        if( theFunction == isNumber ) msg = pNumber;
        if( theFunction == isEmail ) msg = pEmail;
        if( theFunction == isPhoneNumber ) msg = pPhoneNumber;
        if( theFunction == isName ) msg = pName;
    }
    
    if((emptyOK == true) && (isEmpty(theField.value))) return true;

    if((emptyOK == false) && (isEmpty(theField.value))) 
        return warnEmpty(theField);

    if( checkNiceness && !isNice(theField.value))
        return warnInvalid(theField, pNice);

    if(theFunction(theField.value) == true) 
        return true;
    else
        return warnInvalid(theField,msg);

}

function isTime(hora){
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
function dateAway(strDate) {
	var Date1 = new fecha(strDate);
	//
	var currentTime = new Date()
	var day = currentTime.getDate()
	var month = currentTime.getMonth() + 1
	var year = currentTime.getFullYear()
	//
	var myDate1 = new Date( Date1.anio, Date1.mes, Date1.dia );
	var myDate2 = new Date( year, month, day );
	//
	var diff = myDate2.getTime() - myDate1.getTime();
	var diffDays = Math.abs(Math.floor(diff / (3600000*24)));
	//alert ('La diferencia es de ' + diffDays + ' dias');
	return diffDays
}
function dateAwayNA(strDate) {
	var Date1 = new fecha(strDate);
	//
	var currentTime = new Date()
	var day = currentTime.getDate()
	var month = currentTime.getMonth() + 1
	var year = currentTime.getFullYear()
	//
	var myDate1 = new Date( Date1.anio, Date1.mes, Date1.dia );
	var myDate2 = new Date( year, month, day );
	//
	var diff = myDate2.getTime() - myDate1.getTime();
	var diffDays = Math.floor(diff / (3600000*24));
	//alert ('La diferencia es de ' + diffDays + ' dias');
	return diffDays
}
function fecha(cadena){
	var separador = "/";
	if ( cadena.indexOf( separador ) != -1 ){
		var posi1 = 0;
		var posi2 = cadena.indexOf( separador, posi1 + 1 );
		var posi3 = cadena.indexOf( separador, posi2 + 1 );
		this.dia = cadena.substring( posi1, posi2 );
		this.mes = cadena.substring( posi2 + 1, posi3 );
		this.anio = cadena.substring( posi3 + 1, cadena.length );
	} else {
		this.dia = 0;
		this.mes = 0;
		this.anio = 0;
	}
}
function compDates(strDate, endDate){
	var Date1 = new fecha(strDate);
	var Date2 = new fecha(endDate);
	
	var strDate1 = Date1.anio+Date1.mes+Date1.dia
	var strDate2 = Date2.anio+Date2.mes+Date2.dia
//	-1 if a < b
//	0 if a = b
//	1 if a > b}
	if(strDate1<strDate2) return -1;
	if(strDate1==strDate2) return 0;
	if(strDate1>strDate2) return 1;
}

function isEmail(s){
    if (isEmpty(s)) 
		 if (isEmail.arguments.length == 1) return defaultEmptyOK;
		 else return (isEmail.arguments[1] == true);
    if (isWhitespace(s)) return false;
    var i = 1;
    var sLength = s.length;
    while ((i < sLength) && (s.charAt(i) != "@"))
    { i++ }
    if ((i >= sLength) || (s.charAt(i) != "@")) return false;
    else i += 2;

    while ((i < sLength) && (s.charAt(i) != "."))
    { i++ }
    if ((i >= sLength - 1) || (s.charAt(i) != ".")) return false;
    else return true;
}
function isEmpty(s)
{   return ((s == null) || (s.length == 0))
}
function isWhitespace (s){
		var i;
    if (isEmpty(s)) return true;
    for (i = 0; i < s.length; i++){   
        var c = s.charAt(i);
        // si el caracter en que estoy no aparece en whitespace,
        // entonces retornar falso
        if (whitespace.indexOf(c) == -1) return false;
    }
    return true;
}
function isInteger (s)
{   var i;
    if (isEmpty(s)) 
       if (isInteger.arguments.length == 1) return defaultEmptyOK;
       else return (isInteger.arguments[1] == true);
    
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if( i != 0 ) {
            if (!isDigit(c)) return false;
        } else { 
            if (!isDigit(c) && (c != "-") || (c == "+")) return false;
        }
    }
    return true;
}
// s es un numero (entero o flotante, con o sin signo)
function isNumber (s)
{   var i;
    var dotAppeared;
    dotAppeared = false;
    if (isEmpty(s)) 
       if (isNumber.arguments.length == 1) return defaultEmptyOK;
       else return (isNumber.arguments[1] == true);
    
    for (i = 0; i < s.length; i++)
    {   
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
function isLetter (c)
{
    return( ( uppercaseLetters.indexOf( c ) != -1 ) ||
            ( lowercaseLetters.indexOf( c ) != -1 ) )
}

// c es un digito
function isDigit (c)
{   return ((c >= "0") && (c <= "9"))
}

// c es letra o digito
function isLetterOrDigit (c)
{   return (isLetter(c) || isDigit(c))
}
// ---------------------------------------------------------------------- //
//                  FUNCIONES PARA EL TRIM                  //
// ---------------------------------------------------------------------- //

function Trim( str ){
	var resultStr = "";
	
	resultStr = TrimLeft(str);
	resultStr = TrimRight(resultStr);
	
	return resultStr;
}

function TrimLeft( str ){
	var resultStr = "";
	var i = len = 0;

	// Return immediately if an invalid value was passed in
	if(str+"" == "undefined" || str == null)	
		return null;

	// Make sure the argument is a string
	str += "";

	if(str.length == 0) 
		resultStr = "";
	else {	
  		// Loop through string starting at the beginning as long as there
  		// are spaces.
//	  	len = str.length - 1;
		len = str.length;
		
  		while ((i <= len) && (str.charAt(i) == " "))
			i++;

   	// When the loop is done, we're sitting at the first non-space char,
 		// so return that char plus the remaining chars of the string.
  		resultStr = str.substring(i, len);
  	}

  	return resultStr;
}

function TrimRight( str ){
	var resultStr = "";
	var i = 0;

	// Return immediately if an invalid value was passed in
	if(str+"" == "undefined" || str == null)	
		return null;

	// Make sure the argument is a string
	str += "";
	
	if(str.length == 0) 
		resultStr = "";
	else {
  		// Loop through string starting at the end as long as there
  		// are spaces.
  		i = str.length - 1;
  		while ((i >= 0) && (str.charAt(i) == " "))
 			i--;
 			
 		// When the loop is done, we're sitting at the last non-space char,
 		// so return that char plus all previous chars of the string.
  		resultStr = str.substring(0, i + 1);
  	}
  	
  	return resultStr;  	
}

// ---------------------------------------------------------------------- //
//                  FUNCIONES PARA VALIDAR CARACTERES ESPECIALES                  //
// ---------------------------------------------------------------------- //
function Validar_pagina(valor){
var checkOK = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz_1234567890//.:";
var checkStr = valor;
var allValid = true;
  for (i = 0; i < checkStr.length; i++){
    ch = checkStr.charAt(i);
    for (j = 0; j < checkOK.length; j++)
      if(ch == checkOK.charAt(j))
        break;
    if(j == checkOK.length){
      allValid = false;
      break;
    }
  }
 if(!allValid){
	return (false);
  }
  else{
	return true;
  }
}

function Enviar(Form){
	if(Form.accion.value==0){
	alert("Revise los campos del formulario existen caracteres no validos...");
	return false;
	}
	else return true;
}

//
//-----------------------------------------------------------------------------
// Funciones de conversión entre VBScript y JavaScript				(15/Mar/99)
//
// (c)Guillermo 'guille' Som, 1999
//
//-----------------------------------------------------------------------------
// Las funciones son:
//		Left, Right, Mid, LTrim, RTrim, Trim, InStr, RInStr, Space, 
//		jString (esta se llamará así, ya que String es una palabra reservada)
//		UCase, LCase, Len, 
// Otras funciones adicionales:
//		StrReverse
// Constantes:
//		vbCrLf, vbCr, vbLf, vbTab, 
//
//-----------------------------------------------------------------------------
// Códigos escape:
//
// \b = Backspace
// \f = Form feed
// \n = Line feed
// \r = Carriage return
// \t = Horizontal tab
//-----------------------------------------------------------------------------
// 
// Nota: 
// Para que todo funcione bien, hay que respetar el estado de las instrucciones
// es decir: cuidado con las mayúsculas/minúsculas.
//
//-----------------------------------------------------------------------------
//

//
//-----------------------------------------------------------------------------
// Constantes
var vbCr = "\r";
var vbLf = "\n";
var vbCrLf = vbCr+vbLf;
var vbTab = "\t";

// Devuelve los n primeros caracteres de la cadena
function Left(s, n){
	if(n>s.length)
		n=s.length;
	return s.substring(0, n);
}
// Devuelve los n últimos caracteres de la cadena
function Right(s, n){
	var t=s.length;
	if(n>t)
		n=t;
		
	return s.substring(t-n, t);
}
// Devuelve una cadena desde la posición n, con c caracteres
// Si c = 0 devolver toda la cadena desde la posición n
function Mid(s, n, c){
	var numargs=Mid.arguments.length;
	// Si sólo se pasan los dos primeros argumentos
	if(numargs<3)
		c=s.length-n+1;
	if(c<1)
		c=s.length-n+1;
	if(n+c >s.length)
		c=s.length-n+1;
	if(n>s.length)
		return "";
	return s.substring(n-1,n+c-1);
}
// Devuelve la posición de la primera ocurrencia de s2 en s1
// Si se especifica n, se empezará a comprobar desde esa posición
// Sino se especifica, los dos parámetros serán las cadenas
function InStr(n, s1, s2){
	var numargs=InStr.arguments.length;
	if(numargs<3)
		return n.indexOf(s1)+1;
	else
		return s1.indexOf(s2, n)+1;
}
// Devuelve la posición de la última ocurrencia de s2 en s1
// Si se especifica n, se empezará a comprobar desde esa posición
// Sino se especifica, los dos parámetros serán las cadenas
function RInStr(n, s1, s2){
	var numargs=RInStr.arguments.length;
	if(numargs<3)
		return n.lastIndexOf(s1)+1;
	else
		return s1.lastIndexOf(s2, n)+1;
}
	// Devuelve una cadena con n espacios
function Space(n){
	var t="";
	for(var i=1; i<=n; i++)
		t=t+" ";
	return t;
}
// Devuelve n veces el caracter c
function jString(n, c){
	var t="";
	for(var i=1; i<=n; i++)
		t=t+c;
	return t;
}
// Devuelve la cadena convertida a mayúsculas
function UCase(s){
	return s.toUpperCase();
}
// Devuelve la cadena convertida a mayúsculas
function UpCase(obj) {
  obj.value=obj.value.toUpperCase();
}
// Devuelve la cadena convertida en minúsculas
function LCase(s){
	return s.toLowerCase();
}
// Devuelve la longitud de la cadena s
function Len(s){
	return s.length;
}
// Invierte la cadena
function StrReverse(s){
	var i=s.length;
	var t="";
	while(i>-1){
		t=t+ s.substring(i,i+1);
		i--;
	}
	return t;
}
//
//-----------------------------------------------------------------------------
// Fin del código con las funciones de conversión de VBScript para JavaScript
//-----------------------------------------------------------------------------
//

//-->

//Transformacion del Formato fecha del archivo FormatosVarios.vbs a Javascript
/**
 * DHTML date validation script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/)
 */
// Declaring valid date character, minimum year and maximum year
var dtCh= "/";
var minYear=1900;
var maxYear=2100;

function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}

function DaysArray(n){
	for (var i = 1; i <= n; i++){
		this[i] = 31
		if(i==4 || i==6 || i==9 || i==11){this[i] = 30}
		if(i==2){this[i] = 29}
   } 
   return this
}

function poner_coma(id, val){
	document.getElementById(id).value+=",";
}

function formato_numero(e){
	tecla_codigo=(document.all) ? e.keyCode : e.which;
	if(tecla_codigo==8||tecla_codigo==0||tecla_codigo==13) return true;
//	alert(tecla_codigo);
	patron =/[0-9,]/;
	tecla_valor = String.fromCharCode(tecla_codigo);
	return patron.test(tecla_valor);
}
function formato_numeron(e){
	tecla_codigo=(document.all) ? e.keyCode : e.which;
	if(tecla_codigo==8||tecla_codigo==0||tecla_codigo==13) return true;
//	alert(tecla_codigo);
	patron =/[0-9,-]/;
	tecla_valor = String.fromCharCode(tecla_codigo);
	return patron.test(tecla_valor);
}
function formato_numero_fecha(e){
	tecla_codigo = (document.all) ? e.keyCode : e.which;
	if(tecla_codigo==8 || tecla_codigo==0)return true;
	patron =/[0-9/]/;
	tecla_valor = String.fromCharCode(tecla_codigo);
	return patron.test(tecla_valor);
}
function formato_numero_hora(e){
	tecla_codigo = (document.all) ? e.keyCode : e.which;
	if(tecla_codigo==8 || tecla_codigo==0) return true;
	patron =/[0-9:]/;
	tecla_valor = String.fromCharCode(tecla_codigo);
	return patron.test(tecla_valor);
}
function formato_numero_telefono(e){
	tecla_codigo = (document.all) ? e.keyCode : e.which;
	if(tecla_codigo==8 || tecla_codigo==0 || tecla_codigo==13)return true;
	patron =/[0-9 .()-]/;
	tecla_valor = String.fromCharCode(tecla_codigo);
	return patron.test(tecla_valor);
}
function formato_numero_decimal(e){
	tecla_codigo = (document.all) ? e.keyCode : e.which;
	if(tecla_codigo==8 || tecla_codigo==0 || tecla_codigo==13)return true;
	patron =/[0-9,]/;
	tecla_valor = String.fromCharCode(tecla_codigo);
	return patron.test(tecla_valor);
}
function formato_numero_real(e){
	tecla_codigo = (document.all) ? e.keyCode : e.which;
	if(tecla_codigo==8 || tecla_codigo==0 || tecla_codigo==13)return true;
	patron =/[0-9,-]/;
	tecla_valor = String.fromCharCode(tecla_codigo);
	return patron.test(tecla_valor);
}
function formato_letra(e){
	tecla_codigo = (document.all) ? e.keyCode : e.which;
	//alert(tecla_codigo);
	if(tecla_codigo==8 || tecla_codigo==0 || tecla_codigo==13)return true;
	patron =/[A-Z, a-z]/;
	tecla_valor = String.fromCharCode(tecla_codigo);
	return patron.test(tecla_valor);
}

function abrirventana(url){
	ventana=window.open(url,"_blank","width=825,height=600,scrollbars=yes,resizable=yes,location=no,toolbar=no");
}
function abrirventanahorizontal(url){
	ventana=window.open(url,"_blank","width=1100,height=600,scrollbars=yes,resizable=yes,location=no,toolbar=no");
}

function SectionLoader(Product_Type, Product_Code, Section_name){
	document.getElementById("target_name").value = Section_name;	
	document.getElementById("tipo").value = Product_Type;	
	document.getElementById("producto").value = Product_Code;	
	document.main_form.submit();
}

function cargarAccion(accion){
	document.getElementById("accion").value = accion;	
}
function cargarMenu(target_name){
	cargarModulo(target_name);
	enviar_informacion();
}
function cargarModulo(target_name){
	document.getElementById("target_name").value = target_name;	
}
function enviar_informacion(){
	document.main_form.submit();
}
function EstadoPaginador(){
	if(document.getElementById("sin_registro").value==1){
		document.getElementById("paginador").disabled=true;	
	}
}
function cerrarSesion(){
	document.getElementById("salir").value=1;
	enviar_informacion();
}
function cargar_idgrupo(id_grupo){
	document.getElementById("id_grupo").value=id_grupo;
}
function ReplaceContentInContainer(id,content){
	var container = document.getElementById(id);
	container.innerHTML = content;
}
//
//-----------------------------------------------------------------------------
// Funciones Ajax
//
// 
//
//-----------------------------------------------------------------------------
//

function nuevoAjax(){ 
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
	if(!xmlhttp && typeof XMLHttpRequest!='undefined'){ xmlhttp=new XMLHttpRequest(); } 
	return xmlhttp; 
}

function cargarElementoAjax(url, obj, area_carga, elemento_ajax){
	var valor=obj.options[obj.selectedIndex].value;
	elemento_ajax=nuevoAjax();
	var aleatorio=Math.random();
	elemento_ajax.open("GET", url+"?seleccionado="+valor+"&aleatorio="+aleatorio+"&id="+document.getElementById("campo_seleccion").value, true);
	elemento_ajax.onreadystatechange=function(){ 
		if(elemento_ajax.readyState==1){ document.getElementById(area_carga).innerHTML="Cargando..."; }
		if(elemento_ajax.readyState==4){ document.getElementById(area_carga).innerHTML=elemento_ajax.responseText; } 
	}
	elemento_ajax.send(null);
}

function cargarElementoAjaxUrl(url, area_carga, elemento_ajax){
	elemento_ajax=nuevoAjax();
	var aleatorio=Math.random();
	elemento_ajax.open("GET", url+"&aleatorio="+aleatorio, true);
	elemento_ajax.onreadystatechange=function(){ 
		if(elemento_ajax.readyState==1){
			// Mientras carga elimino la opcion "Selecciona la ciudad" y pongo una que dice "Cargando"
			document.getElementById(area_carga).innerHTML="Cargando...";	
		}
		if(elemento_ajax.readyState==4){ document.getElementById(area_carga).innerHTML=elemento_ajax.responseText; } 
	}
	elemento_ajax.send(null);
}

function cargarElementoAjaxValor(url, valor, area_carga, elemento_ajax){
	elemento_ajax=nuevoAjax();
	var aleatorio=Math.random();
	elemento_ajax.open("GET", url+"?seleccionado="+valor+"&aleatorio="+aleatorio, true);
	elemento_ajax.onreadystatechange=function(){ 
		if(elemento_ajax.readyState==1){ document.getElementById(area_carga).innerHTML="Cargando...";	}
		if(elemento_ajax.readyState==4){ document.getElementById(area_carga).innerHTML=elemento_ajax.responseText; } 
	}
	elemento_ajax.send(null);
}

function cargarElementoAjaxValorFG(url, valor, area_carga, elemento_ajax){
	elemento_ajax=nuevoAjax();
	var aleatorio=Math.random();
	elemento_ajax.open("GET", url+"?seleccionado="+valor+"&aleatorio="+aleatorio, true);
	elemento_ajax.onreadystatechange=function(){ 
		if(elemento_ajax.readyState==1){ document.getElementById(area_carga).innerHTML="Cargando...";	}
		if(elemento_ajax.readyState==4){ document.getElementById(area_carga).innerHTML=elemento_ajax.responseText; } 
	}
	elemento_ajax.send(null);
}