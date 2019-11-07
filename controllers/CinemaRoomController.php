<?php namespace controllers; 
    use dao\CinemaRoomDao as CRD;
    use models\ClassCinemaRoom as CinemaRoom;
    use controllers\ViewsController as View;

    class CinemaRoomController
    {
        private $view;
        private $dao;

        public function __construct(){
            $this->view = new View();
            $this->dao = new CRD();
        }

        public function add($name,$is3D,$capacity,$cinemaId,$nameCinema){
            $room= new CinemaRoom($name,$is3D,$capacity,$cinemaId);
            $this->dao->add($room);
            $this->view->admRooms($nameCinema);
        }

        public function delete($cinemaRoomName,$cinemaName){
            $cinemaDao = new CND();
            $cinema=$cinemaDao->getForID($cinemaName);
            $cinema->deleteCinemaRoom($cinemaRoomName);
            $cinemaDao->updateCinema($cinema);
        }
    }