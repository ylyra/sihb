<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Noticias;
use \Models\Registros;
use \Models\Uteis;
use \Models\Loja;
use \Models\Relatorios;
use \Models\MAmigos;
use \Models\Forum;

class PerfilController extends Controller
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
		$this->loadView('noticias/404', $this->arrayInfo);
	}

	/*
		Configuração de Configurações do Perfil do site
	*/
	public function configuracoes()
	{
		if ($this->acesso->isLogged()) {
			$this->arrayInfo['page_active'] = 'perfil';
			$this->arrayInfo['pageName'] = 'Perfil';

			/* Fara com que a página seja carregada */
			$this->loadTemplate('perfil/configuracoes_geral', $this->arrayInfo);
		} else {
			header("Location: " . BASE);
			exit;
		}
	}

	/*
		Configuração de Configurações do Fórum do site
	*/
	public function configuracoes_forum()
	{

		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') == 1) {
			$this->arrayInfo['page_active'] = 'perfil';
			$this->arrayInfo['pageName'] = 'Configurações do Fórum';

			/* Fara com que a página seja carregada */
			$this->loadTemplate('perfil/configuracoes_forum', $this->arrayInfo);
		} else {
			$l = new \Models\Logs();
			
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			
			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
			
            header("Location: " . BASE);
            exit;
        }
	}

	/*
		Configuração de Configurações do Perfil do site
	*/
	public function configuracoes_perfil()
	{
		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') == 1) {
			$this->arrayInfo['page_active'] = 'perfil';
			$this->arrayInfo['pageName'] = 'Configurações do Perfil';

			/* Fara com que a página seja carregada */
			$this->loadTemplate('perfil/configuracoes_perfil', $this->arrayInfo);
		} else {
			$l = new \Models\Logs();
			
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			
			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
			
            header("Location: " . BASE);
            exit;
        }
	}

	/*
		Configuração de Ver Perfil do membro no site
	*/
	public function ver($nickname)
	{
		$r = new Registros();
		$u = new Uteis();
		$l = new Loja();
		$rel = new Relatorios();
		$m = new MAmigos();

		$this->arrayInfo['page_active'] = 'perfil';
		$this->arrayInfo['pageName'] = "Perfil $nickname";
		$this->arrayInfo['usuario'] = $r->getMembroByNickname($nickname);
		$this->arrayInfo['uteis'] = $u;
		$this->arrayInfo['loja'] = $l;

		if (count($this->arrayInfo['usuario']) > 0) {
			$this->arrayInfo['favoritos'] = $r->getFavoritosUser($this->arrayInfo['usuario']['id']);
			$this->arrayInfo['favoritei'] = $r->getFavoriteiUser($this->arrayInfo['usuario']['id'], $this->acesso->getInfo('id_registro'));

			$this->arrayInfo['mensagens'] = $r->getMensagensPerfil($this->arrayInfo['usuario']['id']);
			$this->arrayInfo['mensagensTotal'] = $r->getMensagensPerfilTotal($this->arrayInfo['usuario']['id']);

			$this->arrayInfo['treinos'] = $rel->getTotalDe($this->arrayInfo['usuario']['id'], 1);
			$this->arrayInfo['treinos_mes'] = $rel->getTotalDeMes($this->arrayInfo['usuario']['id'], 1, 1);
			$this->arrayInfo['treinos_mes_passado'] = $rel->getTotalDeMes($this->arrayInfo['usuario']['id'], 1, 2);

			$this->arrayInfo['des'] = $rel->getTotalDe($this->arrayInfo['usuario']['id'], 1);
			$this->arrayInfo['atendimentos'] = $rel->getTotalDe($this->arrayInfo['usuario']['id'], 1);
			$this->arrayInfo['helpers'] = $rel->getTotalDe($this->arrayInfo['usuario']['id'], 1);
			$this->arrayInfo['supervisores'] = $rel->getTotalDe($this->arrayInfo['usuario']['id'], 1);
			$this->arrayInfo['executivos'] = 0;

			$this->arrayInfo['helpers'] = $rel->getTotalDe($this->arrayInfo['usuario']['id'], 4);
			$this->arrayInfo['helpers_mes'] = $rel->getTotalDeMes($this->arrayInfo['usuario']['id'], 4, 1);
			$this->arrayInfo['helpers_mes_passado'] = $rel->getTotalDeMes($this->arrayInfo['usuario']['id'], 4, 2);
			$this->arrayInfo['amigos'] = $m->getAmigosDe($this->arrayInfo['usuario']['id']);


			/* Fara com que a página seja carregada */
			$this->loadView('perfil/ver', $this->arrayInfo);
		} else {
			$this->loadView('404', $this->arrayInfo);
		}
	}

	/*
		Confirmação de conta obrigatoria do registro
	*/
	public function confirmar_conta()
	{
		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') != 1) {
			$this->arrayInfo['page_active'] = 'perfil';
			$this->arrayInfo['pageName'] = 'Confirmar Conta';

			/* Fara com que a página seja carregada */
			$this->loadTemplate('perfil/confirmar_conta', $this->arrayInfo);
		} else {
			$l = new \Models\Logs();
			
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			
			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
			
            header("Location: " . BASE);
            exit;
        }
	}

	public function alterar_nome()
	{
		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') == 1) {
			$r = new Registros();
			$this->arrayInfo['page_active'] = 'perfil';
			$this->arrayInfo['pageName'] = 'Alterar Nome';

			$this->arrayInfo['registro'] = $r->getMembroByID($this->acesso->getInfo('id_registro'));

			/* Fara com que a página seja carregada */
			$this->loadTemplate('perfil/alterar_nome', $this->arrayInfo);
		} else {
			$l = new \Models\Logs();
			
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			
			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
			
            header("Location: " . BASE);
            exit;
        }
	}

	public function alterar_email()
	{
		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') == 1) {
			$r = new Registros();
			$this->arrayInfo['page_active'] = 'perfil';
			$this->arrayInfo['pageName'] = 'Alterar E-mail';

			$this->arrayInfo['registro'] = $r->getMembroByID($this->acesso->getInfo('id_registro'));

			/* Fara com que a página seja carregada */
			$this->loadTemplate('perfil/alterar_email', $this->arrayInfo);
		} else {
			$l = new \Models\Logs();
			
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			
			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
			
            header("Location: " . BASE);
            exit;
        }
	}

	public function alterar_senha()
	{
		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') == 1) {
			$r = new Registros();
			$this->arrayInfo['page_active'] = 'perfil';
			$this->arrayInfo['pageName'] = 'Alterar Senha';

			$this->arrayInfo['registro'] = $r->getMembroByID($this->acesso->getInfo('id_registro'));

			/* Fara com que a página seja carregada */
			$this->loadTemplate('perfil/alterar_senha', $this->arrayInfo);
		} else {
			$l = new \Models\Logs();
			
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			
			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
			
            header("Location: " . BASE);
            exit;
        }
	}

	public function alterar_avatar()
	{
		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') == 1) {
			$r = new Registros();
			$this->arrayInfo['page_active'] = 'perfil';
			$this->arrayInfo['pageName'] = 'Alterar Avatar';

			$this->arrayInfo['registro'] = $r->getMembroByID($this->acesso->getInfo('id_registro'));

			/* Fara com que a página seja carregada */
			$this->loadTemplate('perfil/alterar_avatar', $this->arrayInfo);
		} else {
			$l = new \Models\Logs();
			
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			
			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
			
            header("Location: " . BASE);
            exit;
        }
	}

	public function meus_topicos()
	{
		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') == 1) {
			$f = new Forum();
			$this->arrayInfo['page_active'] = 'perfil';
			$this->arrayInfo['pageName'] = 'Meus Tópicos';
			$this->arrayInfo['meus_topicos'] = $f->getTopicosByAutorId($this->acesso->getInfo('id_registro'));

			/* Fara com que a página seja carregada */
			$this->loadTemplate('perfil/meus_topicos', $this->arrayInfo);
		} else {
			$l = new \Models\Logs();
			
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			
			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
			
            header("Location: " . BASE);
            exit;
        }
	}

	public function editar_descricao()
	{
		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') == 1 && $this->acesso->getInfo('vip') == 1) {
			$r = new Registros();
			$this->arrayInfo['page_active'] = 'perfil';
			$this->arrayInfo['pageName'] = 'Editar Descrição';

			$this->arrayInfo['registro'] = $r->getMembroByID($this->acesso->getInfo('id_registro'));

			/* Fara com que a página seja carregada */
			$this->loadTemplate('perfil/editar_descricao', $this->arrayInfo);
		} else {
			$l = new \Models\Logs();
			
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			
			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
			
            header("Location: " . BASE);
            exit;
        }
	}

	public function gerar_moedas()
	{
		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') == 1) {
			$r = new Registros();
			$this->arrayInfo['page_active'] = 'perfil';
			$this->arrayInfo['pageName'] = 'Gerar moedas';

			$this->arrayInfo['registro'] = $r->getMembroByID($this->acesso->getInfo('id_registro'));

			/* Fara com que a página seja carregada */
			$this->loadTemplate('perfil/gerar_moedas', $this->arrayInfo);
		} else {
			$l = new \Models\Logs();
			
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			
			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
			
            header("Location: " . BASE);
            exit;
        }
	}

	public function alterar_foto()
	{
		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') == 1) {
			$r = new Registros();
			$this->arrayInfo['page_active'] = 'perfil';
			$this->arrayInfo['pageName'] = 'Alterar foto';

			$this->arrayInfo['registro'] = $r->getMembroByID($this->acesso->getInfo('id_registro'));

			/* Fara com que a página seja carregada */
			$this->loadTemplate('perfil/alterar_foto', $this->arrayInfo);
		} else {
			$l = new \Models\Logs();
			
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			
			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
			
            header("Location: " . BASE);
            exit;
        }
	}

	public function alterar_amigos()
	{
		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') == 1 && $this->acesso->getInfo('vip') == 1) {
			$r = new Registros();
			$m = new MAmigos();

			$this->arrayInfo['page_active'] = 'perfil';
			$this->arrayInfo['pageName'] = 'Alterar amigos';

			$this->arrayInfo['amigos'] = $m->getAmigosDe($this->acesso->getInfo('id_registro'));
			$this->arrayInfo['registro'] = $r->getMembroByID($this->acesso->getInfo('id_registro'));

			/* Fara com que a página seja carregada */
			$this->loadTemplate('perfil/alterar_amigos', $this->arrayInfo);
		} else {
			$l = new \Models\Logs();
			
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			
			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
			
            header("Location: " . BASE);
            exit;
        }
	}

	public function remover_mensagens()
	{
		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') == 1) {
			$r = new Registros();

			$this->arrayInfo['page_active'] = 'perfil';
			$this->arrayInfo['pageName'] = 'Remover mensagens';

			$this->arrayInfo['mensagens'] = $r->getMensagensPerfil2($this->acesso->getInfo('id_registro'));

			/* Fara com que a página seja carregada */
			$this->loadTemplate('perfil/remover_mensagens', $this->arrayInfo);
		} else {
			$l = new \Models\Logs();
			
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			
			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
			
            header("Location: " . BASE);
            exit;
        }
	}

	public function deletarMensagem($id_msg)
	{
		$r = new Registros();
		$msg = $r->getMensagemPerfil($id_msg);
		$_SESSION['aviso_registro'] = 'Tivemos um problema ao tentar apagar esta mensagem. Tente novamente mais tarde!';
		if (
			$this->acesso->isLogged() &&
			$this->acesso->getInfo('confirmado') == 1 &&
			is_numeric($id_msg) &&
			count($msg) > 0 &&
			$msg['id_registro_perfil'] == $this->acesso->getInfo('id_registro')
		) {
			$_SESSION['aviso_registro'] = 'Mensagem apagada com sucesso!';
			$r->deleteMensagem($msg['id'], $this->acesso->getInfo('nickname'));
		}

		if($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') != 1) {
			$l = new \Models\Logs();
			
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			
			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
        }

		header("Location: " . BASE. "perfil/remover-mensagens");
		exit;
	}

	public function alterar_nascimento()
	{
		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') == 1) {
			$r = new Registros();

			$this->arrayInfo['page_active'] = 'perfil';
			$this->arrayInfo['pageName'] = 'Alterar Nascimento';

			$this->arrayInfo['registro'] = $r->getMembroByID($this->acesso->getInfo('id_registro'));

			/* Fara com que a página seja carregada */
			$this->loadTemplate('perfil/alterar_nascimento', $this->arrayInfo);
		} else {
			$l = new \Models\Logs();
			
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			
			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
			
            header("Location: " . BASE);
            exit;
        }
	}

	public function sair()
	{
		if ($this->acesso->isLogged()) {
			unset($_SESSION['sihb_login']);
		}
		header("Location: " . BASE);
	}
}
