<?php namespace controllers;

    use dao\MovieFunctionDao as MovieFunctionDao;
    use models\ClassPurhcase as ClassPurchase;
    use controllers\ViewsController as ViewsController;

    class PurchaseController{
        
        private $functionDao;
        private $view;

        public function __construct(){
            $this->view = new ViewsController();
            $this->functionDao = new MovieFunctionDao();
        }

        public function getTotal($quantityTicket,$total){
            return $quantityTicket*$total;
        }
        public function createPurchase($cinemaId,$quantityTickets,$totalPrice,$userId,$discount){
            echo 'HAPPINESSSSS';
            echo '<br>';
            print_r($quantityTickets);
            echo '<br>';
            var_dump($totalPrice);
            echo '<br>';
            var_dump($userId);
            echo '<br>';
            var_dump($cinemaId);
            
            

        }

    }