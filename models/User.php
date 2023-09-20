<?php

    namespace Model;

    class User extends ActiveRecord{

        protected static $tabla = 'users';
        protected static $columnasDB = ['id','name','surname','email','password',
                                        'telephone','admin','confirmed','token'];

        public $id;
        public $name;
        public $surname;
        public $email;
        public $password;
        public $telephone;
        public $admin;
        public $confirmed;
        public $token;

        public function __construct($args=[]){
            $this->id = $args['id'] ?? null;
            $this->name = $args['name'] ?? '';
            $this->surname = $args['surname'] ?? '';
            $this->email = $args['email'] ?? '';
            $this->password = $args['password'] ?? '';
            $this->telephone = $args['telephone'] ?? '';
            $this->admin = $args['admin'] ?? '0';
            $this->confirmed = $args['confirmed'] ?? '0';
            $this->token = $args['token'] ?? '';
        }
        
        public function validateLogin(){
            if(!$this->email){
                $this->setAlerta('error','Debe ingresar en email');
            }
            if(!$this->password){
                $this->setAlerta('error','Debe ingresar una contraseña');
            }
        }

        public function validateEmail(){
            if(!$this->email){
                $this->setAlerta('error','Debe ingresar en email');
            }
        }

        public function validatePassword(){
            if(!$this->password){
                $this->setAlerta('error','Debe ingresar en email');
            }
            if(strlen($this->password) < 6){
                $this->setAlerta('error','La contraseña debe tener al menos 6 caracteres');
            }
        }

        public function validateNewUserAccount(){
            if(!$this->name){
                $this->setAlerta('error','Debe ingresar un nombre');
            }
            if(!$this->surname){
                $this->setAlerta('error','Debe ingresar un apellido');
            }
            if(!$this->telephone){
                $this->setAlerta('error','Debe ingresar un telefono');
            }
            if(!$this->email){
                $this->setAlerta('error','Debe ingresar un email');
            }
            if(!$this->password){
                $this->setAlerta('error','Debe ingresar una contraseña');
            }else{
                if(strlen($this->password) > 6){
                    $this->setAlerta('error','La contraseña debe tener al menos 6 caracteres');
                }
            }
        }

        public function userExists(){
            $query = "SELECT * FROM ".self::$tabla." WHERE email = '".$this->email."' LIMIT 1";

            $result = self::$db->query($query);

            if($result->num_rows){
                self::setAlerta('error','El usuario ya existe');
            }
        }    
        
        public function hashPassword(){
            //$this->password = password_hash($this->password, PASSWORD_BCRYPT);--Probar CRYPT_BLOWFISH 
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }

        public function createToken(){
            $this->token = uniqid();
        }

        public function validatePasswordAndConfirmation($password){
            $resultado =  password_verify($password, $this->password);
            
            if(!$resultado || !$this->confirmed){
                return false;
            }else{
                return true;
            }
        }
    }

?>