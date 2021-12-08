<?php
namespace Models;

use \Core\Model;

class Relatorios extends Model {

    // 1 = Treinos
    // 2 = DE
    // 3 = Atendimento
    // 4 = Helpers
    // 5 = Supervisores
    
    public function getTotalDe($id_registro, $tipo)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM relatorios WHERE id_registro = :id_registro AND tipo = :tipo");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':tipo', $tipo);
        $sql->execute();        
        $sql = $sql->fetch();
        return $sql['c'];
    }

    public function getTotalDeMes($id_registro, $tipo, $tipo_mes)
    {
        $mes = ($tipo_mes == 1)?date('m'):date('m', strtotime('-1 month'));
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM relatorios WHERE id_registro = :id_registro AND tipo = :tipo AND data LIKE :data");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':tipo', $tipo);
        $sql->bindValue(':data', '%-'.$mes.'-%');
        $sql->execute();        
        $sql = $sql->fetch();
        return $sql['c'];
    }
	
}
