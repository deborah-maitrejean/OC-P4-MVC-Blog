<?php
use \Classes\Router;
include_once('_config.php');
include_once('MyAutoload.php');
MyAutoload::start();

if($_GET) {
    $request = $_GET['action'];
} else {
    $request = "";
}

$router = new Router($request);
$router->renderController();