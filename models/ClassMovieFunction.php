<?php 
    namespace models;
    use models\ClassMovie as Movie;
    class ClassMovieFunction {

        //ATRIBUTES

        private $movie;
        private $cinema;
        private $date;
        private $time;
        private $language;
        private $cinemaRoom;
        private $id;

        //CONSTRUCTOR

        public function __construct($movie,$cinema,$date,$time,$cinemaRoom,$language,$id=null){
            $this->movie=$movie;
            $this->cinema=$cinema;
            $this->date=$date;
            $this->time=$time;
            $this->cinemaRoom=$cinemaRoom;
            $this->language=$language;
            $this->id=$id;
        }


        //GETTERS

        public function getMovie(){
            return $this->movie;
        }
        public function getCinema(){
            return $this->cinema;
        }
        public function getDate(){
            return $this->date;
        }
        public function getTime(){
            return $this->time;
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

    }