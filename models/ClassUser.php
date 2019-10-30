<?php namespace models;

    class ClassUser {
        
        //ATRIBUTES
        private $name;
        private $birthdate;
        private $nationality;
        private $email;
        private $password;
        private $roleLevel;
        
        //CONSTRUCTOR
        public function __construct($name,$birthdate,$nationality,$email,$password,$role='Common'){
            $this->name=$name;
            $this->nationality=$nationality;
            $this->birthdate=$birthdate;
            $this->email=$email;
            $this->password=$password;
            $this->roleLevel= $role;
        }
        
        //GETTERS
        public function getName(){
            return $this->name;
        }
        public function getBirthdate(){
            return $this->birthdate;
        }
        public function getNationality(){
            return $this->nationality;
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