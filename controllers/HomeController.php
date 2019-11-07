<?php namespace controllers;
    
    use controllers\UserController as UserController;
    
    class HomeController
    {
        private $userController;
        
        public function __construct(){
            $this->userController= new UserController();
        }

        public function Index($email=null,$password=null)
        {
            //checksession y login
            $showView=false; //se vuelve verdadero solo si hay un user en session
            if($user=$this->userController->checkSession()){
                $showView=true;
            }
            else{
                if(isset($email)){
                    if($user=$this->userController->login($email,$password)){
                        $showView=true;
                    }
                    else{
                        $alert='Datos incorrectos vuelva a intentarlo';
                    }
                }
            }
            include_once(VIEWS.'/header.php');
            
            if($showView){
                include_once(VIEWS.'/nav.php');
                include_once(VIEWS.'/home.php');
            }
            else{
               
                include_once(VIEWS.'/login.php');
            }
            
            include_once(VIEWS.'/footer.php');
        }
        
        
        public function logout(){
            $this->userController->logout();
            $this->Index();
        }

        public function singUp($name,$birthdate,$nationality,$email,$password,$role='2'){
            $this->userController->singUp($name,$birthdate,$nationality,$email,$password,$role);
            $this->Index();
        }
        public function admCinema(){
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/CrudCinema.php');
            include_once(VIEWS.'/footer.php');
        }



    }

    
?>