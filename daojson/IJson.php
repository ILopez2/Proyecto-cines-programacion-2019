<?php namespace daojson;

    interface IJson{

        function add($var);
        function getAll();
        function getForID($id);
        function saveData();
        function retriveData();
    }

?>