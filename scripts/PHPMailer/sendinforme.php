<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

$Respuesta['Codigo'] = 1;

$footer = '<hr />
<p><strong><span style="margin: 0px; color: #000099; sans-serif;"><span style="font-size: medium;">CONSULTORIO DE PATOLOG&Iacute;A OSTEOARTICULAR Y DE TEJIDOS BLANDOS<br /></span></span></strong><strong><span style="margin: 0px; color: #000099; sans-serif;"><span style="font-size: medium;">PROF. DR. EDUARDO H&Eacute;CTOR SANTINI ARAUJO</span></span></strong></p>
<p style="margin: 0px; text-align: left;"><span style="margin: 0px; color: #000099;"><span style="font-family: Calibri; font-size: medium;">Av. Siempre Viva 2302 Piso 11&ordm; Of "1" Springfield</span></span></p>
<p style="margin: 0px; text-align: left;"><span style="margin: 0px; color: #000099;"><span style="font-family: Calibri; font-size: medium;">Horario: Lunes a Viernes de 9 a 17 hs</span></span></p>
<p style="margin: 0px; text-align: left;"><span style="margin: 0px; color: #000099;"><span style="font-family: Calibri; font-size: medium;">TEL/FAX: (011) 4444-4444 / 4966-1224</span></span></p>
<p style="margin: 0px; text-align: left;"><span style="margin: 0px; color: #000099;"><span style="font-family: Calibri; font-size: medium;">E-mail: </span><a target="_blank"><span style="font-family: Calibri; font-size: medium;">mailto@laboratorio.com.ar</span></a></span></p>
<p style="margin: 0px; text-align: left;"><span style="font-family: Calibri; font-size: medium;">&nbsp;</span></p>
<p style="margin: 0px; text-align: left;"><span style="font-family: Calibri; font-size: medium;">&nbsp;</span></p>
<p style="margin: 0px; text-align: left;"><strong><span style="margin: 0px; color: #000099; sans-serif;"><span style="font-size: medium;"><span style="margin: 0px; sans-serif; font-size: 11pt;">AVISO DE CONFIDENCIALIDAD: La informaci&oacute;n aqu&iacute; contenida y transmitida<br /> es CONFIDENCIAL y puede contener informaci&oacute;n amparada por el secreto<br /> profesional. Es para uso exclusivo del destinatario arriba indicado, y<br /> para su utilizaci&oacute;n espec&iacute;fica. Si usted no es el destinatario, sepa<br /> disculpar la molestia. Se le notifica por el presente que est&aacute;<br /> prohibida su revisi&oacute;n, retransmisi&oacute;n, difusi&oacute;n, y/o cualquier otro<br /> tipo de uso de la informaci&oacute;n contenida por personas extra&ntilde;as al<br /> destinatario original. Si Ud. ha recibido por error esta informaci&oacute;n,<br /> por favor contacte al remitente y elimine la informaci&oacute;n aqu&iacute;<br /> contenida de toda computadora donde resida.<br /> &nbsp;<br /> WARNING OF CONFIDENTIALITY: The information contained and transmitted<br /> here is CONFIDENTIAL and can contain information protected by the<br /> professional secret. It is for exclusive use of the addressee above<br /> indicated, and for his specific use. If you are not the addressee, we<br /> apologize for any inconvenience caused so far. It is hereby notified<br /> that it is prohibited to revise or broadcast or any other type of use<br /> of the information contained by people who are not the original<br /> addressee. If you have received this information by mistake, please<br /> contact the sender and eliminate the information contained here of all<br /> computers.&nbsp;&nbsp; </span></span></span></strong></p>';

require 'lib/PHPMailerAutoload.php';
$mail = new PHPMailer;

$mail->CharSet = 'UTF-8';

//Enable SMTP debugging. 
//$mail->SMTPDebug = 3;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "noreply@labo.com.ar";                 
$mail->Password = "pass";                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to 
$mail->Port = 587;                                   

$mail->From = "noreply@labo.com.ar";
$mail->FromName = "CONSULTORIO DE PATOLOGÍA OSTEOARTICULAR Y DE TEJIDOS BLANDOS";

$mail->isHTML(true);
$mail->Subject = "Informe anatomopatológico ($PacApellido, $PacNombre)";
$mail->AddAttachment($file, "Informe " . $PacApellido. ".pdf"); 

$long = count($destino);
for($i = 0; $i < $long; $i++) {
    $mail->addAddress($destino[$i]["correo"]);
    $medico = $destino[$i]["nombre"];
    $titulo = $destino[$i]["titulo"];

    $mail->Body = "$titulo $medico:<br>
        Se adjunta a este correo el informe anotomopatológico del paciente $PacApellido, $PacNombre. <br><br>
        Atentamente. <br>
        $footer";
    $mail->AltBody = "$titulo $medico: 
        Se adjunta a este correo el informe anotomopatológico del paciente $PacApellido, $PacNombre. 
        Atentamente.";


    if(!$mail->send()) {
        $Respuesta['Codigo'] = 10;
		$Respuesta['Mensaje'] = "Algunos mensajes no han sido enviados.";
    }

    $mail->ClearAllRecipients();

}


    
