<?php
use \Services\Router;

require('../vendor/digitalnature/php-ref/ref.php');
include_once('../config/_config.php');
include_once('../MyAutoload.php');
MyAutoload::start();

if($_GET) {
    $request = $_GET['action'];
} else {
    $request = "";
}

$router = new Router($request);
$router->renderController();