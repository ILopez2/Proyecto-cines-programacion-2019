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
        // metodo por el cual pasa siempre nuestro framework
        public function Index($email=null,$password=null)
        {
            try{
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
                            $_SESSION['errorMje']='Datos incorrectos vuelva a intentarlo';
                        }
                    }
                }
                include_once(VIEWS.'/header.php');
                
                $daoDT=new DateTime();
                
                if($showView){
                            
                    $dao = new MovieApiController();
                    $daoF = new MovieFunctionDao();
                    $date=$daoDT->getActualDate();
                    $functions=$daoF->getAll();
                    $array = $dao->getLastMovies();
                    $genres=$dao->getAllGenres();
                    if(!empty($array)){
                        foreach($array as $k => $v) {
                            if(!$daoF->getForMovie($v->getID())) {
                                unset($array[$k]);
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
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }
        
        //metodo para cerrar una sesion
        public function logout(){
            $this->userController->logout();
            $this->Index();
        }
        //metodo para ingresar por primera vez 
        public function singUp($name,$birthdate,$email,$password,$role='2'){
            $this->userController->singUp($name,$birthdate,$email,$password,$role);
            $this->Index();
        }

    }

    
?>