<?php 
namespace config;
class Autoload {
     public static function start() {
          spl_autoload_register(function($class)
          {
               // Armo la url de la clase a partir del namespace y la instancia.
               $url = ROOT . '/' . str_replace("\\", "/", $class)  . ".php";
               // Convierto la url a minúsculas ya que mi estructura de directorios y ficheros esta toda en minúsculas
               $url = strtolower($url);
               // Incluyo la url que, si todo esta bien, debería contener la clase que intento instanciar.
               include_once($url);
          });
     }
}