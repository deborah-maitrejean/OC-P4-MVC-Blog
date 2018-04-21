<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 21/04/2018
 * Time: 14:15
 */

namespace Blog\Model;

require_once("model/Manager.php");

class LoginManager extends Manager {
    public function getLogin(){
        $db = $this->dbconnect();
        $req = $db->prepare('SELECT * FROM logins WHERE email = ? AND password = ?');
        $req->execute(array($email, $password));
        $req = $req->fetch();

        return $req;
    }
}