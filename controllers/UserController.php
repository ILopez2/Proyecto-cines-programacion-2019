<?php namespace controllers;
    
    //use DAO\UserDAO as UserDAO;
    use daojson\JsonUser as JsonUser;
    //use controllers\HomeController as Home;
    class UserController{
    
        private $userDAO;
        //private $home;

        public function __construct(){
            //$this->userDAO= new UserDAO();
            // JSON 
            $this->userDAO = new JsonUser();
            //$this->home = new Home();
        }
        //Chekea que exista un usuario logeado
        public function checkSession(){
            $rta=false;
            if(isset($_SESSION['loggedEmail'])){
                $rta=true;
            }
            return $rta;
        }

        public function login($email,$pass){
            //tengo que comparar el usuario que viene por parametro(POST) con el que me tengo que traer con get de USERDAO
            $rta=false;
            $users=$this->userDAO->getAll();
            foreach($users as $user){
                if(($user->getEmail() == $email) && ($user->getPassword() == $pass)){
                    $_SESSION['loggedEmail'] = $user->getEmail();
                    $_SESSION['loggedPass'] = $user->getPassword();
                    $rta=true;
                }
            }
            return $rta;
        }

        public function logout(){
            unset($_SESSION['loggedEmail']);
            unset($_SESSION['loggedPass']);
        }
        
}