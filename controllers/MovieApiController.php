<?php namespace controllers;
    //https://developers.themoviedb.org/3
    use models\ClassMovieGenre as CMG;
    use models\ClassMovie as CM;
    use controllers\ViewsController as VC;

    class MovieApiController{

        private $view;

        public function __construct(){
            $view = new VC();
        }

        public function getLastMovies($lang){
            $movies=array();
            $jsonContent=file_get_contents(LASTMVS.$lang);

            $arrayJson= ($jsonContent) ? json_decode($jsonContent, true ) : array();
            $arrayMovies=$arrayJson["results"];
                foreach($arrayMovies as $values){
                    $movieGenres=$this->genreIdToName($values["genre_ids"],$lang);
                    $movie=new CM($values["id"],$values["title"],$values["release_date"],$values["adult"],$values["overview"],$values["poster_path"],$movieGenres);
                    array_push($movies,$movie);
            }
            return $movies;
        }

        /**DEVUELVE UN ARREGLO CON PELICULAS RELACIONADAS AL NOMBRE QUE SE PASO POR PARAMETRO */
        public function getMovie($name,$lang){
            $aux = str_replace(" ","+",$name);
            $movies=array();

            $jsonContent=file_get_contents(SERCM.$aux.$lang);
            $arrayJson= ($jsonContent) ? json_decode($jsonContent, true ) : array();
            $arrayMovies=$arrayJson["results"];

            foreach($arrayMovies as $values){
                    $movieGenres=$this->genreIdToName($values["genre_ids"],$lang);
                    $movie=new CM($values["id"],$values["title"],$values["release_date"],$values["adult"],$values["overview"],$values["poster_path"],$movieGenres);
                    array_push($movies,$movie);
            }
            return $movies;

        }

        public function search($searchResult){
            $this->view->search($searchResult);
        }

        public function getMovieXid($id,$lang){
            
            $jsonContent=file_get_contents(SERCHMID.$id.APIKEY.$lang);
            $values= ($jsonContent) ? json_decode($jsonContent, true ) : array();
            $movieGenres=array();
            foreach($values["genres"] as $gen){
                array_push($movieGenres,$gen["name"]);
            }
            $movie=new CM($values["id"],$values["title"],$values["release_date"],$values["adult"],$values["overview"],$values["poster_path"],$movieGenres);
            return $movie;
        }

        public function getMoviePoster($posterPath=null,$posterSize="200"){
            
            if($posterPath!=null){
                $imgm=IMGM.$posterSize.$posterPath;
            }
            else $imgm=FRONT_ROOT."assets/images/noImage.png";
            return $imgm;
        }

        //TRANSFORMA EL ARRAY DE IDS DE GENEROS EN UN ARRAY DE LOS NOMBRES DE LOS GENEROS
        public function genreIdToName($genresId,$lang){
            $genreNames=array();
            $allGenres=$this->getAllGenres($lang);
            foreach($allGenres as $genre){
                for($i=0;$i<count($genresId);$i++){
                    if($genre->getId()==$genresId[$i]){                
                        array_push($genreNames,$genre->getName());
                    }
                }
            }
            
            return $genreNames;
        }
        //DEVUELVE UN ARRAY CON TODOS LOS GENEROS
        public function getAllGenres($lang){
            $jsonContent=file_get_contents(GEN.$lang);
            $values= ($jsonContent) ? json_decode($jsonContent, true ) : array();
            $genres=array();
            for($i=0;$i<count($values["genres"]);$i++){
                $gen=new CMG($values["genres"][$i]["name"],$values["genres"][$i]["id"]);
                array_push($genres,$gen);
            }
            return $genres;
        }
    }

?>