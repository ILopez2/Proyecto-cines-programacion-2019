<?php
    namespace models;

    class ClassUser {
        
        //ATRIBUTES
        private $name;
        private $birthDate;
        private $nationality;
        private $email;
        private $password;
        private $roleLevel;
        
        //CONSTRUCTOR
        public function __construct($name,$birthDate,$nationality,$email,$password){
            $this->name=$name;
            $this->nationality=$nationality;
            $this->email=$email;
            $this->password=$password;
            $this->roleLevel= "Common";
        }
        
        //GETTERS
        public function getName(){
            return $this->name;
        }
        public function getBirthDate(){
            return $this->birthDate;
        }
        public function getNationality(){
            return $this->name;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getPassword(){
            return $this->password;
        }
        public function getRoleLevel(){
            return $this->roleLevel;
        }
        
        //SETTERS
        
        public function setRoleLevel($roleLevel){
            $this->roleLevel=$roleLevel;
        }

    }