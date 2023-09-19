<?php
   
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

        public function enviarConfirmacion(){
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
                    'htmlContent' => '<html><body><p>Hello <strong>{{params.nombre}}.</strong> You have created your account in AppSalon, 
                    you just have to confirm by pressing the following link</p>
                    Press here <a href="{{params.dominio}}/confirmAccount?token={{params.token}}">Confirm Account</a>
                    <p>If you did not request this change, ignore this message</p>
                    </body></html>',
                    'params' => ['nombre' => $this->nombre, 'token'=>$this->token, 'dominio'=>$_ENV['APP_URL']]
                ]); 
                
                $result = $apiInstance->sendTransacEmail($sendSmtpEmail);

            } catch (Exception $e) {
                echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
            }
        }

        public function enviarInstrucciones(){

            try {
                $config = ClientConfiguration::getDefaultConfiguration()->setApiKey('api-key', $_ENV['API_KEY_BREVO']);

                $apiInstance = new ApiTransactionalEmailsApi(
                    new GuzzleHttp\Client(),
                    $config
                );

                $sendSmtpEmail = new ModelSendSmtpEmail([
                    'subject' => 'Reestablecer password',
                    'sender' => ['name' => 'Gaston', 'email' => 'gastonbosch@hotmail.com'],
                    'to' => [[ 'name' => $this->nombre, 'email' => $this->email]],
                    'htmlContent' => '<html><body><p>Hello <strong>{{params.nombre}}</strong> 
                    You have requested to reset your password,follow the link below to do so.</p>
                    Press here <a href="{{params.dominio}}/recoverPassword?token={{params.token}}">
                    Reset Password</a><p>If you did not request this change, ignore this message</p>
                    </body></html',
                    'params' => ['nombre' => $this->nombre, 'token'=>$this->token, 'dominio'=>$_ENV['APP_URL']]
                ]); 

                $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
                
            } catch (Exception $e) {
                echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
            }
        }
    }

?>
