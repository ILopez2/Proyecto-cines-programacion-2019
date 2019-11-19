<?php namespace controllers;
    
    use models\ClassSeatXFunction as SeatXfunction;
    use dao\SeatXFunctionDao as SeatXfunctionDao;
    use dao\SeatDao as SeatDao;
    use dao\MovieFunctionDao as MovieFunctionDao;

    use controllers\ViewsController as ViewsController;

    class SeatControllers{

        private $seatDao;
        private $seatXfunctionDao;
        private $view;
        
        public function __construct(){
            $this->seatXfunctionDao = new SeatXfunctionDao();
            $this->seatDao = new SeatDao();
            $this->view = new View();
        }
        
        public function getForFunction($functionId){
            $seatsOfFunction=$this->seatXfunctionDao->getForFunction($functionId);
            if(empty($seatsOfFunction)){
                $functionDao=new MovieFunctionDao();
                $function=$functionDao->getForId($functionId);
                $seats=$this->seatDao->getForCinemaRoom($function->getCinemaRoom());
                if(is_array($seats)){
                    foreach($seats as $seat){
                        $seatXfunction=new SeatXfunction($functionId,$seat->getId());
                        $this->seatXfunctionDao->add($seatXfunction);
                    }
                }
                else{
                    $seatXfunction=new SeatXfunction($functionId,$seats->getId());
                    $this->seatXfunctionDao->add($seatXfunction);
                }
                $seatsOfFunction=$this->seatXfunctionDao->getForFunction($functionId);
            }
            $this->view->viewSeatsXFunction($seatsOfFunction);
        }
        public function occupySeat($seatXfunctionId,$seatsOfFunction){
            $seatXfunction=$this->seatXfunctionDao->getForId($seatXfunctionId);
            $seatXfunction->setOccupied(true);
            $this->seatXfunctionDao->changeOccupy($seatXfunction);
            $this->view->viewSeatsXFunction($seatsOfFunction);
        }
    
    
    }