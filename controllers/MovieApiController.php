<?php namespace controllers;
    //https://developers.themoviedb.org/3
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
        public function getLastMoviesToDB(){
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
        public function getLastMovies(){
            $daom= new DAOM();
            $movies= $daom->getAll();
            return $movies;   
        }

        public function getMovieXid($id){            
            $daom= new DAOM();
            $movie=$daom->getForID($id);
            return $movie;
        }
        public function getDetailsForId($id){            
            $jsonContent=file_get_contents(SERCHMID.$id.APIKEY.ESP);
            $values= ($jsonContent) ? json_decode($jsonContent, true ) : array();
            $genres=array();
            foreach($values["genres"] as $gen){
                array_push($genres,$gen["id"]);
            }
            $movie=new CM($values["id"],$values["title"],$values["release_date"],$values["adult"],$values["overview"],$values["poster_path"],$genres,$values["runtime"]);
            return $movie;
        }
        public function getMoviePoster($posterPath=null,$posterSize="300"){
            
            if($posterPath!=null){
                $imgm=IMGM.$posterSize.$posterPath;
            }
            else $imgm=FRONT_ROOT."assets/images/noImage.png";
            return $imgm;
        }

        //CARGA TODOS LOS GENEROS DE LA API EN LA BDD
        public function getAllGenresToDB(){
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
        //DEVUELVE UN ARRAY CON TODOS LOS GENEROS
        public function getAllGenres(){
            $daog=new DAOG();
            $genres=$daog->getAll();
            return $genres;
        }
    }

?>