<?php

namespace Blog\Model;

class Manager {
    
    private $host     = "localhost";
    private $dbname   = "blogjeanforteroche";
    private $login    = "root";
    private $password = "";
    
    protected function dbConnect() {
        $db = new \PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $login, $password);
        return $db;
    }
}
