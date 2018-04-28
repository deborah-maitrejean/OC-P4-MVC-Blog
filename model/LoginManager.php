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

        $login = new Logins();
        $login->hydrate($data);

        return $login;
    }
}