<?php namespace controllers;
    class HomeController
    {
        public function Index()
        {
            // Aca va el codigo que antes ponian en PROCESS

            include_once VIEWS . "/header.php";
            include_once VIEWS . "/nav.php";


            // aca va la vista de la pagina Index


            include_once VIEWS . "/footer.php";
            //checksession y login
        }        
    }
?>