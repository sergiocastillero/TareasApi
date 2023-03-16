<?php
class Listas_model {
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
        if (!$result) {
            throw new Exception("Error al obtener las listas: " . $this->db->errorInfo()[2]);
        }
        while ($fila=$result->fetch(PDO::FETCH_ASSOC)){
            $this->listas[]=$fila;
        }
        return $this->listas;
    }

    public function getListaById($id){
        $consulta = "SELECT * FROM LISTA WHERE ID = :id;";
        $stmt = $this->db->prepare($consulta);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getListaByTarea($tarea_id){
        $consulta = "SELECT * FROM LISTA WHERE ID = (SELECT LISTA_ID FROM TAREA WHERE ID=:tarea_id);";
        $stmt = $this->db->prepare($consulta);
        $stmt->bindParam(':tarea_id', $tarea_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function appendLista($lista){
        $new_id = -1;
        if ($lista){
            $consulta = "SELECT ID FROM LISTA ORDER BY ID DESC LIMIT 1;";
            $result = $this->db->query($consulta);
            $last_id = $result->fetch(PDO::FETCH_ASSOC)["ID"];
            $new_id = $last_id + 1;
            $consulta = "INSERT INTO LISTA (ID, NOMBRE, USUARIO_ID) VALUES(:id, :nombre, :usuario_id);";
            $dades = [
                'id'=>$new_id,
                'nombre'=>$lista->nombre,
                'usuario_id'=>$lista->usuario_id
            ];
            $stmt = $this->db->prepare($consulta);
            $stmt->execute($dades);
        }
        return $new_id;
    }

    public function deleteListaById($id){
        $consulta = "DELETE FROM LISTA WHERE ID=:id;";
        $stmt = $this->db->prepare($consulta);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>
