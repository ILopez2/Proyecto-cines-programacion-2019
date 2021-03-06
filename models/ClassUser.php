<?php namespace models;

    class ClassUser {
        
        //ATRIBUTES
        private $id;
        private $name;
        private $birthdate;
        private $email;
        private $password;
        private $roleLevel;

        
        //CONSTRUCTOR
        public function __construct($id=null,$name,$birthdate,$email,$password,$role='2'){
            $this->id=$id;
            $this->name=$name;
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
        public function getEmail(){
            return $this->email;
        }
        public function getPassword(){
            return $this->password;
        }
        public function getRoleLevel(){
            return $this->roleLevel;
        }
        public function getID(){
            return $this->id;
        }
        //SETTERS
        
        public function setRoleLevel($roleLevel){
            $this->roleLevel=$roleLevel;
        }

    }