<?php namespace controllers;
    
    use models\ClassUser as User;
    use daojson\JsonUser as JsonUser;
    use controllers\ViewsController as ViewController;
    class UserController{
    
        private $userDAO;
        private $view;

        public function __construct(){
            //$this->userDAO= new UserDAO();
            // JSON 
            $this->userDAO = new JsonUser();
            $this->view = new ViewController();
        }
        public function checkSession(){
            //Chekea que exista un usuario logeado
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
                    $_SESSION['loggedRole'] = $user->getRoleLevel();
                    $rta=true;
                }
            }
            return $rta;
        }

        public function logout(){
            //elimina el usuario de la session
            unset($_SESSION['loggedEmail']);
            unset($_SESSION['loggedPass']);
        }

        public function singUp($name,$birthdate,$nationality,$email,$password,$role='Common'){
            //registrar nuevo usario
            $newUser = new User($name,$birthdate,$nationality,$email,$password,$role);
            $this->userDAO->add($newUser);
        }
        
        public function add($name,$birthdate,$nationality,$email,$password){
            //agrega un usuario al dao
            $user = new User($name,$birthdate,$nationality,$email,$password);
            $this->userDAO->add($user);
            $this->view->admUsers();
        }

        public function delete($email){
            //borra un user
            $this->userDAO->delete($email);
            $this->view->admUsers();
        }

        public function edit($name,$birthdate,$nationality,$password,$id,$role){
            //edita uno o varios campos
            $auxUser = new User($name,$birthdate,$nationality,$id,$password,$role);
            var_dump($auxUser);
            $this->userDAO->modify($auxUser,$id);
            $this->view->admUsers();

        }

        public function setRole($email,$role){
            //vuelve a un usuario admin
            
            $this->userDAO->setRole($email,$role);
            
            $this->view->admUsers();
        }
}