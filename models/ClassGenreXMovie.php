<?php
    namespace models;

    class ClassGenreXMovie {
        private $idGenre;
        private $idMovie;

        public function __construct($idGenre,$idMovie){
            $this->idGenre=$idGenre;
            $this->idMovie=$idMovie;
        }
        

        public function getIdGenre(){
            return $this->idGenre;
        }
        public function getIdMovie(){
            return $this->idMovie;
        }
    }