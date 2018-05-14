<?php

namespace Controller;

use \Model\ContactManager;

/**
 * Class Contact
 * @package controller
 */
class Contact
{
    /**
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function sendMail()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        /*if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
            $response = $_POST['g-recaptcha-response'];
            $secretKey = 'YOURSECRETKEY';
            $remoteIp = $_SERVER['REMOTE_ADDR'];
            $apiUrl = 'https://www.google.com/recaptcha/api/siteverify?secret='
                . $secretKey
                . "&response=" . $response
                . "&remoteip=" . $remoteIp ;

            $decode = json_decode(file_get_contents($apiUrl),true);
            if($decode['success'] == true) { */
        if (isset($_POST['submit']) && isset($_POST['lastName']) && isset($_POST['firstName']) && isset($_POST['tel']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
            if (!empty($_POST['lastName']) && !empty($_POST['firstName']) && !empty($_POST['tel']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])) {
                if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
                    if (strlen($_POST['email']) <= 255) {
                        if (preg_match("#^0[1-9]([-. ]?[0-9]{2}){4}$#", $_POST['tel'])) {
                            $_SESSION['message'] = 'Votre message nous a bien été transmis.';
                            $contactManager = new ContactManager();
                            $contactManager->sendMail(
                                htmlspecialchars($_POST['lastName']),
                                htmlspecialchars($_POST['firstName']),
                                htmlspecialchars(trim($_POST['tel'])),
                                htmlspecialchars($_POST['email']),
                                htmlspecialchars($_POST['subject']),
                                htmlspecialchars($_POST['message'])
                            );
                            if ($contactManager){
                                $_SESSION['message'] = 'Votre message nous a bien été transmis.';
                            } else {
                                $_SESSION['message'] = 'Une erreur est survenue.';
                            }
                        } else {
                            $_SESSION['message'] = 'Le numéro de téléphone n\'est pas au bon format.';
                        }
                    } else {
                        $_SESSION['message'] = 'L\'adresse email saisie dépasse la longueur autorisée.';
                    }
                } else {
                    $_SESSION['message'] = 'L\'adresse email n\'est pas au bon format.';
                }
            } else {
                $_SESSION['message'] = 'Tous les champs ne sont pas renseignés.';
            }
        } else {
            $_SESSION['message'] = 'Une erreur est survenue.';
        } /*
            } else {
                $_SESSION['message'] = 'Vous êtes un spammer, impossible d\'envoyer le formulaire.';
            }
        } else {
            $_SESSION['message'] = 'Merci de compléter le captcha.';
        }*/
        header('Location: index.php?action=contact');
    }
}