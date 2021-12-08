<?php
namespace Controllers;

use \Core\Controller;
use \Models\Uteis;
use \Models\Registros;
use \Models\Acesso;
use \Models\Noticias;

class LoginController extends Controller
{

	private $arrayInfo;

	public function __construct()
	{
		parent::__construct();

		$this->arrayInfo = array();
	}

	public function index()
	{
		$ut = new Uteis();
		$a = new Acesso();

		if (isset($_POST['usuario']) && !empty($_POST['usuario'])) {
			$usuario = addslashes($_POST['usuario']);
			$senha = $ut->encripta($_POST['senha']);

			if ($a->verifyUser($usuario, $senha)) {
				header("Location: " . BASE);
			}
		}

		/* Fara com que a página seja carregada */
		$this->loadView('login', $this->arrayInfo);
	}

	public function logout()
	{

		$a = new Acesso();
		if ($a->isLogged()) {
			unset($_SESSION['sihb_login']);
		}

		header("Location: " . BASE);
	}

	public function logar_form()
	{
		$u = new Uteis();
		$r = new Registros();
		$a = new Acesso();

		$_SESSION['aviso_registro'] = 'Logado com sucesso!';

		// if (!$u->isLogged()) {}
		if (isset($_POST['nickname']) && !empty($_POST['nickname']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
			$nickname = addslashes($u->trocarItens($_POST['nickname']));
			$senha = addslashes($u->encripta($_POST['senha']));
			$existe = $r->userExiste($nickname);

			if (count($existe) > 0) {
				if (!$a->verifyUser($nickname, $senha)) {
					$_SESSION['aviso_registro'] = 'Nickname e/ou senha estão incorretos!';
				}
			}

			if (count($existe) == 0) {
				$_SESSION['aviso_registro'] = 'O nickname informado não é um(a) membro(a) da SIHB!';
			}

			if (!$a->temCadastro($existe['id'])) {
				$_SESSION['aviso_registro'] = 'O usuário informado não está cadastrado!';
			}
		} else {
			$_SESSION['aviso_registro'] = 'Nickname e/ou senha estão vazios!';
		}

		header("Location:" . BASE);
		exit;
	}

	public function registrar_form()
	{
		$u = new Uteis();
		$r = new Registros();
		$a = new Acesso();

		$_SESSION['aviso_registro'] = 'Registro criado com sucesso!';

		// if (!$u->isLogged()) {}
		if (isset($_POST['nickname']) && !empty($_POST['nickname']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
			$nickname = addslashes($u->trocarItens($_POST['nickname']));
			$senha = addslashes($u->encripta($_POST['senha']));
			$existe = $r->userExiste($nickname);

			if (count($existe) > 0 && !$a->temCadastro($existe['id'])) {
				$a->addUser($nickname, $existe['id'], $senha);
			}

			if (count($existe) == 0) {
				$_SESSION['aviso_registro'] = 'O nickname informado não é um(a) membro(a) da SIHB!';
			}

			if ($a->temCadastro($existe['id'])) {
				$_SESSION['aviso_registro'] = 'O usuário informado já está cadastrado!';
			}
		} else {
			$_SESSION['aviso_registro'] = 'Nickname e/ou senha estão vazios!';
		}

		header("Location:" . BASE);
		exit;
	}

	public function recuperar()
	{

		$this->acesso = new Acesso();
		$this->acesso->isLogged();

		$n = new Noticias();
		$this->arrayInfo = array(
			'page_active' => 'apostilas',
			'pageName' => '',
			'description' => '',
			'acesso' => $this->acesso,
			'destacadas' => $n->getDestacadas()
		);
		$this->arrayInfo['pageName'] = 'Recuperar conta';

		/* Fara com que a página seja carregada */
		$this->loadTemplate('perfil/recuperar', $this->arrayInfo);
	}

	public function recuperar_continue()
	{

		$this->acesso = new Acesso();
		$this->acesso->isLogged();
		$n = new Noticias();
		$this->arrayInfo = array(
			'page_active' => 'apostilas',
			'pageName' => '',
			'description' => '',
			'acesso' => $this->acesso,
			'destacadas' => $n->getDestacadas()
		);
		$this->arrayInfo['pageName'] = 'Recuperar conta';

		if (isset($_POST['nickname']) && !empty($_POST['nickname'])) {
			$r = new Registros();
			$nickname = addslashes($_POST['nickname']);
			$existe = $r->userExiste($nickname);

			if (count($existe) > 0 && $this->acesso->temCadastro($existe['id'])) {
				$this->arrayInfo['nickname'] = $existe['nickname'];

				/* Fara com que a página seja carregada */
				$this->loadTemplate('perfil/recuperar_c', $this->arrayInfo);
			}
		} else {
			header("Location: " . BASE);
			exit;
		}
	}

	public function alterarSenha()
	{
		if (
			isset($_POST['senha1']) && !empty($_POST['senha1']) &&
			isset($_POST['senha2']) && !empty($_POST['senha2']) &&
			isset($_POST['codigo']) && !empty($_POST['codigo']) &&
			isset($_POST['nickname']) && !empty($_POST['nickname']) &&
			isset($_POST['copiei']) && !empty($_POST['copiei'])
		) {
			$acesso = new Acesso();
			$r = new Registros();
			$u = new Uteis();

			$nickname = addslashes($_POST['nickname']);
			$senha1 = $u->encripta($_POST['senha1']);
			$senha2 = $u->encripta($_POST['senha2']);
			$codigo = addslashes($_POST['codigo']);
			// $codigo = 'Serviço de Inteligência Habbiano ©';
			$existe = $r->userExiste($nickname);
			$missao = $u->getMotto($nickname);


			if (count($existe) > 0 && $acesso->temCadastro($existe['id']) && $senha1 == $senha2 && $codigo == $missao) {
				$id = $acesso->temCadastro1($existe['id']);

				if ($id !== 0) {
					$acesso->updateSenha($senha1, $id, $nickname);
					$_SESSION['aviso_registro'] = 'Senha alterada com sucesso!';
				}
			}

			if (count($existe) == 0) {
				$_SESSION['aviso_registro'] = 'O nickname informado não é um(a) membro(a) da SIHB!';
			}

			if (count($existe) > 0 && !$acesso->temCadastro($existe['id'])) {
				$_SESSION['aviso_registro'] = 'O nickname informado ainda não se cadastrou no site da SIHB!';
			}

			if ($senha1 !== $senha2) {
				$_SESSION['aviso_registro'] = 'As senhas não são iguais!';
			}

			if ($codigo !== $missao) {
				$_SESSION['aviso_registro'] = 'A missão não é igual ao código informado!';
			}
		} else {
			$_SESSION['aviso_registro'] = 'Por favor, informe todas as opções!';
		}

		header("Location: " . BASE);
		exit;
	}
}
