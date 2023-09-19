<?php

    namespace Model;

    class AppointmentService extends ActiveRecord{
        public static $tabla = 'meetingservice';
        public static $columnasDB = ['id','meetingId','serviceId'];

        public $id;
        public $meetingId;
        public $serviceId;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->meetingId = $args['meetingId'] ?? '';
            $this->serviceId = $args['serviceId'] ?? '';
        }
    }
?>