<?php namespace models;
    use models\ClassCinemaBillboard as CinemaBillboard;
    use models\ClassCinemaRoom as CinemaRoom;
    class ClassCinema {
        
        //ATRIBUTES
        private $name;
        private $city;
        private $address;
        private $ticketCost;
        private $cinemaRooms;
        private $billboard;

        //CONSTRUCTOR
        public function __construct($name,$city,$address,$ticketCost,$cinemaRoom=array(),$billboard){
            $this->name=$name;
            $this->city=$city;
            $this->address=$address;
            $this->ticketCost=$ticketCost;
            $this->cinemaRooms=$cinemaRoom;
            $this->billboard=$billboard;
        }

        //GETTERS
        public function getName(){
            return $this->name;
        }
        public function getCity(){
            return $this->city;
        }
        public function getAddress(){
            return $this->address;
        }
        public function getTicketCost(){
            return $this->ticketCost;
        }
        public function getCinemaRooms(){
            return $this->cinemaRooms;
        }
        public function getBillboard(){
            return $this->billboard;
        }
        //SETTERS
        public function setName($name){
            $this->name=$name;
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
        public function setCinemaRoom($cinemaRoom){
            array_push($this->cinemaRooms,$cinemaRoom);
        }
        public function setBillboard($billboard){
            $this->billboard=$billboard;
        }
    }
?>