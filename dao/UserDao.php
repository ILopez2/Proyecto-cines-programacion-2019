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

            $sql = "INSERT INTO usuarios(nombre_user,fecha_nac,email,pass,id_rol1) VALUES (:nombre_user,:fecha_nac,:email,:pass,:id_rol1)";
            $parameters["nombre_user"]=$user->getName();
            $parameters["fecha_nac"]=$user->getBirthdate(); 
            $parameters["email"]=$user->getEmail();
            $parameters["pass"]=$user->getPassword();
            $parameters["id_rol1"]= intval($user->getRoleLevel());
            var_dump($parameters);
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
                return $this->mapear($result);
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
                return $this->mapear($result);
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
        protected function mapear($value) {
            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new User($p['nombre_user'],$p['fecha_nac'],$p['email'],$p['pass'],$p['id_rol1']);
            }, $value);
                /* devuelve un arreglo si tiene datos y sino devuelve nulo*/
                return count($resp) > 1 ? $resp : $resp['0'];
         }
    
    }

?>