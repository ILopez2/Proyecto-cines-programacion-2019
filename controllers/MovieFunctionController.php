<?php namespace controllers;
    
    use dao\MovieFunctionDao as MovieFunctionDao;
    use models\ClassCinema as Cinema;
    use models\ClassCinemaRoom as ClassCinemaRoom;
    use controllers\ViewsController as View;
    use models\ClassMovieFunction as ClassMovieFunction;
    
    class MovieFunctionController{
        
        private $dao;
        private $view;

        public function __construct(){
            //$this->cinemaDao = new JsonCinema();
            $this->dao = new MovieFunctionDao();
            $this->view = new View();
        }


        public function add($cinemaId,$movie,$cinemaRoom,$date,$time,$language,$cinemaName){
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                $functions=$this->dao->getForCinema($cinemaId);
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

        }


        public function delete($id,$cinema){
            //borrar el cine con el nombre pasado por parameto
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                $this->dao->delete($id);
                $_SESSION["successMje"]="Funcion borrada con exito";
                $this->view->admFunctions($cinema);
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
