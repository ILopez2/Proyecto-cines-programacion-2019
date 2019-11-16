<?php namespace models;
    class ClassTicket{

        private $ticketID;
        private $functionID;
        private $userID;
        private $movieID;
        private $QR;
        
        public function __construct($ticketID,$functionID,$userID,$qr,$movieID){
            $this->ticketID=$ticketID;
            $this->functionID=$functionID;
            $this->userID=$userID;
            $this->QR=$qr;
            $this->movieID=$movieID;
        }

        public function getTicketID(){
            return $this->ticketID;
        }
        public function getFunctionID(){
            return $this->functionID;
        }
        public function getfunctionID(){
            return $this->functionID;
        }
        public function getuserID(){
            return $this->userID;
        }
        public function getQR(){
            return $this->QR;
        }
        public function getMovieID(){
            return $this->movieID;
        }
    }