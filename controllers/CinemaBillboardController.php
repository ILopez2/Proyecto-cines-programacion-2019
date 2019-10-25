<?php namespace controllers; 
    use daojson\JsonCinema as JsonCinema;
    use models\ClassCinemaBillboard as Billboard;
    use models\ClassCinema as Cinema;
    use controllers\CinemaRoomController as View;
    class CinemaRoomController
    {

        public function add($movie,$cinemaName){
            $cinemaDao = new JsonCinema();
            $cinema= $cinemaDao->getForID($cinemaName);
            $billboard= $cinema->getBillboard();
            $billboard->addMovie($movie);
            $cinema->setBillboard($billboard);
            $cinemaDao->updateCinema($cinema);
        }

        public function delete($movieId,$cinemaName){
            $cinemaDao = new JsonCinema();
            $cinema=$cinemaDao->getForID($cinemaName);
            $billboard= $cinema->getBillboard();
            $billboard->deleteMovie($movieId);
            $cinema->setBillboard($billboard);
            $cinemaDao->updateCinema($cinema);
        }
        
    }