<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Noticias;
use \Models\Textos;

class ExtrasController extends Controller
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
			'page_active' => 'extras',
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
		Configuração da Página Extras/Quadro de Acionistas do site
	*/
    public function quadro_de_acionistas()
    {
        $this->arrayInfo['pageName'] = 'Cargos Pagos';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(22);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('extras/quadro_de_acionistas', $this->arrayInfo);
    }

    /*
		Configuração da Página Extras/Mentores do site
	*/
    public function mentores()
    {
        $this->arrayInfo['pageName'] = 'Mentores';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(13);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('extras/mentores', $this->arrayInfo);
    }

    /*
		Configuração da Página Extras/Ajudantes do site
	*/
    public function vip()
    {
        $this->arrayInfo['pageName'] = 'Vip';
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto(25);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('extras/vip', $this->arrayInfo);
    }
}
