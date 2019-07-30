// JavaScript Document

// Entry-Time

	var whitespace = " \t\n\r";

	function frmt_nmbr_int(e){
		tecla_codigo=(document.all) ? e.keyCode : e.which;
		if(tecla_codigo==8||tecla_codigo==0||tecla_codigo==13) return true;
		patron=/[0-9]/;
		tecla_valor = String.fromCharCode(tecla_codigo);
		return patron.test(tecla_valor);
	}
	
	function frmt_nmbr_int_neg(e){
		tecla_codigo=(document.all) ? e.keyCode : e.which;
		if(tecla_codigo==8||tecla_codigo==0||tecla_codigo==13) return true;
		patron=/[0-9-]/;
		tecla_valor = String.fromCharCode(tecla_codigo);
		return patron.test(tecla_valor);
	}
	
	function frmt_nmbr_dec(e){
		tecla_codigo = (document.all) ? e.keyCode : e.which;
		if(tecla_codigo==8||tecla_codigo==0||tecla_codigo==13) return true;
		patron=/[0-9,]/;
		tecla_valor = String.fromCharCode(tecla_codigo);
		return patron.test(tecla_valor);
	}
	
	function frmt_nmbr_dec_neg(e){
		tecla_codigo = (document.all) ? e.keyCode : e.which;
		if(tecla_codigo==8||tecla_codigo==0||tecla_codigo==13) return true;
		patron=/[0-9,-]/;
		tecla_valor = String.fromCharCode(tecla_codigo);
		return patron.test(tecla_valor);
	}
	
	function frmt_date(e){
		tecla_codigo = (document.all) ? e.keyCode : e.which;
		if(tecla_codigo==8||tecla_codigo==0||tecla_codigo==13) return true;
		patron=/[0-9/]/;
		tecla_valor = String.fromCharCode(tecla_codigo);
		return patron.test(tecla_valor);
	}
	
	function frmt_time(e){
		tecla_codigo = (document.all) ? e.keyCode : e.which;
		if(tecla_codigo==8||tecla_codigo==0||tecla_codigo==13) return true;
		patron=/[0-9:]/;
		tecla_valor = String.fromCharCode(tecla_codigo);
		return patron.test(tecla_valor);
	}
	
	function frmt_phone(e){
		tecla_codigo = (document.all) ? e.keyCode : e.which;
		if(tecla_codigo==8||tecla_codigo==0||tecla_codigo==13) return true;
		patron=/[0-9 .()-+]/;
		tecla_valor = String.fromCharCode(tecla_codigo);
		return patron.test(tecla_valor);
	}
	
	function frmt_login(e){
		tecla_codigo = (document.all) ? e.keyCode : e.which;
		if(tecla_codigo==8||tecla_codigo==0||tecla_codigo==13) return true;
		patron=/[a-zA-Z0-9\xE1\xE9\xED\xF3\xFA\xF1\xC1\xC9\xCD\xD3\xDA\xD1\s.,_\-#\@]/;
		tecla_valor = String.fromCharCode(tecla_codigo);
		return patron.test(tecla_valor);
	}
	
	function frmt_alpha(e){
		tecla_codigo = (document.all) ? e.keyCode : e.which;
		if(tecla_codigo==8||tecla_codigo==0||tecla_codigo==13) return true;
		patron=/[a-zA-Z0-9 \xE1\xE9\xED\xF3\xFA\xF1\xC1\xC9\xCD\xD3\xDA\xD1\xBF\xA1\s.,:;_¿?¡!"'\-#\@\/%\(\)]/;
		tecla_valor = String.fromCharCode(tecla_codigo);
		return patron.test(tecla_valor);
	}
	
	function frmt_alpha_betic(e){
		tecla_codigo = (document.all) ? e.keyCode : e.which;
		if(tecla_codigo==8||tecla_codigo==0||tecla_codigo==13) return true;
		patron=/^[a-z \xE1\xE9\xED\xF3\xFA\xF1]+$/i;
		tecla_valor = String.fromCharCode(tecla_codigo);
		return patron.test(tecla_valor);
	}	
	
	function frmt_email(e){
		tecla_codigo = (document.all) ? e.keyCode : e.which;
		if(tecla_codigo==8||tecla_codigo==0||tecla_codigo==13) return true;
		patron=/[a-zA-Z0-9\s.@_\-]/;
		tecla_valor = String.fromCharCode(tecla_codigo);
		return patron.test(tecla_valor);
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

	function isEmpty(s){
		return ((s == null) || (s.length == 0))
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
