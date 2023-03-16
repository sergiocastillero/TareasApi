<?php
    require_once("./model/user_auth_m.php");

    class Registro{
        public function __construct($params, $body){
            $method = array_shift($params);

            switch ($method){
                case "GET":
                    $this->get();
                    break;
                case "POST":
                    $this->post($body);
                    break;
                default:
                    $this->notImplementedMethod($method);
                    break;
            }
        }

        private function get(){
            require_once("./vista/registro_v.php");
        }

        private function post($body){
            $username = $body['username'];
            $password = $body['password'];

            // Validación de datos
            if(empty($username) || empty($password)){
                // Datos incompletos
                require_once("./vista/registro_v.php");
            }else{
                $model = new User_auth_model();
                $result = $model->createUser($username, $password);
                if($result){
                    // Registro exitoso
                    header("Location: /login");
                    exit();
                }else{
                    // Error en la base de datos
                    require_once("./vista/registro_v.php");
                }
            }
        }

        private function notImplementedMethod($method){
            header('Content-Type: application/json');
            echo json_encode(array("error"=> "Not implemented method!", "method" => $method)).PHP_EOL;
        }
    }
?>
