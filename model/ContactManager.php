<?php


namespace model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

class ContactManager {
    public function sendMail($lastName, $firstName, $tel, $email, $subject, $message){
        $to = "forterochej@gmail.com";
        $from = "From: ".$lastName." ".$firstName."<".$email."> \nMime-Version:\n";
        $from .= " 1.0\nContent-Type: text/html; charset=UTF-8\n";
        $header = $subject;

        $messageMail =
            "Formulaire de contact : <br/>
            Nom : $lastName <br/>
			Prenom : $firstName <br/>
			Email : $email <br/>
			Tel : $tel <br/>
			Objet : $subject <br/>

			----------- Message ----------- <br/>
			". $message ." <br/>
			-------------------------------";

        mail($to, $header, $messageMail, $from);
        if (mail($to, $header, $messageMail, $from)){
            session_destroy();
        }
    }
}