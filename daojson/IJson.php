<?php namespace daojson;
    //ESTO NO SE USA MAS LUEGO DE IMPLEMENTAR LA PARTE DE BASE DE DATOS
    
    interface IJson{

        function add($var);
        function getAll();
        function getForID($id);
        function saveData();
        function retriveData();
    }

?>