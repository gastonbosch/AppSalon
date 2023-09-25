<?php
/*
    namespace Classes;

    use Brevo\Client\Api\TransactionalEmailsApi as ApiTransactionalEmailsApi;
    use Brevo\Client\Configuration as ClientConfiguration;
    use Brevo\Client\Model\SendSmtpEmail as ModelSendSmtpEmail;
    
    use Exception;
    use GuzzleHttp;

    class Email {
        
        protected $email;
        protected $nombre;
        protected $token;
    
        public function __construct($email, $nombre, $token)
        {
            $this->email = $email;
            $this->nombre = $nombre;
            $this->token = $token;
    
        }

        public function sendConfirmation(){
            try {
                $config = ClientConfiguration::getDefaultConfiguration()->setApiKey('api-key', $_ENV['API_KEY_BREVO']);

                $apiInstance = new ApiTransactionalEmailsApi(
                    new GuzzleHttp\Client(),
                    $config
                );

                $sendSmtpEmail = new ModelSendSmtpEmail([
                    'subject' => 'Confirma tu Cuenta',
                    'sender' => ['name' => 'Gaston', 'email' => 'gastonbosch@hotmail.com'],
                    //'replyTo' => ['name' => 'Sendinblue', 'email' => 'contact@sendinblue.com'],
                    //'to' => [[ 'name' => $this->nombre, 'email' => $this->email]],
                    'to' => [[ 'name' => $this->nombre, 'email' => $this->email]],
                    'htmlContent' => '<html><body><p>Hola <strong>{{params.nombre}}.</strong> Usted ha creado su cuenta en AppSalon, 
                    solo debe confirmar precionan el siguiente link</p>
                    Click aqui <a href="{{params.dominio}}/confirmAccount?token={{params.token}}">confirmar cuenta</a>
                    <p>Si usted no solicito es cambio, ignore este mensaje</p>
                    </body></html>',
                    'params' => ['nombre' => $this->nombre, 'token'=>$this->token, 'dominio'=>$_ENV['APP_URL']]
                ]); 
                
                $result = $apiInstance->sendTransacEmail($sendSmtpEmail);

            } catch (Exception $e) {
                echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
            }
        }

        public function sendInstructions(){

            try {
                $config = ClientConfiguration::getDefaultConfiguration()->setApiKey('api-key', $_ENV['API_KEY_BREVO']);

                $apiInstance = new ApiTransactionalEmailsApi(
                    new GuzzleHttp\Client(),
                    $config
                );

                $sendSmtpEmail = new ModelSendSmtpEmail([
                    'subject' => 'Reestablecer contraseña',
                    'sender' => ['name' => 'Gaston', 'email' => 'gastonbosch@hotmail.com'],
                    'to' => [[ 'name' => $this->nombre, 'email' => $this->email]],
                    'htmlContent' => '<html><body><p>Hola <strong>{{params.nombre}}</strong> 
                    Usted ha solicitado reestablecer su contraseña, siga el siguiente enlace para hacerlo.</p>
                    Click aqui <a href="{{params.dominio}}/recoverPassword?token={{params.token}}">
                    Reestablecer contraseña</a><p>Si usted no solicito es cambio, ignore este mensaje</p>
                    </body></html',
                    'params' => ['nombre' => $this->nombre, 'token'=>$this->token, 'dominio'=>$_ENV['APP_URL']]
                ]); 

                $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
                
            } catch (Exception $e) {
                echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
            }
        }
    }
*/

    namespace Classes;

    use PHPMailer\PHPMailer\PHPMailer;

    class Email{

        public $email;
        public $name;
        public $token;

        public function __construct($email,$name,$token){
            $this->email = $email;
            $this->name = $name;
            $this->token = $token;
        }
                        
        public function sendConfirmation(){
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->Port = $_ENV['MAIL_PORT'];
            $mail->Username = $_ENV['MAIL_USER'];
            $mail->Password = $_ENV['MAIL_PASS'];

            $mail->setFrom('account@appsalon.com');
            $mail->addAddress('account@appsalon.com');
            $mail->Subject = 'Confirm yout account';
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $contenido = "<html>";
            $contenido .= "<p>Hello <strong>".$this->name."</strong> You have created your account in AppSalon, 
            you just have to confirm by pressing the following link</p>";
            $contenido .= "Press here <a href='http://localhost:80/confirmAccount?token=".$this->token."'>
            Confirm Account</a>";
            $contenido .= "<p>If you did not request this change, ignore this message</p>";
            $contenido .= "</html>";

            $mail->Body = $contenido;
            
            $mail->send();
        }

        public function sendInstructions(){
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->Port = $_ENV['MAIL_PORT'];
            $mail->Username = $_ENV['MAIL_USER'];
            $mail->Password = $_ENV['MAIL_PASS'];

            $mail->setFrom('account@appsalon.com');
            $mail->addAddress('account@appsalon.com');
            $mail->Subject = 'Reset password';
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $contenido = "<html>";
            $contenido .= "<p>Hello <strong>".$this->name."</strong> You have requested to reset your password, 
                                                            follow the link below to do so.</p>";
            $contenido .= "Press here <a href='http://localhost:80/recoverPassword?token=".$this->token."'>
            Reset Password</a>";
            $contenido .= "<p>If you did not request this change, ignore this message</p>";
            $contenido .= "</html>";

            $mail->Body = $contenido;
            
            $mail->send();
        }

    }

?>
