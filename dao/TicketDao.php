<?php namespace dao;

    use models\ClassTicket as ClassTicket;
    use dao\Connection as Connection;

    class TicketDao{

        //ATRIBUTES
        private $connection;

        //CONSTRUCT
        public function __construct()
        {
            $this->connection = null;
        }
        //METHODS
        /*
        *Agrega un nuevo ticket a la BDD
        */
        public function add($ticket){
            $sql = "INSERT INTO entradas(id_funcion1,id_usuario,id_compra1,id_asiento1,qr) VALUES (:functionId, :userId, :purchaseId,:seatId,:qr)";
            $parameters["functionId"]=$ticket->getFunctionID();
            $parameters["userId"]=$ticket->getUserID();
            $parameters["purchaseId"]=$ticket->getPurchaseID();
            $parameters["seatId"]=$ticket->getSeatID();
            $parameters["qr"]=$ticket->getQr();
            try{
                //creo la instancia de conexion
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(\PDOException $ex){
                throw $ex;
            } 
        }

        //RETORNA TODOS LOS TICKETS DE LA BDD
        public function getAll(){
            $sql="SELECT * FROM entradas";
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
        
        //RETORNA UN TICKET CORRESPONDIENTE AL ID PASADO POR PARAMETRO
        public function getForId($id){
            $sql="SELECT * FROM entradas WHERE id=:id";
            $parameters["id"]=$id;
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

        //RETORNA LOS TICKETS CORRESPONDIENTES A UNA FUNCION
        public function getForFunction($functionId){
            $sql="SELECT * FROM entradas WHERE id_funcion1=:functionId";
            $parameters["functionId"]=$functionId;
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
        public function edit($ticket){
            //LOS TICKETS NO SE EDITAN
        }
        /*
        *Convierte un array asociativo a un array de objetos para facilitar su manejo
        *si la cantidad de elementos es mayor a 1 retorna el array entero, sino retorna la posicion 0.
        */
        protected function mapeo($value) {
            $value = is_array($value) ? $value : [];   
            $resp=array();  
            $resp = array_map(function($p){
            return new ClassTicket($p['id_entrada'],$p['id_funcion1'],$p['id_usuario1'],$p['id_compra1'],$p['id_asiento1'],$p["qr"]);
            }, $value);
                /* devuelve un arreglo si tiene datos y sino devuelve nulo*/
                return count($resp) > 1 ? $resp : $resp['0'];
         }
    }