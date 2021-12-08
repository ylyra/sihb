<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Noticias;
use \Models\Textos;

class PagesController extends Controller
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
      'page_active' => 'grupos',
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
		Configuração da Página Grupos/Professores do site
	*/
  public function open($id, $slug)
  {
    $t = new Textos();
    $this->arrayInfo['texto'] = $t->getTexto2($id, $slug);
    if (count($this->arrayInfo['texto']) > 0) {
      $this->arrayInfo['pageName'] = $this->arrayInfo['texto']['titulo'];

      /* Fara com que a página seja carregada */
      $this->loadTemplate('pages/open', $this->arrayInfo);
    }
  }

  
}
