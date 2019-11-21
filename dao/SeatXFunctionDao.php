<?php
namespace dao;

use dao\Connection as Connection;
use models\ClassSeatXFunction as SeatXfunction;
class SeatXFunctionDao implements InterfaceDao{

    //ATRIBUTES
    private $connection;

    //CONSTRUCT
    public function __construct()
    {
        $this->connection = null;
    }
    //METHODS
    /*
    *Agrega un nuevo asiento x funcion a la BDD
    */
    public function add($seatXfunction){
        $sql = "INSERT INTO asientoXfuncion(id_asientoXfuncion,id_asiento2,id_funcion2,ocupada) VALUES (:id,:seatId,:functionId,:occupied)";
        $parameters["id"]=$seatXfunction->getId();
        $parameters["seatId"]=$seatXfunction->getSeatId();
        $parameters["functionId"]=$seatXfunction->getFunctionId();
        $parameters["occupied"]=$seatXfunction->getOccupied();
        try{
            //creo la instancia de conexion
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql,$parameters);
        }catch(\PDOException $ex){
            throw $ex;
        } 
    }
    /*
    *Borra un asiento x funcion de la BDD correspondiente al id del mismo pasado por parametro
    */
    public function delete($id){
        $sql="DELETE FROM asientoXfuncion WHERE id_asientoXfuncion = :id";
        $parameters['id']=$id;
        try {
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);    

        } catch (\PDOException $ex) {
            throw $ex;
        }

    }    
    //CAMBIA EL ESTADO DEL ASIENTO DE UNA FUNCION A OCUPADO
    public function changeOccupy($seatXfunction){
        $sql="UPDATE asientoXfuncion SET ocupada=:occupied WHERE id_asientoXfuncion=:seatXfunctionId";
        $parameters["occupied"]=$seat->getOccupied();       
        $parameters["seatXfunctionId"]=$seat->getId();     
        try
        {
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(PDOException $ex)
        {
            throw $ex;
        }
    }
    
    //RETORNA EL ASIENTO X FUNCION CORRESPONDIENTE AL ID PASADO POR PARAMETRO
    public function getForID($id){
        $sql = "SELECT * FROM asientoXfuncion WHERE id_asientoXfuncion = :id";
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
    *Retorna los asientos de la funcion pasada por parametro
    */
    public function getForFunction($functionId){
        $sql = "SELECT * FROM asientoXfuncion WHERE id_funcion2 = :functionId";
        $parameters['functionId']=$functionId;
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

    //RETORNA TODOS LOS ASIENTOS POR FUNCION DE LA BDD
    public function getAll(){
        $sql="SELECT * FROM asientoXfuncion";

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
    public function edit($seatXfunction){
        //LOS X POR FUNCION NO SE EDITAN
    }
    /*
    *Convierte un array asociativo a un array de objetos para facilitar su manejo
    *si la cantidad de elementos es mayor a 1 retorna el array entero, sino retorna la posicion 0.
    */
    protected function mapeo($value) {
        $value = is_array($value) ? $value : [];   
        $resp=array();  
        $resp = array_map(function($p){
        return new SeatXfunction($p['id_funcion2'],$p['id_asiento2'],$p['ocupada']);
        }, $value);
            /* devuelve un arreglo si tiene datos y sino devuelve nulo*/
            return count($resp) > 1 ? $resp : $resp['0'];
    }
}


?>