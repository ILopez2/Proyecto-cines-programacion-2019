<?php namespace models;
    
    class ClassCinema {
        
        //ATRIBUTES
        private $name;
        private $city;
        private $address;
        private $ticketCost;
        private $cinemaRooms;

        //CONSTRUCTOR
        public function __construct($name,$city,$address,$ticketCost){
            $this->name=$name;
            $this->city=$city;
            $this->address=$address;
            $this->ticketCost=$ticketCost;
            $this->cinemaRooms=array();
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
        public function setCinemaRooms($cinemaRoom){
            $this->cinemaRooms=$cinemaRoom;
        }

        //EXTRAS
        public function addCinemaRoom($cinemaRoom){
            $rta=false;
            $msj="Sala cargada con exito";
            foreach($this->cinemaRooms as $room){
                if($room->getName==$cinemaRoom->getName){
                    $rta=true;
                    $msj="Ya existe una sala con ese nombre";
                }
            }
            if($rta==false){
                array_push($this->cinemaRooms,$cinemaRoom);
            }
            return $msj;
        }

        public function deleteCinemaRoom($cinemaRoomName){
            $arrayToSave=array();
            $msj="Sala borrada con exito";
            foreach($this->cinemaRooms as $room){
                if($room->getName() != $cinemaRoomName){
                }
            }
            $this->cinemaRooms=$arrayToSave;
            return $msj;
        }
    }
?>