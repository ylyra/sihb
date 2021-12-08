<?php
namespace Models;

use \Core\Model;

class Emblemas extends Model {

    public function getAll()
    {       
        $array = [];

        $sql = $this->db->query("SELECT * FROM emblemas");

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getBagdeById($id = 1)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM emblemas WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function updateDescricao($id, $nome, $descricao)
    {
        $sql = $this->db->prepare("UPDATE emblemas SET nome = :nome, descricao = :descricao WHERE id = :id");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
	
}
