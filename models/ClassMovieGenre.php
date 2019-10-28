<?php
    namespace models;

    class ClassMovieGenre{
        private $name;
        private $id;

        public function __construct($name,$id){
            $this->name=$name;
            $this->id=$id;
        }

        public function getName(){
            return $this->name;
        }
        public function getId(){
            return $this->id;
        }

        public function setName($name){
            $this->name=$name;
        }
        public function setId($id){
            $this->id=$id;
        }
        
    }




?>