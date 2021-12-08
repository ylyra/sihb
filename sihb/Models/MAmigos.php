<?php

namespace Models;

use \Core\Model;

class MAmigos extends Model
{

    public function getAmigosDe($id_registro)
    {
        $array = [
            'coracao' => $this->getAmigoTipo($id_registro, 1),
            'feliz' => $this->getAmigoTipo($id_registro, 2),
            'money' => $this->getAmigoTipo($id_registro, 3)
        ];
        return $array;
    }

    public function updateAmigos($amigos, $id_registro, $ofc_nickname)
    {
        $this->deleteAll($id_registro);

        foreach ($amigos as $amigo) {
            $this->addAmigo($id_registro, $amigo['id_registro'], $amigo['tipo']);
        }

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " atualizou os melhores amigos.";
        $l->addLog('melhores_amigos', $msg);
    }

    private function getAmigoTipo($id_registro, $tipo)
    {
        $retorno = 'sihb';

        $sql = $this->db->prepare("SELECT *, (select registros.nickname from registros where registros.id = melhores_amigos.id_amigo) as nickname FROM melhores_amigos WHERE id_de = :id_registro AND tipo = :tipo LIMIT 1");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':tipo', $tipo);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $a = $sql->fetch();

            $retorno = $a['nickname'];
        }

        return $retorno;
    }

    public function addAmigo($id_de, $id_amigo, $tipo)
    {
        $sql = $this->db->prepare("INSERT INTO melhores_amigos (id_de, id_amigo, tipo) VALUES (:id_de, :id_amigo, :tipo)");
        $sql->bindValue(':id_de', $id_de);
        $sql->bindValue(':id_amigo', $id_amigo);
        $sql->bindValue(':tipo', $tipo);
        $sql->execute();
    }

    private function deleteAll($id_registro)
    {
        $sql = $this->db->prepare("DELETE FROM melhores_amigos WHERE id_de = :id_de");
        $sql->bindValue(':id_de', $id_registro);
        $sql->execute();
    }
}
