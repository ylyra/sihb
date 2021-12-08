<?php

require 'config.php';

date_default_timezone_set('America/Sao_Paulo');

class Registros
{

	public function get()
	{
		global $db;
		$array = [];

		$sql = $db->query("SELECT * FROM registros WHERE vip = 1");

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function update($id_registro)
	{
		global $db;

		$sql = $db->prepare("UPDATE registros SET vip = 0 WHERE id = :id_registro");
		$sql->bindValue(':id_registro', $id_registro);
		$sql->execute();
	}
}

$r = new Registros();
$data_padrao = date('Y-m-d 23:59:59');
$registros = $r->get();

foreach ($registros as $registro) {
	if ($registro['vip_vencimento'] <= $data_padrao) {
		$r->update($registro['id']);
	}
}
