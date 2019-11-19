<?php namespace dao;

    use models\ClassTicket as ClassTicket;
    use dao\Connection as Connection;

    class TicketDao{

        //ATRIBUTES
        private $connection;

        //CONSTRUCT
        public function __construct()
        {
            $this->connection = null;
        }
        //METHODS
        /*
        *Agrega un nuevo ticket a la BDD
        */
        public function add($ticket){
            $sql = "INSERT INTO entradas(id_entrada,nro_asiento1,id_funcion1,id_usuario1,id_factura1) VALUES (:ticketID, :seat, :functionID, :userID,:billID)";
            $parameters["name"]=$ticket->getTicketID();//id_entrada
            $parameters["city"]=$ticket->getFunctionID();
            $parameters["price"]=$ticket->getUserID();//id_usuario1
            $parameters["price"]=$ticket->getQR();//????
            $parameters["price"]=$ticket->getMovieID();//???? con la tabla de peliculas nueva...
            try{
                //creo la instancia de coneccion
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(\PDOException $ex){
                throw $ex;
            } 
        }

        public function getAll(){
            $sql="SELECT * FROM entradas(id_entrada,nro_asiento1,id_funcion1,id_usuario1,id_factura1)";
            try{
                //creo la instancia de coneccion
                $this->connection= Connection::getInstance();
                $result = $this->connection->execute($sql);
            }catch(\PDOException $ex){
                throw $ex;
            } 
    
            //hay que mapear de un arreglo asociativo a objetos
            if(!empty($result)){
                return $this->mapeo($result);
            }else{
                return false;
            }
        }

        public function edit($function){

        }
        /*
        *Convierte un array asociativo a un array de objetos para facilitar su manejo
        *si la cantidad de elementos es mayor a 1 retorna el array entero, sino retorna la posicion 0.
        */
        protected function mapeo($value) {
            //echo '<pre>';
            //var_dump($value);
            //echo '</pre>';
            $value = is_array($value) ? $value : [];   
            $resp=array();  
            $resp = array_map(function($p){
            return new ClassTicket($p['id_entrada'],$p['nro_asiento1'],$p['id_funcion1'],$p['id_usuario1'],$p['id_factura1']);
            }, $value);
                /* devuelve un arreglo si tiene datos y sino devuelve nulo*/
                return count($resp) > 1 ? $resp : $resp['0'];
         }
    }