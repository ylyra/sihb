<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Noticias;
use \Models\Textos;

class GruposController extends Controller
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
  public function professores()
  {
    $this->arrayInfo['pageName'] = 'Professores';
    $t = new Textos();
    $this->arrayInfo['texto'] = $t->getTexto(31);

    /* Fara com que a página seja carregada */
    $this->loadTemplate('grupos/professores', $this->arrayInfo);
  }

  /*
		Configuração da Página Extras/Ajudantes do site
	*/
  public function ajudantes()
  {
    $this->arrayInfo['pageName'] = 'Ajudantes';
    $t = new Textos();
    $this->arrayInfo['texto'] = $t->getTexto(23);

    /* Fara com que a página seja carregada */
    $this->loadTemplate('grupos/ajudantes', $this->arrayInfo);
  }

  /*
		Configuração da Página Extras/Divulgadores do site
	*/
  public function divulgadores()
  {
    $this->arrayInfo['pageName'] = 'Divulgadores';
    $t = new Textos();
    $this->arrayInfo['texto'] = $t->getTexto(32);

    /* Fara com que a página seja carregada */
    $this->loadTemplate('grupos/ajudantes', $this->arrayInfo);
  }
}
