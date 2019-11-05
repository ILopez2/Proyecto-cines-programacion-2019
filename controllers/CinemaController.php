<?php namespace controllers;
    //aca va a estar la funcionalidad del CRUD de los cines    
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
            //$this->cinemaDao = new JsonCinema();
            $this->cinemaDao = new CinemaDao();
            $this->view = new View();
        }

        public function add($name,$adress,$price,$city){
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'Admin'){
                $cinema = new Cinema($name,$city,$adress,$price);
                //falta resolver el tema de las salas, por el momento no trabajo con ellas solo se crea un array vacio.
                $this->cinemaDao->add($cinema);
                $this->view->admCinema();
            }

        }

        public function delete($name){
            //borrar el cine con el nombre pasado por parameto
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'Admin'){
                $this->cinemaDao->delete($name);
                $this->view->admCinema();
            }
        }


        public function edit($name,$adress,$price,$city){
            //editar el valor del atributo seleccionado por el usuario del cine seleccionado
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == 'Admin'){
                $cinema = new Cinema($name,$city,$adress,$price);
                $this->cinemaDao->modify($cinema);
                $this->view->admCinema();
            }
        }
    }