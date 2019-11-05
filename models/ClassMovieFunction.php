<?php 
    use models/ClassMovie as Movie;
    class ClassMovieFunction {

        //ATRIBUTES

        private $movie;
        private $cinema;
        private $dateTime;
        private $language;
        private $cinemaRoom;
        private $id;

        //CONSTRUCTOR

        public function __constructor($movie,$cinema,$dateTime,$cinemaRoom,$language){
            $this->movie=$movie;
            $this->cinema=$cinema;
            $this->dateTime=$dateTime;
            $this->cinemaRoom=$cinemaRoom;
            $this->language=$language;
            $this->generateId($cinema->getName(),$movie->getId(),$dateTime,$cinemaRoom->getName());
        }


        //GETTERS

        public function getMovie(){
            return $this->movie;
        }
        public function getCinema(){
            return $this->cinema;
        }
        public function getDateTime(){
            return $this->dateTime;
        }
        public function getId(){
            return $this->id;
        }
        public function getCinemaRoom(){
            return $this->cinemaRoom;
        }
        public function getLanguage(){
            return $this->language;
        }

        //SETTERS

        public function setMovie($movie){
            $this->movie=$movie;
        }
        public function setCinema($cinema){
            $this->cinema=$cinema;
        }
        public function setDateTime($dateTime){
            $this->dateTime=$dateTime;
        }
        public function setCinemaRoom($cinemaRoom){
            $this->cinemaRoom=$cinemaRoom;
        }
        public function setLanguage($language){
            $this->language=$language;
        }

        //EXTRAS

        public function generateId($cinemaName,$movieId,$dateTime,$cinemaRoomName){
            $this->id=$cinemaName.$movieId.$dateTime.$cinemaRoomName;
        }
    }