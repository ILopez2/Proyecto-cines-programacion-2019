<?php namespace controllers;
    //esta controladora se encargara de administrar todas las vistas necesarias

    class ViewsController
    {
        private $cinemaDao;
        
        public function __construct(){
            
        }

        public function admCinema(){
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/CrudCinema.php');
            include_once(VIEWS.'/footer.php');
        }
    }