<?php
namespace Models;

use \Core\Model;

class MAmigos extends Model {

    public function getAmigosDe($id_registro)
    {       
        $array = [
            'coracao' => $this->getAmigoTipo($id_registro, 1),
            'feliz' => $this->getAmigoTipo($id_registro, 2),
            'money' => $this->getAmigoTipo($id_registro, 3)
        ];
        return $array;
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

    public function deleteAmigosDe($id_registro)
    {
        $sql = $this->db->prepare("DELETE FROM melhores_amigos WHERE id_de = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
    }

    public function deleteAmigosCom($id_registro)
    {
        $sql = $this->db->prepare("DELETE FROM melhores_amigos WHERE id_amigo = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
    }
	
}
