<?php

namespace Model;

use Entity\Logins;


/**
 * Class LoginManager
 * @package Model
 */
class LoginManager extends Manager
{
    /**
     * @param $email
     * @return Logins
     */
    public function getLogin($email)
    {
        $db = $this->dbconnect();
        $req = $db->prepare('SELECT * FROM logins WHERE email = ?');
        $req->execute(array($email));
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        if ($data !== false) {
            $login = new Logins();
            $login->hydrate($data);

            return $login;
        }
    }

    /**
     * @param $email
     * @return bool|Logins
     */
    public function checkLogin($email)
    {
        $db = $this->dbconnect();
        $req = $db->prepare('SELECT email FROM logins WHERE email = ?');
        $login = $req->execute(array($email));

        $data = $req->fetch(\PDO::FETCH_ASSOC);

        $login = new Logins();
        $login->hydrate($data);

        return $login;
    }

    /**
     * @param $newEmail
     * @param $email
     * @return bool
     */
    public function updateLogin($newEmail, $email)
    {
        $db = $this->dbconnect();
        $req = $db->prepare('UPDATE logins SET email = ? WHERE email = ?');
        $updatedLogin = $req->execute(array($newEmail, $email));

        return $updatedLogin;
    }

    /**
     * @param $newPassword
     * @param $email
     * @return bool
     */
    public function updatePassword($newPassword, $email)
    {
        $db = $this->dbconnect();
        $req = $db->prepare('UPDATE logins SET password = ? WHERE email = ?');
        $updatedPassword = $req->execute(array($newPassword, $email));

        return $updatedPassword;
    }

    /**
     * @param $email
     * @return Logins
     */
    public function getPass($email)
    {
        $db = $this->dbconnect();
        $req = $db->prepare('SELECT password FROM logins WHERE email = ?');
        $req->execute(array($email));
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        if ($data !== false) {
            $pass = new Logins();
            $pass->hydrate($data);

            return $pass;
        }
    }
}