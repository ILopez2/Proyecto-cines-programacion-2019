<?php
    namespace models;
    class ClassSeatXFunction{
        private $id;
        private $functionId;
        private $seatId;
        private $occupied;

        public function __construct($functionId,$seatId,$occupied=false){
            $this->id=$functionId.$seatId;
            $this->functionId=$functionId;
            $this->seatId=$seatId;
            $this->occupied=$occupied;
        }

        public function getId(){
            return $this->id;
        }
        public function getSeatId(){
            return $this->seatId;
        }
        public function getFunctionId(){
            return $this->functionId;
        }
        public function getOccupied(){
            return $this->occupied;
        }

        public function setOccupied($occupied){
            $this->occupied=$occupied;
        }
    }
?>