<?php
namespace Models;

use \Core\Model;
use \Models\Registros;

class Relatorios extends Model {

    // ! Relatórios tipos
    // 1 = Atendimento
    // 2 = DE
    // 3 = Auto-Lotação
    // 4 = Treinamento
    // 5 = Ajudantes
    // 6 = Sugestões
    // 7 = Auto-Lotação FIM
    // 8 = Professores
    
    // ! Ranking valor
    // 1 = TREINOS
    // 2 = DEs
    // 3 = ATEND
    // 4 = EXEC
    // 6 = Ajudantes
    // 7 = Professores
    
    public function getTotalDe($id_registro, $tipo)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM relatorios WHERE id_registro = :id_registro AND tipo = :tipo");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':tipo', $tipo);
        $sql->execute();        
        $sql = $sql->fetch();
        return $sql['c'];
    }

    public function getRelatorio($id)
    {
        $array = [];
        
        $sql = $this->db->prepare("SELECT * FROM relatorios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        
        return $array;
    }

    public function getRelatorios()
    {
        $array = [];
        $sql = $this->db->query("SELECT * FROM relatorios ORDER BY data DESC");

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        
        return $array;
    }

    public function getMeusRelatorios($id_registro)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT * FROM relatorios WHERE id_registro = :id_registro ORDER BY data DESC");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();       

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        
        return $array;
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

    public function updateRelatorio($status, $id, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE relatorios SET status = :status WHERE id = :id");
        $sql->bindValue(':status', $status);
        $sql->bindValue(':id', $id);
        $sql->execute();

        $statuses = [
            1 => 'aceitou',
            2 => 'negou'
        ];

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " atualizou o status de um relatório para ".$statuses[$status].".";
        $l->addLog('rel_edit', $msg);
    }

    public function addRelatorio($tipo, $data, $id_registro, $responsavel_id, $relatorio, $id_criador, $ofc_nickname)
    {
        $sql = $this->db->prepare("INSERT INTO relatorios (tipo, data, id_registro, id_criador, responsavel_id, relatorio) VALUES (:tipo, :data, :id_registro, :id_criador, :responsavel_id, :relatorio)");
        $sql->bindValue(':tipo', $tipo);
        $sql->bindValue(':data', $data);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':id_criador', $id_criador);
        $sql->bindValue(':responsavel_id', $responsavel_id);
        $sql->bindValue(':relatorio', $relatorio);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " adicionou um relatório.";
        $l->addLog('rel_add', $msg);
    }

    public function deleteRelatorios($id_registro)
    {
        $sql = $this->db->prepare("DELETE FROM relatorios WHERE id_registro = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
    }
	
}