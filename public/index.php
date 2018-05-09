<?php
use \Services\Router;
use \Autoloader\MyAutoload;

require('../vendor/digitalnature/php-ref/ref.php');
include_once('../config/_config.php');
include_once('../autoloader/MyAutoload.php');
MyAutoload::start();

$router = new Router($uri);
$router->renderController();