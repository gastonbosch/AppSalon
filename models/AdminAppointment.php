<?php

    namespace Model;

    class AdminAppointment extends ActiveRecord{

        protected static $tabla = 'meetingservice';
        protected static $columnasDB = ['id','time','client','email','telephone','service','price'];

        public $id;
        public $time;
        public $client;
        public $email;
        public $telephone;
        public $service;
        public $price;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->time = $args['time'] ?? '';
            $this->client = $args['client'] ?? '';
            $this->email = $args['email'] ?? '';
            $this->telephone = $args['telephone'] ?? '';
            $this->service = $args['service'] ?? '';
            $this->price = $args['price'] ?? '';
        }
    }

?>