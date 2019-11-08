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


        public function add($movie,$cinemaId,$date,$time,$language,$cinemaRoom){
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                $function = new ClassMovieFunction($movie,$cinemaId,$date,$time,$cinemaRoom,$language);
                var_dump($function);
                $this->dao->add($function);
                $this->view->admFunctions();
            }

        }


        public function delete($id){
            //borrar el cine con el nombre pasado por parameto
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                $this->dao->delete($id);
                $this->view->admFunctions();
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
