<?php

class MyAutoload{
    public static function start(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    public static function autoload($class){
        //var_dump($class); // 'Classes\Router' (length=14)
        //die();
        //echo '<pre>'; print_r($_SERVER); exit;
        //je récupère les données
        $root = $_SERVER['DOCUMENT_ROOT']; // mon chemin de dossier C:\xampp\htdocs\OC-P4-MVC-Blog
        $host = $_SERVER['HTTP_HOST']; // localhost:63342
        // je définis mes contantes
        //define('ROOT', $root. '/OC-P4-MVC-Blog/');
        //define('ROOT', $root. '/');
        define('ROOT', dirname(__DIR__) . '/OC-P4-MVC-Blog/');
        define('HOST', 'http://'. $host . '/OC-P4-MVC-Blog/');

        if (strpos($class, __NAMESPACE__ . '\\') === 0){ // strpos - Cherche la position de la première occurrence dans une chaîne
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);

            require ROOT. $class.'.php';
        }
    }
}
/*
define('CONTROLLER', ROOT . 'controller/');
define('VIEW', ROOT . 'view/'); // nom, chemin
define('MODEL', ROOT . 'model/');
define('CLASSES', ROOT . 'classes/');
define('ASSETS', HOST . 'assets/'); // intégration du dossier assets contenant les css et js, se fait via une URL et pas via un emplacement dans le disque dur, c'est pour ça que c'est pas par ROOT mais par HOST
*/