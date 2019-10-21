<?php
    namespace daojson;
    use models\ClassMovie as CM;

    class JsonMovieApi{
        private $url;

        public __construct(){
            $this->movies=array()
        }

        public setUrl($url){
            $this->url=$url;
        }

        public getLastMovies($lang){
            $movies=array();
            $jsonContent=file_get_contents(LASTMVS.$lang);

            $arrayJson= ($jsonContent) ? json_decode($jsonContent, true ) : array();
            $arrayMovies=$arrayJson["results"];

            for($i=0;i<count($arrayMovies);$i++){
                foreach($arrayMovies as $values){
                    $movie=new CM($values["id"],$values["title"],$values["relase_date"],$values["adult"],$values["overview"],$values["poster_path"]);
                    array_push($movies,$movie);
                }
            }
            return $movies;
        }

        public getMoviePoster($posterPath=null,$posterSize="500"){
            
            if($posterPath!=null){
                $imgm=IMGM.$posterSize.$posterPath;
            }
            else $imgm=FRONT_ROOT."assets/images/noImage.png"
            return $imgm;
        }

        public getMovie($name,$lang){
            str_replace(" ","+",$name);

            $jsonContent=file_get_contents(SERCHM.$name.$lang);
            $values= ($jsonContent) ? json_decode($jsonContent, true ) : array();
            
            $movie=new CM($values["id"],$values["title"],$values["relase_date"],$values["adult"],$values["overview"],$values["poster_path"]);
        }
        public getMovieXid($id,$lang){
            $jsonContent=file_get_contents(SERCHMID.$id.APIKEY.$lang);
            $values= ($jsonContent) ? json_decode($jsonContent, true ) : array();
            $movie=new CM($values["id"],$values["title"],$values["relase_date"],$values["adult"],$values["overview"],$values["poster_path"]);
            return $movie;
        }


    }

?>