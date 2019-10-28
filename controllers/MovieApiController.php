<?php namespace controllers;
    
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
                    $movie=new CM($values["id"],$values["title"],$values["release_date"],$values["adult"],$values["overview"],$values["poster_path"]);
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
                    $movie=new CM($values["id"],$values["title"],$values["release_date"],$values["adult"],$values["overview"],$values["poster_path"]);
                    //var_dump($values["release_date"]);
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
            $movie=new CM($values["id"],$values["title"],$values["release_date"],$values["adult"],$values["overview"],$values["poster_path"]);
            return $movie;
        }

        public function getMoviePoster($posterPath=null,$posterSize="200"){
            
            if($posterPath!=null){
                $imgm=IMGM.$posterSize.$posterPath;
            }
            else $imgm=FRONT_ROOT."assets/images/noImage.png";
            return $imgm;
        }

        public function getGenres($lang){
            $jsonContent=file_get_contents(GEN.$lang);
            $values= ($jsonContent) ? json_decode($jsonContent, true ) : array();
            $genres=array();
            for($i=0;$i<count($values);$i++){
                $gen=new CGM($values[$i]["name"],$values[$i]["id"]);
                array_push($genres,$gen);
            }
            return $genres;
        }
    }

?>