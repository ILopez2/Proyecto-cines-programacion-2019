<?php namespace controllers;

    use dao\MovieFunctionDao as MovieFunctionDao;
    use models\ClassPurhcase as ClassPurchase;
    use controllers\ViewsController as ViewsController;

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
        public function createPurchase($quantityTickets,$totalPrice,$userId,$discount){
            
            $newPurchase = new ClassPurchase($quantityTickets,$totalPrice,$userId,$discount);

        }

    }