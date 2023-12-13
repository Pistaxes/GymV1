<?php

namespace Classes;
use mail\mail\mail;
use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email,$nombre,$token,){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->Host = $_ENV['EMAIL_HOST'];
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Port = $_ENV['EMAIL_PORT'];
    $mail->Username = $_ENV['EMAIL_USER'];
    $mail->Password = $_ENV['EMAIL_PASS'];

    // Configuración del remitente y destinatario
    $mail->From="sceii.itcelaya@gmail.com";
    $mail->addAddress($this->email);
        $mail -> Subject = 'Confirma tu cuenta';
        $mail->isHTML(TRUE);
        $mail->CharSet= 'UTF-8';

        $contenido= "<html>";
        $contenido .= "<p><strong> Hola" . $this->nombre . "</strong> Has creado tu cuenta en Integra, ahora solo debes confirmar
        presionando el siguiente enlace</p>";
        $contenido .= "<p> Presiona aqui: <a href='".$_ENV['APP_URL']."/confirmar-cuenta?token=".$this->token."'> Confirmar cuenta </a></p>";
        $contenido .= "<p> Si tu no solicitaste esta cuenta, puedes ignorar el mensaje </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar Email

        $mail->send();

        
    }

    public function enviarInstrucciones(){
        $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->Host = $_ENV['EMAIL_HOST'];
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Port = $_ENV['EMAIL_PORT'];
    $mail->Username = $_ENV['EMAIL_USER'];
    $mail->Password = $_ENV['EMAIL_PASS'];

    // Configuración del remitente y destinatario
    $mail->From="sceii.itcelaya@gmail.com";
    $mail->addAddress($this->email);
        $mail -> Subject = 'Restablece tu password';
        $mail->isHTML(TRUE);
        $mail->CharSet= 'UTF-8';

        $contenido= "<html>";
        $contenido .= "<p><strong> Hola" . $this->nombre . "</strong> Has solicitado restablecer tu password</p>";
        $contenido .= "<p> Presiona aqui: <a href='".$_ENV['APP_URL']."/recuperar?token=".$this->token.' '."'> Restablecer contraseña </a></p>";
        $contenido .= "<p> Si tu no solicitaste esta cuenta, puedes ignorar el mensaje </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar Email

        $mail->send();
    }
}