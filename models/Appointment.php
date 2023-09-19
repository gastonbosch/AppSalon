<?php

    namespace Model;

    class Appointment extends ActiveRecord{
        public static $tabla = 'meeting';
        public static $columnasDB = ['id','date','time','userId'];

        public $id;
        public $date;
        public $time;
        public $userId;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->date = $args['date'] ?? '';
            $this->time = $args['time'] ?? '';
            $this->userId = $args['userId'] ?? '';
        }
    }
?>