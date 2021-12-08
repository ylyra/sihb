<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Cursos;
use \Models\Textos;

class CursosController extends Controller
{

	private $acesso;
	private $arrayInfo;

	public function __construct()
	{
		parent::__construct();

		$this->acesso = new Acesso();

        if (!$this->acesso->isLogged()) {
            $_SESSION['aviso_registro'] = 'Efetue login para ter acesso a loja do site!';
            header("Location: ".BASE);
        }

        if ($this->acesso->getInfo('confirmado') != 1) {
            $_SESSION['aviso_registro'] = 'Confirme sua conta para ter acesso a loja do site!';
            header("Location: ".BASE);
		}
			
		$this->arrayInfo = array(
			'page_active' => 'cursos',
			'pageName' => '',
			'description' => '',
			'acesso' => $this->acesso,
		);
	}

	/*
		Configuração da Página Inicial da Cursos
	*/
	public function index()
	{
		$c = new Cursos();

		$this->arrayInfo['page_active'] = 'cursos';
		$this->arrayInfo['pageName'] = 'Cursos';
        $this->arrayInfo['cursos'] = $c;
        $this->arrayInfo['pendentes'] = $c->totalCursosTipo($this->acesso->getInfo('id_registro'), 0);
        $this->arrayInfo['completos'] = $c->totalCursosTipo($this->acesso->getInfo('id_registro'), 1);
        $this->arrayInfo['totalCursos'] = $c->totalCursos($this->acesso->getInfo('id_registro'));
		$this->arrayInfo['totalCursosG'] = $c->totalCursosG();
        $this->arrayInfo['meusCursos'] = $c->getMeusCursos($this->acesso->getInfo('id_registro'));
        $this->arrayInfo['cursosArea'] = $c->getAreas($this->acesso->getInfo('id_registro'));
        $this->arrayInfo['historicos'] = $c->getHistorico($this->acesso->getInfo('id_registro'));
		
		/* Fara com que a página seja carregada */
		$this->loadView('cursos/todos', $this->arrayInfo);
	}

	public function comprar($id)
	{
		$c = new Cursos();
		$curso = $c->getCurso(intval($id), $this->acesso->getInfo('id_registro'));
		$tenhoCurso = $c->tenhoCurso($id, $this->acesso->getInfo('id_registro'));

		if (is_numeric($id) && count($curso) > 0 && !$tenhoCurso) {
			
			if ($curso['vip'] && $this->acesso->getInfo('vip') && intval($this->acesso->getInfo('moedas')) >= $curso['valor']) {
				$c->comprarCurso($curso, $this->acesso->getInfo('id_registro'));

			} elseif (!$curso['vip'] && intval($this->acesso->getInfo('moedas')) >= $curso['valor']) {
				$c->comprarCurso($curso, $this->acesso->getInfo('id_registro'));
			}

		}

		header("Location: ".BASE."cursos");
		exit;
	}

	public function getCurso()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		$response = get_object_vars($obj);
		$c = new Cursos();

		if($c->tenhoCurso(intval($response['course']), $this->acesso->getInfo('id_registro'))) {
			$this->arrayInfo['curso'] = $c->getCurso(intval($response['course']), $this->acesso->getInfo('id_registro'));
			$this->arrayInfo['aulas'] = $c->getAulasCurso(intval($response['course']), $this->acesso->getInfo('id_registro'));

			/* Fara com que a página seja carregada */
			$this->loadView('cursos/showCourse', $this->arrayInfo);
		}
	}

	public function marcarVisto()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		$response = get_object_vars($obj);
		$c = new Cursos();

		if($c->tenhoCurso(intval($response['curso']), $this->acesso->getInfo('id_registro'))) {
			$c->addView(intval($response['curso']), intval($response['aula']), $this->acesso->getInfo('id_registro'));
		}
	}

	public function regras()
	{
		$t = new Textos();
		$this->arrayInfo['texto'] = $t->getTexto2(34, 'cursos-regras');
		if (count($this->arrayInfo['texto']) > 0) {
			$this->arrayInfo['pageName'] = 'Cursos - Regras';

			/* Fara com que a página seja carregada */
			$this->loadTemplate('pages/open', $this->arrayInfo);
		}
	}

}
