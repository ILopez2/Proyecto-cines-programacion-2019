<?php namespace models;
    
    class ClassPurchase{

        private $quantityTicket;
        private $totalPrice;
        private $userId;
        private $discount;
        private $id;

        public function __construct($id=null,$quantityTickets,$totalPrice,$userId,$discount){
            $this->quantityTicket=$quantityTicket;
            $this->totalPrice=$totalPrice;
            $this->userId=$userId;
            $this->discount=$discount;
            $this->id=$id
        }

        public function getQuantityTicket(){
            return $this->quantityTicket;
        }
        public function getTotal(){
            return $this->total;
        }
        public function getIdUser(){
            return $this->idUser;
        }
        public function getDiscount(){
            return $this->discount;
        }
    }