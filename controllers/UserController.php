<?php namespace controllers;
    
    use models\ClassUser as User;
    use daojson\JsonUser as JsonUser;
    use dao\UserDao as UserDao;
    use controllers\ViewsController as ViewController;
    class UserController{
    
        //ATRIBUTES
        private $userDAO;
        private $view;

        //CONSTRUCT
        public function __construct(){
            $this->userDAO = new UserDao();
            $this->view = new ViewController();
        }

        //METHODS
        
         /**
         * @method checkSession
        *
        * Este método verifica si existe un usuario en sesion y en caso
        * afirmativo lo toma de la base de datos y compara contraseñas.
        * Esto lo hace con el fin de asegurar que si cambio algun dato
        * obtiene la información actualizada.
        */
        public function checkSession() {
            if (session_status() == PHP_SESSION_NONE)
                session_start();

            if(isset($_SESSION['userLogedIn'])) {

                $user = $this->userDAO->getForID($_SESSION['userLogedIn']->getEmail());

                if($user->getPassword() == $_SESSION['userLogedIn']->getPassword())
                    return $user;

            } else {
                return false;
            }
        }
            /**
         * @method login
        *
        * Verifica si existe un usuario con el Email ingresado
        * En caso de que asi sea comprueba la contraseña y lo guarda en session.
        */
        public function login($email,$pass){
            $rta=false;
            $user=$this->userDAO->getForId($email);
            if($user!=null){
                if(($user->getEmail() == $email) && ($user->getPassword() == $pass)){
                    $_SESSION['userLogedIn'] = $user;
                    $_SESSION['loggedRole'] = $user->getRoleLevel();
                    $rta=true;
                }
            }               
            return $rta;
        }
        /**
         * @method logout
        *
        * Deslogea al usuario borrandolo de la Session
        */
        public function logout(){
            //elimina el usuario de la session
            unset($_SESSION['userLogedIn']);
            unset($_SESSION['loggedRole']);

        }
        /**
         * @method singUp
        *
        *  Registra un nuevo usuario en la bdd, siempre y cuando este no ingrese un email ya ingresado antes.
        */
        public function singUp($name,$birthdate,$email,$password,$role='2'){
            //registrar nuevo usario
            $newUser = new User($name,$birthdate,$email,$password,$role);
            if(!$this->checkUserExists($newUser->getEmail())){
                $this->userDAO->add($newUser);
                $_SESSION['successMje'] = 'Usuario agregado con éxito';
            }else{
                $_SESSION['errorMje']='El <strong>email</strong> ingresado ya esta en uso.';
            }
        }
        /**
         * @method checkUserExists
        *  Comprueba la existencia de un email en la bdd
        */
        public function checkUserExists($email){
            $userList = $this->userDAO->getAll();
            $rta=false;
            foreach($userList as $user){
                if($user->getEmail() == $email){
                    $rta=true;
                }
            }
            return $rta;
        }
        /**
         * @method add
        *   Agrega un nuevo user a la bdd
         */
        public function add($name,$birthdate,$email,$password,$role){
            //agrega un usuario al dao
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                $newUser = new User($name,$birthdate,$email,$password,$role);
                if(!$this->checkUserExists($newUser->getEmail())){
                    $this->userDAO->add($newUser);
                    $_SESSION['successMje'] = 'Usuario agregado con éxito';
                }else{
                    $_SESSION['errorMje']='El <strong>email</strong> ingresado ya esta en uso.';
                }
                $this->view->admUsers();
            }
        }
        /**
         * @method delete
        *   Borra un usuario de la bdd correspondiente al email pasado por parametro
         */
        public function delete($email){
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
               if($this->userDAO->delete($email)){
                $_SESSION['successMje'] = 'Usuario borrado con éxito';
               }
                $this->view->admUsers();
            }
        }
        /**
         * @method edit
        *   Edita los campos de un usuario existente
         */
        public function edit($email,$name,$birthdate,$password,$role){
            //edita uno o varios campos
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                $auxUser = new User($name,$birthdate,$email,$password,$role);
                if($this->userDAO->edit($auxUser)){
                    $_SESSION['successMje'] = 'Usuario editado con éxito';
                }
                $this->view->admUsers();
            }
        }
        /**
         * @method setRole
        *   Setea el rol de un usuario a "Admin" o "Comun" segun corresponda
         */
        public function setRole($email,$role){
            //vuelve a un usuario admin
            if(isset($_SESSION['loggedRole']) && $_SESSION['loggedRole'] == '1'){
                if($this->userDAO->setRole($email,$role)){
                    $_SESSION['successMje'] = 'Rol cambiado con éxito';
                }
                $this->view->admUsers();
            }
        }
}