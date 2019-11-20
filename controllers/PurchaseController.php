<?php namespace controllers;

    use dao\MovieFunctionDao as MovieFunctionDao;
    use models\ClassPurhcase as ClassPurchase;
    use views\ViewsController as ViewsController;

    class PurchaseController{
        
        private $functionDao;
        private $view;

        public function __construct(){
            $this->view=new ViewsController();
            $this->functionDao=new MovieFunctionDao();
        }

        public function getTotal($quantityTicket,$total){
            return $quantityTicket*$total;
        }
        public function createPurchase($quantityTicket,$total,$idUser,$idFunction,$discount){
            

        }

    }