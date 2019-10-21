<?php
    namespace models;
    
    class ClassMovie{
        private $id; //ID DE LA PELICULA
        private $title; //TITULO DE LA PELICULA
        private $relaseDate; //FECHA DE LANZAMIENTO DE LA PELICULA
        private $adult; //BOOLEANO QUE INDICA SI LA PELICULA ES PARA ADULTOS O NO
        private $overview; //SINOPSIS DE LA PELICULA
        private $posterPath; //RUTA DEL ARCHIVO 

        public function __construct($id,$title,$relaseDate,$adult,$overview,$imagePatposterPathh){
            $this->id=$id;
            $this->title=$title;
            $this->relaseDate=$relaseDate;
            $this->adult=$adult;
            $this->overview=$overview;
            $this->posterPath=$posterPath;
        }

        public function getId(){
            return $this->id;
        }
        public function getTitle(){
            return $this->title;
        }
        public function getRelaseDate(){
            return $this->relaseDate;
        }
        public function getAdult(){
            return $this->adult;
        }
        public function getOverview(){
            return $this->overview;
        }
        public function getPosterPath(){
            return $this->posterPath;
        }
    }
?>