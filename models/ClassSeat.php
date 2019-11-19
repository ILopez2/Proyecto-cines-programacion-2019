<?php
    namespace models;
    class ClassSeat{
        private $id;
        private $number;
        private $cinemaRoomId;
        private $occupied;

        public function __constructor($id=null,$number,$cinemaRoomId,$occupied=false){
            $this->id=$id;
            $this->number=$number;
            $this->cinemaRoomId=$cinemaRoomId;
            $this->occupied=$occupied;
        }

        public function getId(){
            return $this->id;
        }
        public function getNumber(){
            return $this->number;
        }
        public function getCinemaRoomId(){
            return $this->cinemaRoomId;
        }
        public function getOccupied(){
            return $this->occupied;
        }

        public function setOccupied($occupied){
            $this->occupied=$occupied;
        }
    }