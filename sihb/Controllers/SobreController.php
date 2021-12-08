<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Noticias;
use \Models\Textos;

class SobreController extends Controller
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
			'page_active' => 'sobre',
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
		Configuração da Página Sobre/História do site
	*/
	public function historia()
	{
		$this->arrayInfo['pageName'] = 'História';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(1);
		
		/* Fara com que a página seja carregada */
		$this->loadTemplate('sobre/historia', $this->arrayInfo);
    }
    
    /*
		Configuração da Página Sobre/Posicionamento do site
	*/
	public function posicionamento()
	{
        $this->arrayInfo['pageName'] = 'Posicionamento';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(2);
		
		/* Fara com que a página seja carregada */
		$this->loadTemplate('sobre/posicionamento', $this->arrayInfo);
    }
    
    /*
		Configuração da Página Sobre/Hierarquia do site
	*/
	public function hierarquia()
	{
        $this->arrayInfo['pageName'] = 'Hierarquia';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(3);
		
		/* Fara com que a página seja carregada */
		$this->loadTemplate('sobre/hierarquia', $this->arrayInfo);
    }
    
    /*
		Configuração da Página Sobre/Estatuto do site
	*/
	public function estatuto()
	{
        $this->arrayInfo['pageName'] = 'Estatuto';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(4);
		
		/* Fara com que a página seja carregada */
		$this->loadTemplate('sobre/estatuto', $this->arrayInfo);
    }
    
    /*
		Configuração da Página Sobre/Atos normativos do site
	*/
	public function atos_normativos()
	{
        $this->arrayInfo['pageName'] = 'Atos normativos';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(5);
		
		/* Fara com que a página seja carregada */
		$this->loadTemplate('sobre/atos_normativos', $this->arrayInfo);
	}
}
