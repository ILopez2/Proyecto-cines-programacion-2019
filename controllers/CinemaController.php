<?php namespace controllers;
    //aca va a estar la funcionalidad del CRUD de los cines    
    use daojson\JsonCinema as JsonCinema;
    use models\ClassCinema as Cinema;
    use controllers\ViewsController as View;
    class CinemaController
    {
        private $cinemaDao;
        private $view;
        
        public function __construct(){
            $this->cinemaDao = new JsonCinema();
            $this->view = new View();
        }

        public function add($name,$adress,$price,$city){
            //tengo que agregar un cine.
            $cinema = new Cinema($name,$city,$adress,$price);
            //falta resolver el tema de las salas, por el momento no trabajo con ellas solo se crea un array vacio.
            $this->cinemaDao->add($cinema);
            $this->view->admCinema();

        }

        public function delete($name){
            //borrar el cine con el nombre pasado por parameto
            $this->cinemaDao->delete($name);
            $this->view->admCinema();
        }

        public function read($name){
            //? no lo se rick
        }
        public function edit(){
            //editar el valor del atributo seleccionado por el usuario del cine seleccionado
            $this->cinemaDao->modify($value,$option,$cinemaName);
            $this->view->admCinema();
        }
    }