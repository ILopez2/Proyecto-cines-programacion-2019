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
        $sql = "INSERT INTO funciones(id_cine2,id_sala2,id_pelicula1,lenguaje,fecha_y_horario) VALUES (:cine,:sala,:pelicula,:lenguaje,:fechaHora)";
        $parameters["cine"]=$function->getCinema();
        $parameters["sala"]=$function->getCinemaRoom();
        $parameters["pelicula"]=$function->getMovie();
        $parameters["lenguaje"]=$function->getLanguage();
        $parameters["fechaHora"]=$function->getDateTime();

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
        $sql="DELETE FROM funciones WHERE id_funcion = :id";
        $parameters['id']=$functionId;
        try {
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);    

        } catch (\PDOException $ex) {
            throw $ex;
        }

    }
    /*
    *Retorna el cine con el nombre pasado por parametro
    */
    public function getForID($functionId){
        $sql = "SELECT * FROM funciones WHERE id_funcion = :id";
        $parameters['id']=$functionId;
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
            return new CMF($p['id_pelicula1'],$p['id_cine2'],$p['fecha_y_horario'],$p['id_sala2'],$p['lenguaje'],$p['id_funcion']);
        }, $value);
            /* devuelve un arreglo si tiene datos y sino devuelve nulo*/
            return count($resp) > 1 ? $resp : $resp['0'];
     }
}


?>