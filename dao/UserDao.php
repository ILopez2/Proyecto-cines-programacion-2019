<?php namespace dao;

    use dao\Connection as Connection;
    use models\ClassUser as User; 
    
    class UserDao implements InterfaceDao{
        
        //ATRIBUTES
        private $connection;

        //CONSTRUCT
        public function __construct()
        {
            $this->connection = null;
        }

        //METHODS
        /*
        *Cambia la contraseña del usuario
        */
        public function updatePass($email,$pass)
        {
          $sql = "UPDATE usuarios SET pass = :pass  WHERE email = :email";
          $parameters['email'] = $email;
          $parameters['pass'] = $pass;
          try
          {
              $this->connection = Connection::getInstance();
              return $this->connection->ExecuteNonQuery($sql, $parameters);
          }
          catch(PDOException $e)
          {
              echo $e;
          }
        }
         /*
        *Agrega un nuevo user a la BDD
        */
        public function add($user){
            $sql = "INSERT INTO usuarios(email,pass,dni1,id_rol1) VALUES (':email',':pass',':dni',':id_rol')";
            $parameters["name"]=$user->getName();
            $parameters["birthdate"]=$user->getBirthdate();  //TENGO QUE ARREGLAR LA BASE DE DATOS,MAÑANA CONSULTO CON VERO
            $parameters["nationality"]=$user->getNationality();
            $parameters["email"]=$user->getEmail();
            $parameters["pass"]=$user->getPassword();
            try{
                //creo la instancia de coneccion
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(\PDOException $ex){
                throw $ex;
            } 
        }
        /*
        *Borra un user de la BDD correspondiente al email del mismo pasado por parametro
        */
        public function delete($email){
            $sql="DELETE FROM usuarios WHERE  email = :email";
            $parameters['email']=$email;
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql, $parameters);    

            } catch (\PDOException $ex) {
                throw $ex;
            }

        }
        /*
        *Retorna el user con el email pasado por parametro
        */
        public function getForID($email){
            $sql = "SELECT * FROM usuarios WHERE email = :email";
            $parameters['email']=$email;
            try{
                //creo la instancia de coneccion
                $this->connection= Connection::getInstance();
                $result = $this->connection->execute($sql,$parameters);
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
        /*
        *Retorna todos los users de la BDD
        */
        public function getAll(){
            $sql="SELECT * FROM usuarios";
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

        public function setRole($email,$role){
            $sql="UPDATE usuarios SET id_rol1 = 'admin' WHERE email = :email";
            $parameters['email']=$email;
            try{
                //creo la instancia de coneccion
                $this->connection= Connection::getInstance();
                $result = $this->connection->execute($sql,$parameters);
            }catch(\PDOException $ex){
                throw $ex;
            } 
        } public function edit(){

        }
        /*
        *Convierte un array asociativo a un array de objetos para facilitar su manejo
        *si la cantidad de elementos es mayor a 1 retorna el array entero, sino retorna la posicion 0.
        */
        protected function mapeo($value){
            $value=is_array($value) ? $value : [];
            $value = array_map(function($p){
                return new User($p['name'],$p['birthdate'],$p['nationality'],$p['email'],$p['pass']);
            },$value);
            return count($resp) > 1 ? $resp : $resp['0'];//hay que checkear del otro lado si esta devolviendo un obj o un array
        }
    }

?>