<?php namespace controllers;
    
    use controllers\UserController as UserController;
    
    class HomeController
    {
        private $userController;

        public function __construct(){
            $this->userController= new UserController();
        }
        public function Index($user=null,$pass=null)
        {
            //checksession y login
            $showView=false; //se vuelve verdadero solo si hay un user en session
            if($user=$this->userController->checkSession()){
                $showView=true;
            }
            else{
                if(isset($user)){
                    if($user=$this->userController->login($user,$pass)){
                        $showView=true;
                    }
                    else{
                        $alert='Datos incorrectos vuelva a intentarlo';
                    }
                }
            }
            include_once(VIEWS.'/header.php');
            
            if($showView){
                include_once(VIEWS.'/home.php');
            }
            else{
                include_once(VIEWS.'/login.php');
            }
        }        
    }
?>