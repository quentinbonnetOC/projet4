<?php
namespace App;
class Autoloader{
    static function autoload($class_name){
        require __DIR__ . '/model' . '/' . $class_name . 'Model.php';
    }
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
}
