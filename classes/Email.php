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

        $mail->setFrom('xfitgym@xgymfit.com');
        $mail->addAddress('xfitgym@gymfit','xFitGym.com');
        $mail->Subject= 'Confirma tu cuenta';


        $mail->isHTML(true);
        $mail->CharSet='UTF-8';
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola".$this->nombre."</strong> Has creado tu cuenta en X GYM FIT solo debes confirmar presionando el siguiente enlace</p>";
        $contenido .= "<p> Presiona aqui: <a href='http://localhost:3000/confirmar-cuenta?token=". $this->token."'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p> Si tu no solicitaste nada ignora este mensaje</p>";
        $contenido .= "</html>";

        $mail ->Body = $contenido;

        $mail ->send();

        
    }
}