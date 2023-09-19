<?php 

    namespace Controller;

    use Model\Service;
    use Model\Appointment;
    use Model\AppointmentService;

    class APIController{

        public static function index(){
            $services = Service::all();

            echo json_encode($services);
        }

        public static function save(){
            //Save appointment
            $appointment = new Appointment($_POST);
            $response = $appointment->guardar();

            //Save AppointmentService
            $idService = explode(",",$_POST['services']);

            foreach($idService as $idService){
                $args = [
                    'meetingId' => $response['id'],
                    'serviceId' => $idService
                ];

                $appointmentAservice = new AppointmentService($args);
                $appointmentAservice->guardar();
            }

            echo json_encode($response);
        } 
        
        public static function delete(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $appointment = Appointment::find($_POST['id']);
                $appointment->eliminar();
                header('Location:'.$_SERVER['HTTP_REFERER']);
            }
        }

    }

?>