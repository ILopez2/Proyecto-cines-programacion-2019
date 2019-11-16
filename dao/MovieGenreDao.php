<?php namespace dao;

    use dao\Connection as Connection;
    use models\ClassMovieGenre as Genre; 
    
    class MovieGenreDao implements InterfaceDao{
        
        //ATRIBUTES
        private $connection;

        //CONSTRUCT
        public function __construct()
        {
            $this->connection = null;
        }
         /*
        *Agrega un nuevo user a la BDD
        */
        public function add($genre){

            $sql = "INSERT INTO generos(id_genero,nombre) VALUES (:IdGenre,:Name)";
            $parameters["IdGenre"]=$genre->getId();
            $parameters["Name"]=$genre->getName(); 
            $this->delete($parameters["IdGenre"]);
            try{
                //creo la instancia de coneccion
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(\PDOException $ex){
                throw $ex;
            } 
        }
        /*
        *Borra un user de la BDD correspondiente al email del mismo pasado por parametro
        */
        public function delete($IdGenre){
            $sql="DELETE FROM generos WHERE  id_genero = :IdGenre";
            $parameters['IdGenre']=$IdGenre;
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql, $parameters);    

            } catch (\PDOException $ex) {
                throw $ex;
            }

        }
        /*
        *Retorna el user con el email pasado por parametro
        */
        public function getForID($IdGenre){
            $sql = "SELECT * FROM generos WHERE id_genero = :IdGenre";
            $parameters['IdGenre']=$IdGenre;
            try{
                //creo la instancia de coneccion
                $this->connection= Connection::getInstance();
                $result = $this->connection->execute($sql,$parameters);
            }catch(\PDOException $ex){
                throw $ex;
            } 
            //hay que mapear de un arreglo asociativo a objetos
            if(!empty($result)){
                return $this->mapear($result);
            }else{
                return false;
            }
        }
        /*
        *Retorna todos los users de la BDD
        */
        public function getAll(){
            $sql="SELECT * FROM generos";
            try{
                //creo la instancia de coneccion
                $this->connection= Connection::getInstance();
                $result = $this->connection->execute($sql);
            }catch(\PDOException $ex){
                throw $ex;
            } 
            //hay que mapear de un arreglo asociativo a objetos
            if(!empty($result)){
                return $this->mapear($result);
            }else{
                return false;
            }

        }
    
        public function edit($user){           
            //LOS GENEROS NO SE EDITAN
        }

        /*
        *Convierte un array asociativo a un array de objetos para facilitar su manejo
        *si la cantidad de elementos es mayor a 1 retorna el array entero, sino retorna la posicion 0.
        */
        protected function mapear($value) {
            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new Genre($p['nombre'],$p['id_genero']);
            }, $value);
                /* devuelve un arreglo si tiene datos y sino devuelve nulo*/
                return count($resp) > 1 ? $resp : $resp['0'];
         }
    
    }
    
?>