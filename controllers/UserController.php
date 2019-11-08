<?php namespace controllers;
    
    use models\ClassUser as User;
    use daojson\JsonUser as JsonUser;
    use dao\UserDao as UserDao;
    use controllers\ViewsController as ViewController;
    class UserController{
    
        private $userDAO;
        private $view;

        public function __construct(){
            //$this->userDAO= new UserDAO();
            // JSON 
            $this->userDAO = new UserDao();
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

        public function singUp($name,$birthdate,$email,$password,$role='Common'){
            //registrar nuevo usario
            $newUser = new User($name,$birthdate,$email,$password,$role);
            if(!$this->checkUserExists($newUser->getEmail())){
                $this->userDAO->add($newUser);
                $_SESSION['successMje'] = 'Usuario agregado con éxito';
            }else{
                $_SESSION['errorMje']='El <strong>email</strong> ingresado ya esta en uso.';
            }
        }
        public function checkUserExists($email){
            $userList = $this->userDAO->getAll();
            $rta=false;
            foreach($userList as $user){
                if($user->getEmail() == $email){
                    $rta=true;
                }
            }
            return $rta;
        }
        public function add($name,$birthdate,$email,$password,$role){
            //agrega un usuario al dao
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                $newUser = new User($name,$birthdate,$email,$password,$role);
                if(!$this->checkUserExists($newUser->getEmail())){
                    $this->userDAO->add($newUser);
                    $_SESSION['successMje'] = 'Usuario agregado con éxito';
                }else{
                    $_SESSION['errorMje']='El <strong>email</strong> ingresado ya esta en uso.';
                }
                $this->view->admUsers();
            }
        }

        public function delete($email){
            //borra un user
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
               if($this->userDAO->delete($email)){
                $_SESSION['successMje'] = 'Usuario borrado con éxito';
               }
                $this->view->admUsers();
            }
        }

        public function edit($email,$name,$birthdate,$password,$role){
            //edita uno o varios campos
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                $auxUser = new User($name,$birthdate,$email,$password,$role);
                if($this->userDAO->edit($auxUser)){
                    $_SESSION['successMje'] = 'Usuario editado con éxito';
                }
                $this->view->admUsers();
            }
        }

        public function setRole($email,$role){
            //vuelve a un usuario admin
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                if($this->userDAO->setRole($email,$role)){
                    $_SESSION['successMje'] = 'Rol cambiado con éxito';
                }
                $this->view->admUsers();
            }
        }
}