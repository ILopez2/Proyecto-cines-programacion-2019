<?php  
     namespace config;
     class Autoload {
          public static function start() {
               spl_autoload_register(function($class)
               {
                    // Armo la url de la clase a partir del namespace y la instancia.
                    $url = ROOT . '/' . str_replace("\\", "/", $class)  . ".php";
                    include_once($url);
               });
          }
     }
?>