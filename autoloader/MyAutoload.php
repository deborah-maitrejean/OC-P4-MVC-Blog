<?php
namespace Autoloader;

class MyAutoload{
    public static function start(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    public static function autoload($class){
        //var_dump($class);die;
        $path = str_replace('\\', '/', $class);
        require '../'.$path.'.php';
    }
}