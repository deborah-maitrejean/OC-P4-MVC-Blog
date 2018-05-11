<?php
//echo '<pre>'; print_r($_SERVER); exit;

$root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];
$uri = $_SERVER['REQUEST_URI'];

// define contantes
define('ROOT', $root . '/OC-P4-MVC-Blog/');
define('HOST', 'http://' . $host . '/OC-P4-MVC-Blog/');
//define('CONTROLLER', ROOT . 'controller/');
define('VIEW', ROOT . 'view/');
//define('MODEL', ROOT . 'model/');
//define('CLASSES', ROOT . 'services/');
define('ASSETS', HOST . 'public/');