<?php namespace controllers;

    //DAOS
    use dao\MovieFunctionDao as MovieFunctionDao;
    //MODELS
    use models\ClassCinemaRoom as ClassCinemaRoom;
    use models\ClassMovieFunction as ClassMovieFunction;
    use models\ClassCinema as Cinema;
    //CONTROLLERS
    use controllers\MovieApiController as MovieApiController;
    use controllers\ViewsController as View;
    
    class MovieFunctionController{
        
        private $dao;
        private $view;

        public function __construct(){
            $this->dao = new MovieFunctionDao();
            $this->view = new View();
        }
        /*
        *
        */
        public function add($cinemaId,$movieId,$cinemaRoom,$date,$time,$language,$cinemaName){
            try{
                $daoM = new MovieApiController();
                $movie = $daoM->getMovieXid($movieId);
                $duration = $movie->getDuration(); //me traigo la duracion de la pelicula
                $auxTimeStart = new \DateTime($date.$time); 
                $timeStart = $auxTimeStart->format('H:i:s');//hora de inicio de la funcion
                $auxTimeEnd = $auxTimeStart->modify('+'.($duration+15).' minute'); //le sumo la duracion +15 para saber la hora de finalizacion
                $timeEnd =  $auxTimeEnd->format('H:i:s');
                $functions = $this->getFunctionsForDateAndMovie($movieId,$date);// me traigo las funciones correspondientes a la fecha y la pelicula ingresada
                if($functions){ //si existen funciones cargadas de esa peli en algun cine.
                    if($this->checkFunctionInCinemaAndRoom($functions,$cinemaId,$cinemaRoom)){//solo puedo agregar si la funcion es el mismo cine y misma sala
                        //en este punto el array/obj $functions tiene el/las funciones que corresponden al mismo cine y misma sala.
                        //por lo tanto lo ultimo que queda es verificar que los horarios no se pisen.
                        //if($this->checkTimeIsAvailable($functions,$timeStart,$timeEnd)){
                            $function = new ClassMovieFunction($movieId,$cinemaId,$date,$timeStart,$timeEnd,$cinemaRoom,$language);              
                            $this->dao->add($function);
                            $_SESSION["successMje"]="Funcion cargada con exito";
                        /*}else{
                            $_SESSION["errorMje"]="El horario: ".$time." ya esta siendo ocupado por otra funcion.";
                        }*/
                        
                    }else{
                        $_SESSION["errorMje"]="La pelicula ingresada ya posee funciones en otro cine o sala para la fecha: ".$date;
                    }
                        
                }
                else{ //si no existen funciones para esa pelicula
                    if(!$this->checkRoomIsAvailable($cinemaRoom,$cinemaId)){ //si la sala ingresada no tiene otras funciones
                        $function = new ClassMovieFunction($movieId,$cinemaId,$date,$timeStart,$timeEnd,$cinemaRoom,$language);              
                        $this->dao->add($function);
                        $_SESSION["successMje"]="Funcion cargada con exito";
                    }else{
                        $_SESSION["errorMje"]="La sala ingresada ya posee funciones de otra pelicula para la fecha: ".$date; 
                    }
                    
                }
                $this->view->admFunctions($cinemaName);
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }
        
        /*
        * Chequea que los horarios ingresados no se pisen con otras funciones existentes
        */
        public function checkTimeIsAvailable($functions,$timeStart,$timeEnd){
            
            $flag=false;
            if(!is_array($functions)){
                if($timeStart > $functions->getTimeEnd() || $timeEnd < $functions->getTimeStart()){
                    $flag=true; 
                }
            }else{
                if($this->checkTimeStartAndEnd($timeStart,$timeEnd,$functions)){ //si es verdadera significa que no se pisa con ninguna funcion
                    $flag=true;
                }
            }
            return $flag;
        }
        /*
        * Se encarga de chequear si los horarios de incio/fin de la funcion no se pisan con algun otro.
        * Modularizo esta parte 
        */
        public function checkTimeStartAndEnd($timeStart,$timeEnd,$functions){
            $flag=false;
            //timeStart hora-inicio
            //timeEnd hora-fin 
            //functions array con funciones
            foreach ($functions as $value) {
                if($timeStart > $value->getTimeEnd() || $timeEnd < $value->getTimeStart()){ 
                    $flag=true;
                }else{
                    $flag=false;
                }
                
               
            }
            return $flag;
            }
        
        /*
        * Esta funcion chequea si la sala ingresada ya posee una funcion ingresada de otra pelicula
        */
        public function checkRoomIsAvailable($roomId,$cinemaId){
            $flag=false;
            $auxFunctions = $this->dao->getForCinema($cinemaId);
            if($auxFunctions){ //si tiene datos
                if(!is_array($auxFunctions)){
                    if($auxFunctions->getCinemaRoom() == $roomId){
                        $flag=true;
                    }
                }else{
                    foreach ($auxFunctions as $key => $value) {
                        if($value->getCinemaRoom() == $roomId){
                            $flag=true;
                        }
                    }
                }
            }
            return $flag;
        }
        /*
        * Esta funcion retorna las funciones correspondientes a un id de una pelicula y una fecha.
        */
        public function getFunctionsForDateAndMovie($movieId,$functionDate){
            $array = array();
            $auxFunctions = $this->dao->getForDate($functionDate); //me traigo las funciones correspondientes a al fecha ingresada 
            if($auxFunctions){ //si tiene datos
                if(!is_array($auxFunctions)){ //si es obj
                    if($auxFunctions->getMovie() == $movieId){
                        $array=$auxFunctions;
                    }
                }else{//si es array
                    foreach ($auxFunctions as $key => $value) {
                        if($value->getMovie() == $movieId){
                            array_push($array,$value);
                        }
                    }
                }
            }
            return $array;
        }
        /*
        * Chequea si la funcion ingresada por el usuario pertenece al mismo cine y sala de la/las funciones ya cargadas de esa peli
        */
        public function checkFunctionInCinemaAndRoom($functions,$cinemaId,$roomId){
            $flag=false;
            if(!is_array($functions)){ //si no es un arreglo
                if($functions->getCinema() == $cinemaId){
                    if($functions->getCinemaRoom() == $roomId){
                        $flag=true;
                    }
                }
            }else{ //si es un arreglo
                foreach ($functions as  $value) {
                    if($value->getCinema() == $cinemaId){//si es en el mismo cine
                        if($value->getCinemaRoom() == $roomId){ //y en la misma sala
                            $flag=true;
                        }
                    }
                }
            }
            
            return $flag;
        }

        //borrar la funcion con los id pasados por parameto
        public function delete($id,$cinemaOrRoom,$option){
            try{
                if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                    $this->dao->delete($id);
                    $_SESSION["successMje"]="Funcion borrada con exito";
                    if($option=="cinema"){
                        $this->view->admFunctions($cinemaOrRoom);
                    }
                    if($option=="cinemaRoom"){
                        $this->view->viewCinemaRoomFunctions($cinemaOrRoom);
                    }
                }
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }
        //modifico una funcion
        public function edit($movie,$cinema,$dateTime,$language,$cinemaRoom,$id){
            try{
                //editar el valor del atributo seleccionado por el usuario del cine seleccionado
                if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                    $function = new ClassMovieFunction($movie,$cinema,$dateTime,$language,$cinemaRoom,$id);
                    $this->cinemaDao->modify($function);
                    $this->view->admFunctions();
                }
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }

    }
