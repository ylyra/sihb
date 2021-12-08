<?php

namespace Core;

class Model
{

	protected $db;
	protected $inicio_dia;
	protected $fim_dia;
	protected $inicio_semana;
	protected $fim_semana;

	public function __construct()
	{
		global $db;
		$this->db = $db;
		$this->inicio_dia = date('Y-m-d 04:00:00');
		$this->fim_dia = date('Y-m-d 03:59:59', strtotime('+1 days'));
		$agora = date('H:i:s');

		if ($agora >= '00:00:00' && $agora <= '03:59:59') {
			$this->inicio_dia = date('Y-m-d 04:00:00', strtotime('-1 days'));
			$this->fim_dia = date('Y-m-d 03:59:59');
		}

		$this->inicio_semana = date('Y-m-d 04:00:00', strtotime('+1 days', strtotime('sunday last week', strtotime(date('Y-m-d')))));
		$this->fim_semana = date('Y-m-d 23:59:59', strtotime('+1 days', strtotime('saturday this week', strtotime(date('Y-m-d')))));
	}
}
