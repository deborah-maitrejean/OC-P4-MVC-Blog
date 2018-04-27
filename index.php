<?php
use \Classes\Router;

include_once('MyAutoload.php');
MyAutoload::start();

if($_GET) {
    $request = $_GET['action'];
} else {
    $request = "";
}
//require_once('classes/Router.php');
$router = new Router($request);
$router->renderController();