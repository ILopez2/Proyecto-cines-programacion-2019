<?php namespace dao;

    use dao\Connection as Connection;
    use models\ClassCinemaRoom as CinemaRoom;  

    class CinemaRoomDao implements InterfaceDao{

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
        public function add($cinemaRoom){
            //tenemos el mismo problema del tipo foreign key no sabemos como poner un int si le pasamos un string (idcine1)
            $sql = "INSERT INTO cines(id_cine1,nombre_sala,capacidad,is3D) VALUES (':id_cine1',':name',':capacity',':is3D')";
            $parameters["id_cine1"]=$cinema->getName();
            $parameters["name"]=$cinema->getCity();
            $parameters["capacity"]=$cinema->getAddress();
            $parameters["is3D"]=$cinema->getTicketCost();
            echo $parameters["id_cine1"].'<br>';
            echo $parameters["name"].'<br>';
            echo $parameters["capacity"].'<br>';
            echo $parameters["is3D"].'<br>';
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
        public function delete($cinemaRName){
            $sql="DELETE FROM cines WHERE nombre_sala = :cinemaRName";
            $parameters['cinemaRName']=$cinemaRName;
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
        public function getForID($cinemaRName){
            $sql = "SELECT * FROM salas WHERE nombre_sala = :cinemaRName";
            $parameters['cinemaRName']=$cinemaRName;
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
            $sql="SELECT * FROM salas";
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
        public function edit(){

        }
        /*
        *Convierte un array asociativo a un array de objetos para facilitar su manejo
        *si la cantidad de elementos es mayor a 1 retorna el array entero, sino retorna la posicion 0.
        */
        protected function mapeo($value){
            $value=is_array($value) ? $value : [];
            $resp=array();
            $resp = array_map(function($p){
                return new Cinema($p['id_cine1'],$p['nombre_sala'],$p['capacidad'],$p['is3D']);
            },$value);
            return count($resp) > 1 ? $resp : $resp['0'];//hay que checkear del otro lado si esta devolviendo un obj o un array
        }
    }

?>