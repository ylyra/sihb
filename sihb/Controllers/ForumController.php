<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Noticias;
use \Models\Forum;
use \Models\Uteis;
use \Models\Loja;
use \Models\Registros;

class ForumController extends Controller
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

        $this->arrayInfo['page_active'] = 'home';
        $this->arrayInfo['pageName'] = 'Início';

        /* Fara com que a página seja carregada */
        $this->loadTemplate('home', $this->arrayInfo);
    }

    /*
		Configuração da Fórum/Abrir site
	*/
    public function abrir($id, $slug = '')
    {
        $f = new Forum();
        $u = new Uteis();
        $l = new Loja();

        $this->arrayInfo['page_active'] = 'forum';
        $this->arrayInfo['uteis'] = $u;
		$this->arrayInfo['topico'] = $f->getTopicoById($id);
		$this->arrayInfo['totalMeusTopicos'] = ($this->acesso->isLogged())?$f->totalMeusTopicos($this->acesso->getInfo('id_registro')):'00';
		$this->arrayInfo['totalMinhasRespostas'] = ($this->acesso->isLogged())?$f->totalMinhasRespostas($this->acesso->getInfo('id_registro')):'00';
		$this->arrayInfo['totalMeusExcluidos'] = ($this->acesso->isLogged())?$f->totalMeusExcluidos($this->acesso->getInfo('id_registro')):'00';
		
		if (is_numeric($id) && count($this->arrayInfo['topico']) > 0 && $this->arrayInfo['topico']['status'] != 4) {
            $offset = 0;
            $limit = 5;
            $currentPage = 1;

            if (!empty($_GET['p']) && is_numeric($_GET['p'])) {
                $currentPage = $_GET['p'];
            }

            $offset = ($currentPage * $limit) - $limit;
            
            $this->arrayInfo['pageName'] = 'Tópico - '.$this->arrayInfo['topico']['titulo'];
            $this->arrayInfo['loja'] = $l;
            $this->arrayInfo['comentarios'] = $f->getComentariosForumById($offset, $limit, $this->arrayInfo['topico']['id']);
            $this->arrayInfo['totalPatrulhas'] = $f->getTotalComentariosForumById($this->arrayInfo['topico']['id']); 
            $this->arrayInfo['numeroDePaginas'] = ceil($this->arrayInfo['totalPatrulhas'] / $limit);
            $this->arrayInfo['currentPage'] = $currentPage;
            // $this->arrayInfo['noticia_comentarios'] = $n->getComentariosNoticiaById($id);

			/* Fara com que a página seja carregada */
            $this->loadTemplate('forum/abrir', $this->arrayInfo);
		} else {
			header("Location: " . BASE);
			exit;
		}

        
    }

    public function criar_topico()
    {
        if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') == 1) {
			$r = new Registros();
			$this->arrayInfo['page_active'] = 'forum';
			$this->arrayInfo['pageName'] = 'Criar Tópico';

			$this->arrayInfo['registro'] = $r->getMembroByID($this->acesso->getInfo('id_registro'));
			
			/* Fara com que a página seja carregada */
			$this->loadTemplate('forum/criar_topico', $this->arrayInfo);
		} else {
			header("Location: ".BASE);
			exit;
		}
    }

    public function publicarTopico()
    {
        $u = new Uteis();
        $f = new Forum();

        $pag = 'perfil/configuracoes-forum';
		$_SESSION['aviso_registro'] = 'Não foi possível publicar o seu tópico. Tente novamente mais tarde!';
        
        if (
            isset($_POST['topico_titulo'])
            && !empty($_POST['topico_titulo'])
            
			&& isset($_POST['topico_categoria'])
            && !empty($_POST['topico_categoria'])

            && isset($_POST['texto'])
            && !empty($_POST['texto'])
            
			&& $this->acesso->isLogged() 
            && $this->acesso->getInfo('confirmado') == 1) 
        {
            $topico_titulo = addslashes($u->trocarItens($_POST['topico_titulo']));
            $slug = $u->criar_slug($topico_titulo);
            $topico_categoria = addslashes($u->trocarItens($_POST['topico_categoria']));
            $texto = $_POST['texto'];
            $nickname = $this->acesso->getInfo('nickname');
            $id_registro = $this->acesso->getInfo('id_registro');
            $data = date('Y-m-d H:i:s');

            $id = $f->addTopico($topico_titulo, $slug, $topico_categoria, $texto, $nickname, $id_registro, $data, $this->acesso->getInfo('nickname'));

            $pag = 'forum/abrir/'.$id.'/'.$slug;
		    $_SESSION['aviso_registro'] = 'Tópico publicado com sucesso!';
            

        } 
        
        header("Location: " . BASE . $pag);
		exit;
    }

    public function deletarTopico($id_topico)
    {
        $u = new Uteis();
        $f = new Forum();

        $pag = 'perfil/configuracoes-forum';
        $_SESSION['aviso_registro'] = 'Não foi possível deletar este tópico. Tente novamente mais tarde!';        
        
        if (
            is_numeric($id_topico)           
            
			&& $this->acesso->isLogged() 
            && $this->acesso->getInfo('confirmado') == 1) 
        {
            
            $meu_topico = $f->meuTopico($id_topico, $this->acesso->getInfo('id_registro'));

            if($meu_topico) {
                $f->deleteTopico($id_topico, $this->acesso->getInfo('nickname'));
                $_SESSION['aviso_registro'] = 'Tópico deletado com sucesso!';
            }

            

        }        
        header("Location: " . BASE . $pag);
		exit;
    }
}
