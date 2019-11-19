<?php namespace controllers; 

    class DateTimeController{

        public function __construct(){
            //VACIO
        }

        public function getActualDate(){
            return date("Y-m-d");
        }
        public function getActualTime(){
            return date("H").":".date("i").":".date("s");
        }
    }