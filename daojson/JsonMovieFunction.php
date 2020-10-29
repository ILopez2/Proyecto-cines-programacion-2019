<?php   
    use models\ClassMovieFunction as CMF;


    //ESTO NO SE USA MAS LUEGO DE IMPLEMENTAR LA PARTE DE BASE DE DATOS
    
    class JsonMovieFunction implements IJson{

        //ATRIBUTES
        private $functions= array();
        private $fileName;

        public function __construct(){
            $this->fileName= dirname(__DIR__)."/data/MovieFunctions.json";
        }

        public function add($function){
            $this->retriveData();
            $exist=false;
            if($this->getForID($function->getId())!= null){
                $exist=true;
            }
            if($exist){
                $_SESSION['errorMje']='La funcion ingresada ya existe';
            }else{
                array_push($this->functions,$function);
                $_SESSION['successMje'] = 'Funcion agregada con exito';
            }
            $this->saveData();
        }

        public function getForID($id){
            //Retorna la funcion correspondiente con el id que viene por parametro
            $rta=null;
            $this->retriveData();
            foreach($this->functions as $function){
                if($function->getId() == $id){
                    $rta=$function;
                }
            }
            return $rta;
        }
        
    }