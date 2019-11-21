<?php namespace models;
    
    class ClassPurchase{

        private $quantityTicket;
        private $totalPrice;
        private $userId;
        private $discount;
        private $id;

        public function __construct($quantityTickets,$totalPrice,$userId,$discount,$id=null){
            $this->quantityTicket=$quantityTickets;
            $this->totalPrice=$totalPrice;
            $this->userId=$userId;
            $this->discount=$discount;
            $this->id=$id;
        }

        public function getQuantityTicket(){
            return $this->quantityTicket;
        }
        public function getTotal(){
            return $this->totalPrice;
        }
        public function getIdUser(){
            return $this->userId;
        }
        public function getDiscount(){
            return $this->discount;
        }
        public function getId(){
            return $this->id;
        }
    }