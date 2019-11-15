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
            $sql = "INSERT INTO entradas(id_entrada,nro_asiento1,id_funcion1,id_usuario1,id_factura1) VALUES (:name, :address, :price, :city)";
            $parameters["name"]=$cinema->getName();
            $parameters["city"]=$cinema->getCity();
            $parameters["address"]=$cinema->getAddress();
            $parameters["price"]=$cinema->getTicketCost();
            try{
                //creo la instancia de coneccion
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(\PDOException $ex){
                throw $ex;
            } 
        }
    }