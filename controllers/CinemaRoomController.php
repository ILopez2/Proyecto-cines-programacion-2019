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

        public function add($name,$is3D,$capacity,$idCinema){
            $cinema=$this->daoC->getForID2($idCinema);
            $rooms=$cinema->getCinemaRooms();
            $flag=false;
            if(!empty($rooms)){
                foreach($rooms as $RM){
                    if($RM->getName()==$name){
                        $_SESSION['errorMje']='<strong>Ya existe una sala con ese nombre</strong>';
                    }
                    else {
                        if($flag==false){
                            $room= new CinemaRoom($name,$is3D,$capacity,$idCinema);
                            $this->daoCR->add($room);
                            $_SESSION['successMje'] = 'Sala agregada con éxito';
                            $flag=true;
                        }
                    }
                }
            }
            else {
                $room= new CinemaRoom($name,$is3D,$capacity,$idCinema);
                $this->daoCR->add($room);
                $_SESSION['successMje'] = 'Sala agregada con éxito';
            }
            $this->view->admRooms($idCinema);
        }

        public function delete($cinemaRoomName,$cinemaId){
            $cinemaDao = new CND();
            $cinema=$cinemaDao->getForID2($cinemaId);
            $cinema->deleteCinemaRoom($cinemaRoomName);
            $cinemaDao->updateCinema($cinema);
        }
    }