<?php namespace dao;

    use dao\Connection as Connection;
    use models\ClassPurchase as Purchase;
    

    class PurchaseDao implements InterfaceDao{

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
        public function add($purchase){
            $sql = "INSERT INTO compras(id_usuario1,cant_entradas,monto,descuento) VALUES (:userId, :ticketQuantity, :amount, :discount)";
            $parameters["userId"]=$cinema->getIdUser();
            $parameters["ticketQuantity"]=$cinema->getQuantityTicket();
            $parameters["amount"]=$cinema->getTotal();
            $parameters["discount"]=$cinema->getDiscount();
            try{
                //creo la instancia de coneccion
                $this->connection = Connection::getInstance();
                $this->connection->ExecuteNonQuery($sql,$parameters);
                return $this->connection->lastInsertId();
            }catch(\PDOException $ex){
                throw $ex;
            } 
        }
        /*
        *Borra un cine de la BDD correspondiente al nombre del mismo pasado por parametro
        */
        public function delete($id){
            $sql="DELETE FROM compras WHERE id_compra = :id";
            $parameters['id']=$id;
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
        public function getForID($id){
            $sql = "SELECT * FROM compras WHERE id_compra = :id";
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

        public function getAll(){
            $sql="SELECT * FROM compras";
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
        public function edit($purchase){
            //LAS COMPRAS NO SE EDITAN
        }
        /*
        *Convierte un array asociativo a un array de objetos para facilitar su manejo
        *si la cantidad de elementos es mayor a 1 retorna el array entero, sino retorna la posicion 0.
        */
        protected function mapeo($value){
            $value=is_array($value) ? $value : [];
            $resp=array();
            $resp = array_map(function($p){
                return new Purchase($p['id_compra'],$p['cant_entradas'],$p['monto'],$p['id_usuario1'],$p['descuento']);
            },$value);
            return count($resp) > 1 ? $resp : $resp['0'];//hay que checkear del otro lado si esta devolviendo un obj o un array
        }

    }

?>