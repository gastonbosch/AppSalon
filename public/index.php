<?php 

require_once __DIR__ . '/../includes/app.php';

use Controller\LoginController;
use Controller\AdminController;
use Controller\APIController;
use Controller\AppointmentController;
use Controller\ServiceController;
use MVC\Router;

$router = new Router();

//PARTE PUBLICA
//Start sesion
$router->get('/',[LoginController::class,'login']);
$router->post('/',[LoginController::class,'login']);

//Close sesion
$router->get('/logout',[LoginController::class,'logout']);

//Forget password
$router->get('/forgetPassword',[LoginController::class,'forgetPassword']);
$router->post('/forgetPassword',[LoginController::class,'forgetPassword']);

//Reset password
$router->get('/recoverPassword',[LoginController::class,'recoverPassword']);
$router->post('/recoverPassword',[LoginController::class,'recoverPassword']);

//Create Account
$router->get('/createAccount',[LoginController::class,'createAccount']);
$router->post('/createAccount',[LoginController::class,'createAccount']);

//Confirm Account
$router->get('/confirmAccount',[LoginController::class,'confirmAccount']);
$router->get('/message',[LoginController::class,'message']);

//PARTE PRIVADA
//appointment
$router->get('/appointment',[AppointmentController::class,'index']);
$router->get('/admin',[AdminController::class,'index']);

//API
$router->get('/api/services',[APIController::class,'index']);
$router->post('/api/appointment',[APIController::class,'save']);
$router->post('/api/delete',[APIController::class,'delete']);

//CRUD Services
$router->get('/services',[ServiceController::class,'index']);
$router->get('/services/create',[ServiceController::class,'create']);
$router->post('/services/create',[ServiceController::class,'create']);
$router->get('/services/update',[ServiceController::class,'update']);
$router->post('/services/update',[ServiceController::class,'update']);
$router->post('/services/delete',[ServiceController::class,'delete']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();