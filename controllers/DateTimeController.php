<?php namespace controllers; 

    class DateTimeController{

        public function __construct(){
            //VACIO
        }
        // metodo que devuelve la fecha actual
        public function getActualDate(){
            return date("Y-m-d");
        }
        // metodo que devuelve la hora actual
        public function getActualTime(){
            return date("H").":".date("i").":".date("s");
        }
        // metodo que devuelve el dia actual
        public function getActualDay(){
            return date("l");
        }
    }