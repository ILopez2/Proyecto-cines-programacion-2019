<?php namespace controllers;
    
    use controllers\UserController as UserController;
    use controllers\MovieApiController as MovieApiController;
    use controllers\DateTimeController as DateTime;
    use dao\MovieFunctionDao as MovieFunctionDao;
    use dao\CinemaDao as CinemaDao;
    class HomeController
    {
        private $userController;
        
        public function __construct(){
            $this->userController= new UserController();
        }

        public function Index($email=null,$password=null)
        {
            $daoDT=new DateTime();
            //checksession y login
            $showView=false; //se vuelve verdadero solo si hay un user en session
            
            if($user = $this->userController->checkSession()){
                $showView=true;
            }
            else{
                if(isset($email)) {
                    if($user=$this->userController->login($email,$password)){
                        $showView=true;
                    }
                    else {
                        $alert='Datos incorrectos vuelva a intentarlo';
                    }
                }
            }
            include_once(VIEWS.'/header.php');
            
            if($showView){
                         
                $dao = new MovieApiController();
                $daoF = new MovieFunctionDao();
                $daoDT=new DateTime();
                $date=$dao->getActualDate();
                $functions=$daoF->getAll();
                $array = $dao->getLastMovies();
                $genres=$dao->getAllGenres();
                if(!empty($array)){
                    foreach($array as $k => $v) {
                        if($v->getDate()>=$date){
                            if(!$daoF->getForMovie($v->getID())) {
                                unset($array[$k]);
                            }
                        }           
                    }
                }
                include_once(VIEWS.'/nav.php');
                include_once(VIEWS.'/home.php');
            }
            else{
                $date=$daoDT->getActualDate();
                include_once(VIEWS.'/login.php');
            }
            
            include_once(VIEWS.'/footer.php');
        }
        
        
        public function logout(){
            $this->userController->logout();
            $this->Index();
        }

        public function singUp($name,$birthdate,$email,$password,$role='2'){
            $this->userController->singUp($name,$birthdate,$email,$password,$role);
            $this->Index();
        }

    }

    
?>