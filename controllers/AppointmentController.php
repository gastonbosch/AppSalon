<?php
    namespace Controller;

    use MVC\Router;

    class AppointmentController{

        public static function index(Router $router){

            if(empty($_SESSION)){
                session_start();
            }

            isAuth();

            $router->render('appointment/index',[
                'name'=>$_SESSION['name'],
                'id'=>$_SESSION['id']
            ]);
        }

    }


?>