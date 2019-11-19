<?php
    namespace models;
    class ClassSeat{
        private $id;
        private $number;
        private $cinemaRoomId;

        public function __construct($id=null,$number,$cinemaRoomId){
            $this->id=$id;
            $this->number=$number;
            $this->cinemaRoomId=$cinemaRoomId;
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

    }