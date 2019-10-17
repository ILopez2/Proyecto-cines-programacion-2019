<?php 
namespace config;
class Autoload {
     public static function start() {
          spl_autoload_register(function($class)
          {
               echo $url = ROOT . '/' . str_replace("\\", "/", $class)  . ".php";
               include_once($url);
          });
     }
}
