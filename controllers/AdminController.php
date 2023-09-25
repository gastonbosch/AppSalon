<?php 

    namespace Controller;

    use Model\AdminAppointment;
    use MVC\Router;

    class AdminController{

        public static function index(Router $router){
            
            if(!isset($_SESSION)){
                session_start();
            }

            isAdmin();
            
            $date = $_GET['date'] ?? date('Y-m-d');
            $dateArray = explode('-',$date);
            
            if(!checkdate($dateArray[1],$dateArray[2],$dateArray[0])){
                header('Location: /404');
            }
            
            $query = "select m.id, m.time,concat(u.name,' ',u.surname) as client, u.email, u.telephone, s.name as service, s.price  
                      from meeting m 
                      left outer join users u 
                      on m.userId = u.id 
                      left outer join meetingservice m2 
                      on m.id = m2.meetingId 
                      left outer join services s 
                      on m2.serviceId = s.id
                      where m.date = '$date'";
            
            

            $appointments = AdminAppointment::SQL($query);

            $router->render('admin/index',[
                'name'=>$_SESSION['name'],
                'appointments'=>$appointments,
                'date'=>$date
            ]);
        }
    }

?>