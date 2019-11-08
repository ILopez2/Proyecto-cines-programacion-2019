<?php namespace controllers; 
    use dao\CinemaRoomDao as CRD;
    use dao\CinemaDao as CD;
    use models\ClassCinemaRoom as CinemaRoom;
    use controllers\ViewsController as View;

    class CinemaRoomController
    {
        private $view;
        private $daoCR;
        private $daoC;

        public function __construct(){
            $this->view = new View();
            $this->daoCR = new CRD();
            $this->daoC = new CD();
        }

        public function add($name,$is3D,$capacity,$nameCinema){
            $cinemaId = $this->daoC->getCinemaIdForName($nameCinema);
            //var_dump($cinemaId);
            echo $is3D;
            $room= new CinemaRoom($name,$is3D,$capacity,$cinemaId->getId());
            $this->daoCR->add($room);
            $this->view->admRooms($nameCinema);
        }

        public function delete($cinemaRoomName,$cinemaName){
            $cinemaDao = new CND();
            $cinema=$cinemaDao->getForID($cinemaName);
            $cinema->deleteCinemaRoom($cinemaRoomName);
            $cinemaDao->updateCinema($cinema);
        }
    }