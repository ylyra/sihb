<?php
namespace Models;

use \Core\Model;

class Textos extends Model {

    public function getTexto($id)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM textos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getTexto2($id, $slug)
    {
        $array = [];

        if (is_numeric($id)) {
            $sql = $this->db->prepare("SELECT * FROM textos WHERE id = :id AND local = :local");
            $sql->bindValue(':id', $id);
            $sql->bindValue(':local', $slug);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $array = $sql->fetch();
            }
        }

        return $array;
    }
	
}
