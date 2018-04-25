<?php
include_once('_config.php');

if($_GET) {
    $request = $_GET['action'];
} else {
    $request = "";
}
require_once('classes/Router.php');
$router = new Router($request);
$router->renderController();