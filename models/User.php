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
                $this->setAlerta('error','You must enter an email');
            }
            if(!$this->password){
                $this->setAlerta('error','You must enter a password');
            }
        }

        public function validateEmail(){
            if(!$this->email){
                $this->setAlerta('error','You must enter an email');
            }
        }

        public function validatePassword(){
            if(!$this->password){
                $this->setAlerta('error','You must enter an email');
            }
            if(strlen($this->password) < 6){
                $this->setAlerta('error','Password must have at least 6 characters');
            }
        }

        public function validateNewUserAccount(){
            if(!$this->name){
                $this->setAlerta('error','You must enter a user name');
            }
            if(!$this->surname){
                $this->setAlerta('error','You must enter a user surname');
            }
            if(!$this->telephone){
                $this->setAlerta('error','You must enter a telephone');
            }
            if(!$this->email){
                $this->setAlerta('error','You must enter a email');
            }
            if(!$this->password){
                $this->setAlerta('error','You must enter a password');
            }else{
                if(strlen($this->password) > 6){
                    $this->setAlerta('error','Password must have at least 6 characters');
                }
            }
        }

        public function userExists(){
            $query = "SELECT * FROM ".self::$tabla." WHERE email = '".$this->email."' LIMIT 1";

            $result = self::$db->query($query);

            if($result->num_rows){
                self::setAlerta('error','User already exists');
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