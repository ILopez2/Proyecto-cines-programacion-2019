<?php namespace controllers; 
    use daojson\JsonCinema as JsonCinema;
    use models\ClassCinemaRoom as CinemaRoom;
    use controllers\CinemaRoomController as View;
    class CinemaRoomController
    {

        public function add($name,$is3D,$capacity,$cinemaName){
            $cinemaDao = new JsonCinema();
            $room= new CinemaRoom($name,$is3D,$capacity);
            $cinema=$cinemaDao->getForID($cinemaName);
            $cinema->addCinemaRoom($room);
            $cinemaDao->updateCinema($cinema);
        }

        public function delete($cinemaRoomName,$cinemaName){
            $cinemaDao = new JsonCinema();
            $cinema=$cinemaDao->getForID($cinemaName);
            $cinema->deleteCinemaRoom($cinemaRoomName);
            $cinemaDao->updateCinema($cinema);
        }
    }