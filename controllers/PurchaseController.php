<?php namespace controllers;

    use dao\MovieFunctionDao as MovieFunctionDao;
    use dao\PurchaseDao as PurchaseDao;
    use models\ClassPurchase as ClassPurchase;
    use controllers\ViewsController as ViewsController;
    use models\ClassTicket as ClassTicket;
    use dao\TicketDao as TicketDao;
    use phpqrcode\QRcode as QRcode;
    use controllers\HomeController as Home;

    

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
                $home=new Home();
                $daoTicket = new TicketDao();
                $newPurchase = new ClassPurchase($quantityTickets,$totalPrice,$userId,$discount);
                $this->purchaseDao->add($newPurchase);
                $ids_array = $this->purchaseDao->getLastIds();
                $last_id = $ids_array[0][0];
                $i=0;
                while($i < $quantityTickets){
                    $i++;
                    $newTicket = new ClassTicket($functionId,$userId,$last_id);
                    $daoTicket->add($newTicket);
                }
                $_SESSION["successMje"]="Compra realizada con exito,revise las entradas en su email";
                $home->Index();
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
                                foreach($ticket as $t){
                                    $purchase=$purchaseDao->getForID($t->getPurchaseID());
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
                echo $ex;
            }
        }
        // genero un qr aleatorio
        public function generateRandomQr($id){
            $filePath = TEMP.'/'. $id . ".png";
            echo $filePath;
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