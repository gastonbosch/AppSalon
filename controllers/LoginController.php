<?php

    namespace Controller;

    use Classes\Email;
    use MVC\Router;
    use Model\User;

    class LoginController{

        public static function login(Router $router){

            $alertas = [];

            if($_SERVER['REQUEST_METHOD']==='POST'){
                $auth = new User($_POST);

                $auth->validateLogin();
                
                if(empty(User::getAlertas())){
                    
                    $user = User::where('email',$auth->email);
                    
                    if($user){
                        //If the user exists we validate password
                        if($user->validatePasswordAndConfirmation($auth->password)){
                            session_start();

                            $_SESSION['id'] = $user->id;
                            $_SESSION['name'] = $user->name.' '.$user->surname;
                            $_SESSION['email'] = $user->email;
                            $_SESSION['login'] = true;
                            
                            //Redireccionamiento
                            if($user->admin==='1'){
                                $_SESSION['admin'] = $user->admin ?? null;
                                
                                header('Location: /admin');
                            }else{
                                header('Location: /appointment');
                            }
                        }else{
                            //If the password is incorrect
                            User::setAlerta('error','La contraseña es incorrecta o el usuario no está confirmado');                         
                        }
                    }else{
                        //Is the user not exists
                        User::setAlerta('error','Usuario no encontrado');
                    }

                }
            }
            $alertas = User::getAlertas();
            
            $router->render('auth/login',[
                'alerts' => $alertas
            ]);
        }

        public static function logout(){
            session_start();
            $_SESSION = [];
            header('Location: /');
        }

        public static function forgetPassword(Router $router){

            if($_SERVER['REQUEST_METHOD']==='POST'){
                $auth = new User($_POST);

                $auth->validateEmail();

                if(empty(User::getAlertas())){
                    $user = User::where('email',$auth->email);

                    if($user && $user->confirmed === '1'){
                        //Usuario existe y esta confirmado

                        //I create the token and save
                        $user->createToken();
                        $user->guardar();

                        //Send email
                        $email = new Email($user->email, $user->name, $user->token);
                        $email->sendInstructions();

                        //Message to succese
                        User::setAlerta('succese','Consulte su correo electrónico');

                    }else{
                        //Usuario no existe o no esta confirmado
                        User::setAlerta('error','El usuario no existe o no está confirmado');
                    }
                }
            }

            $router->render('auth/forgetPassword',[
                'alerts' => User::getAlertas()
            ]);
        }

        public static function recoverPassword(Router $router){

            $error = false;
            $user = User::where('token',$_GET['token']);

            if(empty($user)){
                User::setAlerta('error','Token no valido');
                $error = true;
            }else{
                if($_SERVER['REQUEST_METHOD']==='POST'){
                    $pass = new User($_POST);
                    
                    $pass->validatePassword();
                    
                    if(empty($pass::getAlertas())){
                        $user->password = $pass->password;

                        $user->hashPassword($user->password);
                        $user->token=null;
                     
                        $result = $user->guardar();

                        if($result){
                            header('Location: /');
                        }
                    }
                }
            }

            $router->render('auth/recoverPassword',[
                'alerts' => User::getAlertas(),
                'error' =>$error
            ]);
        }

        public static function createAccount(Router $router){

            $user = new User;
            $alerts = [];

            if($_SERVER['REQUEST_METHOD']==='POST'){
                $user = new User($_POST);

                $user->validateNewUserAccount();
                $alerts = $user::getAlertas();
                //Validate if you have an alerts
                if(empty($alerts)){
                    //Validate if you user already exist
                    $user->userExists();
                    $alerts = $user::getAlertas();
                    if(empty($alerts)){
                        //if user exists we hash password
                        $user->hashPassword();

                        //we create a token
                        $user->createToken();

                        //we send email
                        $emial = new Email($user->email, $user->name, $user->token);
                        
                        $emial->sendConfirmation();

                        $resultado = $user->guardar();

                        if($resultado){
                            header('Location: /message');
                        }
                    }
                }
            }

            $router->render('auth/createAccount',[
                'user' => $user,
                'alerts' => $alerts
            ]);
        }

        public static function message(Router $router){
            $router->render('auth/message',[]);
        }

        public static function confirmAccount(Router $router){

            $alerts = [];
            $token = s($_GET['token']);
            
            $user = User::where('token',$token);
            
            if(empty($user)){
                User::setAlerta('error','Token no valido');
            }else{
                $user->confirmed = '1';
                $user->token = null;
                $user->guardar();
                User::setAlerta('succese','Cuenta validada exitosamente');
            };
            $alerts = User::getAlertas();
            $router->render('auth/confirmAccount',[
                'alerts'=>$alerts
            ]);
        }

    }

?>