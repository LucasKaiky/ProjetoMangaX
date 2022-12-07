<?php

/* 
Endereço do servidor SMTP do Gmail: smtp.gmail.com
Nome Gmail SMTP: Seu nome completo
Gmail SMTP username: email@gmail.com
Senha Gmail SMTP: senha
Porta Gmail SMTP (TLS): 587
Porta Gmail SMTP (SSL): 465
*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function enviar_email($destinatario, $assunto, $mensagemHTML)
{
    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output   SMTP::DEBUG_SERVER para mostrar -- 0 para não mostrar
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'projetophpunipe@gmail.com';                     //SMTP username
        $mail->Password   = 'ewkhprsfkpbiwthy';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Destinatario
        $mail->setFrom('projetophpunipe@gmail.com', 'MangaXpress');
        $mail->addAddress($destinatario);     //Add email do destinatario

        //Conteudo
        $mail->CharSet="UTF-8";
        $mail->isHTML(true);       //Set email format to HTML
        $mail->Subject = $assunto; //Titulo do email
        $mail->Body    = $mensagemHTML; //Corpo do email

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
