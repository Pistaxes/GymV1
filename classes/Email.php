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
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '8b3dc27e729d47';
        $mail->Password = '756fcbf05723cf';

        $mail->setFrom('cuentas@integra.com');
        $mail->addAddress('cuentas@integra.com','Integra.com');
        $mail -> Subject = 'Confirma tu cuenta';
        $mail->isHTML(TRUE);
        $mail->CharSet= 'UTF-8';

        $contenido= "<html>";
        $contenido .= "<p><strong> Hola" . $this->nombre . "</strong> Has creado tu cuenta en Integra, ahora solo debes confirmar
        presionando el siguiente enlace</p>";
        $contenido .= "<p> Presiona aqui: <a href='http://localhost:3000/confirmar-cuenta?token=".$this->token."'> Confirmar cuenta </a></p>";
        $contenido .= "<p> Si tu no solicitaste esta cuenta, puedes ignorar el mensaje </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar Email

        $mail->send();

        
    }

    public function enviarInstrucciones(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '8b3dc27e729d47';
        $mail->Password = '756fcbf05723cf';

        $mail->setFrom('cuentas@integra.com');
        $mail->addAddress('cuentas@integra.com','Integra.com');
        $mail -> Subject = 'Restablece tu password';
        $mail->isHTML(TRUE);
        $mail->CharSet= 'UTF-8';

        $contenido= "<html>";
        $contenido .= "<p><strong> Hola" . $this->nombre . "</strong> Has solicitado restablecer tu password</p>";
        $contenido .= "<p> Presiona aqui: <a href='http://localhost:3000/recuperar?token=".$this->token.' '."'> Restablecer contraseña </a></p>";
        $contenido .= "<p> Si tu no solicitaste esta cuenta, puedes ignorar el mensaje </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar Email

        $mail->send();
    }
}