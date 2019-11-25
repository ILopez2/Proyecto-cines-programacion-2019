<?php namespace controllers;

class QrController{

    public function __construct(){
        //NO TIENE NADA
    }

    //RETRONA EL LINK DE LA IMAGEN DEL CODIGO QR
    public function generateQrCode($data){
        return QRGEN.$data;
    }

}

