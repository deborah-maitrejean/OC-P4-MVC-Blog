<?php

namespace Controller;

use \Model\LoginManager;


/**
 * Class Login
 * @package Controller
 */
class Login
{
    public function loginControl()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password'])) {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
                    // hachage du mot de passe
                    $passHach = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    // vérification des identifiants
                    $loginManager = new LoginManager();
                    $login = $loginManager->getLogin($_POST['email']);
                    $psword = $login->getPassword();

                    if ($login !== null && password_verify($_POST['password'], $psword)) {
                        // l'identification a réussi
                        $_SESSION['time'] = time();
                        $_SESSION['email'] = $login->getEmail();
                        $_SESSION['password'] = $login->getPassword();
                        $_SESSION['name'] = substr($login->getEmail(), 0, 11);
                        $_SESSION['connected'] = true;
                        session_write_close();

                        header('location: index.php?action=adminHomeView');
                    } else {
                        $_SESSION['message'] = 'Mauvais identifiants de connexion.';
                        header('location: index.php?action=adminConnexion');
                    }
                } else {
                    $_SESSION['message'] = 'Le format de l\'adresse email est incorrect.';
                    header('location: index.php?action=adminConnexion');
                }
            } else {
                $_SESSION['message'] = 'Tous les champs ne sont pas remplis.';
                header('location: index.php?action=adminConnexion');
            }
        } else {
            $_SESSION['message'] = 'Une erreur est survenue.';
            header('location: index.php?action=adminConnexion');
        }
    }

    public function logOut()
    {
        if (session_start()) {
            session_destroy();
            header('location: index.php?action=home');
        }
    }

    public function changeLogin()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['newEmail']) && isset($_POST['newEmailVerif'])) {
            if (!empty($_POST['email']) && !empty($_POST['newEmail']) && !empty($_POST['newEmailVerif'])) {
                $loginManager = new LoginManager();
                $login = $loginManager->checkLogin($_POST['email']);
                $email = $login->getEmail();
                if ($email != null && $email == $_POST['email']) {
                    if ($_POST['newEmail'] == $_POST['newEmailVerif']) {
                        $emailPattern = "#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#";
                        if (preg_match($emailPattern, $_POST['newEmail'])) {
                            if ($email <= 255 && $_POST['newEmail'] <= 255) {
                                $newEmail = $_POST['newEmail'];
                                $loginManager->updateLogin($newEmail, $email);
                                $_SESSION['message'] = 'L\'identifiant a été mis à jour.';
                            } else {
                                $_SESSION['message'] = 'L\'adresse email ne doit pas dépasser 255 caractères.';
                            }
                        } else {
                            $_SESSION['message'] = 'Le format de l\'adresse email est invalide.';
                        }
                    } else {
                        $_SESSION['message'] = 'Les nouveaux identifiants saisis ne sont pas identiques.';
                    }
                } else {
                    $_SESSION['message'] = 'L\'identifiant n\'est pas reconnu.';
                }
            } else {
                $_SESSION['message'] = 'Tous les champs ne sont pas remplis.';
            }
        } else {
            $_SESSION['message'] = 'Une erreur est survenue.';
        }
        header('location: index.php?action=settings');
    }

    public function changePassword()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['newPassword']) && isset($_POST['newPasswordVerif'])) {
            if (!empty($_POST['email']) && !empty($_POST['newPassword']) && !empty($_POST['newPasswordVerif'])) {
                if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
                    if ($_POST['newPassword'] == $_POST['newPasswordVerif']) {
                        if ($_POST['email'] <= 255 && $_POST['newPassword'] <= 255) {
                            $loginManager = new LoginManager();
                            $pass = $loginManager->getPass($_POST['email']);
                            $psword = $pass->getPassword();

                            // hachage du nouveau mot de passe
                            $newPassHash = password_hash($_POST['newPassword'], PASSWORD_BCRYPT);
                            if (password_verify($_POST['newPassword'], $newPassHash)) {
                                $loginManager->updatePassword($newPassHash, $_POST['email']);
                                $_SESSION['message'] = 'Le mot de passe a été mis à jour.';
                            }
                        } else {
                            $_SESSION['message'] = 'Le mot de passe ne doit pas pas dépasser 255 caractères.';
                        }
                    } else {
                        $_SESSION['message'] = 'Les nouveaux mots de passe saisis ne sont pas identiques.';
                    }
                } else {
                    $_SESSION['message'] = 'L\'adresse email de connexion n\'est pas au bon format.';
                }
            } else {
                $_SESSION['message'] = 'Tous les champs ne sont pas remplis.';
            }
        } else {
            $_SESSION['message'] = 'Une erreur est survenue.';
        }
        header('location: index.php?action=settings');
    }
}