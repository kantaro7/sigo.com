<?php
if($_POST["prcs"]=="S"){
	$tprcs=$_POST["tprcs"];

	$nombre_visit=$_POST["nombre_$tprcs"];
	$email_visit=$_POST["correo_$tprcs"];

	$email_recep=$email_addr[$tprcs];


	//Establecer información específica de cada tipo de correo
	switch ($tprcs) {
		case 'emplea':
			//Correo de Interesado en Empléate
			$msj1=",<br>y manifestar su interés en laborar en nuestra Organización";
			$msj2=".<br>$nombre_visit ha manifestado interés laborar en nuestra Organización";

			$sexo="Indefinido";
			if(isset($_POST["sexo_f"])) $sexo="Femenino";
			if(isset($_POST["sexo_m"])) $sexo="Masculino";
			break;
		case 'contac':
			//Correo de Ineresado en Contacto
			$msj1="";
			$msj2="";
			break;
	}

  $msg="";
  
	//Enviar correos
	include_once("admin/phpmailer/class.phpmailer.php");
	
	$mail = new PHPMailer(true); 					// the true param means it will throw exceptions on errors, which we need to catch
	
	$mail->CharSet = 'UTF-8';							// Allowing latin characters
	$mail->Encoding = "base64";

	$mail->IsSendmail();									//$mail->IsSMTP();
	$mail->IsHTML(true);									// telling the class the body is html-formatted
	$mail->SMTPAuth = true;								// telling the class that authrntication is needed
	$mail->SMTPSecure = "tls";						// telling the class the authentication type
	$mail->Port = 465;										// set the SMTP port
	$mail->Host = $email_host;						// SMTP host server
	$mail->Username = $email_user;				// SMTP user name
	$mail->Password = $email_pass;				// SMTP password

	
	//	Email for the visitor
	//
	try {
		$mail->SetFrom($email_user, 'Sigo - Contacto');
		$mail->AddAddress($email_visit, $nombre_visit);
		$mail->Subject = $nombre_visit.', gracias por comunicarse con Sigo';

		$body  = '<!DOCTYPE html>';
		$body  .= '<html lang="en">';
		$body  .= '<head>';
		$body  .= '<meta charset="UTF-8">';
		$body  .= '<title>Document</title>';
		$body  .= '<style>';
		$body  .= '@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,600);';
		$body  .= 'body{ font-family: "Open Sans", sans-serif; }';
		$body  .= '</style>';
		$body  .= '</head>';
		$body  .= '<body>';
		$body  .= '<div class="center">';
		$body  .= '<img src="'.$apl_root.'img/logo_login.png" style="margin-left:40%;margin-bottom:20px;" alt="">';
		$body  .= '<h3 style="text-align:center">'.html_encode($nombre_visit).', gracias por comunicarse con Sigo'.html_encode($msj1).'.</h3>';
		$body  .= '<p style="text-align:center">Hemos recibido satisfactorimente su información.<br>Nuestro personal se pondrá en contacto con usted a la brevedad posible.</p><h4 style="text-align:center">Atentamente,</h4><p style="text-align:center">Sigo.</p><p style="text-align:center; color:#4f4f4f; font-size:12px">¿Necesita ayuda? Contáctenos por contacto@sigo.com <br>© 2015-2016 sigo. Todos los derechos reservados.';
		$body  .= '</p>';
		$body  .= '</div>';
		$body  .= '</body>';
		$body  .= '</html>';

		$mail->Body = $body; 							// Cuerpo del mensaje.

		$mail->Send();										// Enviar el Correo
	} catch (phpmailerException $e){
		$msg.="Email 1: Problemas con el correo electrónico suministrado. ";
	} catch (Exception $e){
		$msg.="Email 1: Problemas al tratar de enviar el correo (".$e->getMessage()."). ";
	}


	//	Email for Sigo
	//
	try {
		$mail->SetFrom($email_user, 'Sigo - Contacto');
		$mail->ClearAllRecipients( );
		$mail->AddAddress($email_addr["conta"], 'Sigo - página web');
		$mail->Subject = "Contacto Página Web (".$nombre_visit.')';

		$body  = '<!DOCTYPE html>';
		$body  .= '<html lang="en">';
		$body  .= '<head>';
		$body  .= '<meta charset="UTF-8">';
		$body  .= '<title>Document</title>';
		$body  .= '<style>';
		$body  .= '@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,600);';
		$body  .= 'body{ font-family: "Open Sans", sans-serif; }';
		$body  .= '</style>';
		$body  .= '</head>';
		$body  .= '<body>';
		$body  .= '<div class="center">';
		$body  .= '<img src="'.$apl_root.'img/logo_login.png" style="margin-left:37%;margin-bottom:20px;" alt="">';
		$body  .= '<h3 style="text-align:center">Hemos recibido el siguiente mensaje de la sección de Contacto de la página web'.html_encode($msj2).'.</h3>';

													$body  .= '<h4 style="text-align:left;margin-left:10px;margin-top: 15px;">Nombre: <b> '.html_encode($nombre_visit).'</b></h4>';
													$body  .= '<h4 style="text-align:left;margin-left:10px;margin-top: 15px;">Correo: <b> '.$email_visit.'</b></h4>';
		if($tprcs=="emplea") 	$body  .= '<h4 style="text-align:left;margin-left:10px;margin-top: 15px;">Sexo:<b> '.html_encode($sexo).'</b></h4>';
		if($tprcs=="emplea") 	$body  .= '<h4 style="text-align:left;margin-left:10px;margin-top: 15px;">Fecha Nacimiento:<b> '.html_encode($_POST["fecha_emplea"]).'</b></h4>';
		if($tprcs=="contac") 	$body  .= '<h4 style="text-align:left;margin-left:10px;margin-top: 15px;">Mensaje:<b> '.html_encode($_POST["mensaje"]).'</b></h4>';
													$body  .= '<h4 style="text-align:left;margin-left:10px;margin-top: 25px;"><b>Se adjunta C.V.</b></h4>';

		$body  .= '<p style="text-align:center;margin-top: 30px;">© 2015-2016 Sigo. Todos los derechos reservados.';
		$body  .= '</p>';
		$body  .= '</div>';
		$body  .= '</body>';
		$body  .= '</html>';

		//Cuerpo del mensaje
		$mail->Body = $body;

		//Se incluye archivo Adjunto
		if (isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] == UPLOAD_ERR_OK) {
    	$mail->AddAttachment($_FILES['cv_file']['tmp_name'], $_FILES['cv_file']['name']);
		}

		//Enviar el Correo
		$mail->Send();
	} catch (phpmailerException $e){
		$msg.="Email 2: Problemas con el correo electrónico. ";
	} catch (Exception $e){
		$msg.="Email 2: Problemas al tratar de enviarnos el correo (".$e->getMessage()."). ";
	}
	

	if($msg!=""){
		$_POST["prcs"]="";
		$_SESSION["email_error"]=$msg;
		?>
		<script language="JavaScript">
			//alert("Debe verificar las siguientes condiciones:\n\n<?php echo(html_encode($msg)); ?>");
		</script>
		<?php
	} else {
		$_SESSION["email_error"]="OK";
		$_POST = array();
	}

}
//echo("msg [ ".$msg." ] <br>");
?>