<?php
/*
 * Class Router
 * create routes and find controller
 */

include_once('controller/Frontend.php');
include_once('controller/Backend.php');

class Router {
    private $request;
    private $routes = [ // tableau qui récupère toutes les routes, il fait un lien entre ce qu'on demande, et un autre tbealu qui intègre le controller

    ];
}