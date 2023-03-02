<?php
    Class Tareas_model {
        private $db;
        private $tareas;
        public function __construct(){
            require_once("./model/connexio.php");
            $this->db=Connexio::connectar();
            $this->tareas=array();
        }

        public function getTareas(){
            $consulta = "SELECT * FROM TAREA";
            $result = $this->db->query($consulta);
            while ($fila=$result->fetch(PDO::FETCH_ASSOC)){
                $this->tareas[]=$fila;
            }
            return $this->tareas;
        }

        public function getTareaById($id){
            $consulta = "SELECT * FROM TAREA WHERE ID =". $id .";";
            $result = $this->db->query($consulta);
            while ($fila=$result->fetch(PDO::FETCH_ASSOC)){
                return $fila;
            }
            return null;
        }

        public function getTareasByLista($lista_id){
            $consulta = "SELECT * FROM TAREA WHERE LISTA_ID =". $lista_id .";";
            $result = $this->db->query($consulta);
            while ($fila=$result->fetch(PDO::FETCH_ASSOC)){
                $this->tareas[]=$fila;
            }
            return $this->tareas;
        }

        public function getTareasRealizadas(){
            $consulta = "SELECT * FROM TAREA WHERE REALIZADA = true";
            $result = $this->db->query($consulta);
            while ($fila=$result->fetch(PDO::FETCH_ASSOC)){
                $this->tareas[]=$fila;
            }
            return $this->tareas;
        }

        public function appendTarea($tarea){
            $new_id = -1;
            if ($tarea){
                $consulta = "SELECT ID FROM TAREA ORDER BY ID DESC LIMIT 1;";
                $result = $this->db->query($consulta);
                $last_id = $result->fetch(PDO::FETCH_ASSOC)["ID"];
                $new_id = $last_id + 1;
                $consulta = "INSERT INTO TAREA (ID, DESCRIPCION, FECHA_VENCIMIENTO, REALIZADA, LISTA_ID) VALUES(:id, :descripcion, :fecha_vencimiento, :realizada, :lista_id);";
                $dades = [
                    'id'=>$new_id,
                    'descripcion'=>$tarea->descripcion,
                    'fecha_vencimiento'=>$tarea->fecha_vencimiento,
                    'realizada'=>$tarea->realizada,
                    'lista_id'=>$tarea->lista_id
                ];
                $res_insert = $this->db->prepare($consulta)->execute($dades);
            }
            return $new_id;
        }

        public function deleteTareaById($id){
            $consulta = "DELETE FROM TAREA WHERE ID=?;";
                
            $res_delete = $this->db->prepare($consulta)->execute(array($id));
        }
    }
?> 