<?php

namespace Models;

use \Core\Model;
use \Models\Registros;

class Externos extends Model
{

    // ! 1 = Ajudantes
    // ! 2 = Jornal
    // ! 3 = Forum
    // ! 4 = Professores
    // ! 5 = Entretenimento
    // ! 6 = Ouvidoria,
    // ! 7 = Cursos

    public function isMembro($id_externo, $id_registro)
    {
        $sql = $this->db->prepare("SELECT * FROM externos WHERE id_externo = :id_externo AND id_registro = :id_registro");
        $sql->bindValue(":id_externo", $id_externo);
        $sql->bindValue(":id_registro", $id_registro);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        }

        $r = new Registros();
        $registro = $r->getMembroByID($id_registro);

        if ($registro['patente_id'] <= 6) {            
            return true;
        }

        return false;
    }

    public function isMembro2($id_externo, $id_registro)
    {
        $sql = $this->db->prepare("SELECT * FROM externos WHERE id_externo = :id_externo AND id_registro = :id_registro");
        $sql->bindValue(":id_externo", $id_externo);
        $sql->bindValue(":id_registro", $id_registro);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function getInfosById($id, $id_externo)
    {
        $array = [];
        
        $sql = $this->db->prepare("SELECT * FROM externos WHERE id = :id AND id_externo = :id_externo");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_externo", $id_externo);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }
    
    public function getInfos($id_registro, $id_externo)
    {
        $array = [];
        
        $sql = $this->db->prepare("SELECT * FROM externos WHERE id_registro = :id_registro AND id_externo = :id_externo");
        $sql->bindValue(":id_registro", $id_registro);
        $sql->bindValue(":id_externo", $id_externo);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getMembros($id_externo)
    {
        $array = [];
        
        $sql = $this->db->prepare("SELECT * FROM externos WHERE id_externo = :id_externo ORDER BY cargo DESC");
        $sql->bindValue(":id_externo", $id_externo);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function addMembro($id_registro, $nickname, $cargo, $id_externo, $ofc_nickname)
    {
        $sql = $this->db->prepare("INSERT INTO externos (id_registro, id_externo, cargo, nickname) VALUES (:id_registro, :id_externo, :cargo, :nickname)");
        $sql->bindValue(":id_registro", $id_registro);
        $sql->bindValue(":id_externo", $id_externo);
        $sql->bindValue(":cargo", $cargo);
        $sql->bindValue(":nickname", $nickname);
        $sql->execute();

        $externos = [
            1 => 'Ajudantes',
            2 => 'Jornal',
            3 => 'Fórum',
            4 => 'Professores'
        ];

        $l = new \Models\Logs();
        $msg = "No dia ".date('d/m/Y')." às [".date('H:i')."] o(a) ".$ofc_nickname." adicionou o(a) ".$nickname." no externo ".$externos[$id_externo].".";
        $l->addLog('externo_add', $msg);
    }

    public function updateMembro($id, $nickname, $cargo, $id_externo, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE externos SET nickname = :nickname, cargo = :cargo WHERE id = :id AND id_externo = :id_externo");
        $sql->bindValue(":nickname", $nickname);
        $sql->bindValue(":cargo", $cargo);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_externo", $id_externo);
        $sql->execute();

        $externos = [
            1 => 'Ajudantes',
            2 => 'Jornal',
            3 => 'Fórum',
            4 => 'Professores'
        ];

        $l = new \Models\Logs();
        $msg = "No dia ".date('d/m/Y')." às [".date('H:i')."] o(a) ".$ofc_nickname." editou as informações do(a) ".$nickname." no externo ".$externos[$id_externo].".";
        $l->addLog('externo_edit', $msg);
    }

    public function delMembro($id, $id_externo, $nickname, $ofc_nickname)
    {
        $sql = $this->db->prepare("DELETE FROM externos WHERE id = :id AND id_externo = :id_externo");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_externo", $id_externo);
        $sql->execute();

        $externos = [
            1 => 'Ajudantes',
            2 => 'Jornal',
            3 => 'Fórum',
            4 => 'Professores'
        ];

        $l = new \Models\Logs();
        $msg = "No dia ".date('d/m/Y')." às [".date('H:i')."] o(a) ".$ofc_nickname." adicionou o(a) ".$nickname." no externo ".$externos[$id_externo].".";
        $l->addLog('externo_del', $msg);
    }

    public function deleteExterno($id_registro)
    {
        $sql = $this->db->prepare("DELETE FROM externos WHERE id_registro = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
    }
    
}
