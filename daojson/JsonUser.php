<?php namespace daojson;

    use models\ClassUser as CU;

    class JsonUser implements IJson{

        private $usersList = array();
        private $fileName;

        public function __construct()
        {
            $this->fileName =ROOT."data/Users.json";
        }

        public function add($user){
            $this->retriveData();
            array_push($this->usersList,$user);
            $this->saveData();
        }
        public function getForID($name){
            //retornar el cine correspondiente con el id que viene por parametro
           /* $rta=null;
            $this->retriveData();
            foreach($cinema as $cine){
                if($cine->getName() == $name){
                    $rta=$name
                }
            }
            return $name;*/
        }
        public function getAll(){
            $this->retriveData();    
            return $this->usersList;
        }

        public function saveData(){
            $arrayToEncode = array();
            foreach($this->usersList as $user){
                $arrayValues["name"]=$user->getName();
                $arrayValues["birthdate"]=$user->getBirthdate();
                $arrayValues["nationality"]=$user->getNationality();
                $arrayValues["email"]=$user->getEmail();
                $arrayValues["password"]=$user->getPassword();
                $arrayValues["role"]=$user->getRoleLevel();
                array_push($arrayToEncode,$arrayValues);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }

        public function retriveData(){
            $this->usersList= array();

            if(file_exists($this->fileName)){
                
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();
                foreach($arrayToDecode as $valuesArray){
                $user = new CU($valuesArray["name"],$valuesArray["birthdate"],$valuesArray["nationality"],$valuesArray["email"],$valuesArray["password"],$valuesArray["role"]);
                    array_push($this->usersList,$user);
                }

            }
        }



        
    }