<?php namespace controllers;
    
    use dao\MovieFunctionDao as MovieFunctionDao;
    use models\ClassCinema as Cinema;
    use models\ClassCinemaRoom as ClassCinemaRoom;
    use controllers\ViewsController as View;
    use models\ClassMovieFunction as ClassMovieFunction;
    use controllers\MovieApiController as MovieApiController;
    
    class MovieFunctionController{
        
        private $dao;
        private $view;

        public function __construct(){
            //$this->cinemaDao = new JsonCinema();
            $this->dao = new MovieFunctionDao();
            $this->view = new View();
        }


        public function add($cinemaId,$movie,$cinemaRoom,$date,$time,$language,$cinemaName){
           /* if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                $functions=$this->dao->getForCinema($cinemaId); //traigo las funciones del cine pasado por parametro 
                $flag=false;
                $movieExists=false;
                foreach($functions as $value){
                    if($date == $value->getDate() && $movie == $value->getMovie()){ 
                        //ya existe una funcion de esa pelicula en ese cine para la fecha
                        $movieExists=true;
                    }
                }
                if($movieExists){//si existe una funcion de esa peli en el cine
                    if($cinemaRoom == $value->getCinemaRoom())//solo puede puede agregar la funcion si es en la misma sala
                    {
                        $flag=true;
                    }
                }
                if(!$movieExists){//si no existe funciones para esa pelicula en esa sala y fecha
                    $function = new ClassMovieFunction($movie,$cinemaId,$date,$time,$cinemaRoom,$language);              
                    $this->dao->add($function);
                    $_SESSION["successMje"]="Funcion cargada con exito";
                }elseif(!$flag){
                    $_SESSION["errorMje"]="Ya existe una funcion en otra sala de la pelicula seleccionada";
                }else{// si existe funciones en ese cine y la sala es la misma
                    echo 'entro';
                    /*$daoM = new MovieApiController();
                    $theMovie = $daoM->getMovieXid($movie);
                    $duration = $theMovie->getDuration();
                    $time='01:00';
                    $time_start_newobj = date_create($date.''.$time); //hora de inicio de la nueva funcion
                    $time_end_newobj = $time_start_newobj->modify('+'.($duration+15).'minute');//horario de finalizacion de la nueva funcion
                    if($functions=$this->dao->getForRoomAndCinemaID($cinemaRoom,$cinemaId)){ //me traigo las funciones que pertenecen a la sala ingresada
                        foreach($functions as $value){
                               $time_start = date_create($value->getDate().''.$value->getTime());//horario de inicio
                               $time_end = $time_start->modify('+'.$duration.'minute');//horario de finalizacion    
                               
                               
                            
                        }
                   }
                }

                

               
                

                

                $hora1 = strtotime($time);
                $hora2 = strtotime("22:00");
                if($hora1<$hora2){
                    echo 'es menor';
                }else{
                    echo 'es mayor';
                }
                echo '<br>';
                $date = new \DateTime();
                $dateFrom = \DateTime::createFromFormat('!H:i', $time);
                $dateFrom->modify('+220 minute');
                $dateFrom->format('H:i');
                $newDate= date('H:i');
               echo $newDate;*/
                //$date->modify('-2 hours');
                $flag=false;
                if(!empty($functions)){
                    if(is_array($functions)){
                        foreach($functions as $FU){
                            if($FU->getCinemaRoom()==$cinemaRoom){
                                if($FU->getDate()==$date){
                                    if($FU->getTime()==$time){  
                                        $flag=true;                      
                                    }
                                }
                            }
                        }
                    }
                    else{
                        if($functions->getCinemaRoom()==$cinemaRoom){
                            if($functions->getDate()==$date){
                                if($functions->getTime()==$time){
                                    $flag=true;                        
                                }
                            }
                        }
                    }
                }
                if($flag==false){
                    $function = new ClassMovieFunction($movie,$cinemaId,$date,$time,$cinemaRoom,$language);              
                    $this->dao->add($function);
                    $_SESSION["successMje"]="Funcion cargada con exito";
                }
                else{
                    $_SESSION["errorMje"]="Ya hay una funcion en esa sala para esa fecha y hora";
                }
                $this->view->admFunctions($cinemaName);
            }
            
        
    


        public function delete($id,$cinemaOrRoom,$option){
            //borrar el cine con el nombre pasado por parameto
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

        public function edit($movie,$cinema,$dateTime,$language,$cinemaRoom,$id){
            //editar el valor del atributo seleccionado por el usuario del cine seleccionado
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                $function = new ClassMovieFunction($movie,$cinema,$dateTime,$language,$cinemaRoom,$id);
                $this->cinemaDao->modify($function);
                $this->view->admFunctions();
            }
        }

    }
