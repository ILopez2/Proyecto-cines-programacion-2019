<?php
namespace dao;

use dao\Connection as Connection;
use dao\SeatDao as DaoSeat;
use models\ClassMovieFunction as CMF;  
use models\ClassSeat as Seat;


class MovieFunctionDao implements InterfaceDao{

    //ATRIBUTES
    private $connection;

    //CONSTRUCT
    public function __construct()
    {
        $this->connection = null;
    }
    //METHODS
    /*
    *Agrega una nueva funcion a la BDD
    */
    public function add($function){
        $sql = "INSERT INTO funciones(id_cine2,id_sala2,id_pelicula1,lenguaje,fecha,hora_inicio,hora_final) VALUES (:cine,:sala,:pelicula,:lenguaje,:fecha,:hora_inicio,:hora_final)";
        $parameters["cine"]=$function->getCinema();
        $parameters["sala"]=$function->getCinemaRoom();
        $parameters["pelicula"]=$function->getMovie();
        $parameters["lenguaje"]=$function->getLanguage();
        $parameters["fecha"]=$function->getDate();
        $parameters["hora_inicio"]=$function->getTimeStart();
        $parameters["hora_final"]=$function->getTimeEnd();

        try{
            //creo la instancia de conexion
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql,$parameters);
        }catch(\PDOException $ex){
            throw $ex;
        } 
    }
    /*
    *Borra una funcion de la BDD correspondiente al id del mismo pasado por parametro
    */
    public function delete($functionId){
        $sql="DELETE FROM funciones WHERE id_funcion = :functionId";
        $parameters['functionId']=$functionId;
        try {
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);    

        } catch (\PDOException $ex) {
            throw $ex;
        }

    }
    /*
    *Retorna las funciones de una sala en particular.
    */
    public function getForRoomAndCinemaID($roomId,$cinemaId){
        $sql = "SELECT * FROM funciones WHERE id_sala2 = :roomId AND id_cine2 = :cinemaId";
        $parameters['cinemaId']=$cinemaId;
        $parameters['roomId']=$roomId;
        try{
            //creo la instancia de conexion
            $this->connection= Connection::getInstance();
            $result = $this->connection->execute($sql,$parameters);
        }catch(\PDOException $ex){
            throw $ex;
        } 
        //hay que mapear de un arreglo asociativo a objetos
        if(!empty($result)){
            return $this->mapeo($result);
        }else{
            return false;
        }
    }
    // RETORNA LA FUNCION CORRESPONDIENTE AL ID PASADO POR PARAMETRO
    public function getForID($id){
        $sql = "SELECT * FROM funciones WHERE id_funcion = :id";
        $parameters['id']=$id;
        try{
            //creo la instancia de conexion
            $this->connection= Connection::getInstance();
            $result = $this->connection->execute($sql,$parameters);
        }catch(\PDOException $ex){
            throw $ex;
        } 
        //hay que mapear de un arreglo asociativo a objetos
        if(!empty($result)){
            return $this->mapeo($result);
        }else{
            return false;
        }
    }
     /*
    *Retorna las funciones de la pelicula que correspondan a la fecha pasada por parametro
    */
    public function getForDate($functionDate){
        $sql = "SELECT * FROM funciones WHERE fecha = :functionDate";
        $parameters['functionDate']=$functionDate;
        try{
            //creo la instancia de conexion
            $this->connection= Connection::getInstance();
            $result = $this->connection->execute($sql,$parameters);
        }catch(\PDOException $ex){
            throw $ex;
        } 
        //hay que mapear de un arreglo asociativo a objetos
        if(!empty($result)){
            return $this->mapeo($result);
        }else{
            return false;
        }
    }
    /*
    *Retorna las funciones de la pelicula pasada por parametro
    */
    public function getForMovie($movieID){
        $sql = "SELECT * FROM funciones WHERE id_pelicula1 = :movieID";
        $parameters['movieID']=$movieID;
        try{
            //creo la instancia de conexion
            $this->connection= Connection::getInstance();
            $result = $this->connection->execute($sql,$parameters);
        }catch(\PDOException $ex){
            throw $ex;
        } 
        //hay que mapear de un arreglo asociativo a objetos
        if(!empty($result)){
            return $this->mapeo($result);
        }else{
            return false;
        }
    }
    //RETORNA LAS FUNCIONES DEL CINE PASADO POR PARAMETRO
    public function getForCinema($cinemaId){
        $sql = "SELECT * FROM funciones WHERE id_cine2 = :cinemaId";
        $parameters['cinemaId']=$cinemaId;
        try{
            //creo la instancia de conexion
            $this->connection= Connection::getInstance();
            $result = $this->connection->execute($sql,$parameters);
        }catch(\PDOException $ex){
            throw $ex;
        } 
        //hay que mapear de un arreglo asociativo a objetos
        if(!empty($result)){
            return $this->mapeo($result);
        }else{
            return false;
        }
    }
    //RETORNA LAS FUNCIONES CORRESPONDIENTES A UNA SALA
    public function getForCinemaRoom($cinemaRoomId){
        $sql = "SELECT * FROM funciones WHERE id_sala2 = :cinemaRoomId";
        $parameters['cinemaRoomId']=$cinemaRoomId;
        try{
            //creo la instancia de conexion
            $this->connection= Connection::getInstance();
            $result = $this->connection->execute($sql,$parameters);
        }catch(\PDOException $ex){
            throw $ex;
        } 
        //hay que mapear de un arreglo asociativo a objetos
        if(!empty($result)){
            return $this->mapeo($result);
        }else{
            return false;
        }
    }
    /*
    *Retorna todas las funciones de la BDD
    */
    public function getAll(){
        $sql="SELECT * FROM funciones";

        try{
            //creo la instancia de conexion
            $this->connection= Connection::getInstance();
            $result = $this->connection->execute($sql);
        }catch(\PDOException $ex){
            throw $ex;
        } 

        //hay que mapear de un arreglo asociativo a objetos
        if(!empty($result)){
            return $this->mapeo($result);
        }else{
            return false;
        }

    }
    public function edit($function){

    }
    /*
    *Convierte un array asociativo a un array de objetos para facilitar su manejo
    *si la cantidad de elementos es mayor a 1 retorna el array entero, sino retorna la posicion 0.
    */
    protected function mapeo($value) {
        $value = is_array($value) ? $value : [];   
        $resp=array();  
        $resp = array_map(function($p){
        return new CMF($p['id_pelicula1'],$p['id_cine2'],$p['fecha'],$p['hora_inicio'],$p['hora_final'],$p['id_sala2'],$p['lenguaje'],$p['id_funcion']);
        }, $value);
            /* devuelve un arreglo si tiene datos y sino devuelve nulo*/
            return count($resp) > 1 ? $resp : $resp['0'];
     }
}


?>