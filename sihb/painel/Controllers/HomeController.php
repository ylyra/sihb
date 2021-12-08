<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Registros;

class HomeController extends Controller
{

	private $acesso;
	private $arrayInfo;

	public function __construct()
	{
		parent::__construct();

		$this->acesso = new Acesso();

		if (!$this->acesso->isLogged()) {
			header("Location: " . BASE_PAI);
			exit;
		}

		$this->arrayInfo = array(
			'page_active' => '',
			'pageName' => '',
			'description' => '',
			'acesso' => $this->acesso
		);
	}

	/*
		Configuração da Página Inicial do site
	*/
	public function index()
	{

		$r = new Registros();

		$this->arrayInfo['page_active'] = 'home';
		$this->arrayInfo['pageName'] = 'Início';
		$this->arrayInfo['total_registros'] = $r->totalRegistros();
		$this->arrayInfo['alistados_dia'] = $r->agentesDia(date('Y-m-d'));
		$this->arrayInfo['diferenca_alistados'] = $r->diferencaAlistados(date('Y-m-d'), $this->arrayInfo['alistados_dia']);

		/* Fara com que a página seja carregada */
		$this->loadTemplate('home', $this->arrayInfo);
	}

	public function cartao()
	{
		if ($this->acesso->deuEntrada($this->acesso->getInfo('id_registro'))) {
			$hoje = $this->acesso->getCartaoDia($this->acesso->getInfo('id_registro'));
			$this->acesso->darSaida($hoje['id'], date('Y-m-d H:i:s'));
		} else {
			$tipo = ($this->user->getInfo('patente') >= 11)?1:0;
			$this->acesso->darEntrada($this->acesso->getInfo('id_registro'), date('Y-m-d H:i:s'), $tipo);
		}

		header("Location: " . BASE);
		exit;
	}
}
