<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Textos;
use \Models\Uteis;

class SiteController extends Controller
{

	private $acesso;
	private $arrayInfo;

	public function __construct()
	{
		parent::__construct();

		$this->acesso = new Acesso();

		if (!$this->acesso->isLogged()) {
			header("Location: ".BASE_PAI);
			exit;
        }
        
        if ($this->acesso->getInfo('patente') >= 7) {
            $l = new \Models\Logs();
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
            $l->addLog('invasao', $msg);

			header("Location: ".BASE);
			exit;
		}

		$this->arrayInfo = array(
			'page_active' => 'site',
			'pageName' => '',
			'description' => '',
			'acesso' => $this->acesso
		);
	}

	/*
		Configuração da Página Inicial do site
	*/
	public function index()
	{
        $t = new Textos();

        $this->arrayInfo['pageName'] = 'Páginas do site';
        $this->arrayInfo['paginas'] = $t->getTextos();        
		
		/* Fara com que a página seja carregada */
		$this->loadTemplate('site/todas', $this->arrayInfo);
    }

    /*
		Configuração da Página de Criação de páginas ocultas do site
	*/
    public function criar()
    {
        $this->arrayInfo['pageName'] = 'Criar página oculta';

        /* Fara com que a página seja carregada */
        $this->loadTemplate('site/criar', $this->arrayInfo);
    }

    public function criarTexto()
    {
        $pag = BASE.'site';
        if (isset($_POST['titulo']) && !empty($_POST['titulo']) && isset($_POST['texto']) && !empty($_POST['texto'])) {
            $t = new Textos();
            $u = new Uteis();
            $titulo = addslashes($_POST['titulo']);
            $local = $u->criar_slug($titulo);
            $texto = $_POST['texto'];
            $t->addTexto($titulo, $local, $texto, 1, $this->acesso->getInfo('nickname'));
        }

        header("Location: ".$pag);
        exit;
    }
    
    public function editarPagina($id)
    {
        if (is_numeric($id)) {
            $t = new Textos();

            $this->arrayInfo['pageName'] = 'Páginas do site';
            $this->arrayInfo['pagina'] = $t->getTexto($id);        
            
            /* Fara com que a página seja carregada */
            $this->loadTemplate('site/editar', $this->arrayInfo);
        }
    }

    public function editarTexto($id)
    {
        $pag = BASE.'site';
        if (is_numeric($id) && isset($_POST['texto']) && !empty($_POST['texto'])) {
            $t = new Textos();
            
            $texto = $_POST['texto'];
            $t->atualizarTexto($id, $texto, $this->acesso->getInfo('nickname'));
            $pag = BASE.'site/editarPagina/'.$id;
        }

        header("Location: ".$pag);
        exit;
    }

    public function deleteOculta($id)
    {
        if (is_numeric($id)) {
            $t = new Textos();
            $pagina = $t->getTexto($id);

            if (count($pagina) > 0 && $pagina['tipo'] == 1) {
                $t->deletarTexto($pagina['id'], $this->acesso->getInfo('nickname'));
            }
        }

        header("Location: ".BASE."site");
        exit;
    }

	
}
