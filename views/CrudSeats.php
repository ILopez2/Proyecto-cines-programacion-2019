<?php namespace controllers;
    
    use models\ClassSeat as Seat;
    
    use dao\CinemaRoomDao as CinemaRoomDao;
    use dao\MovieFuntionDao as MovieFuntionDao;
    use dao\UserDao as UserDao;

    use controllers\ViewsController as ViewsController;

    class TicketControllers{

        private $seatDao;
        private $view;
        
        public function __construct(){
            $this->ticketDao = new TicketDao();
            $this->view = new View();
        }
     
    
    
    
    }