<?php namespace controllers;
    
    use models\ClassTicket as ClassTicket;
    
    use dao\TicketDao as TicketDao;
    use dao\CinemaDao as CinemaDao;
    use dao\CinemaRoomDao as CinemaRoomDao;
    use dao\MovieFuntionDao as MovieFuntionDao;
    use dao\UserDao as UserDao;

    use controllers\ViewsController as ViewsController;

    class TicketControllers{

        private $ticketDao;
        private $view;
        
        public function __construct(){
            $this->ticketDao = new TicketDao();
            $this->view = new View();
        }

        public function add($id,$cinemaid,$cinemaroomid,$price,$userid,$date,$time,$qr,$idmovie){
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                if($this->cinemaDao->getForID($name)!=null){
                $ticket = new ClassTicket($id,$cinemaid,$cinemaroomid,$price,$userid,$date,$time,$qr,$idmovie);
                //falta resolver el tema de las salas, por el momento no trabajo con ellas solo se crea un array vacio.
                $this->ticketDao->add($ticket);
                $_SESSION['successMje'] = 'Ticket agregado con éxito';
                $this->view->admTicket();
                }
                else{
                    $_SESSION['errorMje'] = 'Ya existe un ticket';
                    $this->view->admTicket();
                }
            }
        }
    }