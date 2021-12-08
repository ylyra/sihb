<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Noticias;
use \Models\Uteis;

class NoticiasController extends Controller
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
		$n = new Noticias();
		$u = new Uteis();
		
		$this->arrayInfo['currentPage'] = 1;

		$this->arrayInfo['filtros'] = [
			'pesquise_por' => '',
			'categoria' => 'all',
			'ordem' => 'desc',
			'data_de' => '',
			'data_ate' => ''
		];

		if (isset($_GET['categoria']) && !empty($_GET['categoria']) && is_numeric($_GET['categoria'])) {
			$this->arrayInfo['filtros']['categoria'] = intval($_GET['categoria']);
		}

		if (isset($_GET['pesquise_por']) && !empty($_GET['pesquise_por'])) {
			$this->arrayInfo['filtros']['pesquise_por'] = $_GET['pesquise_por'];
		}

		if (isset($_GET['ordem']) && !empty($_GET['ordem'])) {
			$this->arrayInfo['filtros']['ordem'] = $_GET['ordem'];
		}

		if (isset($_GET['data_de']) && !empty($_GET['data_de'])) {
			$this->arrayInfo['filtros']['data_de'] = $_GET['data_de'];
		}

		if (isset($_GET['data_ate']) && !empty($_GET['data_ate'])) {
			$this->arrayInfo['filtros']['data_ate'] = $_GET['data_ate'];
		}

		$filtros = $this->arrayInfo['filtros'];
		$filtros['page'] = 1;

		if (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) {
			$filtros['page'] = intval($_GET['page']);
			$this->arrayInfo['currentPage'] = intval($_GET['page']);
		}		

		$this->arrayInfo['page_active'] = 'home';
		$this->arrayInfo['pageName'] = 'Notícias';
		$this->arrayInfo['destacadas'] = $n->getDestacadas();
		$this->arrayInfo['noticias'] = $n->getNoticia($filtros);
		$this->arrayInfo['numeroDePaginas'] = ceil($n->getTotalNoticias($filtros) / 9);

		$this->arrayInfo['categorias'] = $n->getCategorias();

		$this->arrayInfo['u'] = $u;

		/* Fara com que a página seja carregada */
		$this->loadView('noticias/todas', $this->arrayInfo);
	}

	/*
		Configuração de Ouvidoria do site
	*/
	public function abrir($id, $slug)
	{
		$n = new Noticias();

		$this->arrayInfo['page_active'] = 'noticias';
		$this->arrayInfo['noticia'] = $n->getNoticiaById($id);
		$this->arrayInfo['noticia_comentarios'] = $n->getComentariosNoticiaById($id);
		
		if ($this->acesso->isLogged()) {
			$this->arrayInfo['votei'] = $n->verificarVoto($id, $this->acesso->getInfo('id_registro'));
			$this->arrayInfo['noticias'] = $n;
		}

		if (is_numeric($id) && count($this->arrayInfo['noticia']) > 0) {
			$this->arrayInfo['pageName'] = 'Notícia - '.$this->arrayInfo['noticia']['titulo'];

			/* Fara com que a página seja carregada */
			$this->loadTemplate('noticias/abrir', $this->arrayInfo);
		} else {
			header("Location: " . BASE);
			exit;
		}
	}

	public function equipe()
	{
		$this->arrayInfo['pageName'] = 'Notícias - Equipe';

        /* Fara com que a página seja carregada */
        $this->loadTemplate('noticias/equipe', $this->arrayInfo);
	}

	public function colunas()
	{
		$this->arrayInfo['pageName'] = 'Notícias - Colunas';

        /* Fara com que a página seja carregada */
        $this->loadTemplate('noticias/colunas', $this->arrayInfo);
	}

	public function faca_parte()
	{
		$this->arrayInfo['pageName'] = 'Notícias - Faça parte';

        /* Fara com que a página seja carregada */
        $this->loadTemplate('noticias/faca_parte', $this->arrayInfo);
	}
}
