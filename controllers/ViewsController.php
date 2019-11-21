<?php namespace controllers;
    
    //DAOS
    use dao\CinemaDao as CinemaDao;
    use dao\CinemaRoomDao as CinemaRoomDao;
    use dao\MovieFunctionDao as MovieFunctionDao;
    use dao\MovieGenreDao as MovieGenreDao;
    use dao\TicketDao as TicketDao;
    use dao\UserDao as UserDao;
    use dao\SeatDao as SeatDao;
    use dao\SeatXFunctionDao as SeatXFDao;
    
    //CONTROLLERS
    use controllers\HomeController as Home;
    use controllers\MovieApiController as MovieApiController;
    use controllers\SeatController as SeatCon;
    use controllers\DateTimeController as DateTime;
    use controllers\PurchaseController as PurchaseCon;

    //ESTA CONTROLADORA GESTIONA TODAS LAS VISTAS
    class ViewsController
    {
        public function __construct(){
            //VACIO.
        }
        
        //BUSQUEDA DE PELICULAS      
            //POR FECHA Y/O GENERO
        public function search($searchGenre=null,$searchDate=null){
            if(strpos($searchGenre, '-')!=false){
                $searchDate=$searchGenre;
                $searchGenre=null;
            }
            $dao = new MovieFunctionDao();
            $daoC=new CinemaDao();
            $daoCR= new CinemaRoomDao();
            $daoM = new MovieApiController();
            $genres=$daoM->getAllGenres();
            $allFunctions=$dao->getAll();
            $functions=$dao->getAll();
            $movies=array();
            if(!empty($searchDate)){
                if(!empty($allFunctions)){
                    $functions=array();
                    if(is_array($allFunctions)){
                        foreach($allFunctions as $function){
                            if($searchDate == $function->getDate()){
                                array_push($functions,$function);
                            }
                        }
                        foreach($functions as $fu){
                            $movie=$daoM->getMovieXid($fu->getMovie());
                            array_push($movies,$movie); 
                        } 
                    }
                    else{      
                        if($searchDate == $allFunctions->getDate()){
                            array_push($functions,$allFunctions);
                        }
                    }
                    foreach($functions as $fu){
                        $movie=$daoM->getMovieXid($fu->getMovie());
                        array_push($movies,$movie); 
                    } 
                    $movies=array_unique($movies,SORT_REGULAR );
                }
            }
            if(!empty($searchGenre)){
                if(!empty($functions)){
                    $movies=array();
                    if(is_array($functions)){
                        foreach($functions as $fu){
                            $movie=$daoM->getMovieXid($fu->getMovie());                    
                            foreach($movie->getGenres() as $gen){
                                if($gen == $searchGenre){
                                    array_push($movies,$movie);
                                }
                            }         
                        }
                    }
                    else{
                        $movie=$daoM->getMovieXid($functions->getMovie(),ESP);
                        foreach($movie->getGenres() as $gen){
                            if($gen == $searchGenre){
                                array_push($movies,$movie);
                            }  
                        }  
                    }
                    $movies=array_unique($movies,SORT_REGULAR );
                }
            }    
            if(empty($movies)){
                $home= new Home();
                if(empty($searchGenre) && empty($searchDate)){
                    $_SESSION['errorMje'] = "Seleccione alguna de las opciones de busqueda";
                }else{
                    if(empty($searchGenre)){
                        $_SESSION['errorMje'] = 'No hay funciones para la fecha '.$searchDate;
                    }
                    else{
                        if(empty($searchDate)){
                            var_dump($searchGenre);
                            $_SESSION['errorMje'] = 'No hay peliculas del genero '.$daoM->getGenreForID($searchGenre)->getName()." en cartelera";
                        }
                        else{
                            $_SESSION['errorMje'] = "No hay funciones de peliculas del genero ".$daoM->getGenreForID($searchGenre)->getName()." para la fecha ".$searchDate;
                        }
                    }
                }

                $home->Index();
            }
            else{
                include_once(VIEWS.'/header.php');
                include_once(VIEWS.'/nav.php');
                include_once(VIEWS.'/Search.php');
                include_once(VIEWS.'/footer.php');
            }        
        }
        //VER 
            //GANANCIAS DE UN CINE
        public function viewCinemaEarnings($cinemaId){
            $purchaseController= new PurchaseCon();
            $purchases= $purchaseController->getForCinema($cinemaId);
            if(!empty($purchases)){
                $daoCinema=new CinemaDao();
                $cinemaName=$daoCinema->getForID($cinemaId)->getName();
                $totalEarnings=0;
                foreach($purchases as $purchase){
                    $totalEarnings+=$purchase->getTotal();
                }
                include_once(VIEWS.'/header.php');
                include_once(VIEWS.'/nav.php');
                include_once(VIEWS.'/CinemaEarnings.php');
                include_once(VIEWS.'/footer.php');
            }
            else{
                $_SESSION['errorMje'] = "Ese cine no realizo ninguna venta aun";
                $this->admCinema();
            }      
        }
            //FUNCIONES DE UNA PELICULA
        public function viewFunctions($id){
            $dao = new MovieFunctionDao();
            $daoC=new CinemaDao();
            $daoM = new MovieApiController();
            $daoRM= new CinemaRoomDao();
            $daoMG= new MovieGenreDao();
            $daoDT=new DateTime();
            $date=$daoDT->getActualDate();
            $genres=$daoM->getAllGenres();
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
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/MovieFunction.php');
            include_once(VIEWS.'/footer.php');
        }
            //FUNCIONES DE UNA SALA
        public function viewCinemaRoomFunctions($cinemaRoomId){
            $search = new MovieApiController();
            $genres=$search->getAllGenres();
            $functionDao= new MovieFunctionDao();
            $functions=$functionDao->getForCinemaRoom($cinemaRoomId);
            $roomDao= new CinemaRoomDao();
            $room=$roomDao->getForID($cinemaRoomId);
            if(!empty($functions)){        
            $daoMAC= new MovieApiController();
            $cinemaRoomName=$room->getName(); 
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/CinemaRoomFunctions.php');
            include_once(VIEWS.'/footer.php');
            }
            else{
                $_SESSION["errorMje"]="Esa sala no tiene funciones";
                $this->admRooms($room->getCinemaId());
            }
        }   
            //ASIENTOS DE UNA FUNCION
        public function viewFunctionSeats($functionId){
            $search = new MovieApiController();
            $genres=$search->getAllGenres();
            $seatController=new SeatCon();
            $seatDao=new SeatDao();
            $seatsXfunction= $seatController->getForFunction($functionId);
            $i=0;
            $ticketsSold=0;
            $ticketsNotSold=0;
            $seatNumberOccupied=array();
            if(!empty($seatsXfunction)){
                if(is_array($seatsXfunction)){
                    foreach($seatsXfunction as $seatXf){
                        $seat=$seatDao->getForID($seatXf->getSeatId());
                        $seatNumber=$seat->getNumber();
                        $seatNumberOccupied[$i]["seatNumber"]=$seatNumber;
                        $seatNumberOccupied[$i]["occupied"]=$seatXf->getOccupied();
                        if($seatNumberOccupied[$i]["occupied"]==true){
                            $ticketsSold++;
                        }
                        else{
                            $ticketsNotSold++;
                        }
                        $i++;
                    }
                }
                else{
                    $seat=$seatDao->getForID($seatsXfunction->getSeatId());
                    $seatNumber=$seat->getNumber();
                    array_push($seatNumberOccupied[$i]["seatNumber"],$seatNumber);
                    array_push($seatNumberOccupied[$i]["occupied"],$seatsXfunction->getOccupied());
                    if($seatNumberOccupied[$i]["occupied"]==true){
                        $ticketsSold++;
                    }
                    else{
                        $ticketsNotSold++;
                    }
                }
            }   
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/CrudSeats.php');
            include_once(VIEWS.'/footer.php');
        }   
            //ELEGIR ASIENTOS
        public function selectSeats($functionId){
            $search = new MovieApiController();
            $genres=$search->getAllGenres();
            $seatController=new SeatCon();
            $seats= $seatController->getForFunction($functionId);
            include_once(VIEWS.'/header.php');
            include_once(VIEWS.'/nav.php');
            include_once(VIEWS.'/SelectSeat.php');
            include_once(VIEWS.'/footer.php');
        }
            //COMPRAR ENTRADAS
        public function buyTickets($functionId,$seatsXFids=null){
            if($seatsXFids!=null){
                $seatController=new SeatCon();
                $seatDao=new SeatDao();
                $daoMovieFunction = new MovieFunctionDao();
                $daoCinemaRoom = new CinemaRoomDao();
                $daoTicket = new TicketDao();
                $daoCinema = new CinemaDao();
                $daoUser = new UserDao();
                $daoM = new MovieApiController();
                $dateC = new DateTimeController();
                $day = $dateC->getActualDay();
                $quantityTickets=0;
                $seatsXfunction=$seatController->getFromIds($seatsXFids);
                $seats=array();
                foreach($seatsXfunction as $seatXF){
                    $seat=$seatDao->getForID($seatXF->getSeatId());
                    array_push($seats,$seat);
                    $quantityTickets++;
                }
                $function=$daoMovieFunction->getForID($functionId);       
                $fDate=$function->getDate();
                $fTime=$function->getTime();
                $room=$daoCinemaRoom->getForID($function->getCinemaRoom());
                $roomName=$room->getName();   
                $cinema=$daoCinema->getForID2($function->getCinema());
                $cinemaName=$cinema->getName();
                $totalPrice = ($cinema->getTicketCost())*($quantityTickets);
                $discount=0;
                $flagDiscount=false;
                if(($quantityTickets>=2) && ($day == 'Thursday' || 'Wednesday')){
                    $discount=0.25;
                    $flagDiscount=true;
                    $totalPrice=$totalPrice-$totalPrice*$discount;
                }
                $user = $daoUser->getForID($_SESSION['userLogedIn']->getEmail());
                $userId=$user->getID();
                $movie = $daoM->getMovieXid($function->getMovie());
                $poster= $daoM->getMoviePoster($movie->getPosterPath());          
                include_once(VIEWS.'/header.php');
                include_once(VIEWS.'/nav.php');
                include_once(VIEWS.'/BuyTicket.php');
                include_once(VIEWS.'/footer.php');
            }           
            else{
                $_SESSION["errorMje"]="No selecciono ningun asiento";
                $this->selectSeats($functionId);
            }
        }
        //ADMINISTRACION

            //USUARIOS
        public function admUsers(){
            $search = new MovieApiController();
            $genres=$search->getAllGenres();
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
            $genres=$search->getAllGenres();
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
            $genres=$search->getAllGenres();
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
            $genres=$daoMAC->getAllGenres();
            $cines=$cinemaDao->getAll();
            $array = $daoMAC->getLastMovies();
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