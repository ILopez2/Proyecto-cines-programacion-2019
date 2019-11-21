<?php namespace controllers;

    use dao\MovieFunctionDao as MovieFunctionDao;
    use dao\PurchaseDao as PurchaseDao;
    use models\ClassPurchase as ClassPurchase;
    use controllers\ViewsController as ViewsController;
    use models\ClassTicket as ClassTicket;
    use dao\TicketDao as TicketDao;

    class PurchaseController{
        
        private $purchaseDao;
        private $view;

        public function __construct(){
            $this->view = new ViewsController();
            $this->purchaseDao = new PurchaseDao();
        }
        // creo un registro de una compra
        public function createPurchase($quantityTickets,$totalPrice,$userId,$discount,$functionId){
            try{
                var_dump($functionId);
                $newPurchase = new ClassPurchase($quantityTickets,$totalPrice,$userId,$discount);
                $last_id = $this->purchaseDao->add($newPurchase);
                
                $qr = $this->generateRandomQr($last_id);
                while($i < $quantityTickets){
                    $i++;
                    $newTicket = new ClassTicket($functionId,$userId,$qr,$last_id);
                }
            }
            catch(PDOException $ex)
            {
                echo $ex;
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
                    foreach($functions as $function){
                        $ticket=$ticketDao->getForFunction($function->getId());
                        array_push($tickets,$ticket);
                    }
                    if(!empty($tickets)){
                        foreach($tickets as $ticket){
                            $purchase=$purchaseDao->getForID($ticket->getPurchaseID());
                            array_push($purchases,$purchase);
                        }
                    }      
                } 
                return $purchases;
            }
            catch(PDOException $ex)
            {
                echo $ex;
            }
        }
        // genero un qr aleatorio
        public function generateRandomQr($id){
            $filePath = ROOT . $id . ".png";
            $content = "Purchase code" . $id;
            $size = 10;
            $level = 'L';
            $framSize = 3;
            
            QRcode::png($content, $filePath, $level, $size, $framSize);
            $qrImage = file_get_contents($filePath);
            unlink($filePath);
            return $qrImage;
        }
    }