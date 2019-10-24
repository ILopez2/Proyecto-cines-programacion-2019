<?php namespace models;
    
    class ClassCinemaRoom {
        
    //ATRIBUTES
        private $name;
        private $is3D; 
        private $capacity;
        private $seats=array();
    
    //CONSTRUCTOR
    public function __construct($name,$is3D,$capacity){
        $this->name=$name;
        $this->is3D=$is3D;
        $this->capacity=$capacity;
        $this->createSeats($capacity);
    }

    //GETTERS
    public function getName(){
        return $this->name;
    }
    public function getIs3D(){
        return $this->is3D;
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
    public function setIs3D($is3D){
        $this->is3D=$is3D;
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