<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                      //poner 2 aca es como poner un var dump, sino pongan 0 y no muestra nada
    
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //aca va el host, averiguar en google cual es dependiendo del @ del email
    $mail->SMTPAuth   = true;                                   //no toquen nada aca
    $mail->Username   = '@gmail.com';                     // aca ponemos nuestro mail para enviar mails
    $mail->Password   = 'qplzwwhaujptmsrn';                               //si usamos gmail, habilitar autenticacion en dos pasos y crear una clave para la app, todo en seguridad y privacidad de gmail esta
    $mail->SMTPSecure = 'ssl';            //si la pagina tiene un candadito, ssl, si no lo tiene, tsl
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('brunopruzsi@gmail.com', 'Caninos Ya');
    $mail->addAddress('CaninosYa@outlook.com','XD' );     // aca pondriamos el owner gmail y el owner name, o username
               //Name is optional
  


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Aca iria el asunto de reserva';
    $mail->Body    = 'Aca pondria el cupon de reserva'; //esto es html asi que podemos agregar imagenes y pavaditas si llegamos con el tiempo
    
    $mail->send();
    echo 'mensaje enviado!';  
} catch (Exception $e) {
    echo "error al enviar. Mailer Error: {$mail->ErrorInfo}";
}