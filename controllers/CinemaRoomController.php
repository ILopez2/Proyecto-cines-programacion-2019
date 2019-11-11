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
                if(is_array($rooms)){ //en caso de que sea un array
                        foreach($rooms as $RM){
                            if($RM->getName()==$name){
                                $flag=true;
                            }
                        }            
                    }else{ //en caso de que sea un obj
                        if($rooms->getName()==$name){
                            $flag=true;
                        }
                     }
            }
            if(!$flag){ //si no existe
                $room= new CinemaRoom($name,$is3D,$capacity,$idCinema);
                $this->daoCR->add($room);
                $_SESSION['successMje'] = 'Sala agregada con éxito';
                $this->view->admRooms($idCinema);
            }else{
                $_SESSION['errorMje']='<strong>Ya existe una sala con ese nombre</strong>';
                $this->view->admRooms($idCinema);
            }
        }

        public function delete($idroom,$idcinema){
            $this->daoCR->delete($idroom);
            $_SESSION['successMje'] = 'Sala borrada con éxito';
            $this->view->admRooms($idcinema);
        }

        public function edit($roomId,$name,$capacity,$is3D,$cinemaId){
            //editar el valor del atributo seleccionado por el usuario del cine seleccionado
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                $room=new CinemaRoom($name,$is3D,$capacity,$cinemaId,$roomId);
                $this->daoCR->edit($room);
                $this->view->admRooms($roomId);
            }
        }
    }