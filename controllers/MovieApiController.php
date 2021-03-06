<?php namespace controllers;
    use models\ClassMovieGenre as CMG;
    use models\ClassMovie as CM;
    use dao\MovieDao as DAOM;
    use dao\MovieGenreDao as DAOG;
    use controllers\ViewsController as VC;
    use controllers\HomeController as HC;

    class MovieApiController{

        private $view;

        public function __construct(){
            $view = new VC();
        }
        //devuelve todas las peliculas de la api a la base de datos
        public function getLastMoviesToDB(){
            try{
                $this->getAllGenresToDB();
                $daom= new DAOM();
                $jsonContent=file_get_contents(LASTMVS.ESP);
                $arrayJson= ($jsonContent) ? json_decode($jsonContent, true ) : array();
                $arrayMovies=$arrayJson["results"];
                foreach($arrayMovies as $values){
                    $movie=$this->getDetailsForId($values["id"]);        
                    $daom->add($movie);             
                }
                $home=new HC();
                $home->Index();
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }
        //metodo que devuelve todas las ultimas peliculas
        public function getLastMovies(){
            try{
                $daom= new DAOM();
                $movies= $daom->getAll();
                return $movies;  
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            } 
        }
        //metodo que devuelve una pelicula por id
        public function getMovieXid($id){     
            try{       
                $daom= new DAOM();
                $movie=$daom->getForID($id);
                return $movie;
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }
        public function getDetailsForId($id){            
            $jsonContent=file_get_contents(SERCHMID.$id.APIKEY.ESP);
            $values= ($jsonContent) ? json_decode($jsonContent, true ) : array();
            $genres=array();
            foreach($values["genres"] as $gen){
                array_push($genres,$gen["id"]);
            }
            $movie=new CM($values["id"],$values["title"],$values["release_date"],$values["overview"],$values["poster_path"],$genres,$values["runtime"]);
            return $movie;
        }
        //metodo que devuelve el poster de una pelicula pasando por parametro la altura 
        public function getMoviePoster($posterPath=null,$posterSize="300"){
            
            if($posterPath!=null){
                $imgm=IMGM.$posterSize.$posterPath;
            }
            else $imgm=FRONT_ROOT."assets/images/noImage.png";
            return $imgm;
        }

        //CARGA TODOS LOS GENEROS DE LA API EN LA BDD
        public function getAllGenresToDB(){
            try{
                $daog=new DAOG();
                $jsonContent=file_get_contents(GEN.ESP);
                $values= ($jsonContent) ? json_decode($jsonContent, true ) : array();
                for($i=0;$i<count($values["genres"]);$i++){
                    $gen=new CMG($values["genres"][$i]["name"],$values["genres"][$i]["id"]);
                    $daog->add($gen);
                }
                $home=new HC();
                $home->Index();
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }
        //DEVUELVE UN ARRAY CON TODOS LOS GENEROS
        public function getAllGenres(){
            try{
                $daog=new DAOG();
                $genres=$daog->getAll();
                return $genres;
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }
        public function getGenreForID($genreId){
            try{
                $daog=new DAOG();
                $genre=$daog->getForID($genreId);
                return $genre;
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }
    }

?>