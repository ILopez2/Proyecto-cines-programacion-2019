<?php namespace dao;

    use dao\Connection as Connection;
    use \Exception as Exception;
    use models\ClassCinema as Cinema;  

    //getCinema, getAll (read)

    class CinemaDao implements InterfaceDao{
     
        public function add(){
            $sql = "INSERT INTO BLAH BLAH"
            $parameters['name']=$user->getName();
            try{
                //creo la instancia de coneccion
                $this->connection= Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(\PDOException $ex){
                throw $ex;
            } 
        }

        public function read($email){
            $sql = "SELECT FROM BLAH BLAH"
            $parameters['email']=$email;
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

        protected function mapeo($value){
            //si la cantidad de elementos es mayor a uno retorna el array entero sino retorna la posicion 0
            $value=is_array($value) ? $value : [];
            $value = array_map(function($p){
                return new Cinema($p['name'])
            },$value);
            return count($resp) > 1 ? $resp : $resp['0'];//hay que checkear del otro lado si esta devolviendo un obj o un array
        }
    }

?>