<?php namespace controllers;
    //esta controladora se encargara de administrar todas las vistas necesarias
    use dao\CinemaDao as CinemaDao;
    use dao\MovieFunctionDao as MovieFunctionDao;
    use dao\MovieGenreDao as MovieGenreDao;
    use dao\CinemaRoomDao as CinemaRoomDao;
    use dao\UserDao as UserDao;
    use dao\TicketDao as TicketDao;
    use controllers\MovieApiController as MovieApiController;
    use controllers\HomeController as Home;
    class ViewsController
    {
        public function __construct(){
            //VACIO.
        }
        
        //BUSQUEDA DE PELICULAS
            //POR GENERO
        public function searchForGen($searchG){ 
            $daoMovie = new MovieApiController();
            $daoMovieGenres= new MovieGenreDao();
            $daoFunction= new MovieFunctionDao();
            $genres=$daoMovie->getAllGenres(ESP);
            $functions=$daoFunction->getAll();
            $movies=array();
            if(!empty($functions)){
                if(is_array($functions)){
                    foreach($functions as $fu){
                        $movie=$daoMovie->getMovieXid($fu->getMovie());                    
                        foreach($movie->getGenres() as $gen){
                            if($gen == $searchG){
                                array_push($movies,$movie);
                            }
                        }           
                    }
                }
                else{
                    $movie=$daoMovie->getMovieXid($functions->getMovie(),ESP);
                    foreach($movie->getGenres() as $gen){
                        if($gen == $searchG){
                            array_push($movies,$movie);
                        }
                    }     
                }
                $movies=array_unique($movies,SORT_REGULAR );
            }
            if(empty($movies)){
                $home= new Home();
                $_SESSION['errorMje'] = 'No hay peliculas del genero '.$daoMovieGenres->getForID($searchG)->getName()." en cartelera";
                $home->Index();
            }
            else{
                include_once(VIEWS.'/header.php');
                include_once(VIEWS.'/nav.php');
                include_once(VIEWS.'/SearchGen.php');
                include_once(VIEWS.'/footer.php');
            }
            
        }   
            //POR FECHA
        public function searchForDate($searchF){
            $dao = new MovieFunctionDao();
            $daoC=new CinemaDao();
            $daoM = new MovieApiController();
            $genres=$daoM->getAllGenres(ESP);
            $allFunctions=$dao->getAll();
            $cinemasFunction=array();
            if(is_array($allFunctions)){
                foreach($allFunctions as $function){
                    if($searchF == $function->getDate()){
                        array_push($cinemasFunction,$function);
                    }
                }
            }
            else{      
                if($searchF == $allFunctions->getDate()){
                    array_push($cinemasFunction,$allFunctions);
                }
            } 
            if(empty($cinemasFunction)){
                $home= new Home();
                $_SESSION['errorMje'] = 'No hay funciones para la fecha '.$searchF;
                $home->Index();
            }
            else{
                include_once(VIEWS.'/header.php');
                include_once(VIEWS.'/nav.php');
                include_once(VIEWS.'/SearchDate.php');
                include_once(VIEWS.'/footer.php');
            }        
        }
            //VER FUNCIONES DE UNA PELICULA
        public function viewFunctions($id){
            $dao = new MovieFunctionDao();
            $daoC=new CinemaDao();
            $daoM = new MovieApiController();
            $daoRM= new CinemaRoomDao();
            $daoMG= new MovieGenreDao();
            $genres=$daoM->getAllGenres(ESP);
            $cinemasFunction=$dao->getForMovie($id);
            $movie = $daoM->getMovieXid($id);
            $title=$movie->getTitle();
            $poster= $daoM->getMoviePoster($movie->getPosterPath());
            $overView=$movie->getOverview();
            $genrsId=$movie->getGenres();
            $duration=$movie->getDuration();
            $genrs=array();
            foreach($genrsId as $genId){
                array_push($genrs,$daoMG->getForID($genId)->getName());
            }
            $adult=$movie->getAdult();
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/MovieFunction.php');
            include_once(VIEWS.'/footer.php');
        }

        //ADMINISTRACION

            //USUARIOS
        public function admUsers(){
            $search = new MovieApiController();
            $genres=$search->getAllGenres(ESP);
            $dao = new UserDao();
            $users=$dao->getAll();
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/CrudUsers.php');
            include_once(VIEWS.'/footer.php');
        }

            //CINES
        public function admCinema(){
            $search = new MovieApiController();
            $genres=$search->getAllGenres(ESP);
            $dao = new CinemaDao();
            $cinemas=$dao->getAll();
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/CrudCinema.php');
            include_once(VIEWS.'/footer.php');
        }

            //SALAS DE CINE
        public function admRooms($cinemaId){
            $search = new MovieApiController();
            $genres=$search->getAllGenres(ESP);
            $dao = new CinemaRoomDao();
            $rooms = $dao->getForCinema($cinemaId);
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/CrudRooms.php');
            include_once(VIEWS.'/footer.php');
        }

            //FUNCIONES DE PELICULAS
        public function admFunctions($cinemaName){
            $dao = new MovieFunctionDao();
            $cinemaDao=new CinemaDao();
            $roomDao=new CinemaRoomDao();
            $daoMAC = new MovieApiController();
            $genres=$daoMAC->getAllGenres(ESP);
            $cines=$cinemaDao->getAll();
            $array = $daoMAC->getLastMovies(ESP);
            $cine=$cinemaDao->getForID($cinemaName);
            $functions=$dao->getForCinema($cine->getId());
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/CrudMovieFunction.php');
            include_once(VIEWS.'/footer.php');
        }

            //ENTRADAS DE CINE       
        public function admTickets(){
            $daoTicket = new TicketDao();
            $daoCinema=new CinemaDao();
            $daoCinemaRoom = new CinemaRoomDao();
            $daoMovieFunction = new MovieFunctionDao();
            $daoUsers = new UserDao();
            $users=$daoUsers->getAll();
            $cinemas=$daoCinema->getAll();
            $cinemaRooms=$daoCinemaRoom->getAll();
            $functions=$daoFunction->getAll();
            $tickets=$daoTicket->getAll();
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/CrudTicket.php');
            include_once(VIEWS.'/footer.php');
        }
    }