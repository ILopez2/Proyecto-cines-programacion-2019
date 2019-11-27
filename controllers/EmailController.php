<?php   
    namespace controllers;

    use dao\UserDao as UserDao;
    use dao\MovieFunctionDao as MovieFunctionDao;
    use dao\CinemaDao as CinemaDao;
    use dao\MovieDao as MovieDao;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    class EmailController{

        private $from;
        private $pass;
        private $mailSender;

        public function __construct(){
            $this->from = "themoviepassoriginal@gmail.com";
            $this->pass= "moviepass123";
            $this->mailSender = new PHPMailer();
            $this->mailSender->IsSMTP();
            $this->mailSender->SMTPAuth = true;
            $this->mailSender->Host = "smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com
            $this->mailSender->Username =$this->from; // Correo completo a utilizar
            $this->mailSender->Password =$this->pass; // Contraseña
            $this->mailSender->Port = 587; // Puerto a utilizar
            //Con estas pocas líneas iniciamos una conexión con el SMTP. Lo que ahora deberíamos hacer, es configurar el mensaje a enviar, el //From, etc.
            // Desde donde enviamos (Para mostrar)
            $this->mailSender->From = $this->from; 
            $this->mailSender->FromName = "Movie Pass";
            $this->mailSender->IsHTML(true);
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
            $functionTime=$function->getTimeStart();
            $qrImages="";
            foreach($qrs as $qr){
                $qrImages.="<br><img src=".$qr."/>";
            }
            $to=$userEmail;
            $message="Presente estos codigos qr en el cine ".$cinemaName." para poder acceder a la funcion de ".$movieTitle." el dia ".$functionDate." en el horario ".$functionTime."<br>-Entradas: ".$qrImages;
            $subject="MoviePass Entradas para ver ".$movieTitle;
            $header="De: ".$this->from;
            $this->mailSender->Subject = $header;
            $this->mailSender->AddAddress($to);
            $this->mailSender->Body=$message;
            $this->mailSender->send();
        }
    }