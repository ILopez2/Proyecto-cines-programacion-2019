<?php namespace daojson; 
    //ESTO NO SE USA MAS LUEGO DE IMPLEMENTAR LA PARTE DE BASE DE DATOS
    
    use models\ClassCinema as CC;
    use models\ClassCinemaRoom as CR;
    class JsonCinema implements IJson {

        //ATRIBUTES
        private $cinemas= array();
        private $fileName;

        //CONSTRUCTOR
        public function __construct(){
            $this->fileName= dirname(__DIR__)."/data/Cinemas.json";
        }

        //JSON FUNCTIONS


        //AÑADE UN CINE AL JSON
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

        //ELIMINA EL CINE CON EL NOMBRE QUE SE ENVIA POR PARAMETRO
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

        //RETORNA EL CINE CON EL NOMBRE QUE SE ENVIA POR PARAMETRO
        public function getForID($name){
            $rta=null;
            $this->retriveData();
            foreach($this->cinemas as $cine){
                if($cine->getName() == $name){
                    $rta=$cine;
                }
            }
            return $rta;
        }

        //ENVIA UN CINE PARA MODIFICAR CON TODOS LOS DATOS NUEVOS 
        public function modify($newCinema){
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

        //DEVUELVE UN ARREGLO CON TODOS LOS CINES
        public function getAll(){
            $this->retriveData();
            return $this->cinemas;
        }

        //GUARDAR EL ARRAY EN EL JSON
        public function saveData(){
            $array=array();          
            foreach($this->cinemas as $cinema){
                $values["name"]=$cinema->getName();
                $values["city"]=$cinema->getCity();
                $values["address"]=$cinema->getAddress();
                $values["ticketCost"]=$cinema->getTicketCost();
                $rooms=$cinema->getCinemaRooms();
                if(!empty($rooms)){
                    foreach($rooms as $room){
                        for($i=0;$i<count($rooms);$i++){
                            $values["cinemaRooms"][$i]["name"]=$room->getName();
                            $values["cinemaRooms"][$i]["is3D"]=$room->getIs3D();
                            $values["cinemaRooms"][$i]["capacity"]=$room->getCapacity();
                            $values["cinemaRooms"][$i]["seats"]=$room->getSeats();
                            $values["cinemaRooms"][$i]["prueba"]="jaja";
                        }
                    }
                }
                else $values["cinemaRooms"]=array();
                $values["billboard"]=$cinema->getBillboard();
                array_push($array,$values);
            }
            $jsonContent= json_encode($array, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }

        public function jsonToCinemaRoom($cinemaRooms){
            $roomsArray=array();
            if(!empty($cinemaRooms)){
                for($i=0;$i<count($cinemaRooms);$i++){
                    $room=new CR($cinemaRooms[$i]["name"],$cinemaRooms[$i]["is3D"],$cinemaRooms[$i]["capacity"]);
                    array_push($roomsArray,$room);
                }
            }
        }
        //GUARDA EN EL ARREGLO TODOS LOS DATOS QUE ESTAN EN EL JSON
        public function retriveData(){
            $this->cinemas= array();
            if(file_exists($this->fileName)){
                $jsonContent=file_get_contents($this->fileName);
                $array= ($jsonContent) ? json_decode($jsonContent, true ) : array();
                foreach($array as $values){
                    $cinemaRooms=$this->jsonToCinemaRoom($values["cinemaRooms"]);
                    $cinema = new CC($values["name"],$values["city"],$values["address"],$values["ticketCost"],$cinemaRooms,$values["billboard"]);
                    array_push($this->cinemas, $cinema);
                }
            }
        }
       
    }

?>