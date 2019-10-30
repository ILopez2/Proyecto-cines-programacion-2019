<?php namespace models;

class ClassMovie{

    //ATRIBUTES
    private $id; //ID DE LA PELICULA
    private $title; //TITULO DE LA PELICULA
    private $releaseDate; //FECHA DE LANZAMIENTO DE LA PELICULA
    private $adult; //BOOLEANO QUE INDICA SI LA PELICULA ES PARA ADULTOS O NO
    private $overview; //SINOPSIS DE LA PELICULA
    private $posterPath; //RUTA DEL ARCHIVO 
    private $genres; //ARRAY DE GENEROS

     //CONSTRUCTOR
    public function __construct($id,$title,$releaseDate,$adult,$overview,$posterPath,$genres=array()){
        $this->id=$id;
        $this->title=$title;
        $this->releaseDate=$releaseDate;
        $this->adult=$adult;
        $this->overview=$overview;
        $this->posterPath=$posterPath;
        $this->genres=$genres;
    }

     //GETTERS
    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getReleaseDate(){
        return $this->releaseDate;
    }
    public function getAdult(){
        return $this->adult;
    }
    public function getOverview(){
        return $this->overview;
    }
    public function getPosterPath(){
        return $this->posterPath;
    }
    public function getGenres(){
        return $this->genres;
    }
}
?>