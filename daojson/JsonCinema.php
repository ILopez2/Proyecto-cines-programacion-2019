<?php namespace daojson; 

    use models\ClassCinema as CC;

    class JsonCinema implements IJson {

        //ATRIBUTES
        private $cinemas= array();
        private $fileName;

        //CONSTRUCTOR
        public function __construct(){
            $this->fileName= dirname(__DIR__)."/data/Cinemas.json";
        }

        //JSON FUNCTIONS
        public function add($cinema){
            $this->retriveData();
            array_push($this->cinemas,$cinema);
            $this->saveData();
        }

        public function getAll(){
            $this->retriveData();
            return $this->cinemas;
        }

        private function saveData(){
            $array=array();

            foreach($this->cinemas as $cinema){
                $values["name"]=$cinema->getName();
                $values["country"]=$cinema->getCountry();
                $values["province"]=$cinema->getProvince();
                $values["city"]=$cinema->getCity();
                $values["address"]=$cinema->getAddress();
                $values["ticketCost"]=$cinema->getTicketCost();
                $values["cinemaRooms"]=$cinema->getCinemaRooms();
                array_push($array,$values);
            }
            $jsonContent= json_encode($array, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }

        private function retriveData(){
            $this->cinemas= array();

            if(file_exists($this->fileName)){
                $jsonContent=file_get_contents($this->fileName);
                $array= ($jsonContent) ? json_decode($jsonContent, true ) : array();

                foreach($array as $values){
                    $cinema = new CC($values["name"],$values["country"],$values["province"],$values["city"],$values["address"],$values["ticketCost"],$values["cinemaRooms"]);
                    array_push($this->cinemas, $cinema);
                }
            }
        }
    }

?>