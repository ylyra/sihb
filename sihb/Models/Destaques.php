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
	
}
