<?php namespace models;
    
    class ClassCinema {
        
        //ATRIBUTES
        private $name;
        private $country;
        private $province;
        private $city;
        private $address;
        private $ticketCost;
        private $cinemaRooms=array();

        //CONSTRUCTOR
        public function __construct($name,$country,$province,$city,$address,$ticketCost,$cinemaRooms){
            $this->name=$name;
            $this->country=$country;
            $this->province=$province;
            $this->city=$city;
            $this->address=$address;
            $this->ticketCost=$ticketCost;
            $this->cinemaRooms=$cinemaRooms;
        }

        //GETTERS
        public function getName(){
            return $this->name;
        }
        public function getCountry(){
            return $this->country;
        }
        public function getProvince(){
            return $this->province;
        }
        public function getCity(){
            return $this->city;
        }
        public function getAddress(){
            return $this->Address;
        }
        public function getTicketCost(){
            return $this->ticketCost;
        }
        public function getCinemaRooms(){
            return $this->cinemaRooms;
        }
        
        //SETTERS
        public function setName($name){
            $this->name=$name;
        }
        public function setCountry($country){
            $this->country=$country;
        }
        public function setProvince($province){
            $this->province=$province;
        }
        public function setCity($city){
            $this->city=$city;
        }
        public function setAddress($address){
            $this->address=$address;
        }
        public function setTicketCost($ticketCost){
            $this->ticketCost=$ticketCost;
        }
        public function setCinemaRooms($cinemaRoom){
            $this->cinemaRooms=$cinemaRoom;
        }

        //EXTRAS
        public function addCinemaRoom($cinemaRoom){
           array_push($this->cinemaRooms,$cinemaRoom);
        }
    }
?>