<?php namespace controllers;

    use dao\MovieFunctionDao as MovieFunctionDao;
    use dao\PurchaseDao as PurchaseDao();
    use models\ClassPurhcase as ClassPurchase;
    use controllers\ViewsController as ViewsController;
    use models\ClassTicket as ClassTicket;

    class PurchaseController{
        
        private $purchaseDao;
        private $view;

        public function __construct(){
            $this->view = new ViewsController();
            $this->purchaseDao = new PurchaseDao();
        }

        public function getTotal($quantityTicket,$total){
            return $quantityTicket*$total;
        }
        public function createPurchase($quantityTickets,$totalPrice,$userId,$discount,$seats){
            var_dump($seats);
            $purchaseDAO = new PurchaseDao();
            $newPurchase = new ClassPurchase($quantityTickets,$totalPrice,$userId,$discount);
            $last_id = $this->purchaseDAO->add($newPurchase);
            
            $qr = $this->generateRandomQr($last_id);
            while($i < $quantityTickets){
                $i++;
                $newTicket = new ClassTicket($functionID,$userId,$qr,$last_id);
            }
        }
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