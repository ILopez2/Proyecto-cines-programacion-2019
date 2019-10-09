<?php
    namespace models;
    class ClassCinema {
        //ATRIBUTES
        private $name;
        private $country;
        private $province;
        private $city;
        private $address;
        private $ticketCost;

        //CONSTRUCTOR
        public function __construct($name,$country,$province,$city,$address,$ticketCost){
            $this->name=$name;
            $this->country=$country;
            $this->province=$province;
            $this->city=$city;
            $this->address=$address;
            $this->ticketCost=$ticketCost;
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

        //SETTERS

        public function setTicketCost($ticketCost){
            $this->ticketCost=$ticketCost;
        }
    }
?>