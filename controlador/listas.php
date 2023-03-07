<?php
    require_once("./model/listas_m.php");
    class Listas{    
        public function __construct($params, $body){
            $method = array_shift($params);
            $x_api_key = array_shift($params);
            switch ($method){
                case "GET":
                    $this->getLista($params);
                    break;
                case "POST":
                    $this->postLista($params, $body);
                    break;
                case "DELETE":
                    $this->deleteLista($params);
                    break;
                default:
                    $this->notImplementedMethodLista($params, $method);
                    break;
            }
        }

        private function getLista($params){
            $model = new Listas_model();
            if (count($params) == 0){
                $listas = $model->getListas();
            }else{
                switch (strtolower($params[0])){
                    case "id":
                        $listas = $model->getListaById($params[1]);
                        break;
                    case "lista":
                        $listas = $model->getListaByTarea($params[1]);
                        break;
                    default:
                        echo "bad request";
                }
            }
            require_once("./vista/listas_v.php");
        }

        private function postLista($params, $body){
            $model = new Listas_model();
            $newId = $model->appendLista($body);
            $listas = $model->getListaById($newId);
            http_response_code(201);
            require_once("./vista/listas_v.php");
        }

        private function deleteLista($params){
            $model = new Listas_model();
            if (count($params) == 0){
                echo "bad request";
            }else{
                switch (strtolower($params[0])){
                    case "id":
                        $resultado = $model->deleteListaById($params[1]);
                        break;
                    default:
                        echo "bad request";
                }
            }
            http_response_code(204);
        }

        private function notImplementedMethodLista($params, $method){
            header('Content-Type: application/json');
            echo json_encode(array("error"=> "Not implemented method!", "method" => $method, "params" => $params)).PHP_EOL;
        }
    }
?>