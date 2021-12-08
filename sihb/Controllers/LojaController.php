<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Loja;

class LojaController extends Controller
{

	private $user;
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
			'page_active' => 'servicos_externos',
			'pageName' => '',
			'description' => '',
			'acesso' => $this->acesso,
		);
	}

	/*
		Configuração da Página Inicial da Loja
	*/
	public function index()
	{
		$l = new Loja();

		$offset = 0;
		$limit = 20;
		$currentPage = 1;

		// if (!empty($_GET['p']) && is_numeric($_GET['p'])) {
		// 	$currentPage = $_GET['p'];
		// }

		$offset = ($currentPage * $limit) - $limit;

		$this->arrayInfo['page_active'] = 'loja';
		$this->arrayInfo['pageName'] = 'Loja';
		$this->arrayInfo['loja'] = $l;
		$this->arrayInfo['emblemas'] = $l->getProdutos($offset, $limit, 1);
		$this->arrayInfo['beneficios'] = $l->getProdutos($offset, $limit, 2);
		$this->arrayInfo['ultimas_compras'] = $l->ultimasCompras(10);
		$this->arrayInfo['ultimos_itens'] = $l->ultimosItens(4);

		
		/* Fara com que a página seja carregada */
		$this->loadView('loja/todos', $this->arrayInfo);
	}

	public function getEmblemasP()
	{
		$l = new Loja();

		$offset = 0;
		$limit = 20;
		$currentPage = 1;

		$json = file_get_contents('php://input');
        $obj = json_decode($json);
		$response = get_object_vars($obj);
		
		$tipo = 1;
		if (is_numeric($response['page']) && is_numeric($response['tipo']) && is_numeric($response['local'])) {
			$currentPage = intval($response['page']);
			$local = intval($response['local']);
			$tipo = intval($response['tipo']);
		}

		if($tipo == 1 && $currentPage > 1) {
			$currentPage = $currentPage - 1;
		} elseif ($tipo == 2) {
			$currentPage = $currentPage + 1;
		}

		$offset = ($currentPage * $limit) - $limit;
		
		$this->arrayInfo['loja'] = $l;
		$this->arrayInfo['emblemas'] = $l->getProdutos($offset, $limit, $local);
		
		/* Fara com que a página seja carregada */
		$this->loadView('loja/get', $this->arrayInfo);
	}
	
	public function shopstatus()
	{
		$l = new Loja();

		$json = file_get_contents('php://input');
        $obj = json_decode($json);
		$response = get_object_vars($obj);

		if (is_numeric($response['t']) && is_numeric($response['i'])) {
			$tipo = intval($response['t']);
			$id = intval($response['i']);

			$produto = $l->getItemById($id);
			$data = date('Y-m-d H:i:s');

			if (count($produto) > 0) {
				// ! Emblema presente limitado
				if ($tipo == 4 && $produto['tipo'] == 1 && $produto['vip'] == 0 && $produto['limite'] >= 1) { 
					$nickname = addslashes($response['nickname']);
					$tipo = $l->presentearItem($produto, $nickname, $this->acesso->getInfo('moedas'), $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));

				} // ! Emblema presente ilimitado
				elseif ($tipo == 4 && $produto['tipo'] == 1 && $produto['vip'] == 0 && $produto['limite'] == -1) { 
					$nickname = addslashes($response['nickname']);
					$tipo = $l->presentearItem($produto, $nickname, $this->acesso->getInfo('moedas'), $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));
				}
								
				// ! Emblema não vip limitado 
				elseif ($tipo == 5 && $produto['tipo'] == 1 && $produto['vip'] == 0 && $produto['limite'] >= 1) { 
					$tipo = $l->comprarItem($produto, $this->acesso->getInfo('moedas'), $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));

				} 
				// ! Emblema vip e usuario vip limitado
				elseif ($tipo == 5 && $produto['tipo'] == 1 && $produto['vip'] == 1 && $this->acesso->getInfo('vip') == 1 && $produto['limite'] >= 1) { 
					$tipo = $l->comprarItem($produto, $this->acesso->getInfo('moedas'), $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));

				} 
				
				// ! Benefício não vip limitado
				elseif ($tipo == 5 && $produto['tipo'] == 2 && $produto['vip'] == 0 && $produto['limite'] >= 1) { 
					$tipo = $l->comprarItem($produto, $this->acesso->getInfo('moedas'), $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));

				} 
				// ! Benefício vip e usuario vip limitado
				elseif ($tipo == 5 && $produto['tipo'] == 2 && $produto['vip'] == 1 && $this->acesso->getInfo('vip') == 1 && $produto['limite'] >= 1) { 
					$tipo = $l->comprarItem($produto, $this->acesso->getInfo('moedas'), $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));

				} 
				
				// ! Emblema não vip ilimitado 
				elseif ($tipo == 5 && $produto['tipo'] == 1 && $produto['vip'] == 0 && $produto['limite'] == -1 && $produto['is_limited'] == 1) { 
					$tipo = $l->comprarItem($produto, $this->acesso->getInfo('moedas'), $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));

				} 
				// ! Emblema vip e usuario vip ilimitado
				elseif ($tipo == 5 && $produto['tipo'] == 1 && $produto['vip'] == 1 && $this->acesso->getInfo('vip') == 1 && $produto['limite'] == -1 && $produto['is_limited'] == 1) { 
					$tipo = $l->comprarItem($produto, $this->acesso->getInfo('moedas'), $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));

				} 
				
				// ! Benefício não vip ilimitado
				elseif ($tipo == 5 && $produto['tipo'] == 2 && $produto['vip'] == 0 && $produto['limite'] == -1 && $produto['is_limited'] == 1) { 
					$tipo = $l->comprarItem($produto, $this->acesso->getInfo('moedas'), $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));

				} 
				// ! Benefício vip e usuario vip ilimitado
				elseif ($tipo == 5 && $produto['tipo'] == 2 && $produto['vip'] == 1 && $this->acesso->getInfo('vip') == 1 && $produto['limite'] == -1 && $produto['is_limited'] == 1) { 
					$tipo = $l->comprarItem($produto, $this->acesso->getInfo('moedas'), $this->acesso->getInfo('id_registro'), $this->acesso->getInfo('nickname'));

				} 

				

				/* Fara com que a página seja carregada */
				$this->loadView('loja/shopstatus', [
					'tipo' => $tipo,
					'produto' => $produto
				]);
			}

		}		

		
	}


}
