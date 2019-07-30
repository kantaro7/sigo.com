<?php
function html_encode($text){
	$arreglo_letras_1=array("á"=> "Ã¡", "Á"=> "Ã", "é"=> "Ã©", "É"=> "Ã‰", "í"=> "Ã­", "Í"=> "Ã", "ó"=> "Ã³", "Ó"=> "Ã“", "ó"=> "¢", "ú"=> "Ãº", "Ú"=> "Ãš", "ñ"=> "Ã±", "Ñ"=> "Ã‘", "º"=> "Â°", "º"=> "Âº");
	$arreglo_letras_2=array("Á"=>"&Aacute;", "É"=>"&Eacute;", "Í"=>"&Iacute;","Ó"=>"&Oacute;", "Ú"=>"&Uacute;", "á"=>"&aacute;", "é"=>"&eacute;", "í"=>"&iacute;", "ó"=>"&oacute;", "ú"=>"&uacute;", "Ñ"=>"&Ntilde;", "ñ"=>"&ntilde;", "°"=>"&deg;", "º"=>"&deg;", "°"=>"&deg;", "ª"=>"&deg;", "'"=>"&acute;", '"'=>"&acute;", '¿'=>"&iquest;");
	$txt=$text;
	foreach ($arreglo_letras_1 as $key=> $val){
		$text= str_replace($val, $key, $text);
	}
	foreach ($arreglo_letras_2 as $key=> $val){
		$text= str_replace($key, $val, $text);
	}
//	echo("[$txt]==>  [$texto]<br>");
	return ($text);
}
function html_encode_sc($text){
	$arreglo_letras_1=array("á"=> "Ã¡", "Á"=> "Ã", "é"=> "Ã©", "É"=> "Ã‰", "í"=> "Ã­", "Í"=> "Ã", "ó"=> "Ã³", "Ó"=> "Ã“", "ó"=> "¢", "ú"=> "Ãº", "Ú"=> "Ãš", "ñ"=> "Ã±", "Ñ"=> "Ã‘", "°"=> "Â°", "°"=> "Âº");
	$arreglo_letras_2=array("Á"=>"&Aacute;", "É"=>"&Eacute;", "Í"=>"&Iacute;","Ó"=>"&Oacute;", "Ú"=>"&Uacute;", "á"=>"&aacute;", "é"=>"&eacute;", "í"=>"&iacute;", "ó"=>"&oacute;", "ú"=>"&uacute;", "Ñ"=>"&Ntilde;", "ñ"=>"&ntilde;", "°"=>"&deg;", "º"=>"&deg;", "ª"=>"&deg;", '¿'=>"&iquest;");
	$txt=$text;
	foreach ($arreglo_letras_1 as $key=> $val){
		$text= str_replace($val, $key, $text);
	}
	foreach ($arreglo_letras_2 as $key=> $val){
		$text= str_replace($key, $val, $text);
	}
//	echo("[$txt]==>  [$texto]<br>");
	return ($text);
}
function html_encode_loc($text){
	$letters_array_0=array("À"=> "Á", "È"=> "É", "Ì"=> "Í", "Ò"=> "Ó", "Ù"=> "Ú");
	$txt=$text;
	foreach($letters_array_0 as $key=> $val){
		$text=str_replace($key, $val, $text);
	}
	return ($text);
}
function html_encode_prnt($text){
	$letters_array=array("Á"=>"&Aacute;", "É"=>"&Eacute;", "Í"=>"&Iacute;","Ó"=>"&Oacute;", "Ú"=>"&Uacute;", "á"=>"&aacute;", "é"=>"&eacute;", "í"=>"&iacute;", "ó"=>"&oacute;", "ú"=>"&uacute;", "Ñ"=>"&Ntilde;", "ñ"=>"&ntilde;", "º"=>"&deg;", "°"=>"&deg;", '¿'=>"&iquest;");
	foreach ($letters_array as $key=> $val){
		$text= str_replace($val, $key, $text);
	}
	return ($text);
}
function strtolower_es($text){
	$arreglo_letras=array("Á"=> "á", "É"=> "é", "Í"=> "í", "Ó"=> "ó", "Ú"=> "ú", "Ü"=> "ü", "Ñ"=> "ñ");
	$text=strtolower($texto);
	foreach ($arreglo_letras as $key=> $val){
		$text= str_replace($key, $val, $text);
	}
	return ($text);
}
function dateadd($date, $dd=0, $mm=0, $yy=0, $hh=0, $mn=0, $ss=0){
	$date_r=getdate(strtotime($date));
	$date_result=date("Y-m-d", mktime(($date_r["hours"]+$hh),($date_r["minutes"]+$mn),($date_r["seconds"]+$ss),($date_r["mon"]+$mm),($date_r["mday"]+$dd),($date_r["year"]+$yy)));
	return $date_result;
}
function dateDiff($dformat, $endDate, $beginDate){
	$date_parts1=explode($dformat, $beginDate);
	$date_parts2=explode($dformat, $endDate);
	$start_date=gregoriantojd($date_parts1[0], $date_parts1[1], $date_parts1[2]);
	$end_date=gregoriantojd($date_parts2[0], $date_parts2[1], $date_parts2[2]);
	return $end_date - $start_date;
}

function timeDiff($firstTime,$lastTime){
	$firstTime=strtotime($firstTime);
	$lastTime=strtotime($lastTime);
	$timeDiff=$lastTime-$firstTime;
	return $timeDiff;
}
function get_time_difference( $start, $end ){
	$uts['start']      =    strtotime( $start );
	$uts['end']        =    strtotime( $end );
	if( $uts['start']!==-1 && $uts['end']!==-1 ){
		if( $uts['end'] >= $uts['start'] ){
			$diff    =    $uts['end'] - $uts['start'];
			if( $days=intval((floor($diff/86400))) )
				$diff = $diff % 86400;
			if( $hours=intval((floor($diff/3600))) )
				$diff = $diff % 3600;
			if( $minutes=intval((floor($diff/60))) )
				$diff = $diff % 60;
			$diff    =    intval( $diff );            
			return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );
		} else {
			trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );
		}
	} else {
		trigger_error( "Invalid date/time data detected", E_USER_WARNING );
	}
	return( false );
}
function enviar_correo($mail_host, $mail_user, $mail_pass, $mail_from, $mail_from_name, $mail_addr, $mail_subj, $mail_body, $mail_body_alt){
	require_once("../../php_mailer/class.phpmailer.php");
	$mail=new phpmailer();
	$mail->PluginDir="../../php_mailer/";
	$mail->Mailer="smtp";
	$mail->Host=$mail_host;
	$mail->SMTPAuth=true;
	$mail->Username=$mail_user; 
	$mail->Password=$mail_pass;
	$mail->From=$mail_from;
	$mail->FromName=$mail_from_name;
	$mail->Timeout=60;
	foreach($mail_addr as $key=>$addrs){
		$mail->AddAddress($addrs);
	}
	$mail->Subject=$mail_subj;
	$mail->Body=$mail_body;
	$mail->AltBody=$mail_body_alt;
	$exito=$mail->Send();
	$intentos=1; 
	while ((!$exito)&&($intentos<5)){
		sleep(5);
		$exito=$mail->Send();
		$intentos=$intentos+1;	
	}
	if(!$exito){
		echo "Problemas enviando correo electrónico a ".$valor;
		echo "<br/>".$mail->ErrorInfo;	
	} else {
//		echo "Mensaje enviado correctamente";
	}
}

//Preparar valor $_post de un checkbox para actualizar
function prprr_chckbox($valor){
	global $vlr_chkbx_si, $vlr_bd_no;
	if($valor==$vlr_chkbx_si){
		return $vlr_bd_si;
	} else {
		return $vlr_bd_no;
	}
}

?>
