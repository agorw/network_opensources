<?php
namespace MF;

class Autoloads{
    static function register() {
        spl_autoload_register([
            __CLASS__,
            'charge'
        ]);
    }
    
    static function charge($class) {
        $class = str_replace(__NAMESPACE__. '\\','',$class);
        $class = str_replace('\\','/',$class);
        $fichier = __DIR__ . '/' . $class . '.php';
        if(file_exists($fichier)) {
            include $fichier; 
        }
    }
}