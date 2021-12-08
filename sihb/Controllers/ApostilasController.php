<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Noticias;
use \Models\Textos;

class ApostilasController extends Controller
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
			'page_active' => 'apostilas',
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
		Configuração da Página Apostilas/treinamento_de_estagiarios do site
	*/
    public function treinamento_de_estagiarios()
    {
        $this->arrayInfo['pageName'] = 'Treinamento de Estagiários';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(13);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('apostilas/treinamento_de_estagiarios', $this->arrayInfo);
    }

    /*
		Configuração da Página Apostilas/treinamento_de_agentes do site
	*/
    public function treinamento_de_agentes()
    {
        $this->arrayInfo['pageName'] = 'Treinamento de Agentes';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(14);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('apostilas/treinamento_de_agentes', $this->arrayInfo);
    }

    /*
		Configuração da Página Apostilas/treinamento_de_agentes_especiais do site
	*/
    public function treinamento_de_agentes_especiais()
    {
        $this->arrayInfo['pageName'] = 'Treinamento de Agentes Especiais';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(15);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('apostilas/treinamento_de_agentes_especiais', $this->arrayInfo);
    }

    /*
		Configuração da Página Apostilas/treinamento_de_agentes_especiais do site
	*/
    public function treinamento_de_agentes_seniores()
    {
        $this->arrayInfo['pageName'] = 'Treinamento de Agentes Especiais';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(16);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('apostilas/treinamento_de_agentes_seniores', $this->arrayInfo);
    }

    /*
		Configuração da Página Apostilas/Pele e Cabelo do site
	*/
    public function pele_e_cabelo()
    {
        $this->arrayInfo['pageName'] = 'Pele e Cabelo';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(17);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('apostilas/pele_e_cabelo', $this->arrayInfo);
    }

    /*
		Configuração da Página Apostilas/Áreas da Sede do site
	*/
    public function areas_da_sede()
    {
        $this->arrayInfo['pageName'] = 'Áreas da Sede';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(18);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('apostilas/areas_da_sede', $this->arrayInfo);
    }

    /*
		Configuração da Página Apostilas/Discord do site
	*/
    public function discord()
    {
        $this->arrayInfo['pageName'] = 'Discord';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(19);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('apostilas/discord', $this->arrayInfo);
    }

    /*
		Configuração da Página Apostilas/Habbo Etiqueta do site
	*/
    public function hb_etiqueta()
    {
        $this->arrayInfo['pageName'] = 'Habbo Etiqueta';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(20);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('apostilas/hb_etiqueta', $this->arrayInfo);
    }

    /*
		Configuração da Página Apostilas/Blacklist do site
	*/
    public function blacklist()
    {
        $this->arrayInfo['pageName'] = 'Blacklist';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(21);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('apostilas/blacklist', $this->arrayInfo);
    }

    /*
		Configuração da Página Apostilas/Como ser promovido? do site
	*/
    public function como_ser_promovido()
    {
        $this->arrayInfo['pageName'] = 'Como ser promovido?';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(26);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('apostilas/como_ser_promovido', $this->arrayInfo);
    }

    /*
		Configuração da Página Apostilas/Como ser um bom funcionário? do site
	*/
    public function como_ser_um_bom_funcionario()
    {
        $this->arrayInfo['pageName'] = 'Como ser um bom funcionário?';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(27);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('apostilas/como_ser_um_bom_funcionario', $this->arrayInfo);
    }

    /*
		Configuração da Página Apostilas/Uniformes do site
	*/
    public function uniformes()
    {
        $this->arrayInfo['pageName'] = 'Uniformes';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(28);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('apostilas/uniformes', $this->arrayInfo);
    }

    /*
		Configuração da Página Apostilas/Requisitos da Sede do site
	*/
    public function requisitos_da_sede()
    {
        $this->arrayInfo['pageName'] = 'Requisitos da Sede';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(28);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('apostilas/requisitos_da_sede', $this->arrayInfo);
    }

    /*
		Configuração da Página Apostilas/Combate de Fraudes Ideológicas do site
	*/
    public function combate_de_fraudes_ideologicas()
    {
        $this->arrayInfo['pageName'] = 'Combate de Fraudes Ideológicas';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(28);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('apostilas/combate_de_fraudes_ideologicas', $this->arrayInfo);
    }

    /*
		Configuração da Página Apostilas/Instruções de Ética e Conduta do site
	*/
    public function instrucoes_etica_conduta()
    {
        $this->arrayInfo['pageName'] = 'Instruções de Ética e Conduta';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(28);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('apostilas/instrucoes_etica_conduta', $this->arrayInfo);
    }


}
