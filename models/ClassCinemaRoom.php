<?php namespace models;
    
    class ClassCinemaRoom {
        
    //ATRIBUTES
        private $name;
        private $type; 
        private $capacity;
        private $seats=array();
    
    //CONSTRUCTOR
    public function __construct($name,$type,$capacity){
        $this->name=$name;
        $this->type=$type;
        $this->capacity=$capacity;
        $this->createSeats($capacity);
    }

    //GETTERS
    public function getName(){
        return $this->name;
    }
    public function getType(){
        return $this->type;
    }
    public function getCapacity(){
        return $this->Capacity;
    }
    public function getSeats(){
        return $this->seats;
    }

    //SETTERS
    public function setName($name){
        $this->name=$name;
    }
    public function setType($type){
        $this->type=$type;
    }
    public function setCapacity($capacity){
        $this->capacity=$capacity;
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