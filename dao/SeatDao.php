<?php
    namespace dao;

    use dao\Connection as Connection;
    use models\ClassSeat as CS;  

    class SeatDao implements InterfaceDao{

        //ATRIBUTES
        private $connection;

        //CONSTRUCT
        public function __construct()
        {
            $this->connection = null;
        }
        //METHODS
        /*
        *Agrega un nuevo asiento a la BDD
        */
        public function add($seat){
            $sql = "INSERT INTO asientos(nro_asiento,id_sala1) VALUES (:number,:cinemaRoomId)";
            $parameters["number"]=$seat->getNumber();
            $parameters["cinemaRoomId"]=$seat->getCinemaRoomId();

            try{
                //creo la instancia de conexion
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(\PDOException $ex){
                throw $ex;
            } 
        }
        /*
        *Borra un asiento de la BDD correspondiente al nombre del mismo pasado por parametro
        */
        public function delete($id){
            $sql="DELETE FROM asientos WHERE id_asiento = :id";
            $parameters['id']=$id;
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql, $parameters);    

            } catch (\PDOException $ex) {
                throw $ex;
            }

        }    
        //RETORNA UN ASIENTO CORRESPONDIENTE AL ID PASADO POR PARAMETRO
        public function getForID($id){
            $sql = "SELECT * FROM asientos WHERE id_asiento = :id";
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
        *Retorna los asientos de la sala pasada por parametro
        */
        public function getForCinemaRoom($cinemaRoomId){
            $sql = "SELECT * FROM asientos WHERE id_sala1 = :cinemaRoomId";
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

        //RETORNA TODOS LOS ASIENTOS DE LA BDD
        public function getAll(){
            $sql="SELECT * FROM asientos";

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
        public function edit($seat){
            //LOS ASIENTOS NO SE EDITAN
        }
        /*
        *Convierte un array asociativo a un array de objetos para facilitar su manejo
        *si la cantidad de elementos es mayor a 1 retorna el array entero, sino retorna la posicion 0.
        */
        protected function mapeo($value) {
            $value = is_array($value) ? $value : [];   
            $resp=array();  
            $resp = array_map(function($p){
            return new CS($p['id_asiento'],$p['nro_asiento'],$p['id_sala1']);
            }, $value);
                /* devuelve un arreglo si tiene datos y sino devuelve nulo*/
                return count($resp) > 1 ? $resp : $resp['0'];
        }
    }


?>