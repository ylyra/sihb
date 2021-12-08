<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Destaques;
use \Models\Noticias;
use \Models\Forum;
use \Models\Emblemas;
use \Models\Uteis;
use \Models\Ranking;
use \Models\Textos;

class HomeController extends Controller
{

	private $acesso;
	private $arrayInfo;

	public function __construct()
	{
		parent::__construct();

		$this->acesso = new Acesso();

		$this->acesso->isLogged();
		$n = new Noticias();		
		$this->arrayInfo = array(
			'page_active' => '',
			'pageName' => '',
			'description' => '',
			'acesso' => $this->acesso,
			'destacadas' => $n->getDestacadas()
		);
	}

	/*
		Configuração da Página Inicial do site
	*/
	public function index()
	{

		$d = new Destaques();
		$n = new Noticias();
		$f = new Forum();
		$e = new Emblemas();

		$this->arrayInfo['page_active'] = 'home';
		$this->arrayInfo['pageName'] = 'Início';
		$this->arrayInfo['u'] = new Uteis();
		$this->arrayInfo['destaque'] = $d->getDestaque();
		$this->arrayInfo['recentes'] = $n->getRecentes();
		$this->arrayInfo['f_recentes'] = $f->getRecentes();
		$this->arrayInfo['total_topicos'] = $f->getTotalTopicos();
		$this->arrayInfo['emblemas'] = $e->getAll();
		
		/* Fara com que a página seja carregada */
		$this->loadTemplate('home', $this->arrayInfo);
	}

	/*
		Configuração de Ouvidoria do site
	*/
	public function ouvidoria()
	{

		$this->arrayInfo['page_active'] = 'ouvidoria';
		$this->arrayInfo['pageName'] = 'Ouvidoria';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(6);
		
		/* Fara com que a página seja carregada */
		$this->loadTemplate('principal/ouvidoria', $this->arrayInfo);
	}

	/*
		Configuração de Melhores da Semana do site
	*/
	public function melhores_da_semana()
	{
		$id_registro = 0;

		if ($this->acesso->isLogged()) {
			$id_registro = $this->acesso->getInfo('id_registro');
		}

		$this->arrayInfo['page_active'] = 'melhores_da_semana';
		$this->arrayInfo['pageName'] = 'Melhores da Semana';

		$r = new Ranking();
		$this->arrayInfo['treinos'] = $r->getRanking(1, $id_registro);
		$this->arrayInfo['des'] = $r->getRanking(2, $id_registro);
		$this->arrayInfo['atendimentos'] = $r->getRanking(6, $id_registro);
		$this->arrayInfo['executivos'] = $r->getRanking(7, $id_registro);
		$this->arrayInfo['gerais'] = $r->getRanking(5);

		$this->arrayInfo['meugeral'] = $r->getRankingById(5, $id_registro);

		
		/* Fara com que a página seja carregada */
		$this->loadView('principal/melhores_da_semana', $this->arrayInfo);
	}
}
