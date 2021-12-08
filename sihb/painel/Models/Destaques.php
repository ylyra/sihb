<?php
namespace Models;

use \Core\Model;

class Destaques extends Model {

    public function getDestaque()
    {       
        $array = [];

        $sql = $this->db->query("SELECT *, 
        (select patentes.nome from patentes where patentes.id = destaques.patente_id) as patente, 
        (select registros.vip from registros where registros.id = destaques.id_registro) as vip 
        FROM destaques ORDER BY id DESC LIMIT 1");

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function addDestaque($registro, $data, $caracteristicas, $ofc_nickname)
    {
        $sql = $this->db->prepare("INSERT INTO destaques (id_registro, nickname, qualidades, patente_id, data) VALUES (:id_registro, :nickname, :qualidades, :patente_id, :data)");
        $sql->bindValue(':id_registro', $registro['id']);
        $sql->bindValue(':nickname', $registro['nickname']);
        $sql->bindValue(':qualidades', $caracteristicas);
        $sql->bindValue(':patente_id', $registro['patente_id']);
        $sql->bindValue(':data', $data);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia ".date('d/m/Y')." às [".date('H:i')."] o(a) ".$ofc_nickname." colocou o(a) ".$registro['nickname']." como membro destaque.";
        $l->addLog('destaque', $msg);
    }
	
}
