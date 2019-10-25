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
            $exist=false;
            if($this->getForID($cinema->getName())!=null){
                $exist=true;
            }
            if($exist){
                $_SESSION['errorMje']='El nombre ingresado ya existe.';
            }else{
                array_push($this->cinemas,$cinema);
                $_SESSION['successMje'] = 'Cine agregado con éxito';
            }
            $this->saveData();
        }
        public function delete($name){
            $this->retriveData();
            $newList = array();
            $mje=false;
            
            foreach ($this->cinemas as $cine) {
                if($cine->getName() == $name){
                    $mje=true;
                }
                if($cine->getName() != $name){ 
                    array_push($newList, $cine);
                    
                }
            }
            if($mje){
                $_SESSION['successMje'] = 'Cine borrado con éxito';
            }
            $this->cinemas = $newList;
            $this->saveData();
        }
        public function getForID($name){
            //retornar el cine correspondiente con el id que viene por parametro
            $rta=null;
            $this->retriveData();
            foreach($this->cinemas as $cine){
                if($cine->getName() == $name){
                    $rta=$cine;
                }
            }
            return $rta;
        }
        public function modify($newCinema){
            //hay que modificar esta funcion para que se puedan editar varios o todos los campos a la vez.
            $this->retriveData();
            $arrayToSave= array();
            foreach($this->cinemas as $value){
                if($value->getName() == $newCinema->getName()){
                    $value=$newCinema;
                }
                array_push($arrayToSave,$value);
            }
            $this->cinemas=$arrayToSave;
            $this->saveData();
        }

        public function getAll(){
            $this->retriveData();
            return $this->cinemas;
        }
        public function updateCinema($cinemaToUpdate){
            $this->retriveData();
            $arrayToSave= array();
            foreach($this->cinemas as $cinema){
                if($cinema->getName() == $cinemaToUpdate->getName()){
                    $cinema=$cinemaToUpdate;
                }
                array_push($arrayToSave,$cinema);
            }
            $this->cinemas=$arrayToSave;
            $this->saveData();
        }
        public function saveData(){
            $array=array();

            foreach($this->cinemas as $cinema){
                $values["name"]=$cinema->getName();
                $values["city"]=$cinema->getCity();
                $values["address"]=$cinema->getAddress();
                $values["ticketCost"]=$cinema->getTicketCost();
                $values["cinemaRooms"]=$cinema->getCinemaRooms();
                $values["billboard"]=$cinema->getBillboard();
                array_push($array,$values);
            }
            $jsonContent= json_encode($array, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }

        public function retriveData(){
            $this->cinemas= array();

            if(file_exists($this->fileName)){
                $jsonContent=file_get_contents($this->fileName);
                $array= ($jsonContent) ? json_decode($jsonContent, true ) : array();

                foreach($array as $values){
                    $cinema = new CC($values["name"],$values["city"],$values["address"],$values["ticketCost"],$values["cinemaRooms"],$values["billboard"]);
                    array_push($this->cinemas, $cinema);
                }
            }
        }
    }

?>