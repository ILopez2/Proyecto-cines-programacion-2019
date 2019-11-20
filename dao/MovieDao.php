<?php namespace dao;

    use dao\MovieGenreDao as DAOMG;
    use dao\GenreXMovieDao as DAOGXM;
    use dao\Connection as Connection;
    use models\ClassMovie as Movie; 
    use models\ClassGenreXMovie as GenreXMovie; 
    
    class MovieDao implements InterfaceDao{
        
        //ATRIBUTES
        private $connection;

        //CONSTRUCT
        public function __construct()
        {
            $this->connection = null;
        }

        public function add($movie){

            $sql = "INSERT INTO peliculas(id_pelicula,title,releaseDate,overview,posterPath,duration) VALUES (:MovieId,:Title,:RelaseDate,:OverView,:PosterPath,:Duration)";
            $this->delete($movie->getId());
            $parameters["MovieId"]=$movie->getId();
            $parameters["Title"]=$movie->getTitle(); 
            $parameters["RelaseDate"]=$movie->getReleaseDate();
            $parameters["OverView"]= $movie->getOverview();
            $parameters["PosterPath"]= $movie->getPosterPath();
            $parameters["Duration"]= $movie->getDuration();
                  
            try{
                //creo la instancia de coneccion
                $this->connection = Connection::getInstance();
                $queryResult=$this->connection->ExecuteNonQuery($sql,$parameters);
                $daogxm = new DAOGXM();   
                foreach($movie->getGenres() as $gen){
                    $daogxm->delete($movie->getId().$gen);
                    $genXmovie= new GenreXMovie($gen,$movie->getId());
                    $daogxm->add($genXmovie);
                }
                return $queryResult;
            }catch(\PDOException $ex){
                throw $ex;
            } 
        }
        /*
        *Borra una pelicula de la BDD correspondiente al id del mismo pasado por parametro
        */
        public function delete($MovieId){
            $sql="DELETE FROM peliculas WHERE  id_pelicula = :MovieId";
            $parameters['MovieId']=$MovieId;
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
        public function getForID($MovieId){
            $sql = "SELECT * FROM peliculas WHERE id_pelicula = :MovieId";
            $parameters['MovieId']=$MovieId;
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
            $sql="SELECT * FROM peliculas";
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
    
        public function edit($movie){           
            //LAS PELICULAS NO SE EDITAN
        }

        /*
        *Convierte un array asociativo a un array de objetos para facilitar su manejo
        *si la cantidad de elementos es mayor a 1 retorna el array entero, sino retorna la posicion 0.
        */
        protected function mapear($value) {
            $value = is_array($value) ? $value : [];     
            $resp = array_map(function($p){
                $daogxm=new DAOGXM();
                $genres=array();
                $idGenres=$daogxm->getForMovie($p['id_pelicula']);
                if (is_array($idGenres) || is_object($idGenres)){
                    foreach($idGenres as $genId){
                        array_push($genres,$genId->getIdGenre());
                    }
                }   
                return new Movie($p['id_pelicula'],$p['title'],$p['releaseDate'],$p['overview'],$p['posterPath'],$genres,$p['duration']);
            }, $value);
                /* devuelve un arreglo si tiene datos y sino devuelve nulo*/
                return count($resp) > 1 ? $resp : $resp['0'];
         }
    
    }
    
?>