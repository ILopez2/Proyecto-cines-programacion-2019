<?php namespace Config;
    class movieRepository{
        
        private $movieList = array();

        private function SaveData() {
            $arrayToEncode = array();

            foreach($this->movieList as $movies)
            {
                
                // faltaria saber guardar
                /*$valuesArray["name"] = $user->getName();
                $valuesArray["dni"] = $user->getDNI();
                $valuesArray["birthdate"] = $user->getBirthdate();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["pass"] = $user->getPass();*/

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('movies.json', $jsonContent);
        }

        private function RetrieveData() {
            $this->movieList = array();

            if(file_exists('data/users.json'))
            {
                $jsonContent = file_get_contents('data/users.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {

                    //$user = new User($valuesArray["name"], $valuesArray["dni"], $valuesArray["birthdate"], $valuesArray["email"], $valuesArray["pass"]);

                    array_push($this->movieList, $user);

                }
            }
        }

        public function getAll(){
            $this->retrieveData();
            return $this->movieList;
        }

        public function add($newMovie){
            $this->retrieveData();
            $add=true;
            if(!empty($this->movieList))
            {
                foreach($this->movieList as $value)
                {
                    if($newMovie->getName() == $value->getName()){
                        $add=false;
                    }
                }
            }
            if($add){
                array_push($this->movieList, $newMovie);
            }
            
            $this->saveData();
        }

        
        public function delete($movie){
            $this->retrieveData();
            $newMovieList = array();
            foreach ($this->movieList as $movieOnList) {
                
                /// get movieName()
                if($movieOnList->getMovieName() != $movie){
                    array_push($newMovieList, $movie);
                }
            }
    
            $this->movieList = $newMovieList;
            $this->saveData();
        }
    }