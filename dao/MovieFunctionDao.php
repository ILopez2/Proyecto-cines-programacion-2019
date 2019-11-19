<?php
namespace dao;

use dao\Connection as Connection;
use models\ClassMovieFunction as CMF;  

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
    *Agrega un nuevo cine a la BDD
    */
    public function add($function){
        $sql = "INSERT INTO funciones(id_cine2,id_sala2,id_pelicula1,lenguaje,fecha,hora) VALUES (:cine,:sala,:pelicula,:lenguaje,:fecha,:hora)";
        $parameters["cine"]=$function->getCinema();
        $parameters["sala"]=$function->getCinemaRoom();
        $parameters["pelicula"]=$function->getMovie();
        $parameters["lenguaje"]=$function->getLanguage();
        $parameters["fecha"]=$function->getDate();
        $parameters["hora"]=$function->getTime();

        try{
            //creo la instancia de coneccion
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql,$parameters);
        }catch(\PDOException $ex){
            throw $ex;
        } 
    }
    /*
    *Borra un cine de la BDD correspondiente al nombre del mismo pasado por parametro
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
    public function getForID($id){
        $sql = "SELECT * FROM funciones WHERE id_funcion = :id";
        $parameters['id']=$id;
        try{
            //creo la instancia de coneccion
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
            //creo la instancia de coneccion
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
    public function getForCinema($cinemaId){
        $sql = "SELECT * FROM funciones WHERE id_cine2 = :cinemaId";
        $parameters['cinemaId']=$cinemaId;
        try{
            //creo la instancia de coneccion
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
    *Retorna todos los cines de la BDD
    */
    public function getAll(){
        $sql="SELECT * FROM funciones";

        try{
            //creo la instancia de coneccion
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
        return new CMF($p['id_pelicula1'],$p['id_cine2'],$p['fecha'],$p['hora'],$p['id_sala2'],$p['lenguaje'],$p['id_funcion']);
        }, $value);
            /* devuelve un arreglo si tiene datos y sino devuelve nulo*/
            return count($resp) > 1 ? $resp : $resp['0'];
     }
}


?>