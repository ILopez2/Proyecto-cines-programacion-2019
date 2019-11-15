<?php namespace models;
    class ClassTicket{

        private $ticketID;
        private $cinemaID;
        private $cinemaRoomID;
        private $price;
        private $userID;
        private $date;
        private $time;
        private $QR;
        private $movieID;

        public function __construct($id,$cinemaid,$cinemaroomid,$price,$userid,$date,$time,$qr,$idmovie){
            $this->ticketID=$id;
            $this->cinemaID=$cinemaid;
            $this->cinemaRoomID=$cinemaroomid;
            $this->price=$price;
            $this->userID=$userid;
            $this->date=$date;
            $this->time=$time;
            $this->QR=$qr;
            $this->movieID=$idmovie;
        }

        public function getTicketID(){
            return $this->ticketID;
        }
        public function getCinemaID(){
            return $this->cinemaID;
        }
        public function getCinemaRoomID(){
            return $this->cinemaRoomID;
        }
        public function getPrice(){
            return $this->price;
        }
        public function getUserID(){
            return $this->userID;
        }
        public function getDate(){
            return $this->date;
        }
        public function getTime(){
            return $this->time;
        }
        public function getQR(){
            return $this->QR;
        }
        public function getMovieID(){
            return $this->movieID;
        }
    }