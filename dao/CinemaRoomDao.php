<?php namespace dao;

    use dao\Connection as Connection;
    use dao\SeatDao as SeatDao;
    use models\ClassSeat as Seat;
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
        *Agrega una sala a la BDD
        */
        public function add($cinemaRoom){
            $sql = "INSERT INTO salas(id_cine1,nombre_sala,capacidad,is3D) VALUES (:id_cine1,:name,:capacity,:is3D)";
            $parameters["id_cine1"]=$cinemaRoom->getCinemaId();
            $parameters["name"]=$cinemaRoom->getName();
            $parameters["capacity"]=$cinemaRoom->getCapacity();
            $parameters["is3D"]=$cinemaRoom->getIs3D();
            try{
                //creo la instancia de conexion
                $this->connection = Connection::getInstance();
                $Executeresult=$this->connection->ExecuteNonQuery($sql,$parameters);
                $rooms=$this->getAll();
                $createdRoomId=0;
                if(is_array($rooms)){
                    foreach($rooms as $room){
                        if($room->getCinemaId()==$parameters["id_cine1"] && $room->getName()==$parameters["name"]){
                            $createdRoomId=$room->getId();                  
                        }
                    }
                } 
                else{
                    if($rooms->getCinemaId()==$parameters["id_cine1"] && $rooms->getName()==$parameters["name"]){
                        $createdRoomId=$rooms->getId();                  
                    }
                } 
                $daoSeats= new SeatDao();
                for($i=0;$i<$parameters["capacity"];$i++){
                    $seat=new Seat(null,($i+1),$createdRoomId);
                    $daoSeats->add($seat);
                }
                
                
                return $Executeresult;
            }
            catch(\PDOException $ex){
                throw $ex;
            } 
            
            
        }
        /*
        *Borra una sala de la BDD correspondiente al id del mismo pasado por parametro
        */
        public function delete($cinemaRoomId){
            $sql="DELETE FROM salas WHERE id_sala = :cinemaRoomId";
            $parameters['cinemaRoomId']=$cinemaRoomId;
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql, $parameters);    

            } catch (\PDOException $ex) {
                throw $ex;
            }

        }
        /*
        *Retorna la sala con el id pasado por parametro
        */
        public function getForID($roomID){
            $sql = "SELECT * FROM salas WHERE id_sala = :roomID";
            $parameters['roomID']=$roomID;
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
        public function getForCinema($cinemaId){
            $sql = "SELECT * FROM salas WHERE id_cine1 =:cinemaId";
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
        /*
        *Retorna todas las salas de la BDD
        */
        public function getAll(){
            $sql="SELECT * FROM salas";
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
            Edita la sala pasada por parametro
        */
        public function edit($room){
            $sql="UPDATE salas SET nombre_sala=:name,is3d=:is3D,capacidad=:capacity WHERE id_sala=:roomId";
            $parameters["name"]=$room->getName();
            $parameters["capacity"]=$room->getCapacity();
            $parameters["is3D"]=$room->getIs3D();
            $parameters["roomId"]=$room->getId();           
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
            $resp = array_map(function($p){
                return new CinemaRoom($p['nombre_sala'],$p['is3d'],$p['capacidad'],$p['id_cine1'],$p['id_sala']);
            },$value);
            return count($resp) > 1 ? $resp : $resp['0'];//hay que checkear del otro lado si esta devolviendo un obj o un array
        }
    }

?>