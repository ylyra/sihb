<?php
require 'config.php';

class Ranking
{

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
	
	protected $inicio_dia;
	protected $fim_dia;
	protected $inicio_semana;
	protected $fim_semana;

	public function __construct()
	{
		$this->inicio_semana = date('Y-m-d 00:00:00', strtotime('sunday last week', strtotime(date('Y-m-d'))));
		$this->fim_semana = date('Y-m-d 23:59:59', strtotime('saturday this week', strtotime(date('Y-m-d'))));
	}
	

	public function get($tipo)
	{
		global $db;

		$array = [];

		$sql = $db->prepare("SELECT id_registro, COUNT(*) AS c, ( select registros.nickname from registros where registros.id = relatorios.id_registro ) as nickname FROM relatorios WHERE tipo IN (:tipo) AND data >= :data1 AND data <= :data2 GROUP BY id_registro ORDER BY c DESC");
		$sql->bindValue(':tipo', $tipo);
		$sql->bindValue(':data1', $this->inicio_semana);
		$sql->bindValue(':data2', $this->fim_semana);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function addRanking($id_registro, $total, $posicao, $tipo)
	{
		global $db;

		$sql = $db->prepare("INSERT INTO ranking_semanal (id_registro, posicao, tipo, total) VALUES (:id_registro, :posicao, :tipo, :total)");
		$sql->bindValue(':id_registro', $id_registro);
		$sql->bindValue(':posicao', $posicao);
		$sql->bindValue(':tipo', $tipo);
		$sql->bindValue(':total', $total);
		$sql->execute();
	}

	public function deleteAllFromRanking()
	{
		global $db;
		$db->query("DELETE FROM ranking_semanal");
	}
}

$r = new Ranking();
$atendimentos = $r->get('1');
$des = $r->get('2');
$auto_lotacoes = $r->get('3, 7');
$treinamentos = $r->get('4');
$ajudantes = $r->get('5');
$professores = $r->get('8');
$gerais = $r->get('1, 2, 3, 4, 5, 6, 8');
$r->deleteAllFromRanking();

// 1 = TREINOS
// 2 = DEs
// 3 = ATEND
// 4 = EXEC
// 6 = Ajudantes
// 7 = Professores
// 8 = Auto-Lotação


foreach ($treinamentos as $atendimentoId => $atendimento) {
	$posicao = $atendimentoId + 1;
	$r->addRanking($atendimento['id_registro'], $atendimento['c'], $posicao, 1);
}

foreach ($des as $atendimentoId => $atendimento) {
	$posicao = $atendimentoId + 1;
	$r->addRanking($atendimento['id_registro'], $atendimento['c'], $posicao, 2);
}

foreach ($atendimentos as $atendimentoId => $atendimento) {
	$posicao = $atendimentoId + 1;
	$r->addRanking($atendimento['id_registro'], $atendimento['c'], $posicao, 3);
}

foreach ($ajudantes as $atendimentoId => $atendimento) {
	$posicao = $atendimentoId + 1;
	$r->addRanking($atendimento['id_registro'], $atendimento['c'], $posicao, 6);
}

foreach ($professores as $atendimentoId => $atendimento) {
	$posicao = $atendimentoId + 1;
	$r->addRanking($atendimento['id_registro'], $atendimento['c'], $posicao, 7);
}

foreach ($auto_lotacoes as $atendimentoId => $atendimento) {
	$posicao = $atendimentoId + 1;
	$r->addRanking($atendimento['id_registro'], $atendimento['c'], $posicao, 8);
}

foreach ($gerais as $atendimentoId => $atendimento) {
	$posicao = $atendimentoId + 1;
	$r->addRanking($atendimento['id_registro'], $atendimento['c'], $posicao, 5);
}

