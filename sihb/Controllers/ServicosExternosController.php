<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Noticias;
use \Models\Textos;

class ServicosExternosController extends Controller
{

	private $user;
	private $arrayInfo;

	public function __construct()
	{
		parent::__construct();

		$this->acesso = new Acesso();

		$this->acesso->isLogged();
		$n = new Noticias();		
		$this->arrayInfo = array(
			'page_active' => 'servicos_externos',
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

		$this->arrayInfo['page_active'] = 'home';
		$this->arrayInfo['pageName'] = 'Início';
		
		/* Fara com que a página seja carregada */
		$this->loadTemplate('home', $this->arrayInfo);
    }
    
    /*
		Configuração da Página Serviços Externos/Operações do site
	*/
	public function operacoes()
	{
		$this->arrayInfo['pageName'] = 'Operações';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(6);
		
		/* Fara com que a página seja carregada */
		$this->loadTemplate('servicos_externos/operacoes', $this->arrayInfo);
    }
    
    /*
		Configuração da Página Serviços Externos/Atendimento de Ocorrências do site
	*/
	public function atendimento_de_ocorrencias()
	{
        $this->arrayInfo['pageName'] = 'Atendimento de Ocorrências';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(7);
		
		/* Fara com que a página seja carregada */
		$this->loadTemplate('servicos_externos/atendimento_de_ocorrencias', $this->arrayInfo);
    }
    
    /*
		Configuração da Página Serviços Externos/Conquistas do site
	*/
	public function conquistas()
	{
        $this->arrayInfo['pageName'] = 'Conquistas';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(8);
		
		/* Fara com que a página seja carregada */
		$this->loadTemplate('servicos_externos/conquistas', $this->arrayInfo);
    }
}
