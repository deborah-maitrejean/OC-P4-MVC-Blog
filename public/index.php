<?php
use \Services\Router;
use \Autoloader\MyAutoload;
use \Services\Container;

require('../vendor/digitalnature/php-ref/ref.php');
include_once('../config/_config.php');
include_once('../autoloader/MyAutoload.php');
MyAutoload::start();

$container = new Container();
$router = new Router($uri);
//$router->renderController();

$resolve = $router->resolve();
$controller = $container->getController($resolve['controller']);
$method = $container->getController($resolve['method']);
$params = $container->getController($resolve['params']);
call_user_func_array([$controller, $method], $resolve['params']);