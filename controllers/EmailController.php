<?php   
    namespace controllers;

    use dao\UserDao as UserDao;
    use dao\MovieFunctionDao as MovieFunctionDao;
    use dao\CinemaDao as CinemaDao;
    use dao\MovieDao as MovieDao;

    class EmailController{

        private $from;

        public function __construct(){
            $from = "themoviepassoriginal@gmail.com";
        }

        public function sendTickets($qrs,$userId,$functionId){
            $userDao=new UserDao();
            $movieFunctionDao=new MovieFunctionDao();
            $cinemaDao=new CinemaDao();
            $movieDao=new MovieDao();
            $function=$movieFunctionDao->getForID($functionId);
            $cinema=$cinemaDao->getForID2($function->getCinema());
            $movie=$movieDao->getForID($function->getMovie());
            $user=$userDao->getForID2($userId);
            $userEmail=$user->getEmail();
            $cinemaName=$cinema->getName();
            $movieTitle=$movie->getTitle();
            $functionDate=$function->getDate();
            $functionTime=$function->getTime();
            $qrImages="";
            foreach($qrs as $qr){
                $qrImages.="\r\n<img src=".$qr."/>";
            }
            $to=$userEmail;
            $subject="MoviePass Entradas para ver ".$movieTitle;
            $headers="De: ".$this->from."\r\n";
            $message="Presente estos codigos qr en el cine ".$cinemaName." para poder acceder a la funcion de ".$movieTitle." el dia ".$functionDate." en el horario ".$functionTime."\r\n-Entradas: ".$qrImages;
            mail($to,$subject,$message, $headers);
        }
    }