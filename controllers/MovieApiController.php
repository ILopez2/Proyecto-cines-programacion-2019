<?php
    namespace controllers;
    use models\ClassMovie as CM;

    class MovieApiController{

        public function __construct(){
            
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
            str_replace(" ","+",$name);
            $movies=array();
            $jsonContent=file_get_contents(SERCHM.$name.$lang);

            $arrayJson= ($jsonContent) ? json_decode($jsonContent, true ) : array();
            $arrayMovies=$arrayJson["results"];
                foreach($arrayMovies as $values){
                    $movie=new CM($values["id"],$values["title"],$values["relase_date"],$values["adult"],$values["overview"],$values["poster_path"]);
                    array_push($movies,$movie);
                }
            return $movies;

        }

        public function getMovieXid($id,$lang){
            $jsonContent=file_get_contents(SERCHMID.$id.APIKEY.$lang);
            $values= ($jsonContent) ? json_decode($jsonContent, true ) : array();
            $movie=new CM($values["id"],$values["title"],$values["relase_date"],$values["adult"],$values["overview"],$values["poster_path"]);
            return $movie;
        }

        public function getMoviePoster($posterPath=null,$posterSize="500"){
            
            if($posterPath!=null){
                $imgm=IMGM.$posterSize.$posterPath;
            }
            else $imgm=FRONT_ROOT."assets/images/noImage.png";
            return $imgm;
        }

    }

?>