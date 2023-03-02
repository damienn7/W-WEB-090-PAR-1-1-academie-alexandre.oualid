<?php
namespace App\model;

class AutoloaderModel
{
    static function register(){
        spl_autoload_register(array(__CLASS__,'autoload'));
    }
    static function autoload($class){
        $class = str_replace(__NAMESPACE__ . "\\", "", $class);
        $class = str_replace("\\", "/", $class);
        
        
        if (strrpos(__DIR__,"controller")===true) {
            require '../controller/'.$class.'.php';
        }else {
            // die();
            require '../model/'.$class.'.php';
        }

    }
}

?>