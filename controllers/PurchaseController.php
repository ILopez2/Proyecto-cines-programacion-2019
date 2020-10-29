<?php namespace controllers;

    use dao\MovieFunctionDao as MovieFunctionDao;
    use dao\PurchaseDao as PurchaseDao;
    use dao\TicketDao as TicketDao;
    use dao\SeatXFunctionDao as SeatXFDao;

    use controllers\ViewsController as ViewsController;
    use controllers\QrController as QrController;
    use controllers\HomeController as Home;
    use controllers\SeatController as SeatController;
    use controllers\EmailController as EmailController;

    use models\ClassPurchase as ClassPurchase;
    use models\ClassTicket as ClassTicket;
    
    

    class PurchaseController{
        
        private $purchaseDao;
        private $view;

        public function __construct(){
            $this->view = new ViewsController();
            $this->purchaseDao = new PurchaseDao();
        }
        // creo un registro de una compra
        public function createPurchase($quantityTickets,$totalPrice,$userId,$discount,$functionId,$seatsXFunctionString){
            try{
                $seatController= new SeatController();
                $seatXFunctionDao= new SeatXFDao();
                $qrController=new QrController();
                $emailController= new EmailController();
                $home=new Home();
                $daoTicket = new TicketDao();
                $newPurchase = new ClassPurchase($quantityTickets,$totalPrice,$userId,$discount);
                $this->purchaseDao->add($newPurchase);
                $ids_array = $this->purchaseDao->getLastIds();
                $purchaseId = $ids_array[0][0];
                $seatsXFunctionIds = explode("-", $seatsXFunctionString);
                $seatsXFunctionArray=array();
                $qrsTomail=array();
                foreach($seatsXFunctionIds as $Id){
                    array_push($seatsXFunctionArray,$seatXFunctionDao->getForID($Id));
                }
                $i=0;
                while($i < $quantityTickets){    
                    $message="-Asiento:".$seatsXFunctionArray[$i]->getSeatId()."-Funcion:".$functionId."-Compra:".$purchaseId;
                    $QRlink=$qrController->generateQrCode($message);
                    array_push($qrsTomail,$QRlink);
                    $newTicket = new ClassTicket($functionId,$userId,$purchaseId,$seatsXFunctionArray[$i]->getSeatId(),$QRlink);
                    $daoTicket->add($newTicket);  
                    $seatController->occupySeat($seatsXFunctionArray[$i]->getId());   
                    $i++;
                }
                $emailController->sendTickets($qrsTomail,$userId,$functionId);
                $_SESSION["successMje"]="Compra realizada con exito,revise las entradas en su email";
                $home->Index();
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }           
        }
        public function getForCinema($cinemaId){
            try{                
                $functionDao=new MovieFunctionDao();
                $ticketDao= new TicketDao();
                $purchaseDao= new PurchaseDao();
                $functions=$functionDao->getForCinema($cinemaId);
                $tickets=array();
                $purchases=array();
                if(!empty($functions)){
                    if(is_array($functions)){
                        foreach($functions as $function){
                            $ticket=$ticketDao->getForFunction($function->getId());
                            array_push($tickets,$ticket);
                        }
                    } 
                    else{
                        $ticket=$ticketDao->getForFunction($functions->getId());
                        array_push($tickets,$ticket);    
                    }
                    if(!empty($tickets)){
                        foreach($tickets as $ticket){
                            if(!empty($ticket)){
                                if(is_array($ticket)){
                                    foreach($ticket as $t){
                                        $purchase=$purchaseDao->getForID($t->getPurchaseID());
                                        array_push($purchases,$purchase);
                                    }   
                                }   
                                else{
                                    $purchase=$purchaseDao->getForID($ticket->getPurchaseID());
                                    array_push($purchases,$purchase);
                                }           
                            } 
                        }                            
                    }
                }    

                $purchases=array_unique($purchases,SORT_REGULAR);  
                return $purchases;
            }  
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }
    }