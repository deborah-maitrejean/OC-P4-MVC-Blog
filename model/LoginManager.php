<?php

namespace Model;

require_once("model/Manager.php");

class LoginManager extends Manager {
    public function getLogin($email, $passHach){
        $db = $this->dbconnect();
        $req = $db->prepare('SELECT * FROM logins WHERE email = ? AND password = ?');
        $req->execute(array($email, $passHach));
        $req = $req->fetch();

        return $req;
    }
}