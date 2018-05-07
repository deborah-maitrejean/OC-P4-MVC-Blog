<?php

namespace Model;

/**
 * Class Manager
 * @package Model
 */
class Manager
{
    private $host = "localhost";
    private $dbname = "blogjeanforteroche";
    private $login = "root";
    private $password = "";

    /**
     * @return \PDO
     */
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8', $this->login, $this->password);
        return $db;
    }
}
