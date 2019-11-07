<?php namespace controllers;
    //esta controladora se encargara de administrar todas las vistas necesarias
    class ViewsController
    {
        //private $home;
        
        public function __construct(){
            //I'm the fucking construct.
        }
        public function admUsers(){
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/CrudUsers.php');
            include_once(VIEWS.'/footer.php');
        }
        public function admCinema(){
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/CrudCinema.php');
            include_once(VIEWS.'/footer.php');
        }

        public function admRooms($cinemaName){
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/CrudRooms.php');
            include_once(VIEWS.'/footer.php');
        }

        public function Mhome(){
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/home.php');
            include_once(VIEWS.'/footer.php');
        }

        public function searchGen($searchG){
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/SearchResult.php');
            include_once(VIEWS.'/footer.php');
        }
        public function admFunctions($cinemaName){
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/CrudMovieFunction.php');
            include_once(VIEWS.'/footer.php');
        }
        public function viewFunctions($id){
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/MovieFunction.php');
            include_once(VIEWS.'/footer.php');
        }
    }