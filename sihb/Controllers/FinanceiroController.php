<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Noticias;
use \Models\Textos;

class FinanceiroController extends Controller
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
      'page_active' => 'financeiro',
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
    $this->loadTemplate('financeiro/quadro_de_acionistas', $this->arrayInfo);
  }

  /*
		Configuração da Página Extras/Salários do site
	*/
  public function sihbcoins()
  {
    $this->arrayInfo['pageName'] = 'SIHBCoins';
    $t = new Textos();
    $this->arrayInfo['texto'] = $t->getTexto(35);

    /* Fara com que a página seja carregada */
    $this->loadTemplate('financeiro/sihbcoins', $this->arrayInfo);
  }
  
  /*
		Configuração da Página Extras/Salários do site
	*/
  public function salarios()
  {
    $this->arrayInfo['pageName'] = 'Salários';
    $t = new Textos();
    $this->arrayInfo['texto'] = $t->getTexto(29);

    /* Fara com que a página seja carregada */
    $this->loadTemplate('financeiro/salarios', $this->arrayInfo);
  }

  /*
		Configuração da Página Extras/Sistema de Indicações do site
	*/
  public function sistema_de_indicacao()
  {
    $this->arrayInfo['pageName'] = 'Sistema de Indicações';
    $t = new Textos();
    $this->arrayInfo['texto'] = $t->getTexto(30);

    /* Fara com que a página seja carregada */
    $this->loadTemplate('financeiro/sistema_de_indicacao', $this->arrayInfo);
  }
}
