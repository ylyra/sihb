<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Relatorios;
use \Models\Registros;
use \Models\Uteis;

class RelatoriosController extends Controller
{

	private $acesso;
	private $arrayInfo;

	public function __construct()
	{
		parent::__construct();

		$this->acesso = new Acesso();

		if (!$this->acesso->isLogged()) {
			header("Location: " . BASE_PAI);
			exit;
		}

		$this->arrayInfo = array(
			'page_active' => 'relatorios',
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

		$this->arrayInfo['page_active'] = 'relatorios';
		$this->arrayInfo['pageName'] = 'Lista de membros';

		/* Fara com que a página seja carregada */
		$this->loadTemplate('404', $this->arrayInfo);
	}

	/*
		Página dos Meus relatório do site
	*/
	public function meus()
	{
		$r = new Relatorios();

		$this->arrayInfo['page_active'] = 'relatorios';
		$this->arrayInfo['pageName'] = 'Meus relatório';
		$this->arrayInfo['local'] = 1;
		$this->arrayInfo['tipos'] = [
			1 => 'Relatório de Atendimento',
			2 => 'Relatório de DE',
			3 => 'Relatório de Auto-Lotação Início',
			4 => 'Relatório de Treinamento',
			5 => 'Relatório de Ação Ajudante',
			6 => 'Sugestão',
			7 => 'Relatório de Auto-Lotação Fim',
			8 => 'Relatório Professores',
			10 => 'Relatório Entretenimento',
			11 => 'Relatório Ouvidoria'
		];
		$this->arrayInfo['meus'] = $r->getMeusRelatorios($this->acesso->getInfo('id_registro'));

		/* Fara com que a página seja carregada */
		$this->loadTemplate('relatorios/meus', $this->arrayInfo);
	}

	/*
		Página de Todos os relatório do site
	*/
	public function todos()
	{
		$r = new Relatorios();

		if ($this->acesso->getInfo('patente') <= 10) {
			$this->arrayInfo['page_active'] = 'relatorios';
			$this->arrayInfo['pageName'] = 'Todos relatório';
			$this->arrayInfo['local'] = 2;
			$this->arrayInfo['tipos'] = [
				1 => 'Relatório de Atendimento',
				2 => 'Relatório de DE',
				3 => 'Relatório de Auto-Lotação Início',
				4 => 'Relatório de Treinamento',
				5 => 'Relatório de Ação Ajudante',
				6 => 'Sugestão',
				7 => 'Relatório de Auto-Lotação Fim',
				8 => 'Relatório Professores',
				10 => 'Relatório Entretenimento',
				11 => 'Relatório Ouvidoria'
			];
			$this->arrayInfo['meus'] = $r->getRelatorios();

			/* Fara com que a página seja carregada */
			$this->loadTemplate('relatorios/meus', $this->arrayInfo);
		} else {
			$l = new \Models\Logs();
			$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			$_SESSION['edit_registro'] = 'Você está tentando acessar uma página disponível apenas para a direção.';
			$_SESSION['edit_registro_tipo'] = 'danger';
			header("Location: " . BASE);
			exit;
		}
	}

	/*
		Página de Criar relatório do site
	*/
	public function criar()
	{
		$r = new Relatorios();
		$re = new Registros();

		$this->arrayInfo['page_active'] = 'relatorios';
		$this->arrayInfo['pageName'] = 'Criar relatório';
		$this->arrayInfo['executivos'] = $re->getExecutivos();

		/* Fara com que a página seja carregada */
		$this->loadTemplate('relatorios/criar', $this->arrayInfo);
	}

	public function getCriar()
	{
		$re = new Registros();

		$tipo = 1;
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		$response = get_object_vars($obj);

		if (is_numeric($response['valor'])) {
			$l = new \Models\Logs();
			if ($response['valor'] == 2 && $this->acesso->getInfo('patente') > 12) {
				$tipo = 8;
				$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar um relatório que não tinha permissão.";
				$l->addLog('invasao', $msg);
			} elseif ($response['valor'] == 3 && $this->acesso->getInfo('patente') > 12) {
				$tipo = 8;
				$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar um relatório que não tinha permissão.";
				$l->addLog('invasao', $msg);
			} elseif ($response['valor'] == 4 && $this->acesso->getInfo('patente') > 11) {
				$tipo = 8;
				$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar um relatório que não tinha permissão.";
				$l->addLog('invasao', $msg);
			} elseif ($response['valor'] == 5 && !$this->acesso->isExterno(1, $this->acesso->getInfo('id_registro'))) {
				$tipo = 8;
				$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar um relatório que não tinha permissão.";
				$l->addLog('invasao', $msg);
			} elseif ($response['valor'] == 9 && !$this->acesso->isExterno(4, $this->acesso->getInfo('id_registro'))) {
				$tipo = 8;
				$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar um relatório que não tinha permissão.";
				$l->addLog('invasao', $msg);
			} elseif ($response['valor'] == 10 && !$this->acesso->isExterno(5, $this->acesso->getInfo('id_registro'))) {
				$tipo = 8;
				$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar um relatório que não tinha permissão.";
				$l->addLog('invasao', $msg);
			} elseif ($response['valor'] == 11 && !$this->acesso->isExterno(6, $this->acesso->getInfo('id_registro'))) {
				$tipo = 8;
				$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar um relatório que não tinha permissão.";
				$l->addLog('invasao', $msg);
			} else {
				$tipo = intval($response['valor']);
			}
		}

		$this->loadView('relatorios/getCriar', [
			'tipo' => $tipo,
			'executivos' => $re->getExecutivos(),
			'acesso' => $this->acesso
		]);
	}

	public function addRelatorio()
	{
		$uteis = new Uteis();
		$r = new Relatorios();
		$re = new Registros();

		$_SESSION['relatorio'] = 'Relatório enviado com sucesso!';
		$_SESSION['relatorio_tipo'] = 'success';


		if (isset($_POST['tipo']) && !empty($_POST['tipo'])) {
			$tipo = intval($_POST['tipo']);

			if (
				$tipo == 1
				&& isset($_POST['data']) && !empty($_POST['data'])
				&& isset($_POST['atendente']) && !empty($_POST['atendente'])
				&& isset($_POST['responsavel']) && !empty($_POST['responsavel'])
				&& isset($_POST['novato']) && !empty($_POST['novato'])
			) {
				$data = (isset($_POST['data']) && !empty($_POST['data'])) ? addslashes($_POST['data']) : date('d/m/Y');
				$data2 = $data . ' ' . date('H:i:s');
				$ut = explode('/', $data);
				$u = $ut[2] . '-' . $ut[1] . '-' . $ut[0];
				$data = $u . ' ' . date('H:i:s');

				$atendente = addslashes($uteis->trocarItens($_POST['atendente']));
				$atendente_id = $re->getIdDe($atendente);

				$responsavel = addslashes($uteis->trocarItens($_POST['responsavel']));
				$responsavel_id = $re->getIdDe($responsavel);

				$novato = addslashes($uteis->trocarItens($_POST['novato']));

				$relatorio = json_encode([
					'Data' => $data2,
					'Responsavel' => $responsavel,
					'Atendente' => $atendente,
					"Novato" => $novato
				]);
				$r->addRelatorio($tipo, $data, $atendente_id, $responsavel_id, $relatorio, $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
			} elseif (
				$tipo == 2 && $this->acesso->getInfo('patente') <= 12
				&& isset($_POST['data']) && !empty($_POST['data'])
				&& isset($_POST['atendente']) && !empty($_POST['atendente'])
				&& isset($_POST['responsavel']) && !empty($_POST['responsavel'])
				&& isset($_POST['novato']) && !empty($_POST['novato'])
			) {
				$data = (isset($_POST['data']) && !empty($_POST['data'])) ? addslashes($_POST['data']) : date('d/m/Y');
				$data2 = $data . ' ' . date('H:i:s');
				$ut = explode('/', $data);
				$u = $ut[2] . '-' . $ut[1] . '-' . $ut[0];
				$data = $u . ' ' . date('H:i:s');

				$atendente = addslashes($uteis->trocarItens($_POST['atendente']));
				$atendente_id = $re->getIdDe($atendente);

				$responsavel = addslashes($uteis->trocarItens($_POST['responsavel']));
				$responsavel_id = $re->getIdDe($responsavel);

				$novato = addslashes($uteis->trocarItens($_POST['novato']));

				$relatorio = json_encode([
					'Data' => $data2,
					'Responsavel' => $responsavel,
					'Atendente' => $atendente,
					"Novato" => $novato
				]);
				$r->addRelatorio($tipo, $data, $atendente_id, $responsavel_id, $relatorio, $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
			} elseif (
				$tipo == 3 && $this->acesso->getInfo('patente') <= 12
				&& isset($_POST['data']) && !empty($_POST['data'])
				&& isset($_POST['atendente']) && !empty($_POST['atendente'])
				&& isset($_POST['contas']) && !empty($_POST['contas'])
			) {

				$data = (isset($_POST['data']) && !empty($_POST['data'])) ? addslashes($_POST['data']) : date('d/m/Y');
				$data2 = $data . ' ' . date('H:i:s');
				$ut = explode('/', $data);
				$u = $ut[2] . '-' . $ut[1] . '-' . $ut[0];
				$data = $u . ' ' . date('H:i:s');

				$atendente = addslashes($uteis->trocarItens($_POST['atendente']));
				$atendente_id = $re->getIdDe($atendente);
				$responsavel_id = 0;

				$contas = addslashes($uteis->trocarItens($_POST['contas']));

				$relatorio = json_encode([
					'Data' => $data2,
					'Nickname' => $atendente,
					'Contas' => $contas
				]);
				$r->addRelatorio($tipo, $data, $atendente_id, $responsavel_id, $relatorio, $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
			} elseif (
				$tipo == 4 && $this->acesso->getInfo('patente') <= 11
				&& isset($_POST['data']) && !empty($_POST['data'])
				&& isset($_POST['atendente']) && !empty($_POST['atendente'])
				&& isset($_POST['responsavel']) && !empty($_POST['responsavel'])
				&& isset($_POST['nicksnames']) && !empty($_POST['nicksnames'])
				&& isset($_POST['treinamento_tipo']) && !empty($_POST['treinamento_tipo'])
			) {
				$data = (isset($_POST['data']) && !empty($_POST['data'])) ? addslashes($_POST['data']) : date('d/m/Y');
				$data2 = $data . ' ' . date('H:i:s');
				$ut = explode('/', $data);
				$u = $ut[2] . '-' . $ut[1] . '-' . $ut[0];
				$data = $u . ' ' . date('H:i:s');

				$atendente = addslashes($uteis->trocarItens($_POST['atendente']));
				$atendente_id = $re->getIdDe($atendente);

				$responsavel = addslashes($uteis->trocarItens($_POST['responsavel']));
				$responsavel_id = $re->getIdDe($responsavel);

				$treinamento_tipo = addslashes($uteis->trocarItens($_POST['treinamento_tipo']));

				$treinados = $_POST['nicksnames'];
				$treinados = implode(' / ', $treinados);

				$relatorio = json_encode([
					'Data' => $data2,
					'Treinamento' => $treinamento_tipo,
					'Responsavel' => $responsavel,
					'Atendente' => $atendente,
					"Novato" => $treinados
				]);
				$r->addRelatorio($tipo, $data, $atendente_id, $responsavel_id, $relatorio, $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
			} elseif (
				$tipo == 5 && $this->acesso->isExterno(1, $this->acesso->getInfo('id_registro'))
				&& isset($_POST['data']) && !empty($_POST['data'])
				&& isset($_POST['atendente']) && !empty($_POST['atendente'])
				&& isset($_POST['ajudado']) && !empty($_POST['ajudado'])
				&& isset($_POST['como']) && !empty($_POST['como'])
				&& isset($_POST['onde']) && !empty($_POST['onde'])
			) {
				$data = (isset($_POST['data']) && !empty($_POST['data'])) ? addslashes($_POST['data']) : date('d/m/Y');
				$data2 = $data . ' ' . date('H:i:s');
				$ut = explode('/', $data);
				$u = $ut[2] . '-' . $ut[1] . '-' . $ut[0];
				$data = $u . ' ' . date('H:i:s');

				$atendente = addslashes($uteis->trocarItens($_POST['atendente']));
				$atendente_id = $re->getIdDe($atendente);

				$ajudado = addslashes($uteis->trocarItens($_POST['ajudado']));
				$como = addslashes($uteis->trocarItens($_POST['como']));
				$onde = addslashes($uteis->trocarItens($_POST['onde']));
				$responsavel_id = 0;

				$relatorio = json_encode([
					'Data' => $data2,
					'Ajudante' => $atendente,
					'Ajudado' => $ajudado,
					'Como' => $como,
					'Onde' => $onde
				]);
				$r->addRelatorio($tipo, $data, $atendente_id, $responsavel_id, $relatorio, $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
			} elseif (
				$tipo == 6
				&& isset($_POST['data']) && !empty($_POST['data'])
				&& isset($_POST['nickname']) && !empty($_POST['nickname'])
				&& isset($_POST['sugestao']) && !empty($_POST['sugestao'])
			) {
				$data = (isset($_POST['data']) && !empty($_POST['data'])) ? addslashes($_POST['data']) : date('d/m/Y');
				$data2 = $data . ' ' . date('H:i:s');
				$ut = explode('/', $data);
				$u = $ut[2] . '-' . $ut[1] . '-' . $ut[0];
				$data = $u . ' ' . date('H:i:s');
				$atendente = addslashes($uteis->trocarItens($_POST['nickname']));
				$atendente_id = $re->getIdDe($atendente);

				$sugestao = addslashes($uteis->trocarItens($_POST['sugestao']));
				$responsavel_id = 0;

				$relatorio = json_encode([
					'Data' => $data2,
					'Nickname' => $atendente,
					'Sugestao' => $sugestao
				]);
				$r->addRelatorio($tipo, $data, $atendente_id, $responsavel_id, $relatorio, $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
			} elseif (
				($tipo == 7 && $this->acesso->getInfo('patente') <= 12)
				&& isset($_POST['data']) && !empty($_POST['data'])
				&& isset($_POST['atendente']) && !empty($_POST['atendente'])
				&& isset($_POST['contas']) && !empty($_POST['contas'])
				&& isset($_POST['tempo']) && !empty($_POST['tempo'])
				&& isset($_POST['responsavel']) && !empty($_POST['responsavel'])
			) {

				$data = (isset($_POST['data']) && !empty($_POST['data'])) ? addslashes($_POST['data']) : date('d/m/Y');
				$data2 = $data . ' ' . date('H:i:s');
				$ut = explode('/', $data);
				$u = $ut[2] . '-' . $ut[1] . '-' . $ut[0];
				$data = $u . ' ' . date('H:i:s');

				$atendente = addslashes($uteis->trocarItens($_POST['atendente']));
				$atendente_id = $re->getIdDe($atendente);

				$tempo = addslashes($uteis->trocarItens($_POST['tempo']));

				$responsavel = addslashes($uteis->trocarItens($_POST['responsavel']));
				$responsavel_id = 0;

				$contas = addslashes($uteis->trocarItens($_POST['contas']));

				$relatorio = json_encode([
					'Data' => $data2,
					'Nickname' => $atendente,
					'Contas' => $contas,
					'Tempo' => $tempo,
					'Responsavel' => $responsavel
				]);
				$r->addRelatorio($tipo, $data, $atendente_id, $responsavel_id, $relatorio, $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
			} elseif (
				$tipo == 9 && $this->acesso->isExterno(4, $this->acesso->getInfo('id_registro'))
				&& isset($_POST['data']) && !empty($_POST['data'])
				&& isset($_POST['atendente']) && !empty($_POST['atendente'])
				&& isset($_POST['ajudado']) && !empty($_POST['ajudado'])
				&& isset($_POST['como']) && !empty($_POST['como'])
			) {
				$data = (isset($_POST['data']) && !empty($_POST['data'])) ? addslashes($_POST['data']) : date('d/m/Y');
				$data2 = $data . ' ' . date('H:i:s');
				$ut = explode('/', $data);
				$u = $ut[2] . '-' . $ut[1] . '-' . $ut[0];
				$data = $u . ' ' . date('H:i:s');

				$atendente = addslashes($uteis->trocarItens($_POST['atendente']));
				$atendente_id = $re->getIdDe($atendente);

				$ajudado = addslashes($uteis->trocarItens($_POST['ajudado']));
				$como = addslashes($uteis->trocarItens($_POST['como']));
				$responsavel_id = 0;

				$relatorio = json_encode([
					'Data' => $data2,
					'Professor' => $atendente,
					'Membro' => $ajudado,
					'Tipo' => $como
				]);
				$r->addRelatorio(8, $data, $atendente_id, $responsavel_id, $relatorio, $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
			} elseif (
				$tipo == 10 && $this->acesso->isExterno(5, $this->acesso->getInfo('id_registro'))
				&& isset($_POST['data']) && !empty($_POST['data'])
				&& isset($_POST['atendente']) && !empty($_POST['atendente'])
				&& isset($_POST['nicksnames']) && !empty($_POST['nicksnames'])
				&& isset($_POST['premio']) && !empty($_POST['premio'])
			) {
				$data = (isset($_POST['data']) && !empty($_POST['data'])) ? addslashes($_POST['data']) : date('d/m/Y');
				$data2 = $data . ' ' . date('H:i:s');
				$ut = explode('/', $data);
				$u = $ut[2] . '-' . $ut[1] . '-' . $ut[0];
				$data = $u . ' ' . date('H:i:s');

				$atendente = addslashes($uteis->trocarItens($_POST['atendente']));
				$atendente_id = $re->getIdDe($atendente);

				$nicksnames = $_POST['nicksnames'];
				
				$evento_tipo = addslashes($uteis->trocarItens($_POST['evento_tipo']));
				$premio = intval($_POST['premio']);

				$responsavel_id = 0;

				foreach ($nicksnames as $nickname) {
					$registro_usuario = $re->getMembroByNickname($nickname);

					if(count($registro_usuario) > 0) {
						$re->addMoedas($registro_usuario['id'], $premio);
					}
				}

				$relatorio = json_encode([
					'Data' => $data,
					'Promotor' => $atendente,
					'Membro' => implode(', ', $nicksnames),
					'Tipo' => $evento_tipo,
					'Premio' => $premio
				]);
				$r->addRelatorio(10, $data, $atendente_id, $responsavel_id, $relatorio, $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
			} elseif (
				$tipo == 11 && $this->acesso->isExterno(6, $this->acesso->getInfo('id_registro'))
				&& isset($_POST['data']) && !empty($_POST['data'])
				&& isset($_POST['atendente']) && !empty($_POST['atendente'])
				&& isset($_POST['feedback']) && !empty($_POST['feedback'])
				&& isset($_POST['como']) && !empty($_POST['como'])
			) {
				$data = (isset($_POST['data']) && !empty($_POST['data'])) ? addslashes($_POST['data']) : date('d/m/Y');
				$data2 = $data . ' ' . date('H:i:s');
				$ut = explode('/', $data);
				$u = $ut[2] . '-' . $ut[1] . '-' . $ut[0];
				$data = $u . ' ' . date('H:i:s');

				$atendente = addslashes($uteis->trocarItens($_POST['atendente']));
				$atendente_id = $re->getIdDe($atendente);

				$ajudado = addslashes($uteis->trocarItens($_POST['feedback']));
				$como = addslashes($uteis->trocarItens($_POST['como']));
				$responsavel_id = 0;

				$relatorio = json_encode([
					'Data' => $data2,
					'Professor' => $atendente,
					'Membro' => $ajudado,
					'Tipo' => $como
				]);
				$r->addRelatorio(11, $data, $atendente_id, $responsavel_id, $relatorio, $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
			} else {

				$_SESSION['relatorio'] = 'Tivemos uma falha ao tenta envia o seu relatório!';
				$_SESSION['relatorio_tipo'] = 'danger';
			}
		} else {
			$_SESSION['relatorio'] = 'Tivemos uma falha ao tenta envia o seu relatório!';
			$_SESSION['relatorio_tipo'] = 'danger';
		}

		header("Location: " . BASE . "relatorios/criar");
		exit;
	}

	public function updateStatus($status, $id)
	{
		$r = new Relatorios();
		$relatorio = $r->getRelatorio($id);


		if ($this->acesso->getInfo('patente') <= 10 && in_array($status, [1, 2]) && count($relatorio) > 0 && $relatorio['status'] == 0) {
			$r->updateRelatorio($status, $id, $this->acesso->getInfo('nickname'));

			if ($status == 1) {
				$re = new Registros();
				$re->addMoedas($relatorio['id_registro'], 1);
			}
		}

		header("Location: " . BASE . "relatorios/todos");
		exit;
	}
}
