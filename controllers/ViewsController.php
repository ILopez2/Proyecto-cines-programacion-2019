<?php namespace controllers;
    //esta controladora se encargara de administrar todas las vistas necesarias
    use dao\CinemaDao as CinemaDao;
    use dao\MovieFunctionDao as MovieFunctionDao;
    use dao\CinemaRoomDao as CinemaRoomDao;
    use dao\UserDao as UserDao;
    use dao\TicketDao as TicketDao;
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

        public function searchForGen($searchG){ 
            $daoMovie = new MovieApiController();
            $daoFunction= new MovieFunctionDao();
            $genres=$daoMovie->getAllGenres(ESP);
            $functions=$daoFunction->getAll();
            $result=array();
            if(is_array($functions)){
                foreach($functions as $fu){
                    $movie=$daoMovie->getMovieXid($fu->getMovie());
                    array_push($result,$movie);               
                }
                $result=array_unique($result,SORT_REGULAR );
            }
            else{
                $movie=$daoMovie->getMovieXid($functions->getMovie(),ESP);
                array_push($result,$movie);
            }
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/SearchGen.php');
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
            $daoRM= new CinemaRoomDao();
            $genres=$daoM->getAllGenres(ESP);
            $cinemasFunction=$dao->getForMovie($id);
            $movie = $daoM->getMovieXid($id);
            $title=$movie->getTitle();
            $poster= $daoM->getMoviePoster($movie->getPosterPath());
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/MovieFunction.php');
            include_once(VIEWS.'/footer.php');
        }
        public function searchForDate($searchF){
            $dao = new MovieFunctionDao();
            $daoC=new CinemaDao();
            $daoM = new MovieApiController();
            $genres=$daoM->getAllGenres(ESP);
            $cinemasFunction=$dao->getAll();
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/SearchDate.php');
            include_once(VIEWS.'/footer.php');
        }
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