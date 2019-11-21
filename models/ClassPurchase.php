<?php namespace models;
    
    class ClassPurchase{

        private $id;
        private $quantityTicket;
        private $total;
        private $idUser;
        private $idFunction;
        private $discount;

        public function __construct($id,$quantityTicket,$total,$idUser,$idFunction,$discount){
            $this->quantityTicket=$quantityTicket;
            $this->total=$total;
            $this->idUser=$idUser;
            $this->idFunctionDate=$idFunction;
            $this->discount=$discount;
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
        public function getIdFunction(){
            return $this->idFunction    ;
        }
        public function getDiscount(){
            return $this->discount;
        }
    }