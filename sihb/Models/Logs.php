<?php
namespace Models;

use \Core\Model;

class Logs extends Model {
    
    public function addLog($tipo, $msg)
	{
		$sql = $this->db->prepare("INSERT INTO logs (tipo, texto) VALUES (:tipo, :msg)");
		$sql->bindValue(':tipo', $tipo);
		$sql->bindValue(':msg', $msg);
		$sql->execute();
	}
	
}
