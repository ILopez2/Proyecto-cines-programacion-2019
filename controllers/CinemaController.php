<?php namespace controllers;  
    use models\ClassCinema as Cinema;
    use models\ClassCinemaRoom as ClassCinemaRoom;
    use dao\CinemaDao as CinemaDao;
    use daojson\JsonCinema as JsonCinema;
    use controllers\ViewsController as View;

    class CinemaController
    {
        private $cinemaDao;
        private $view;
        
        public function __construct(){
            $this->cinemaDao = new CinemaDao();
            $this->view = new View();
        }
        // agrego un cine pasandole por parametro nombre direccion precio y ciudad
        public function add($name,$adress,$price,$city){    
            try{
                if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                    if($this->cinemaDao->getForID($name)==null){
                    $cinema = new Cinema($name,$city,$adress,$price);
                    $this->cinemaDao->add($cinema);
                    $_SESSION['successMje'] = 'Cine agregado con éxito';
                    $this->view->admCinema();
                    }
                    else{
                        $_SESSION['errorMje'] = 'Ya existe un cine con ese nombre';
                        $this->view->admCinema();
                    }
                }
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }

        public function delete($id){
            try{
                if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){

                    $this->cinemaDao->delete($id);
                    $_SESSION['successMje'] = 'Cine borrado con éxito';
                    $this->view->admCinema();
                }
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }

        public function edit($name,$adress,$price,$city){
            try{
                if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                $cinema = new Cinema($name,$city,$adress,$price);
                $this->cinemaDao->edit($cinema);
                $_SESSION['successMje'] = 'Cine modificado con éxito';
                $this->view->admCinema();
                }
            }    
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }
    }