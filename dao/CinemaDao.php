<?php namespace dao;

    use dao\Connection as Connection;
    use models\ClassCinema as Cinema;  

    class CinemaDao implements InterfaceDao{

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
        public function add($cinema){
            $sql = "INSERT INTO cines(nombre_cine,direccion,valor_entrada,id_ciudad1) VALUES (':name',':address',':price',':city')";
            $parameters["name"]=$cinema->getName();
            $parameters["city"]=$cinema->getCity();
            $parameters["address"]=$cinema->getAddress();
            $parameters["price"]=$cinema->getTicketCost();
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
        public function delete($cinemaName){
            $sql="DELETE FROM cines WHERE nombre_cine = :cinemaName"
            $parameters['cinemaName']=$cinemaName;
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
        public function readforID($cinemaName){
            $sql = "SELECT * FROM cines WHERE nombre_cine = :cinemaName"
            $parameters['cinemaName']=$cinemaName;
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
                return false
            }
        }
        /*
        *Retorna todos los cines de la BDD
        */
        public function readAll(){
            $sql="SELECT * FROM cines";
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
                return false
            }

        }
        /*
        *Convierte un array asociativo a un array de objetos para facilitar su manejo
        *si la cantidad de elementos es mayor a 1 retorna el array entero, sino retorna la posicion 0.
        */
        protected function mapeo($value){
            $value=is_array($value) ? $value : [];
            $value = array_map(function($p){
                return new Cinema($p['name'],$p['city'],$p['address'],$p['price']);
            },$value);
            return count($resp) > 1 ? $resp : $resp['0'];//hay que checkear del otro lado si esta devolviendo un obj o un array
        }
    }

?>