<?php namespace controllers;
    //aca va a estar la funcionalidad del CRUD de los cines    
    use daojson\JsonCinema as JsonCinema;
    use models\ClassCinema as Cinema;
    use controllers\HomeController as Home;
    class CinemaController
    {
        private $cinemaDao;
        private $home;
        
        public function __construct(){
            $this->cinemaDao = new JsonCinema();
            $this->home = new Home();
        }

        public function add($name,$adress,$price,$city){
            //tengo que agregar un cine.
            $cinema = new Cinema($name,$city,$adress,$price);
            //falta resolver el tema de las salas, por el momento no trabajo con ellas solo se crea un array vacio.
            $this->cinemaDao->add($cinema);
            $this->home->admCinema();

        }

        public function delete($name){
            //borrar el cine con el nombre pasado por parameto
            $this->cinemaDao->delete($name);
            $this->home->admCinema();
        }

        public function read($name){

        }
        public function edit(){
            //editar el valor del atributo seleccionado por el usuario del cine seleccionado
            $this->cinemaDao->modify($value,$option,$cinemaName);
            $this->home->admCinema();
        }
    }