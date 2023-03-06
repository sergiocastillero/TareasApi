<?php
    Class Listas_model {
        private $db;
        private $listas;
        public function __construct(){
            require_once("./model/connexio.php");
            $this->db=Connexio::connectar();
            $this->listas=array();
        }

        public function getListas(){
            $consulta = "SELECT * FROM LISTA";
            $result = $this->db->query($consulta);
            while ($fila=$result->fetch(PDO::FETCH_ASSOC)){
                $this->listas[]=$fila;
            }
            return $this->listas;
        }

        public function getListaById($id){
            $consulta = "SELECT * FROM LISTA WHERE ID =". $id .";";
            $result = $this->db->query($consulta);
            while ($fila=$result->fetch(PDO::FETCH_ASSOC)){
                return $fila;
            }
            return null;
        }

        public function getListaByTarea($tarea_id){
            $consulta = "SELECT * FROM LISTA WHERE ID = (SELECT LISTA_ID FROM TAREA WHERE ID=".$tarea_id.");";
            $result = $this->db->query($consulta);
            while ($fila=$result->fetch(PDO::FETCH_ASSOC)){
                return $fila;
            }
            return null;
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

        public function deleteListaById($id){
            $consulta = "DELETE FROM LISTA WHERE ID=?;";
                
            $res_delete = $this->db->prepare($consulta)->execute(array($id));
        }
    }
?> 