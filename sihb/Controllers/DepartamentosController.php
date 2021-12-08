<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Noticias;
use \Models\Textos;

class DepartamentosController extends Controller
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
			'page_active' => 'departamentos',
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
		Configuração da Página Departamentos/Educação e Civismo do site
	*/
	public function educacao_e_civismo()
	{
		$this->arrayInfo['pageName'] = 'Educação e Civismo';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(9);
		
		/* Fara com que a página seja carregada */
		$this->loadTemplate('departamentos/educacao_e_civismo', $this->arrayInfo);
    }
    
    /*
		Configuração da Página Departamentos/Jurídico do site
	*/
	public function juridico()
	{
        $this->arrayInfo['pageName'] = 'Jurídico';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(10);
		
		/* Fara com que a página seja carregada */
		$this->loadTemplate('departamentos/juridico', $this->arrayInfo);
    }
    
    /*
		Configuração da Página Departamentos/Comunicação do site
	*/
	public function comunicacao()
	{
        $this->arrayInfo['pageName'] = 'Comunicação';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(11);
		
		/* Fara com que a página seja carregada */
		$this->loadTemplate('departamentos/comunicacao', $this->arrayInfo);
    }

    /*
		Configuração da Página Departamentos/Logística e RH do site
	*/
	public function logistica_e_rh()
	{
        $this->arrayInfo['pageName'] = 'Logística e RH';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(12);
		
		/* Fara com que a página seja carregada */
		$this->loadTemplate('departamentos/logistica_e_rh', $this->arrayInfo);
    }
}
