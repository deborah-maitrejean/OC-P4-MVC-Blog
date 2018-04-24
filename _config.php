<?php
//echo '<pre>'; print_r($_SERVER); exit;

// je récupère les données
$root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];

// je définis mes contantes
define('ROOT', $root . '/OC-P4-MVC-Blog/'); // echo ROOT affiche mon chemin de dossier C:/xampp/htdocs/OC-P4-MVC/
define('HOST', 'http://'. $host . '/OC-P4-MVC-Blog/'); // echo HOST affiche localhost/OC-P4-MVC
// j’ai maintenant mes liens absolus

// je peux maintenant définir mes contantes
define('CONTROLLER', ROOT . 'controller/');
define('VIEW', ROOT . 'view/'); // nom, chemin
define('MODEL', ROOT . 'model/');
define('CLASSES', ROOT . 'classes/');
define('ASSETS', HOST . 'assets/'); // intégration du dossier assets contenant les css et js, se fait via une URL et pas via un emplacement dans le disque dur, c'est pour ça que c'est pas par ROOT mais par HOST