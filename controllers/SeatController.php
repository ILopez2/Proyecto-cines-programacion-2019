<?php namespace controllers;
    
    use models\ClassSeatXFunction as SeatXfunction;
    use dao\SeatXFunctionDao as SeatXFDao;
    use dao\SeatDao as SeatDao;
    use dao\MovieFunctionDao as MovieFunctionDao;

    use controllers\ViewsController as View;

    class SeatController{

        private $seatDao;
        private $seatXfunctionDao;
        private $view;
        
        public function __construct(){
            $this->seatXfunctionDao = new SeatXFDao();
            $this->seatDao = new SeatDao();
            $this->view = new View();
        }
        //metodo que duvuelve un asiento de un id de una funcion pasa por parametro 
        public function getForFunction($functionId){
            $seatsOfFunction=$this->seatXfunctionDao->getForFunction($functionId);
            if(empty($seatsOfFunction)){
                $functionDao=new MovieFunctionDao();
                $function=$functionDao->getForID($functionId);
                $seats=$this->seatDao->getForCinemaRoom($function->getCinemaRoom());
                if(!empty($seats)){
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
            }
            return $seatsOfFunction;
        }
        // setea el asiento en ocupado
        public function occupySeat($seatXfunctionId){
            $seatXfunction=$this->seatXfunctionDao->getForId($seatXfunctionId);
            $seatXfunction->setOccupied(1);
            $this->seatXfunctionDao->changeOccupy($seatXfunction);
        }
        //devuelve un array con las posiciones de los asientos
        public function getFromIds($seatXfunctionIds){
            $daoSXF= new SeatXFDao();
            $seatsXfunction=array();
            foreach($seatXfunctionIds as $id){
                array_push($seatsXfunction,$daoSXF->getForID($id));
            }
            return $seatsXfunction;
        }
    
    }