<?php namespace dao;
/**
*
*/
class Connection {
     private $pdo = null;
     private $pdoStatement = null;
     private static $instance = null;
     /**
      *
      */
     public function __construct() {
          try {
               $this->pdo = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
               $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
          } catch (Exception $ex) {
               throw $ex;
          }
     }
     /**
      *
      */
     public static function getInstance()
     {
         if(self::$instance == null)
            self::$instance = new Connection();
         return self::$instance;
     }
     /**
      *
      */
     public function execute($query, $parameters = array())
     {
          try
          {
			// Creo una sentencia llamando a prepare. Esto devuelve un objeto statement
               $this->pdoStatement = $this->pdo->prepare($query);
               //var_dump($this->pdoStatement);
               foreach($parameters as $parameterName => $value)
               {
                    // Reemplazo los marcadores de parametro por los valores reales utilizando el método bindParam().
                    $this->pdoStatement->bindParam(":".$parameterName, $value);
               }
               //var_dump($this->$pdoStatement);
               //echo 'soy pdostatment';
               $this->pdoStatement->execute();
               return $this->pdoStatement->fetchAll();
          }
          catch(Exception $ex)
          {
               throw $ex;
          }
     }
     /**
      *
      */
     public function executeNonQuery($query, $parameters = array())
     {
          try
          {
               // Creo una sentencia llamando a prepare. Esto devuelve un objeto statement
               $this->pdoStatement = $this->pdo->prepare($query);
               foreach($parameters as $parameterName => $value) {
                    // Reemplazo los marcadores de parametro por los valores reales utilizando el método bindParam().
                    $this->pdoStatement->bindParam(":$parameterName", $parameters[$parameterName]);
               }
               $this->pdoStatement->execute();
               return $this->pdoStatement->rowCount();
          }
          catch(\PDOException $ex)
          {
               throw $ex;
          }
     }
}