<?php
namespace Models;

use \Core\Model;

class Ranking extends Model {

    // 1 = TREINOS
    // 2 = DEs
    // 3 = ATEND
    // 4 = EXEC
    // 6 = Ajudantes
    // 7 = Professores

    public function getRanking($tipo, $id_registro = 0)
    {       
        $array = [];

        $sql = $this->db->prepare("SELECT *,
        (select registros.nickname from registros where registros.id = ranking_semanal.id_registro) as nickname,
        (select registros.patente_id from registros where registros.id = ranking_semanal.id_registro) as patente_id,
        (select patentes.nome from patentes where patentes.id = patente_id) as patente
        FROM ranking_semanal WHERE tipo = :tipo LIMIT 10");
        $sql->bindValue(':tipo', $tipo);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        $array = $this->verificarArray($array, $tipo);

        if ($id_registro != 0) {
            $sql = $this->db->prepare("SELECT *,
            (select registros.nickname from registros where registros.id = ranking_semanal.id_registro) as nickname,
            (select registros.patente_id from registros where registros.id = ranking_semanal.id_registro) as patente_id,
            (select patentes.nome from patentes where patentes.id = patente_id) as patente 
            FROM ranking_semanal WHERE id_registro = :id_registro AND tipo = :tipo");
            $sql->bindValue(':id_registro', $id_registro);
            $sql->bindValue(':tipo', $tipo);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $a = $sql->fetch();

                $array[9] = $a;
            }

        }

        return $array;
    }

    public function getRankingById($tipo, $id_registro = 0)
    {       
        $array = [];

        if ($id_registro != 0) {
            $sql = $this->db->prepare("SELECT *,
            (select registros.nickname from registros where registros.id = ranking_semanal.id_registro) as nickname,
            (select registros.patente_id from registros where registros.id = ranking_semanal.id_registro) as patente_id,
            (select patentes.nome from patentes where patentes.id = patente_id) as patente 
            FROM ranking_semanal WHERE id_registro = :id_registro AND tipo = :tipo LIMIT 1");
            $sql->bindValue(':id_registro', $id_registro);
            $sql->bindValue(':tipo', $tipo);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $array = $sql->fetch();
            }

        }

        return $array;
    }

    private function verificarArray($array, $tipo)
    {
        if(count($array) == 0) {
            for ($i=0; $i < 10; $i++) { 
                $array[$i] = [
                    'id_registro' => 2,
                    'posicao' => ($i+1),
                    'tipo' => $tipo,
                    'total' => 0,
                    'nickname' => 'sihb',
                    'patente' => 'Controle',
                    'patente_id' => 2
                ];
            }
        } elseif(count($array) == 1) {
            for ($i=1; $i < 10; $i++) { 
                $array[$i] = [
                    'id_registro' => 2,
                    'posicao' => ($i+1),
                    'tipo' => $tipo,
                    'total' => 0,
                    'nickname' => 'sihb',
                    'patente' => 'Controle',
                    'patente_id' => 2
                ];
            }
        } elseif(count($array) == 2) {
            for ($i=2; $i < 10; $i++) { 
                $array[$i] = [
                    'id_registro' => 2,
                    'posicao' => ($i+1),
                    'tipo' => $tipo,
                    'total' => 0,
                    'nickname' => 'sihb',
                    'patente' => 'Controle',
                    'patente_id' => 2
                ];
            }
        } elseif(count($array) == 3) {
            for ($i=3; $i < 10; $i++) { 
                $array[$i] = [
                    'id_registro' => 2,
                    'posicao' => ($i+1),
                    'tipo' => $tipo,
                    'total' => 0,
                    'nickname' => 'sihb',
                    'patente' => 'Controle',
                    'patente_id' => 2
                ];
            }
        } elseif(count($array) == 4) {
            for ($i=4; $i < 10; $i++) { 
                $array[$i] = [
                    'id_registro' => 2,
                    'posicao' => ($i+1),
                    'tipo' => $tipo,
                    'total' => 0,
                    'nickname' => 'sihb',
                    'patente' => 'Controle',
                    'patente_id' => 2
                ];
            }
        } elseif(count($array) == 5) {
            for ($i=5; $i < 10; $i++) { 
                $array[$i] = [
                    'id_registro' => 2,
                    'posicao' => ($i+1),
                    'tipo' => $tipo,
                    'total' => 0,
                    'nickname' => 'sihb',
                    'patente' => 'Controle',
                    'patente_id' => 2
                ];
            }
        } elseif(count($array) == 6) {
            for ($i=6; $i < 10; $i++) { 
                $array[$i] = [
                    'id_registro' => 2,
                    'posicao' => ($i+1),
                    'tipo' => $tipo,
                    'total' => 0,
                    'nickname' => 'sihb',
                    'patente' => 'Controle',
                    'patente_id' => 2
                ];
            }
        } elseif(count($array) == 7) {
            for ($i=7; $i < 10; $i++) { 
                $array[$i] = [
                    'id_registro' => 2,
                    'posicao' => ($i+1),
                    'tipo' => $tipo,
                    'total' => 0,
                    'nickname' => 'sihb',
                    'patente' => 'Controle',
                    'patente_id' => 2
                ];
            }
        } elseif(count($array) == 8) {
            for ($i=8; $i < 10; $i++) { 
                $array[$i] = [
                    'id_registro' => 2,
                    'posicao' => ($i+1),
                    'tipo' => $tipo,
                    'total' => 0,
                    'nickname' => 'sihb',
                    'patente' => 'Controle',
                    'patente_id' => 2
                ];
            }
        }

        return $array;
    }
	
}
