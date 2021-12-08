<?php
namespace Models;

use \Core\Model;

class Logs extends Model {

    public function getLogs()
    {       
        $retorno = [];

        $sql = $this->db->query("SELECT * FROM logs ORDER BY id DESC");

        if ($sql->rowCount() > 0) {
            $retorno = $sql->fetchAll();
        }

        return $retorno;
    }

    public function addLog($tipo, $msg)
	{
		$sql = $this->db->prepare("INSERT INTO logs (tipo, texto) VALUES (:tipo, :msg)");
		$sql->bindValue(':tipo', $tipo);
		$sql->bindValue(':msg', $msg);
		$sql->execute();
	}
	
}
