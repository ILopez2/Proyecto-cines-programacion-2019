<?php namespace models;
    
    class ClassCinemaRoom {
        
    //ATRIBUTES
        private $name;
        private $is3D; 
        private $capacity;
        private $cinemaId;
        private $roomId; 
    
    //CONSTRUCTOR
    public function __construct($name=null,$is3D=null,$capacity=null,$cinemaId=null,$roomId=null){
        $this->name=$name;
        $this->is3D=$is3D;
        $this->capacity=$capacity;
        $this->cinemaId=$cinemaId;
        $this->roomId=$roomId;
    }

    //GETTERS
    public function getName(){
        return $this->name;
    }
    public function getIs3D(){
        return $this->is3D;
    }
    public function getCapacity(){
        return $this->capacity;
    }
    public function getCinemaId(){
        return $this->cinemaId;
    }
    public function getId(){
        return $this->roomId;
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
    }

    }
?>