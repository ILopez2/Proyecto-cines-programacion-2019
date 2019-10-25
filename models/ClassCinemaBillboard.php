<?php namespace models;
    class CinemaBillboard{
        
        // ATRIBUTES
        private $movies;
        
        // CONSTRUCTOR
        public function __construct(){
            $this->movies=array()
        }
        // GETTERS 
        
        public function getMovies(){
            return $this->movies;
        }
        // EXTRAS
        public function deleteMovie($movieId){
            $arrayToSave=array();
            foreach($this->movies as $movie){
                if($movie->getId != $movieId){
                    array_push($arrayToSave,$movie);
                }
            }
            $this->movies=$arrayToSave;
        }
        public function addMovie($movie){
            array_push($this->movies, $movie);
        }
    }