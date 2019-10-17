//checkSession,login($user,$pass)
<?php namespace controllers;
use DAO\UserDAO as UserDAO;
class UserController {
    private $userDAO;

    public function __construct(){
        $this->userDAO= new UserDAO();
    }
    //Chekea que exista un usuario logeado
    public function checkSession(){
        $rta=false;
        if(isset($_SESSION['loggedUser'])){
            $rta=true;
        }
        return $rta;
    }

    public function login($email,$pass){
        //tengo que comparar el usuario que viene por parametro(POST) con el que me tengo que traer con get de USERDAO
        $users=$this->userDAO->getAll();
        foreach($users as $user){
            if($user->getEmail() == $email && $user->getPass() == $pass){
                $_SESSION['loggedEmail']=
                $_SESSION['loggedPass']=
            }
        }
    }
}