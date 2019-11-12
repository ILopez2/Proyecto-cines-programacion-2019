<?php namespace controllers;
    //esta controladora se encargara de administrar todas las vistas necesarias
    use dao\CinemaDao as CinemaDao;
    use dao\MovieFunctionDao as MovieFunctionDao;
    use dao\CinemaRoomDao as CinemaRoomDao;
    use dao\UserDao as UserDao;
    use controllers\MovieApiController as MovieApiController;
    
    class ViewsController
    {
        public function __construct(){
            //I'm the fucking construct.
        }
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

        public function searchGen($searchG){ 
            
            $daoMovie = new MovieApiController();
            $daoFunction= new MovieFunctionDao();
            $genres=$daoMovie->getAllGenres(ESP);
            $functions=$daoFunction->getAll();
            $result=array();
            foreach($functions as $fu){
                $movie=$daoMovie->getMovieXid($fu->getMovie(),ESP);
                array_push($result,$movie);
            }
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/SearchResult.php');
            include_once(VIEWS.'/footer.php');
        }
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
        public function viewFunctions($id){
            $dao = new MovieFunctionDao();
            $daoC=new CinemaDao();
            $daoM = new MovieApiController();
            $genres=$daoM->getAllGenres(ESP);
            $cinemasFunction=$dao->getAll();
            $movie = $daoM->getMovieXid($id,ESP);
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/MovieFunction.php');
            include_once(VIEWS.'/footer.php');
        }
        public function searchFunctions($searchF){
            $dao = new MovieFunctionDao();
            $daoC=new CinemaDao();
            $daoM = new MovieApiController();
            $genres=$daoM->getAllGenres(ESP);
            $cinemasFunction=$dao->getAll();
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/SearchFunction.php');
            include_once(VIEWS.'/footer.php');
        }
    }