<?php namespace dao;

    use dao\Connection as Connection;
    use models\ClassGenreXMovie as GenreXMovie; 
    
    class GenreXMovieDao implements InterfaceDao{
        
        //ATRIBUTES
        private $connection;

        //CONSTRUCT
        public function __construct()
        {
            $this->connection = null;
        }
         
        public function add($GenreXMovie){

            $sql = "INSERT INTO generosXpelicula(id_generoxpelicula,id_pelicula,id_genero) VALUES (:id_generoxpelicula,:id_pelicula,:id_genero)";
            $parameters["id_generoxpelicula"]=$GenreXMovie->getIdMovie().$GenreXMovie->getIdGenre(); 
            $parameters["id_pelicula"]=$GenreXMovie->getIdMovie();
            $parameters["id_genero"]=$GenreXMovie->getIdGenre(); 
            
            try{
                //creo la instancia de coneccion
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(\PDOException $ex){
                throw $ex;
            } 
        }
        
        public function delete($id_pelicula){
            $sql="DELETE FROM generosXpelicula WHERE  id_pelicula = :id_pelicula";
            $parameters['id_pelicula']=$id_pelicula;
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql, $parameters);    

            } catch (\PDOException $ex) {
                throw $ex;
            }

        }
        public function getForID($id){
            //EN ESTA TABLA NO SE UTILIZA EL ID PROPIO
        }
        
        public function getForMovie($id_pelicula){
            $sql = "SELECT * FROM generosXpelicula WHERE id_pelicula = :id_pelicula";
            $parameters['id_pelicula']=$id_pelicula;
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
            $sql="SELECT * FROM generosXpelicula";
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
            //LOS GENEROS X PELICULA NO SE EDITAN
        }

        /*
        *Convierte un array asociativo a un array de objetos para facilitar su manejo
        *si la cantidad de elementos es mayor a 1 retorna el array entero, sino retorna la posicion 0.
        */
        protected function mapear($value) {
            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new GenreXMovie($p['id_pelicula'],$p['id_genero']);
            }, $value);
                /* devuelve un arreglo si tiene datos y sino devuelve nulo*/
                return count($resp) > 1 ? $resp : $resp['0'];
         }
    
    }
    
?>