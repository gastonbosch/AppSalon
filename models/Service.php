<?php

    namespace Model;

    class Service extends ActiveRecord{

        //Base de datos
        protected static $tabla = 'services';
        protected static $columnasDB = ['id','name','price'];

        public $id;
        public $name;
        public $price;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->name = $args['name'] ?? '';
            $this->price = $args['price'] ?? '';
        }

        public function validate(){
            if(!$this->name){
                self::setAlerta('error','Name is required');
            }

            if(!$this->price){
                self::setAlerta('error','Price is required');
            }

            if(!is_numeric($this->price)){
                self::setAlerta('error','Not valid format');
            }
        }

    }

?>