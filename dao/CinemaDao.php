<?php namespace dao;

    use dao\Connection as Connection;
    use dao\CinemaRoomDao as CRD;
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
            $sql = "INSERT INTO cines(nombre_cine,direccion,valor_entrada,id_ciudad1) VALUES (:name, :address, :price, :city)";
            $parameters["name"]=$cinema->getName();
            $parameters["city"]=$cinema->getCity();
            $parameters["address"]=$cinema->getAddress();
            $parameters["price"]=$cinema->getTicketCost();
            try{
                //creo la instancia de conexion
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(\PDOException $ex){
                throw $ex;
            } 
        }
        /*
        *Borra un cine de la BDD correspondiente al id del mismo pasado por parametro
        */
        public function delete($id){
            $sql="DELETE FROM cines WHERE id_cine = :id";
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
        public function getForID($cinemaName){
            $sql = "SELECT * FROM cines WHERE nombre_cine = :cinemaName";
            $parameters['cinemaName']=$cinemaName;
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
        *Retorna el id del cine correspondiente al nombre de cine pasado por parametro
        */
        public function getCinemaIdForName($cinemaName){
            $sql = "SELECT id_cine FROM cines WHERE nombre_cine = :cinemaName";
            $parameters['cinemaName']=$cinemaName;
            try{
                //creo la instancia de conexion
                $this->connection= Connection::getInstance();
                $result = $this->connection->execute($sql,$parameters);
            }catch(\PDOException $ex){
                throw $ex;
            } 
            //Hay que mapear de un arreglo asociativo a objetos
            if(!empty($result)){
                return $this->mapeo($result);
            }else{
                return false;
            }
        }
        /*
            Retorna el cine correspondiente al id pasado por parametro
        */
        public function getForID2($id){
            $sql = "SELECT * FROM cines WHERE id_cine = :id";
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
        *Retorna todos los cines de la BDD
        */
        public function getAll(){
            $sql="SELECT * FROM cines";
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
        /*
            Edita el cine pasado por parametro
        */
        public function edit($cinema){
            $sql = "UPDATE cines SET nombre_cine=:nombre_cine,direccion=:direccion,valor_entrada=:valor_entrada,id_ciudad1=:id_ciudad1 WHERE nombre_cine = :nombre_cine";
            $parameters["nombre_cine"]=$cinema->getName();
            $parameters["id_ciudad1"]=$cinema->getCity();
            $parameters["direccion"]=$cinema->getAddress();
            $parameters["valor_entrada"]=$cinema->getTicketCost();
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
        /*
        *Convierte un array asociativo a un array de objetos para facilitar su manejo
        *si la cantidad de elementos es mayor a 1 retorna el array entero, sino retorna la posicion 0.
        */
        protected function mapeo($value){
            $value=is_array($value) ? $value : [];
            $resp=array();
            $city="";
            $resp = array_map(function($p){
            $cinemaRooms=null;
            $roomDao=new CRD();
            $rooms=$roomDao->getAll();  
            if(!empty($rooms)){
                if(is_array($rooms)){
                    $cinemaRooms=array();
                    foreach($rooms as $room){
                        if($room->getCinemaId()==$p["id_cine"])
                        array_push($cinemaRooms,$room);
                    }
                }
                else $cinemaRooms=$rooms;
            }
                if($p['id_ciudad1']==1){
                    $city="Mar del Plata";
                }
                elseif($p['id_ciudad1']==2){
                    $city="Miramar";
                }
                return new Cinema($p['nombre_cine'],$city,$p['direccion'],$p['valor_entrada'],$cinemaRooms,$p["id_cine"]);
            },$value);
            return count($resp) > 1 ? $resp : $resp['0'];//hay que checkear del otro lado si esta devolviendo un obj o un array
        }

    }

?>