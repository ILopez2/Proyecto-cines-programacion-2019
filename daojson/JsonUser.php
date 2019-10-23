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
            $exist=false;
            foreach($this->usersList as $value){
                if($user->getEmail() == $value->getEmail()){
                    $exist=true;
                }
            }
            if($exist){
                $_SESSION['errorMje']='El <strong>email<strong> ingresado ya esta en uso.';
            }else{
                array_push($this->usersList,$user);
                $_SESSION['successMje'] = 'Usuario agregado con éxito';
            }
            $this->saveData();
        }
        public function getForID($email){
            //retornar el cine correspondiente con el id que viene por parametro
            $rta=null;
            $this->retriveData();
            foreach($this->usersList as $value){
                if($value->getEmail() == $email){
                    $rta=$value;
                }
            }
            return $rta;
        }

        public function delete($email){
            $this->retriveData();
            $newList = array();
            $mje=false;
            
            foreach ($this->usersList as $user) {
                if($user->getEmail() == $email){
                    $mje=true;
                }
                if($user->getEmail() != $email){ 
                    array_push($newList, $user);
                    
                }
            }
            if($mje){
                $_SESSION['successMje'] = 'Usuario borrado con éxito';
            }
            $this->usersList = $newList;
            $this->saveData();
        }
      
        public function modify($newUser,$id){
            //hay que modificar esta funcion para que se puedan editar varios o todos los campos a la vez.
            $this->retriveData();
            $arrayToSave= array();
            foreach($this->usersList as $user){
                if($user->getEmail() == $id){
                    $user=$newUser;
                }
                array_push($arrayToSave,$user);
            }
            $usersList=$arrayToSave;
            $this->saveData();
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


        public function setRole($email,$role){
            $this->retriveData();
            $newList = array();
            
            foreach ($this->usersList as $user) {
               
                if($user->getEmail() == $email){ 
                    $user->setRoleLevel($role);
                    
                }
                array_push($newList, $user);
            }
            $this->usersList = $newList;
            $this->saveData();
        }
        
        
    }