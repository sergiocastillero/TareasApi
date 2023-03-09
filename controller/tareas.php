<?php
    require_once("./model/tareas_m.php");
    class Tareas{    
        public function __construct($params, $body){
            $method = array_shift($params);
            $x_api_key = array_shift($params);
            switch ($method){
                case "GET":
                    $this->getTarea($params);
                    break;
                case "POST":
                    $this->postTarea($params, $body);
                    break;
                case "DELETE":
                    $this->deleteTarea($params);
                    break;
                default:
                    $this->notImplementedMethodTarea($params, $method);
                    break;
            }
        }

        private function getTarea($params){
            $model = new Tareas_model();
            if (count($params) == 0){
                $tareas = $model->getTareas();
            }else{
                switch (strtolower($params[0])){
                    case "id":
                        $tareas = $model->getTareaById($params[1]);
                        break;
                    case "lista":
                        $tareas = $model->getTareasByLista($params[1]);
                        break;
                    default:
                        echo "bad request";
                }
            }
            require_once("./vista/tareas_v.php");
        }

        private function postTarea($params, $body){
            $model = new Tareas_model();
            $newId = $model->appendTarea($body);
            $tareas = $model->getTareaById($newId);
            http_response_code(201);
            require_once("./vista/tareas_v.php");
        }

        private function deleteTarea($params){
            $model = new Tareas_model();
            if (count($params) == 0){
                echo "bad request";
            }else{
                switch (strtolower($params[0])){
                    case "id":
                        $tareas = $model->deleteTareaById($params[1]);
                        break;
                    default:
                        echo "bad request";
                }
            }
            http_response_code(204);
        }

        private function notImplementedMethodTarea($params, $method){
            header('Content-Type: application/json');
            echo json_encode(array("error"=> "Not implemented method!", "method" => $method, "params" => $params)).PHP_EOL;
        }
    }
?>