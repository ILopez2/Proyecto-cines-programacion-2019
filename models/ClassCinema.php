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
        //private $billboard;
        private $id; //de que te sirve poner este atributo si no podes setearle su id correspondiente?

        //CONSTRUCTOR
        public function __construct($name,$city,$address,$ticketCost,$cinemaRoom=array(),$id=null){
            $this->name=$name;
            $this->city=$city;
            $this->address=$address;
            $this->ticketCost=$ticketCost;
            $this->cinemaRooms=$cinemaRoom;
            //$this->billboard=$billboard;
            $this->id=$id;
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
        /*public function getBillboard(){
            return $this->billboard;
        }*/
        public function getId(){
            return $this->id;
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
            $this->cinemaRooms=$cinemaRoom;
        }
        /*public function setBillboard($billboard){
            $this->billboard=$billboard;
        }*/

        //EXTRAS 

        public function addCinemaRoom($cinemaRoom){
            $rta=false;
            foreach($this->cinemaRooms as $room){
                if($room->getName()==$cinemaRoom->getName()){
                    $rta=true; 
                }
            }
            if($rta==false){
                array_push($this->cinemaRooms,$cinemaRoom);
                $_SESSION["successMje"]="Sala cargada con exito";
            }
            else $_SESSION["errorMje"]="La sala ya existe";
        }

        public function deleteCinemaRoom($cinemaRoomName){
            $arrayToSave=array();
            $rta=false;
            foreach($this->cinemaRooms as $room){
                if($room->getName() != $cinemaRoomName){
                    array_push($this->arrayToSave,$room);
                }
                else $rta=true;
            }
            if($rta=false) $_SESSION["errorMje"]="No existe una sala con ese nombre";
            else $_SESSION["successMje"]="Sala borrada con exito";
            $this->setCinemaRoom($arrayToSave);
        }
    }
?>