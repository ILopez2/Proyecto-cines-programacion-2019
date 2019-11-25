<?php namespace controllers; 

    class DateTimeController{

        public function __construct(){
            date_default_timezone_set(TMZARG);
        }
        // metodo que devuelve la fecha actual
        public function getActualDate(){
            return date("Y-m-d",time());
        }
        // metodo que devuelve la hora actual
        public function getActualTime(){
            return date("H",time()).":".date("i",time()).":".date("s",time());
        }
        // metodo que devuelve el dia actual
        public function getActualDay(){       
            return date("l",time());
        }
    }