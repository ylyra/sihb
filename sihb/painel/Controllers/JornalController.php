<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Noticias;
use \Models\Externos;
use \Models\Uteis;
use \Models\Registros;

class JornalController extends Controller
{

    private $acesso;
    private $arrayInfo;

    public function __construct()
    {
        parent::__construct();

        $this->acesso = new Acesso();
        $e = new Externos();

        if (!$this->acesso->isLogged()) {
            header("Location: " . BASE);
            exit;
        }

        if (!$e->isMembro(2, $this->acesso->getInfo('id_registro'))) {
            $l = new \Models\Logs();
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
            $l->addLog('invasao', $msg);

            header("Location: " . BASE);
            exit;
        }

        $this->arrayInfo = array(
            'page_active' => 'jornal',
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
        $n = new Noticias();
        $e = new Externos();

        $this->arrayInfo['pageName'] = 'Todas as notícias';
        $this->arrayInfo['noticias'] = $n->getNoticias();
        $this->arrayInfo['mi_externos'] = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($this->arrayInfo['mi_externos']) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $this->arrayInfo['mi_externos'] = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        $this->arrayInfo['total_noticias'] = $n->getTotalNoticias();
        $this->arrayInfo['total_noticias_revisadas'] = $n->getTotalNoticias(1);
        $this->arrayInfo['total_noticias_sem_revisao'] = $n->getTotalNoticias(0);
        $this->arrayInfo['total_minhas'] = $n->getTotalNoticiasDe($this->acesso->getInfo('id_registro'));

        /* Fara com que a página seja carregada */
        $this->loadTemplate('jornal/todas', $this->arrayInfo);
    }

    public function criar()
    {
        $n = new Noticias();
        $id = $n->criarNoticia($this->acesso->getInfo('id_registro'));
        header("Location: " . BASE . "jornal/create/" . $id);
        exit;
    }

    public function create($id)
    {
        $n = new Noticias();
        $noticia = $n->getNoticiaById($id);
        if (is_numeric($id) && $noticia['autor_id'] == $this->acesso->getInfo('id_registro')) {
            $e = new Externos();

            $this->arrayInfo['pageName'] = 'Criar notícia';
            $this->arrayInfo['id'] = $id;
            $this->arrayInfo['categorias'] = $n->getCategorias();
            $this->arrayInfo['noticia'] = $noticia;
            $this->arrayInfo['mi_externos'] = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

            if (count($this->arrayInfo['mi_externos']) == 0 && $this->acesso->getInfo('patente') <= 6) {
                $this->arrayInfo['mi_externos'] = [
                    'id_registro' => $this->acesso->getInfo('id_registro'),
                    'cargo' => 10,
                    'id_externo' => 2,
                    'nickname' => $this->acesso->getInfo('nickname')
                ];
            }


            /* Fara com que a página seja carregada */
            $this->loadTemplate('jornal/criar', $this->arrayInfo);
        }
    }

    public function revisar($id)
    {
        $n = new Noticias();
        $e = new Externos();
        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        $noticia = $n->getNoticiaById($id);
        if (is_numeric($id) && $mi_externos['cargo'] >= 3) {
            $e = new Externos();

            $this->arrayInfo['pageName'] = 'Editar notícia';
            $this->arrayInfo['id'] = $id;
            $this->arrayInfo['categorias'] = $n->getCategorias();
            $this->arrayInfo['noticia'] = $noticia;
            $this->arrayInfo['mi_externos'] = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

            if (count($this->arrayInfo['mi_externos']) == 0 && $this->acesso->getInfo('patente') <= 6) {
                $this->arrayInfo['mi_externos'] = [
                    'id_registro' => $this->acesso->getInfo('id_registro'),
                    'cargo' => 10,
                    'id_externo' => 2,
                    'nickname' => $this->acesso->getInfo('nickname')
                ];
            }


            /* Fara com que a página seja carregada */
            $this->loadTemplate('jornal/criar2', $this->arrayInfo);
        }
    }

    public function editar($id)
    {
        $n = new Noticias();
        $noticia = $n->getNoticiaById($id);
        if (is_numeric($id) && $noticia['autor_id'] == $this->acesso->getInfo('id_registro')) {
            $e = new Externos();

            $this->arrayInfo['pageName'] = 'Editar notícia';
            $this->arrayInfo['id'] = $id;
            $this->arrayInfo['categorias'] = $n->getCategorias();
            $this->arrayInfo['noticia'] = $noticia;
            $this->arrayInfo['mi_externos'] = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

            if (count($this->arrayInfo['mi_externos']) == 0 && $this->acesso->getInfo('patente') <= 6) {
                $this->arrayInfo['mi_externos'] = [
                    'id_registro' => $this->acesso->getInfo('id_registro'),
                    'cargo' => 10,
                    'id_externo' => 2,
                    'nickname' => $this->acesso->getInfo('nickname')
                ];
            }

            /* Fara com que a página seja carregada */
            $this->loadTemplate('jornal/criar', $this->arrayInfo);
        }
    }

    public function updateCriacao()
    {
        $n = new Noticias();
        $u = new Uteis();
        $e = new Externos();
        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }


        if (
            isset($_POST['id']) && !empty($_POST['id']) &&
            isset($_POST['titulo']) &&
            isset($_POST['subtitulo']) &&
            isset($_POST['banner']) &&
            isset($_POST['categoria']) &&
            isset($_POST['texto']) &&
            isset($_POST['tipo']) && !empty($_POST['tipo'])
        ) {
            $id = addslashes($_POST['id']);
            $titulo = addslashes($_POST['titulo']);
            $slug = $u->criar_slug($titulo);
            $subtitulo = addslashes($_POST['subtitulo']);
            $banner = addslashes($_POST['banner']);
            $categoria = addslashes($_POST['categoria']);
            $texto = $_POST['texto'];
            $tipo = intval($_POST['tipo']);
            $status = 0;

            if ($mi_externos['cargo'] >= 2 && $tipo == 2) {
                $status = 1;
            }

            $noticia = $n->getNoticiaById($id);
            if (is_numeric($id) && $noticia['autor_id'] == $this->acesso->getInfo('id_registro')) {
                $n->updateCriacao($id, $titulo, $slug, $subtitulo, $banner, $categoria, $texto, $this->acesso->getInfo('nickname'), $this->acesso->getInfo('id_registro'), $status);
            }
        }

        header("Location: " . BASE . "jornal");
        exit;
    }

    public function update()
    {
        $n = new Noticias();
        $u = new Uteis();
        $e = new Externos();
        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        if (
            isset($_POST['id']) && !empty($_POST['id']) &&
            isset($_POST['titulo']) &&
            isset($_POST['subtitulo']) &&
            isset($_POST['banner']) &&
            isset($_POST['categoria']) &&
            isset($_POST['texto']) &&
            $mi_externos['cargo'] >= 3
        ) {
            $id = addslashes($_POST['id']);
            $titulo = addslashes($_POST['titulo']);
            $slug = $u->criar_slug($titulo);
            $subtitulo = addslashes($_POST['subtitulo']);
            $banner = addslashes($_POST['banner']);
            $categoria = addslashes($_POST['categoria']);
            $texto = $_POST['texto'];
            $noticia = $n->getNoticiaById($id);
            $status = (isset($_POST['status']) && !empty($_POST['status'])) ? intval($_POST['status']) : 0;

            if (is_numeric($id) && $mi_externos['cargo'] >= 3) {
                $n->updateCriacao($id, $titulo, $slug, $subtitulo, $banner, $categoria, $texto, $noticia['autor'], $noticia['autor_id'], $status, $this->acesso->getInfo('nickname'));
            }
        }

        header("Location: " . BASE . "jornal");
        exit;
    }

    public function delete_my($id)
    {
        $n = new Noticias();
        if (
            is_numeric($id)
        ) {
            $noticia = $n->getNoticiaById($id);
            if (is_numeric($id) && $noticia['autor_id'] == $this->acesso->getInfo('id_registro')) {
                $n->deleteNoticia($id, $this->acesso->getInfo('nickname'));
            }
        }

        header("Location: " . BASE . "jornal");
        exit;
    }

    public function delete($id)
    {
        $n = new Noticias();
        $e = new Externos();
        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        if (
            is_numeric($id) &&
            $mi_externos['cargo'] >= 3
        ) {
            $n->deleteNoticia($id, $this->acesso->getInfo('nickname'));
        }

        header("Location: " . BASE . "jornal");
        exit;
    }

    public function equipe()
    {
        $e = new Externos();

        $this->arrayInfo['pageName'] = 'Equipe';
        $this->arrayInfo['membros'] = $e->getMembros(2);
        $this->arrayInfo['mi_externos'] = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($this->arrayInfo['mi_externos']) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $this->arrayInfo['mi_externos'] = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        /* Fara com que a página seja carregada */
        $this->loadTemplate('jornal/equipe', $this->arrayInfo);
    }

    public function equipeAdd()
    {
        $e = new Externos();

        $this->arrayInfo['pageName'] = 'Adicionar membro a equipe';
        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        if ($mi_externos >= 4) {
            /* Fara com que a página seja carregada */
            $this->loadTemplate('jornal/equipe_add', $this->arrayInfo);
        }
    }

    public function equipeAddAction()
    {
        $e = new Externos();
        $r = new Registros();

        $this->arrayInfo['pageName'] = 'Adicionar membro a equipe';
        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        if ($mi_externos >= 4 && isset($_POST['nickname']) && !empty($_POST['nickname']) && isset($_POST['cargo']) && !empty($_POST['cargo'])) {
            $nickname = addslashes($_POST['nickname']);
            $cargo = addslashes($_POST['cargo']);
            $registro = $r->getMembroByNickname($nickname);

            if (count($registro) > 0 && !$e->isMembro2(2, $registro['id'])) {
                $e->addMembro($registro['id'], $registro['nickname'], $cargo, 2, $this->acesso->getInfo('nickname'));
            }
        }

        header("Location: " . BASE . "jornal/equipe");
        exit;
    }

    public function editarMembro($id)
    {
        $e = new Externos();

        $this->arrayInfo['pageName'] = 'Editar membro da equipe';
        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        if ($mi_externos >= 4 && is_numeric($id)) {
            $this->arrayInfo['membro'] = $e->getInfosById($id, 2);

            /* Fara com que a página seja carregada */
            $this->loadTemplate('jornal/equipe_edit', $this->arrayInfo);
        }
    }

    public function equipeEditAction()
    {
        $e = new Externos();
        $r = new Registros();

        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        if ($mi_externos >= 4 && isset($_POST['nickname']) && !empty($_POST['nickname']) && isset($_POST['cargo']) && !empty($_POST['cargo'])) {
            $nickname = addslashes($_POST['nickname']);
            $cargo = addslashes($_POST['cargo']);
            $id = intval($_POST['id']);
            $registro = $r->getMembroByNickname($nickname);

            if (count($registro) > 0) {
                $e->updateMembro($id, $registro['nickname'], $cargo, 2, $this->acesso->getInfo('nickname'));
            }
        }

        header("Location: " . BASE . "jornal/equipe");
        exit;
    }

    public function deletarMembro($id)
    {
        $e = new Externos();
        $r = new Registros();
        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        $externo_membro = $e->getInfosById($id, 2);
        if (
            is_numeric($id) &&
            $e->isMembro(2, $this->acesso->getInfo('id_registro')) &&
            $this->arrayInfo['minha_info']['cargo'] >= 4 &&
            count($externo_membro) > 0
        ) {
            $e->delMembro($id, 2, $externo_membro['nickname'], $this->acesso->getInfo('nickname'));
        }

        header("Location: " . BASE . "jornal/equipe");
        exit;
    }

    public function comentarios()
    {
        $e = new Externos();
        $n = new Noticias();

        $this->arrayInfo['pageName'] = 'Comentários das notícias';
        $this->arrayInfo['noticias_comentarios'] = $n->getComentariosNoticias();
        $this->arrayInfo['mi_externos'] = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($this->arrayInfo['mi_externos']) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $this->arrayInfo['mi_externos'] = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        /* Fara com que a página seja carregada */
        $this->loadTemplate('jornal/comentarios', $this->arrayInfo);
    }

    public function deletarComentario($id)
    {
        $e = new Externos();
        $n = new Noticias();

        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        if ($mi_externos >= 4 && is_numeric($id)) {
            $n->delComentario($id, $this->acesso->getInfo('nickname'));
        }

        header("Location: " . BASE . "jornal/comentarios");
        exit;
    }

    public function categorias()
    {
        $e = new Externos();
        $n = new Noticias();

        $this->arrayInfo['pageName'] = 'Comentários das notícias';
        $this->arrayInfo['categorias'] = $n->getCategorias();
        $this->arrayInfo['mi_externos'] = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($this->arrayInfo['mi_externos']) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $this->arrayInfo['mi_externos'] = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        /* Fara com que a página seja carregada */
        $this->loadTemplate('jornal/categorias', $this->arrayInfo);
    }

    public function categoriasAdd()
    {
        $e = new Externos();
        $n = new Noticias();

        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        if ($mi_externos >= 4) {
            $this->arrayInfo['pageName'] = 'Comentários das notícias';
            $this->arrayInfo['categorias'] = $n->getCategorias();
            $this->arrayInfo['mi_externos'] = $mi_externos;

            /* Fara com que a página seja carregada */
            $this->loadTemplate('jornal/categorias_add', $this->arrayInfo);
        }
    }

    public function categoriasAddAction()
    {
        $e = new Externos();
        $r = new Registros();
        $n = new Noticias();

        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }


        if ($mi_externos >= 4 && isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $n->addCategoria($nome, $this->acesso->getInfo('nickname'));
        }

        header("Location: " . BASE . "jornal/categorias");
        exit;
    }

    public function deletarCategoria($id)
    {
        $e = new Externos();
        $n = new Noticias();

        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 2);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 2,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        if ($mi_externos >= 4 && is_numeric($id)) {
            $n->delCategoria($id, $this->acesso->getInfo('nickname'));
        }

        header("Location: " . BASE . "jornal/categorias");
        exit;
    }
}
