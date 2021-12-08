<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Noticias;
use \Models\Forum;
use \Models\Uteis;
use \Models\Bugs;
use Models\Registros;
use Models\Loja;
use Models\MAmigos;

class FormController extends Controller
{

	private $user;
	private $arrayInfo;

	public function __construct()
	{
		parent::__construct();
	}

	/*
		Configuração da Página Inicial do site
	*/
	public function index()
	{
		/* Fara com que a página seja carregada */
		$this->loadView('404', $this->arrayInfo);
	}

	/*
		Configuração de Ouvidoria do site
	*/
	public function enviarComentario()
	{
		$acesso = new Acesso();
		$u = new Uteis();
		$n = new Noticias();
		$pag = '';
		if (isset($_POST['comentar']) && !empty($_POST['comentar']) && is_numeric($_POST['noticia_id']) && $acesso->isLogged() && $acesso->getInfo('confirmado') == 1) {
			$msg = addslashes($u->trocarItens($_POST['comentar']));
			$id = intval($_POST['noticia_id']);
			$slug = addslashes($_POST['noticia_slug']);
			$n->addComentario($msg, $id, $acesso->getInfo('id_registro'), $acesso->getInfo('nickname'), date('Y-m-d H:i:s'));
			$pag = "noticias/abrir/$id/$slug";
		}

		header("Location: " . BASE . $pag);
		exit;
	}

	/*
		Configuração de Ouvidoria do site
	*/
	public function comentarTopico()
	{
		$acesso = new Acesso();
		$u = new Uteis();
		$f = new Forum();
		$pag = '';
		if (
			isset($_POST['envie_msg'])
			&& !empty($_POST['envie_msg'])
			&& is_numeric($_POST['id_topico'])
			&& $acesso->isLogged()
			&& $acesso->getInfo('confirmado') == 1
		) {

			$msg = addslashes($u->trocarItens($_POST['envie_msg']));
			$id = intval($_POST['id_topico']);
			$slug = addslashes($_POST['slug_topico']);

			$f->addComentario($msg, $id, $acesso->getInfo('id_registro'), $acesso->getInfo('nickname'), date('Y-m-d H:i:s'), $acesso->getInfo('nickname'));
			$pag = "forum/abrir/$id/$slug";
		}

		header("Location: " . BASE . $pag);
		exit;
	}

	public function favoritarPerfil($tipo, $id_registro)
	{
		$acesso = new Acesso();
		$r = new Registros();

		$pag = '';
		$_SESSION['aviso_registro'] = 'Tivemos um problema ao tentar favoritar o usuário. Tente novamente mais tarde!';

		if (
			is_numeric($tipo)
			&& is_numeric($id_registro)
			&& $acesso->isLogged()
			&& $acesso->getInfo('confirmado') == 1
		) {
			$registro = $r->getMembroByID($id_registro);

			if (count($registro) > 0) {
				$pag = 'profile/' . $registro['nickname'];

				$_SESSION['aviso_registro'] = $r->favoritarPerfil($tipo, $id_registro, $acesso->getInfo('id_registro'), $acesso->getInfo('nickname'));
			}
		}

		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') != 1) {
			$l = new \Models\Logs();

			$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);

			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
		}

		header("Location: " . BASE . $pag);
		exit;
	}

	/*
		Configuração de Ouvidoria do site
	*/
	public function bug_ranking()
	{
		$u = new Uteis();
		$b = new Bugs();
		$pag = 'melhores-da-semana';
		$_SESSION['aviso_registro'] = 'Tivemos um problema ao tentar reportar o seu bug. Tente novamente mais tarde!';
		if (
			isset($_POST['nickname'])
			&& !empty($_POST['nickname'])
			&&  isset($_POST['tipo'])
			&& !empty($_POST['tipo'])
			&&  isset($_POST['qt'])
			&& !empty($_POST['qt'])
			&&  isset($_FILES['prova'])
			&& !empty($_FILES['prova'])
		) {

			$nickname = addslashes($u->trocarItens($_POST['nickname']));
			$tipo = addslashes($u->trocarItens($_POST['tipo']));
			$qt = addslashes($u->trocarItens($_POST['qt']));

			$foto = $_FILES['prova'];

			$permitidos = array('image/jpeg', 'image/jpg', 'image/png');

			if (in_array($foto['type'], $permitidos)) {

				$foto_nome = 'screenshot_' . uniqid() . '.jpg';
				move_uploaded_file($foto['tmp_name'], 'assets/media/reportedbug/' . $foto_nome);

				list($width_orig, $height_orig) = getimagesize('assets/media/reportedbug/' . $foto_nome);
				$ratio = $width_orig / $height_orig;

				$width = $width_orig;
				$height = $height_orig;

				if ($width / $height > $ratio) {
					$width = $height * $ratio;
				} else {
					$height = $width / $ratio;
				}

				$img = imagecreatetruecolor($width, $height);
				if ($foto['type'] == 'image/jpeg') {
					$origi = imagecreatefromjpeg('assets/media/reportedbug/' . $foto_nome);
				} elseif ($foto['type'] == 'image/png') {
					$origi = imagecreatefrompng('assets/media/reportedbug/' . $foto_nome);
				}

				// get the color white
				$color = imagecolorallocate($img, 255, 255, 255);

				// fill entire image
				imagefill($img, 0, 0, $color);

				imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

				imagejpeg($img, 'assets/media/reportedbug/' . $foto_nome, 80);

				$msg = "<strong>Nickname: </strong> $nickname <br/>";
				$msg .= "<strong>Tipo: </strong> $tipo <br/>";
				$msg .= "<strong>Quantidade certa: </strong> $qt <br/>";
				$msg .= "<strong>Prova: </strong> <a href='" . BASE . "assets/media/reportedbug/" . $foto_nome . "'>Prova</a> <br/>";

				$b->addBug('melhores-da-semana', $msg);
				$_SESSION['aviso_registro'] = 'Bug reportado com sucesso!';
			}
			$pag = "melhores-da-semana";
		}

		header("Location: " . BASE . $pag);
		exit;
	}

	public function trocarFotoPerfil()
	{
		$r = new Registros();
		$acesso = new Acesso();

		$pag = '';
		$_SESSION['aviso_registro'] = 'Tivemos um problema ao tentar trocar a foto. Tente novamente mais tarde!';
		if (
			isset($_FILES['foto'])
			&& !empty($_FILES['foto'])
			&& $acesso->isLogged()
			&& $acesso->getInfo('confirmado') == 1
		) {
			$foto = $_FILES['foto'];
			$registro = $r->getMembroByID($acesso->getInfo('id_registro'));

			$permitidos = array('image/jpeg', 'image/jpg', 'image/png');

			if (in_array($foto['type'], $permitidos)) {

				$foto_nome = 'foto_' . uniqid() . '.jpg';
				move_uploaded_file($foto['tmp_name'], 'assets/media/pic_profile/' . $foto_nome);

				list($width_orig, $height_orig) = getimagesize('assets/media/pic_profile/' . $foto_nome);
				$ratio = $width_orig / $height_orig;

				$width = 160;
				$height = 160;

				if ($width / $height > $ratio) {
					$width = $height * $ratio;
				} else {
					$height = $width / $ratio;
				}

				$img = imagecreatetruecolor($width, $height);
				if ($foto['type'] == 'image/jpeg') {
					$origi = imagecreatefromjpeg('assets/media/pic_profile/' . $foto_nome);
				} elseif ($foto['type'] == 'image/png') {
					$origi = imagecreatefrompng('assets/media/pic_profile/' . $foto_nome);
				}

				// get the color white
				$color = imagecolorallocate($img, 255, 255, 255);

				// fill entire image
				imagefill($img, 0, 0, $color);

				imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

				imagejpeg($img, 'assets/media/pic_profile/' . $foto_nome, 80);

				$url_final = BASE . "assets/media/pic_profile/" . $foto_nome;

				$r->updateFoto($url_final, $acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));

				if ($registro['avatar'] != 'https://i.imgur.com/38HBHH9.png') {
					$avatar_anterior = $registro['avatar'];
					$av = BASE . "assets/media/pic_profile/";
					$avatar_anterior = str_replace($av, '', $avatar_anterior);

					$filename = __DIR__ . "\\..\assets\media\pic_profile\\" . $avatar_anterior;
					if (file_exists($filename)) {
						unlink($filename);
						echo 'File ' . $filename . ' has been deleted';
					} else {
						echo 'Could not delete ' . $filename . ', file does not exist';
					}
				}

				$_SESSION['aviso_registro'] = 'Foto atualizada com sucesso!';
			}
			$pag = "profile/" . $registro['nickname'];
		}

		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') != 1) {
			$l = new \Models\Logs();

			$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);

			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
		}

		header("Location: " . BASE . $pag);
		exit;
	}

	public function confirmarConta()
	{
		$u = new Uteis();
		$acesso = new Acesso();

		$pag = 'perfil/configuracoes';
		$_SESSION['aviso_registro'] = 'Tivemos um problema ao tentar confirmar sua conta. Tente novamente mais tarde!';
		if (
			isset($_POST['codigo'])
			&& !empty($_POST['codigo'])
			&& $acesso->isLogged()
			&& $acesso->getInfo('confirmado') != 1
		) {
			$codigo = $_POST['codigo'];
			$missao = $u->getMotto($acesso->getInfo('nickname'));

			if ($codigo == $missao) {
				$acesso->acessoConfirmarConta($acesso->getInfo('id'));

				$_SESSION['aviso_registro'] = 'Conta confirmada com sucesso!';
			}
		}


		header("Location: " . BASE . $pag);
		exit;
	}

	public function alterarNome()
	{
		$u = new Uteis();
		$r = new Registros();
		$acesso = new Acesso();

		$pag = 'perfil/configuracoes';
		$_SESSION['aviso_registro'] = 'Tivemos um problema ao tentar alterar seu nome. Tente novamente mais tarde!';
		if (
			isset($_POST['nome'])
			&& $acesso->isLogged()
			&& $acesso->getInfo('confirmado') == 1
		) {
			$nome = $u->trocarItens($_POST['nome']);
			$r->updateNome($nome, $acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
			$_SESSION['aviso_registro'] = 'Nome alterado com sucesso!';
		}

		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') != 1) {
			$l = new \Models\Logs();

			$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);

			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
		}

		header("Location: " . BASE . $pag);
		exit;
	}

	public function alterarEmail()
	{
		$u = new Uteis();
		$r = new Registros();
		$acesso = new Acesso();

		$pag = 'perfil/configuracoes';
		$_SESSION['aviso_registro'] = 'Tivemos um problema ao tentar alterar seu e-mail. Tente novamente mais tarde!';
		if (
			isset($_POST['email'])
			&& $acesso->isLogged()
			&& $acesso->getInfo('confirmado') == 1
		) {
			$email = $u->trocarItens($_POST['email']);
			$r->updateEmail($email, $acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
			$_SESSION['aviso_registro'] = 'E-mail alterado com sucesso!';
		}

		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') != 1) {
			$l = new \Models\Logs();

			$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);

			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
		}

		header("Location: " . BASE . $pag);
		exit;
	}

	public function alterarSenha()
	{
		$u = new Uteis();
		$acesso = new Acesso();

		$pag = 'perfil/configuracoes';
		$_SESSION['aviso_registro'] = 'Tivemos um problema ao tentar alterar sua senha. Tente novamente mais tarde!';
		if (
			isset($_POST['senha1'])
			&& !empty($_POST['senha1'])
			&& isset($_POST['senha2'])
			&& !empty($_POST['senha2'])
			&& $acesso->isLogged()
			&& $acesso->getInfo('confirmado') == 1
		) {
			$senha1 = $u->encripta($_POST['senha1']);
			$senha2 = $u->encripta($_POST['senha2']);

			if ($senha1 == $senha2) {
				$acesso->updateSenha($senha1, $acesso->getInfo('id'), $this->acesso->getInfo('nickname'));
				$_SESSION['aviso_registro'] = 'Senha alterada com sucesso!';
			}
		}

		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') != 1) {
			$l = new \Models\Logs();

			$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);

			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
		}

		header("Location: " . BASE . $pag);
		exit;
	}

	public function alterarAvatarForum()
	{
		$r = new Registros();
		$acesso = new Acesso();

		$pag = 'perfil/configuracoes-forum';
		$_SESSION['aviso_registro'] = 'Tivemos um problema ao tentar trocar a foto. Tente novamente mais tarde!';
		if (
			isset($_FILES['avatar'])
			&& !empty($_FILES['avatar'])
			&& $acesso->isLogged()
			&& $acesso->getInfo('confirmado') == 1
		) {
			$foto = $_FILES['avatar'];
			$registro = $r->getMembroByID($acesso->getInfo('id_registro'));

			$permitidos = array('image/jpeg', 'image/jpg', 'image/png');

			if (in_array($foto['type'], $permitidos)) {

				$foto_nome = 'foto_' . uniqid() . '.jpg';
				move_uploaded_file($foto['tmp_name'], 'assets/media/pic_forum/' . $foto_nome);

				list($width_orig, $height_orig) = getimagesize('assets/media/pic_forum/' . $foto_nome);
				$ratio = $width_orig / $height_orig;

				$width = 200;
				$height = 200;

				$img = imagecreatetruecolor($width, $height);
				if ($foto['type'] == 'image/jpeg') {
					$origi = imagecreatefromjpeg('assets/media/pic_forum/' . $foto_nome);
				} elseif ($foto['type'] == 'image/png') {
					$origi = imagecreatefrompng('assets/media/pic_forum/' . $foto_nome);
				}

				// get the color white
				$color = imagecolorallocate($img, 255, 255, 255);

				// fill entire image
				imagefill($img, 0, 0, $color);

				imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

				imagejpeg($img, 'assets/media/pic_forum/' . $foto_nome, 80);

				$url_final = BASE . "assets/media/pic_forum/" . $foto_nome;

				$r->updateFotoForum($url_final, $acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));

				if ($registro['avatar_forum'] != 'https://i.imgur.com/CT7O3o0.png') {
					$avatar_anterior = $registro['avatar'];
					$av = BASE . "assets/media/pic_forum/";
					$avatar_anterior = str_replace($av, '', $avatar_anterior);

					$filename = __DIR__ . "\\..\assets\media\pic_forum\\" . $avatar_anterior;
					if (file_exists($filename)) {
						unlink($filename);
						echo 'File ' . $filename . ' has been deleted';
					} else {
						echo 'Could not delete ' . $filename . ', file does not exist';
					}
				}

				$_SESSION['aviso_registro'] = 'Foto atualizada com sucesso!';
			}
		}

		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') != 1) {
			$l = new \Models\Logs();

			$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);

			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
		}

		header("Location: " . BASE . $pag);
		exit;
	}

	public function alterarDescricaoForum()
	{
		$r = new Registros();
		$acesso = new Acesso();

		$pag = 'perfil/configuracoes-forum';
		$_SESSION['aviso_registro'] = 'Tivemos um problema ao tentar alterar sua descrição. Tente novamente mais tarde!';
		if (
			isset($_POST['texto'])
			&& !empty($_POST['texto'])

			&& $acesso->isLogged()
			&& $acesso->getInfo('confirmado') == 1
			&& $acesso->getInfo('vip') == 1
		) {
			$texto = $_POST['texto'];

			$r->updateDescricaoForum($texto, $acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
			$_SESSION['aviso_registro'] = 'Descrição alterada com sucesso!';
		}

		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') != 1) {
			$l = new \Models\Logs();

			$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);

			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
		}

		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') == 1 && $acesso->getInfo('vip') != 1) {
			$l = new \Models\Logs();

			$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);

			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
		}

		header("Location: " . BASE . $pag);
		exit;
	}

	public function gerarMoedas()
	{
		$r = new Registros();
		$acesso = new Acesso();
		$u = new Uteis();
		$l = new Loja();

		$usei_codigo_moedas = false;

		$pag = 'perfil/configuracoes';
		$_SESSION['aviso_registro'] = 'Tivemos um problema ao tentar validar o código. Tente outro código!';

		if (
			isset($_POST['gerar_moedas'])
			&& !empty($_POST['gerar_moedas'])

			&& $acesso->isLogged()
			&& $acesso->getInfo('confirmado') == 1
		) {
			$codigo_moeda = addslashes($u->trocarItens($_POST['gerar_moedas']));

			$cod_verificacao = $l->verificarCodigo($codigo_moeda);
			$data = date('Y-m-d H:i:s');

			// Verificar se o código tem limite e se a data de expiração é maior que a atual
			if ($cod_verificacao['limite'] >= 1 && $cod_verificacao['expiracao'] >= $data && !$l->useiCodigo($cod_verificacao['id'], $acesso->getInfo('id_registro'), $cod_verificacao['codigo'])) {

				$l->updateCodigo($cod_verificacao['id']);
				$r->addMoedas($acesso->getInfo('id_registro'), $cod_verificacao['valor']);
				$l->addUseiCodigo($cod_verificacao['id'], $acesso->getInfo('id_registro'), $cod_verificacao['codigo'], $cod_verificacao['valor']);
				$_SESSION['aviso_registro'] = 'Código de moedas validado com sucesso!';
				$usei_codigo_moedas = true;
			}

			// Verificar se o código é ilimitado e se a data de expiração é maior que a atual
			elseif ($cod_verificacao['limite'] == -1 && $cod_verificacao['is_limited'] == 1 && $cod_verificacao['expiracao'] >= $data && !$l->useiCodigo($cod_verificacao['id'], $acesso->getInfo('id_registro'), $cod_verificacao['codigo'])) {

				$r->addMoedas($acesso->getInfo('id_registro'), $cod_verificacao['valor']);
				$l->addUseiCodigo($cod_verificacao['id'], $acesso->getInfo('id_registro'), $cod_verificacao['codigo'], $cod_verificacao['valor']);
				$_SESSION['aviso_registro'] = 'Código de moedas validado com sucesso!';
				$usei_codigo_moedas = true;
			}

			// Verificar se o código é ilimitado e se a data de expiração é nula			
			elseif ($cod_verificacao['limite'] == -1 && $cod_verificacao['is_limited'] == 1 && $cod_verificacao['expiracao'] == '0000-00-00 00:00:00' && !$l->useiCodigo($cod_verificacao['id'], $acesso->getInfo('id_registro'), $cod_verificacao['codigo'])) {

				$r->addMoedas($acesso->getInfo('id_registro'), $cod_verificacao['valor']);
				$l->addUseiCodigo($cod_verificacao['id'], $acesso->getInfo('id_registro'), $cod_verificacao['codigo'], $cod_verificacao['valor']);
				$_SESSION['aviso_registro'] = 'Código de moedas validado com sucesso!';
				$usei_codigo_moedas = true;
			}

			// Verificar se o código é limitado e se a data de expiração é nula			
			elseif ($cod_verificacao['limite'] >= 1 && $cod_verificacao['is_limited'] == 0 && $cod_verificacao['expiracao'] == '0000-00-00 00:00:00' && !$l->useiCodigo($cod_verificacao['id'], $acesso->getInfo('id_registro'), $cod_verificacao['codigo'])) {

				$l->updateCodigo($cod_verificacao['id']);
				$r->addMoedas($acesso->getInfo('id_registro'), $cod_verificacao['valor']);
				$l->addUseiCodigo($cod_verificacao['id'], $acesso->getInfo('id_registro'), $cod_verificacao['codigo'], $cod_verificacao['valor']);
				$_SESSION['aviso_registro'] = 'Código de moedas validado com sucesso!';
				$usei_codigo_moedas = true;
			}

			// Verifica se o usuário já usou o código
			elseif ($l->useiCodigo($cod_verificacao['id'], $acesso->getInfo('id_registro'), $cod_verificacao['codigo'])) {
				$_SESSION['aviso_registro'] = 'Você já utilizou este código!';
			}

			// Verifica se o código já venceu
			elseif ($cod_verificacao['expiracao'] != '0000-00-00 00:00:00' && $cod_verificacao['expiracao'] >= $data) {
				$_SESSION['aviso_registro'] = 'Este código já venceu!';
			}

			// Verifica se o código é limitado e se já foram usados todos os códigos
			elseif ($cod_verificacao['is_limited'] == 0 && $cod_verificacao['limite'] == 0) {
				$_SESSION['aviso_registro'] = 'Este código já acabou!';
			}
		}

		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') != 1) {
			$l = new \Models\Logs();

			$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);

			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
		}

		if ($usei_codigo_moedas) {
			$l = new \Models\Logs();
			$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " utilizou o código de moedas '".$cod_verificacao['codigo']."'.";
			$l->addLog('codigo_moedas', $msg);
		}

		header("Location: " . BASE . $pag);
		exit;
	}

	public function alterarAvatarPerfil()
	{
		$r = new Registros();
		$acesso = new Acesso();

		$pag = 'perfil/configuracoes-perfil';
		$_SESSION['aviso_registro'] = 'Tivemos um problema ao tentar trocar a foto. Tente novamente mais tarde!';
		if (
			isset($_FILES['avatar'])
			&& !empty($_FILES['avatar'])
			&& $acesso->isLogged()
			&& $acesso->getInfo('confirmado') == 1
		) {
			$registro = $r->getMembroByID($acesso->getInfo('id_registro'));

			$foto = $_FILES['avatar'];

			$permitidos = array('image/jpeg', 'image/jpg', 'image/png');

			if (in_array($foto['type'], $permitidos)) {

				$foto_nome = 'foto_' . uniqid() . '.jpg';
				move_uploaded_file($foto['tmp_name'], 'assets/media/pic_profile/' . $foto_nome);

				list($width_orig, $height_orig) = getimagesize('assets/media/pic_profile/' . $foto_nome);
				$ratio = $width_orig / $height_orig;

				$width = 160;
				$height = 160;

				if ($width / $height > $ratio) {
					$width = $height * $ratio;
				} else {
					$height = $width / $ratio;
				}

				$img = imagecreatetruecolor($width, $height);
				if ($foto['type'] == 'image/jpeg') {
					$origi = imagecreatefromjpeg('assets/media/pic_profile/' . $foto_nome);
				} elseif ($foto['type'] == 'image/png') {
					$origi = imagecreatefrompng('assets/media/pic_profile/' . $foto_nome);
				}

				// get the color white
				$color = imagecolorallocate($img, 255, 255, 255);

				// fill entire image
				imagefill($img, 0, 0, $color);

				imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

				imagejpeg($img, 'assets/media/pic_profile/' . $foto_nome, 80);

				$url_final = BASE . "assets/media/pic_profile/" . $foto_nome;

				if ($registro['avatar'] != 'https://i.imgur.com/38HBHH9.png') {
					$avatar_anterior = $registro['avatar'];
					$av = BASE . "assets/media/pic_profile/";
					$avatar_anterior = str_replace($av, '', $avatar_anterior);

					$filename = __DIR__ . "\\..\assets\media\pic_profile\\" . $avatar_anterior;
					if (file_exists($filename)) {
						unlink($filename);
						echo 'File ' . $filename . ' has been deleted';
					} else {
						echo 'Could not delete ' . $filename . ', file does not exist';
					}
				}

				$r->updateFoto($url_final, $acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
				$_SESSION['aviso_registro'] = 'Foto atualizada com sucesso!';
			}
		}

		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') != 1) {
			$l = new \Models\Logs();

			$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);

			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
		}

		header("Location: " . BASE . $pag);
		exit;
	}

	public function removerFotoPerfil()
	{
		$r = new Registros();
		$acesso = new Acesso();

		$pag = 'perfil/configuracoes-perfil';
		$_SESSION['aviso_registro'] = 'Tivemos um problema ao tentar trocar a foto. Tente novamente mais tarde!';
		if (
			$acesso->isLogged()
			&& $acesso->getInfo('confirmado') == 1
		) {
			$registro = $r->getMembroByID($acesso->getInfo('id_registro'));

			if ($registro['avatar'] != 'https://i.imgur.com/38HBHH9.png') {
				$avatar_anterior = $registro['avatar'];
				$av = BASE . "assets/media/pic_profile/";
				$avatar_anterior = str_replace($av, '', $avatar_anterior);

				$filename = __DIR__ . "\\..\assets\media\pic_profile\\" . $avatar_anterior;

				if (file_exists($filename)) {
					unlink($filename);
					echo 'File ' . $filename . ' has been deleted';
				} else {
					echo 'Could not delete ' . $filename . ', file does not exist';
				}

				$r->updateFoto('https://i.imgur.com/38HBHH9.png', $acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
			}


			$_SESSION['aviso_registro'] = 'Foto atualizada com sucesso!';
		}

		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') != 1) {
			$l = new \Models\Logs();

			$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);

			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
		}

		header("Location: " . BASE . $pag);
		exit;
	}

	public function alterarAmigos()
	{
		$r = new Registros();
		$acesso = new Acesso();
		$m = new MAmigos();
		$u = new Uteis();

		$pag = 'perfil/configuracoes-perfil';
		$_SESSION['aviso_registro'] = 'Tivemos um problema ao tentar alterar seus amigos. Tente novamente mais tarde!';
		if (
			$acesso->isLogged()
			&& $acesso->getInfo('confirmado') == 1
			&& $acesso->getInfo('vip') == 1
		) {
			$coracao = (!empty($_POST['coracao'])) ? $u->trocarItens($_POST['coracao']) : 'sihb';
			$coracao_id = $r->userExiste($coracao);
			$feliz = (!empty($_POST['feliz'])) ? $u->trocarItens($_POST['feliz']) : 'sihb';
			$feliz_id = $r->userExiste($feliz);
			$money = (!empty($_POST['money'])) ? $u->trocarItens($_POST['money']) : 'sihb';
			$money_id = $r->userExiste($money);

			$amigos = [
				0 => [
					'id_registro' => $coracao_id['id'],
					'tipo' => 1
				],
				1 => [
					'id_registro' => $feliz_id['id'],
					'tipo' => 2
				],
				2 => [
					'id_registro' => $money_id['id'],
					'tipo' => 3
				]
			];
			$m->updateAmigos($amigos, $acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
			$_SESSION['aviso_registro'] = 'Amigos alterada com sucesso!';
		}

		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') != 1) {
			$l = new \Models\Logs();

			$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);

			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
		}

		if ($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') == 1 && $this->acesso->getInfo('vip') != 1) {
			$l = new \Models\Logs();

			$msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);

			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
		}

		header("Location: " . BASE . $pag);
		exit;
	}

	public function alterarNascimento()
	{
		$r = new Registros();
		$acesso = new Acesso();
		$u = new Uteis();

		$pag = 'perfil/configuracoes-perfil';
		$_SESSION['aviso_registro'] = 'Tivemos um problema ao tentar alterar sua data de nascimento. Tente novamente mais tarde!';
		if (
			$acesso->isLogged()
			&& $acesso->getInfo('confirmado') == 1
		) {
			$nascimento = (!empty($_POST['data'])) ? $_POST['data'] : '';

			if (!empty($nascimento) && preg_match('/[0-9\/]/m', $nascimento)) {
				$n = explode('/', $nascimento);
				$nascimento = $n[2] . '-' . $n[1] . '-' . $n[0];
				$nascimento = str_replace(' ', '', preg_replace('/[a-zA-Z\/]/m', '', $nascimento));
			} else {
				$nascimento = '';
			}

			if (!$u->validateDate($nascimento)) {
				$nascimento = '';
			}

			$r->updateNascimento($nascimento, $acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
			$_SESSION['aviso_registro'] = 'Data de nascimento alterada com sucesso!';
		}

		if($this->acesso->isLogged() && $this->acesso->getInfo('confirmado') != 1) {
			$l = new \Models\Logs();
			
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
			$l->addLog('invasao', $msg);
			
			$_SESSION['aviso_registro'] = 'Você está tentando acessar uma página que não tem permissão.';
        }

		header("Location: " . BASE . $pag);
		exit;
	}
}