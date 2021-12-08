<?php
namespace Models;

use \Core\Model;

class Bugs extends Model {

    public function addBug($tipo, $msg)
    {       
        $sql = $this->db->prepare("INSERT INTO bugs (local, msg) VALUES (:tipo, :msg)");
        $sql->bindValue(':tipo', $tipo);
        $sql->bindValue(':msg', $msg);
        $sql->execute();
    }
	
}
