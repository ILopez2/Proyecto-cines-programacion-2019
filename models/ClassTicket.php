<?php namespace models;
    class ClassTicket{

        private $ticketID;
        private $functionID;
        private $userID;
        private $purchaseId;
        //private $seatId;
        private $QR;
        
        public function __construct($ticketID=null,$functionID,$userID,$purchaseId,$qr=null){
            $this->ticketID=$ticketID;
            $this->functionID=$functionID;
            $this->userID=$userID;
            $this->purchaseId=$purchaseId;
            $this->seatId=$seatId;
            $this->QR=$qr;          
        }

        public function getTicketID(){
            return $this->ticketID;
        }
        public function getFunctionID(){
            return $this->functionID;
        }
        public function getuserID(){
            return $this->userID;
        }
        public function getPurchaseID(){
            return $this->purchaseId;
        }
        /*public function getSeatID(){
            return $this->seatId;*/
        }
        public function getQR(){
            return $this->QR;
        }
        
    }