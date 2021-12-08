<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Cursos;
use \Models\Externos;
use \Models\Registros;
use \Models\Uteis;

class CursosController extends Controller
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
        $this->arrayInfo = array(
            'page_active' => 'cursos',
            'pageName' => '',
            'description' => '',
            'acesso' => $this->acesso
        );

        $this->arrayInfo['mi_externos'] = $e->getInfos($this->acesso->getInfo('id_registro'), 7);

        if (count($this->arrayInfo['mi_externos']) == 0 && $this->acesso->getInfo('patente') <= 6) {
            $this->arrayInfo['mi_externos'] = [
                'id_registro' => $this->acesso->getInfo('id_registro'),
                'cargo' => 10,
                'id_externo' => 7,
                'nickname' => $this->acesso->getInfo('nickname')
            ];
        }

        if (!$e->isMembro(7, $this->acesso->getInfo('id_registro'))) {
            $l = new \Models\Logs();
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
            $l->addLog('invasao', $msg);

            header("Location: " . BASE);
            exit;
        }
    }

    /*
		Configuração da Página Inicial dos cursos
	*/
    public function index()
    {
        $c = new Cursos();
        $this->arrayInfo['pageName'] = 'Todos os cursos';
        $this->arrayInfo['cursos'] = $c->getCursos();

        /* Fara com que a página seja carregada */
        $this->loadTemplate('cursos/todas', $this->arrayInfo);
    }

    /*
		Configuração da Página Inicial dos cursos
	*/
    public function novo()
    {
        $c = new Cursos();
        $this->arrayInfo['pageName'] = 'Novo curso';
        $this->arrayInfo['areas'] = $c->getAreas();

        /* Fara com que a página seja carregada */
        $this->loadTemplate('cursos/novo', $this->arrayInfo);
    }

    public function addAction()
    {
        $u = new Uteis();
        $retorno = 'cursos';

        $curso_nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
        $area = filter_input(INPUT_POST, 'area', FILTER_SANITIZE_NUMBER_INT);
        $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING);
        $cor = $u->hexToRgb(filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_STRING));
        $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_INT);
        $vip = filter_input(INPUT_POST, 'vip', FILTER_SANITIZE_NUMBER_INT);

        if ($curso_nome && $descricao && $area && $imagem && $cor && $valor) {
            $c = new Cursos();

            $id = $c->addCurso($curso_nome, $descricao, $area, $imagem, $cor, $valor, $vip);
            $retorno = 'cursos/editar/' . $id;
        }

        header("Location: " . BASE . $retorno);
        exit;
    }

    public function editar($id_curso)
    {
        $c = new Cursos();

        $this->arrayInfo['pageName'] = 'Editar curso';
        $this->arrayInfo['curso'] = $c->getCurso($id_curso);
        $this->arrayInfo['areas'] = $c->getAreas();
        $this->arrayInfo['u'] = new Uteis();

        if (is_numeric($id_curso) && !empty($this->arrayInfo['curso'])) {

            /* Fara com que a página seja carregada */
            $this->loadTemplate('cursos/editar', $this->arrayInfo);
        }
    }

    public function editAction($id_curso)
    {
        $c = new Cursos();
        $u = new Uteis();

        $this->arrayInfo['curso'] = $c->getCurso($id_curso);
        $retorno = '';

        $curso_nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
        $area = filter_input(INPUT_POST, 'area', FILTER_SANITIZE_NUMBER_INT);
        $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING);
        $cor = $u->hexToRgb(filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_STRING));
        $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_INT);
        $vip = filter_input(INPUT_POST, 'vip', FILTER_SANITIZE_NUMBER_INT);

        if (is_numeric($id_curso) && !empty($this->arrayInfo['curso']) && $curso_nome && $descricao && $area && $imagem && $cor && $valor) {
            echo 'chegou';

            $c->editCurso($curso_nome, $descricao, $area, $imagem, $cor, $valor, $vip, $id_curso);
            $retorno = 'cursos/editar/' . $id_curso;
        }

        header("Location: " . BASE . $retorno);
        exit;
    }

    public function adicionarAula($id_curso)
    {
        $c = new Cursos();

        $this->arrayInfo['curso'] = $c->getCurso($id_curso);
        $retorno = '';

        $aula_nome = filter_input(INPUT_POST, 'aula_nome', FILTER_SANITIZE_STRING);
        $posicao = filter_input(INPUT_POST, 'posicao', FILTER_SANITIZE_NUMBER_INT);
        $video_url = filter_input(INPUT_POST, 'video_url', FILTER_SANITIZE_STRING);

        if (is_numeric($id_curso) && !empty($this->arrayInfo['curso']) && $aula_nome && $posicao >= 1 && $video_url) {

            $c->adicionarAula($aula_nome, $posicao, $video_url, $id_curso);
            $retorno = 'cursos/editar/' . $id_curso;
        }

        header("Location: " . BASE . $retorno);
        exit;
    }

    public function dar_curso()
    {
        $c = new Cursos();
        $this->arrayInfo['pageName'] = 'Dar curso';
        $this->arrayInfo['cursos'] = $c->getCursos();

        /* Fara com que a página seja carregada */
        $this->loadTemplate('cursos/dar_curso', $this->arrayInfo);
    }

    public function darCursoAction() {

        $r = new Registros();
        $c = new Cursos();

        if (
            isset($_POST['nicksnames']) && !empty($_POST['nicksnames']) &&
            isset($_POST['curso']) && !empty($_POST['curso'])
        ) {
            $nicknames = $_POST['nicksnames'];
            $curso = intval($_POST['curso']);

            foreach ($nicknames as $nickname) {
                $registro = $r->userExiste($nickname);
                if (count($registro) > 0) {
                    $c->darCurso($registro['id'], $curso);
                }
            }

            header("Location: ".BASE."cursos/dar_curso");
        }
    }

    public function areas()
    {
        $c = new Cursos();
        $this->arrayInfo['pageName'] = 'Áreas dos cursos';
        $this->arrayInfo['areas'] = $c->getAreas();

        /* Fara com que a página seja carregada */
        $this->loadTemplate('cursos/areas', $this->arrayInfo);
    }

    public function nova()
    {
        $c = new Cursos();
        $this->arrayInfo['pageName'] = 'Nova área';

        /* Fara com que a página seja carregada */
        $this->loadTemplate('cursos/nova', $this->arrayInfo);
    }

    public function addNovaAction()
    {
        $area_nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING);
        $cor = filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_STRING);

        if ($area_nome && $imagem && $cor) {
            $c = new Cursos();

            $id = $c->addArea($area_nome, $imagem, $cor);
            $retorno = 'cursos/editar_area/' . $id;
        }

        header("Location: " . BASE . $retorno);
        exit;
    }

    public function editar_area($id_area)
    {
        $c = new Cursos();

        $this->arrayInfo['pageName'] = 'Editar área';
        $this->arrayInfo['area'] = $c->getArea($id_area);
        $this->arrayInfo['u'] = new Uteis();

        if (is_numeric($id_area) && !empty($this->arrayInfo['area'])) {

            /* Fara com que a página seja carregada */
            $this->loadTemplate('cursos/editar_area', $this->arrayInfo);
        }
    }

    public function editAreaAction($id_area)
    {
        $retorno = '';
        $c = new Cursos();
        $this->arrayInfo['area'] = $c->getArea($id_area);

        $area_nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING);
        $cor = filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_STRING);

        if (is_numeric($id_area) && !empty($this->arrayInfo['area']) && $area_nome && $imagem && $cor) {
            $c->editArea($area_nome, $cor, $imagem, $id_area);
            
            $retorno = 'cursos/editar_area/' . $id_area;
        }

        header("Location: " . BASE . $retorno);
        exit;
    }

    public function deletar($id_curso)
    {
        $c = new Cursos();

        $this->arrayInfo['curso'] = $c->getCurso($id_curso);
        $retorno = '';

        if (is_numeric($id_curso) && !empty($this->arrayInfo['curso'])) {

            $c->deletarCurso($id_curso);
            $retorno = 'cursos';
        }

        header("Location: " . BASE . $retorno);
        exit;
    }

    public function deletar_aula($id_curso, $id_aula)
    {
        $c = new Cursos();

        $this->arrayInfo['curso'] = $c->getCurso($id_curso);
        $retorno = '';

        if (is_numeric($id_curso) && is_numeric($id_aula) && !empty($this->arrayInfo['curso'])) {

            $c->deletarAula($id_curso, $id_aula);
            $retorno = 'cursos/editar/' . $id_curso;
        }

        header("Location: " . BASE . $retorno);
        exit;
    }

    public function deletar_area($id_area)
    {
        $retorno = 'cursos/areas';
        $c = new Cursos();
        $this->arrayInfo['area'] = $c->getArea($id_area);

        if (is_numeric($id_area) && !empty($this->arrayInfo['area'])) {
            $c->deletarArea($id_area);
        }

        header("Location: " . BASE . $retorno);
        exit;
    }
}
