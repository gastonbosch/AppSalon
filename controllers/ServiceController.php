<?php

    namespace Controller;

use Model\Service;
use MVC\Router;

    class ServiceController{

        public static function index(Router $router){

            if(!isset($_SESSION)){
                session_start();
            }

            isAdmin();

            $services = Service::all();

            $router->render('services/index',[
                'name'=>$_SESSION['name'],
                'services'=>$services
            ]);
        }

        public static function create(Router $router){

            if(!isset($_SESSION)){
                session_start();
            }

            isAdmin();

            $service = new Service;

            if($_SERVER['REQUEST_METHOD']==='POST'){
                $service->sincronizar($_POST);
                $service->validate();
                if(empty(Service::getAlertas())){
                    $service->guardar();
                    header('Location: /services');
                }
            }

            $router->render('services/create',[
                'name'=>$_SESSION['name'],
                'service'=>$service,
                'alerts'=>Service::getAlertas()
            ]);
        }

        public static function update(Router $router){

            if(!isset($_SESSION)){
                session_start();
            }

            isAdmin();

            if (!is_numeric($_GET['id'])) return;

            $service = Service::find($_GET['id']);

            if($_SERVER['REQUEST_METHOD']==='POST'){
                $service->sincronizar($_POST);
                $service->validate();
                if(empty(Service::getAlertas())){
                    $service->guardar();
                    header('Location: /services');
                }
            }
            
            $router->render('services/update',[
                'name'=>$_SESSION['name'],
                'service'=>$service,
                'alerts'=>Service::getAlertas()
            ]);
        }

        public static function delete(){

            if(!isset($_SESSION)){
                session_start();
            }

            isAdmin();

            $service = Service::find($_POST['id']);
            $service->eliminar();
            header('Location: /services');
        }
    }

?>