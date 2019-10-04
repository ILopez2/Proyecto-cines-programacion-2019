<?php
    namespace models;
    //ATRIBUTES
    class CinemaRoom {
        private $name;
        private $type; 
        private $capacity;
        private $seats;
    //CONSTRUCTOR
    public function __construct($name,$type,$capacity){
        $this->name=$name;
        $this->type=$type;
        $this->capacity=$capacity;
        $this->seats=array();
        $this->createSeats($capacity);
        
    }
    //EXTRAS
    private function createSeats($capacity){
        $number=1;
        for($i=0;$i<$capacity;$i++){
            $this->seats[$i]=$number;
            $number++;
        }
    }

    }
?>