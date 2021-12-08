<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Forum;
use \Models\Externos;
use \Models\Uteis;
use \Models\Registros;

class ForumController extends Controller
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

        if (!$e->isMembro(3, $this->acesso->getInfo('id_registro'))) {
            $l = new \Models\Logs();
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
            $l->addLog('invasao', $msg);

            header("Location: " . BASE);
            exit;
        }

        $this->arrayInfo = array(
            'page_active' => 'forum',
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
        $e = new Externos();
        $f = new Forum();

        $this->arrayInfo['pageName'] = 'Todas as postagens';
        $this->arrayInfo['topicos'] = $f->getTopicos();
        $this->arrayInfo['mi_externos'] = $e->getInfos($this->acesso->getInfo('id_registro'), 3);

        if (count($this->arrayInfo['mi_externos']) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $this->arrayInfo['mi_externos'] = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 3,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        $this->arrayInfo['total_topicos'] = $f->getTotalTopicos();
        $this->arrayInfo['total_moderados'] = $f->getTotalTopicos([1, 2]);
        $this->arrayInfo['total_fechados'] = $f->getTotalTopicos([3]);
        $this->arrayInfo['total_deletados'] = $f->getTotalTopicos([4]);

        /* Fara com que a página seja carregada */
        $this->loadTemplate('forum/postagens', $this->arrayInfo);
    }

    public function revisar($id)
    {
        $f = new Forum();
        $e = new Externos();
        $postagem = $f->getTopicoById($id);
        if (is_numeric($id)) {
            $e = new Externos();

            $this->arrayInfo['pageName'] = 'Revisar postagem';
            $this->arrayInfo['id'] = $id;
            $this->arrayInfo['postagem'] = $postagem;
            $this->arrayInfo['mi_externos'] = $e->getInfos($this->acesso->getInfo('id_registro'), 3);

            if (count($this->arrayInfo['mi_externos']) == 0 && $this->acesso->getInfo('patente') <= 6) {
                $this->arrayInfo['mi_externos'] = [
                    'id_registro' => $this->acesso->getInfo('id_registro'),
                    'cargo' => 10,
                    'id_externo' => 3,
                    'nickname' => $this->acesso->getInfo('nickname')
                ];
            }


            /* Fara com que a página seja carregada */
            $this->loadTemplate('forum/postagem', $this->arrayInfo);
        }
    }

    public function editarPostagem()
    {
        $f = new Forum();
        if (
            isset($_POST['id']) && !empty($_POST['id']) &&
            isset($_POST['status']) && !empty($_POST['status'])
        ) {
            $id = addslashes($_POST['id']);
            $status = addslashes($_POST['status']);
            $f->updateStatus($id, $status, $this->acesso->getInfo('nickname'));
        }

        header("Location: " . BASE . "forum");
        exit;
    }

    public function deletarTopico($id)
    {
        $f = new Forum();
        if (
            is_numeric($id)
        ) {
            $f->updateStatus($id, 4, $this->acesso->getInfo('nickname'));
        }

        header("Location: " . BASE . "forum");
        exit;
    }


    /*
		Configuração da Página Inicial do site
	*/
    public function comentarios()
    {
        $e = new Externos();
        $f = new Forum();
        $u = new Uteis();

        $this->arrayInfo['pageName'] = 'Todas os comentarios';
        $this->arrayInfo['comentarios'] = $f->getComentarios();
        $this->arrayInfo['u'] = $u;
        $this->arrayInfo['mi_externos'] = $e->getInfos($this->acesso->getInfo('id_registro'), 3);

        if (count($this->arrayInfo['mi_externos']) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $this->arrayInfo['mi_externos'] = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 3,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        /* Fara com que a página seja carregada */
        $this->loadTemplate('forum/comentarios', $this->arrayInfo);
    }

    public function deletarComentario($id)
    {
        $e = new Externos();
        $f = new Forum();

        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 3);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 3,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        if ($mi_externos >= 1 && is_numeric($id)) {
            $f->delComentario($id, $this->acesso->getInfo('nickname'));
        }

        header("Location: " . BASE . "forum/comentarios");
        exit;
    }


    public function equipe()
    {
        $e = new Externos();

        $this->arrayInfo['pageName'] = 'Equipe';
        $this->arrayInfo['membros'] = $e->getMembros(3);
        $this->arrayInfo['mi_externos'] = $e->getInfos($this->acesso->getInfo('id_registro'), 3);

        if (count($this->arrayInfo['mi_externos']) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $this->arrayInfo['mi_externos'] = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 3,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        /* Fara com que a página seja carregada */
        $this->loadTemplate('forum/equipe', $this->arrayInfo);
    }

    public function equipeAdd()
    {
        $e = new Externos();

        $this->arrayInfo['pageName'] = 'Adicionar membro a equipe';
        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 3);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 3,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        if ($mi_externos >= 2) {
            /* Fara com que a página seja carregada */
            $this->loadTemplate('forum/equipe_add', $this->arrayInfo);
        }
    }

    public function equipeAddAction()
    {
        $e = new Externos();
        $r = new Registros();

        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 3);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 3,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        if ($mi_externos >= 2 && isset($_POST['nickname']) && !empty($_POST['nickname']) && isset($_POST['cargo']) && !empty($_POST['cargo'])) {
            $nickname = addslashes($_POST['nickname']);
            $cargo = addslashes($_POST['cargo']);
            $registro = $r->getMembroByNickname($nickname);

            if (count($registro) > 0 && !$e->isMembro2(3, $registro['id'])) {
                $e->addMembro($registro['id'], $registro['nickname'], $cargo, 3, $this->acesso->getInfo('nickname'));
            }
        }

        header("Location: " . BASE . "forum/equipe");
        exit;
    }

    public function editarMembro($id)
    {
        $e = new Externos();

        $this->arrayInfo['pageName'] = 'Editar membro da equipe';
        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 3);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 3,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        if ($mi_externos >= 2 && is_numeric($id)) {
            $this->arrayInfo['membro'] = $e->getInfosById($id, 3);

            /* Fara com que a página seja carregada */
            $this->loadTemplate('forum/equipe_edit', $this->arrayInfo);
        }
    }

    public function equipeEditAction()
    {
        $e = new Externos();
        $r = new Registros();

        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 3);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 3,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        if ($mi_externos >= 2 && isset($_POST['nickname']) && !empty($_POST['nickname']) && isset($_POST['cargo']) && !empty($_POST['cargo'])) {
            $nickname = addslashes($_POST['nickname']);
            $cargo = addslashes($_POST['cargo']);
            $id = intval($_POST['id']);
            $registro = $r->getMembroByNickname($nickname);

            if (count($registro) > 0) {
                $e->updateMembro($id, $registro['nickname'], $cargo, 3, $this->acesso->getInfo('nickname'));
            }
        }

        header("Location: " . BASE . "forum/equipe");
        exit;
    }

    public function deletarMembro($id)
    {
        $e = new Externos();
        $r = new Registros();
        $mi_externos = $e->getInfos($this->acesso->getInfo('id_registro'), 3);

        if (count($mi_externos) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $mi_externos = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 3,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        $externo_membro = $e->getInfosById($id, 3);

        if (
            is_numeric($id) &&
            $e->isMembro(3, $this->acesso->getInfo('id_registro')) &&
            $this->arrayInfo['minha_info']['cargo'] >= 2 &&
            count($externo_membro) > 0
        ) {
            $e->delMembro($id, 3, $externo_membro['nickname'], $this->acesso->getInfo('nickname'));
        }

        header("Location: " . BASE . "jornal/equipe");
        exit;
    }
}
