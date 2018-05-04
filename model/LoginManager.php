<?php

namespace Model;

use Entity\Logins;

require_once("model/Manager.php");

class LoginManager extends Manager {
    public function getLogin($email, $passHach){
        $db = $this->dbconnect();
        $req = $db->prepare('SELECT * FROM logins WHERE email = ? AND password = ?');
        $req->execute(array($email, $passHach));
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        if ($data !== false){
            $login = new Logins();
            $login->hydrate($data);

            return $login;
        }
    }
    public function checkLogin($email){
        $db = $this->dbconnect();
        $req = $db->prepare('SELECT email FROM logins WHERE email = ?');
        $login = $req->execute(array($email));

        $data = $req->fetch(\PDO::FETCH_ASSOC);

        $login = new Logins();
        $login->hydrate($data);

        return $login;
    }
    public function updateLogin($newEmail, $email){
        $db = $this->dbconnect();
        $req = $db->prepare('UPDATE logins SET email = ? WHERE email = ?');
        $updatedLogin = $req->execute(array($newEmail, $email));

        return $updatedLogin;
    }
    public function checkPassword($password){
        $db = $this->dbconnect();
        $req = $db->prepare("SELECT password FROM logins WHERE password = ?");
        $pass = $req->execute(array($password));

        $data = $req->fetch(\PDO::FETCH_ASSOC);

        $pass = new Logins();
        $pass->hydrate($data);

        return $pass;
    }
    public function updatePassword($newPassword, $password){
        $db = $this->dbconnect();
        $req = $db->prepare('UPDATE logins SET password = ? WHERE password = ?');
        $updatedPassword = $req->execute(array($newPassword, $password));

        return $updatedPassword;
    }
}