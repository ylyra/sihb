<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Loja;
use \Models\Registros;

class LojaController extends Controller
{

	private $acesso;
	private $arrayInfo;

	public function __construct()
	{
		parent::__construct();

		$this->acesso = new Acesso();

		if (!$this->acesso->isLogged()) {
			header("Location: ".BASE_PAI);
			exit;
        }
        
        if ($this->acesso->getInfo('patente') >= 7) {
            $l = new \Models\Logs();

            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
            $l->addLog('invasao', $msg);

			header("Location: ".BASE);
			exit;
		}

		$this->arrayInfo = array(
			'page_active' => 'loja',
			'pageName' => '',
			'description' => '',
			'acesso' => $this->acesso
		);
	}

	/*
		Configuração da Página Inicial da loja
	*/
	public function index()
	{
        /* Fara com que a página de 404 seja carregada */
		$this->loadTemplate('404', $this->arrayInfo);
    }

    /*
		Configuração da Página de Emblemas da Loja
	*/
	public function emblemas()
	{
        $l = new Loja();
        $this->arrayInfo['pageName'] = 'Emblemas - Loja'; 
        $this->arrayInfo['items'] = $l->getProdutos(1); 
        /* Fara com que a página seja carregada */
		$this->loadTemplate('loja/emblemas', $this->arrayInfo);
    }

    /*
		Configuração da Página de Adicionar Emblemas na Loja
	*/
	public function addEmblema()
	{
        $l = new Loja();
        $this->arrayInfo['pageName'] = 'Adicionar Emblema - Loja'; 
        /* Fara com que a página seja carregada */
		$this->loadTemplate('loja/addEmblema', $this->arrayInfo);
    }
    
    /*
		Configuração da Ação de Adicionar Emblemas na Loja
	*/
	public function addEmblemaAction()
	{
        $l = new Loja();

        $_SESSION['emblema'] = 'Emblema adicionado com sucesso!';
		$_SESSION['emblema_tipo'] = 'success';
        
        if (
            isset($_POST['img']) && !empty($_POST['img']) &&
            isset($_POST['descricao']) && !empty($_POST['descricao']) &&
            isset($_POST['valor']) && !empty($_POST['valor'])
        ) {
            $img = addslashes($_POST['img']);
            $descricao = addslashes($_POST['descricao']);
            $valor = addslashes($_POST['valor']);
            $limite = (isset($_POST['limite']) && !empty($_POST['limite']))?addslashes($_POST['limite']):-1;
            $is_limited = ($limite >= 0)?0:1;
            $vip = (isset($_POST['vip']) && !empty($_POST['vip']) && $_POST['vip'] == 'Sim')?1:0;

            $l->addItemLoja(1, $img, $descricao, $valor, $limite, $is_limited, $vip, $this->acesso->getInfo('nickname'));
        } else {
            $_SESSION['emblema'] = 'Tivemos um problema ao tenta adicionar o emblema!';
		    $_SESSION['emblema_tipo'] = 'danger';
        }

        header("Location: ".BASE."loja/emblemas");
        exit;

    }

    /*
		Configuração da Página de Edição de Emblemas na Loja
	*/
	public function editEmblema($id)
	{
        $l = new Loja();
        $this->arrayInfo['emblema'] = $l->getProduto($id, 1);
        if (is_numeric($id) && count($this->arrayInfo['emblema']) > 0) {
            $this->arrayInfo['pageName'] = 'Editar Emblema - Loja'; 
            /* Fara com que a página seja carregada */
            $this->loadTemplate('loja/editEmblema', $this->arrayInfo);
        } else {
            $_SESSION['emblema'] = 'O emblema que está tentando acessar não existe.';
            $_SESSION['emblema_tipo'] = 'danger';
            
            header("Location: ".BASE."loja/emblemas");
            exit;
        }
    }

    /*
		Configuração da Ação de Editar Emblemas na Loja
	*/
	public function editEmblemaAction()
	{
        $l = new Loja();

        $_SESSION['emblema'] = 'Tivemos um problema ao tenta editar o emblema!';
        $_SESSION['emblema_tipo'] = 'danger';
        
        if (
            isset($_POST['img']) && !empty($_POST['img']) &&
            isset($_POST['id']) && !empty($_POST['id']) &&
            isset($_POST['descricao']) && !empty($_POST['descricao']) &&
            isset($_POST['valor']) && !empty($_POST['valor'])
        ) {
            $img = addslashes($_POST['img']);
            $descricao = addslashes($_POST['descricao']);
            $valor_anterior = addslashes($_POST['valor_anterior']);
            $valor = addslashes($_POST['valor']);
            $limite = (isset($_POST['limite']) && !empty($_POST['limite']))?addslashes($_POST['limite']):-1;
            $is_limited = ($limite >= 0)?0:1;
            $vip = (isset($_POST['vip']) && !empty($_POST['vip']) && $_POST['vip'] == 'Sim')?1:0;
            $id = intval($_POST['id']);

            if (count($l->getProduto($id, 1)) > 0) {
                $l->editItemLoja(1, $img, $descricao, $valor_anterior, $valor, $limite, $is_limited, $vip, $id, $this->acesso->getInfo('nickname'));

                $_SESSION['emblema'] = 'Emblema editado com sucesso!';
		        $_SESSION['emblema_tipo'] = 'success';
            }

        }

        header("Location: ".BASE."loja/emblemas");
        exit;

    }

    /*
		Configuração da Ação de Deletar Emblemas na Loja
	*/
	public function delEmblema($id)
	{
        $l = new Loja();

        $_SESSION['emblema'] = 'Tivemos um problema ao tenta deletar o emblema!';
        $_SESSION['emblema_tipo'] = 'danger';
        
        if (is_numeric($id) && count($l->getProduto($id, 1)) > 0) {
            $l->delItemLoja(1, $id, $this->acesso->getInfo('nickname'));

            $_SESSION['emblema'] = 'Emblema deletado com sucesso!';
            $_SESSION['emblema_tipo'] = 'success';
        }

        header("Location: ".BASE."loja/emblemas");
        exit;

    }    

    /*
		Configuração da Página de Beneficios da Loja
	*/
	public function beneficios()
	{
        $l = new Loja();
        $this->arrayInfo['pageName'] = 'Benefícios  - Loja'; 
        $this->arrayInfo['items'] = $l->getProdutos(2); 
        /* Fara com que a página seja carregada */
		$this->loadTemplate('loja/beneficios', $this->arrayInfo);
    }

    /*
		Configuração da Página de Adicionar Benefícios na Loja
	*/
	public function addBeneficio()
	{
        $l = new Loja();
        $this->arrayInfo['pageName'] = 'Adicionar Benefício - Loja'; 
        /* Fara com que a página seja carregada */
		$this->loadTemplate('loja/addBeneficio', $this->arrayInfo);
    }
    
    /*
		Configuração da Ação de Adicionar Benefícios na Loja
	*/
	public function addBeneficioAction()
	{
        $l = new Loja();

        $_SESSION['emblema'] = 'Benefício adicionado com sucesso!';
		$_SESSION['emblema_tipo'] = 'success';
        
        if (
            isset($_POST['img']) && !empty($_POST['img']) &&
            isset($_POST['descricao']) && !empty($_POST['descricao']) &&
            isset($_POST['valor']) && !empty($_POST['valor'])
        ) {
            $img = addslashes($_POST['img']);
            $descricao = addslashes($_POST['descricao']);
            $valor = addslashes($_POST['valor']);
            $limite = (isset($_POST['limite']) && !empty($_POST['limite']))?addslashes($_POST['limite']):-1;
            $is_limited = ($limite >= 0)?0:1;
            $vip = (isset($_POST['vip']) && !empty($_POST['vip']) && $_POST['vip'] == 'Sim')?1:0;

            $l->addItemLoja(2, $img, $descricao, $valor, $limite, $is_limited, $vip, $this->acesso->getInfo('nickname'));
        } else {
            $_SESSION['emblema'] = 'Tivemos um problema ao tenta adicionar o benefício!';
		    $_SESSION['emblema_tipo'] = 'danger';
        }

        header("Location: ".BASE."loja/beneficios");
        exit;

    }

    /*
		Configuração da Página de Edição de Benefícios na Loja
	*/
	public function editBeneficio($id)
	{
        $l = new Loja();
        $this->arrayInfo['emblema'] = $l->getProduto($id, 2);
        if (is_numeric($id) && count($this->arrayInfo['emblema']) > 0) {
            $this->arrayInfo['pageName'] = 'Editar Benefício - Loja'; 
            /* Fara com que a página seja carregada */
            $this->loadTemplate('loja/editBeneficio', $this->arrayInfo);
        } else {
            $_SESSION['emblema'] = 'O benefício que está tentando acessar não existe.';
            $_SESSION['emblema_tipo'] = 'danger';
            
            header("Location: ".BASE."loja/beneficios");
            exit;
        }
    }

    /*
		Configuração da Ação de Editar Benefício na Loja
	*/
	public function editBeneficioAction()
	{
        $l = new Loja();

        $_SESSION['emblema'] = 'Tivemos um problema ao tenta editar o benefício!';
        $_SESSION['emblema_tipo'] = 'danger';
        
        if (
            isset($_POST['img']) && !empty($_POST['img']) &&
            isset($_POST['id']) && !empty($_POST['id']) &&
            isset($_POST['descricao']) && !empty($_POST['descricao']) &&
            isset($_POST['valor']) && !empty($_POST['valor'])
        ) {
            $img = addslashes($_POST['img']);
            $descricao = addslashes($_POST['descricao']);
            $valor_anterior = addslashes($_POST['valor_anterior']);
            $valor = addslashes($_POST['valor']);
            $limite = (isset($_POST['limite']) && !empty($_POST['limite']))?addslashes($_POST['limite']):-1;
            $is_limited = ($limite >= 0)?0:1;
            $vip = (isset($_POST['vip']) && !empty($_POST['vip']) && $_POST['vip'] == 'Sim')?1:0;
            $id = intval($_POST['id']);

            if (count($l->getProduto($id, 2)) > 0) {
                $l->editItemLoja(2, $img, $descricao, $valor_anterior, $valor, $limite, $is_limited, $vip, $id, $this->acesso->getInfo('nickname'));

                $_SESSION['emblema'] = 'Benefício editado com sucesso!';
		        $_SESSION['emblema_tipo'] = 'success';
            }

        }

        header("Location: ".BASE."loja/beneficios");
        exit;

    }

    /*
		Configuração da Ação de Deletar Benefício na Loja
	*/
	public function delBeneficio($id)
	{
        $l = new Loja();

        $_SESSION['emblema'] = 'Tivemos um problema ao tenta deletar o benefício!';
        $_SESSION['emblema_tipo'] = 'danger';
        
        if (is_numeric($id) && count($l->getProduto($id, 2)) > 0) {
            $l->delItemLoja(2, $id, $this->acesso->getInfo('nickname'));

            $_SESSION['emblema'] = 'Benefício deletado com sucesso!';
            $_SESSION['emblema_tipo'] = 'success';
        }

        header("Location: ".BASE."loja/beneficios");
        exit;

    }
    
    /*
		Configuração da Página de Códigos de Coins da Loja
	*/
	public function codigos()
	{
        $l = new Loja();
        $this->arrayInfo['pageName'] = 'Códigos de SIHBCoins  - Loja'; 
        $this->arrayInfo['items'] = $l->getCodigos(); 
        /* Fara com que a página seja carregada */
		$this->loadTemplate('loja/codigos', $this->arrayInfo);
    }

    /*
		Configuração da Página de Adicionar Códigos na Loja
	*/
	public function addCodigo()
	{
        $l = new Loja();
        $this->arrayInfo['pageName'] = 'Adicionar Código - Loja'; 
        /* Fara com que a página seja carregada */
		$this->loadTemplate('loja/addCodigo', $this->arrayInfo);
    }
    
    /*
		Configuração da Ação de Adicionar Códigos na Loja
	*/
	public function addCodigoAction()
	{
        $l = new Loja();

        $_SESSION['emblema'] = 'Código adicionado com sucesso!';
		$_SESSION['emblema_tipo'] = 'success';
        
        if (
            isset($_POST['codigo']) && !empty($_POST['codigo']) &&
            isset($_POST['valor']) && !empty($_POST['valor']) 
        ) {
            $codigo = addslashes($_POST['codigo']);
            $valor = addslashes($_POST['valor']);
            $limite = (isset($_POST['limite']) && !empty($_POST['limite']))?addslashes($_POST['limite']):-1;
            $expiracao = (isset($_POST['expiracao']) && !empty($_POST['expiracao']))?addslashes($_POST['expiracao']):'0000-00-00 00:00:00';

            if ($expiracao != '0000-00-00 00:00:00') {
                $ut = explode('/', $expiracao);
                $u = $ut[2].'-'.$ut[1].'-'.$ut[0];
                $expiracao = $u.' '.date('H:i:s');
            }

            $is_limited = ($limite >= 0)?0:1;

            $l->addCodigo($codigo, $valor, $limite, $expiracao, $is_limited, $this->acesso->getInfo('nickname'));
        } else {
            $_SESSION['emblema'] = 'Tivemos um problema ao tenta adicionar o código!';
		    $_SESSION['emblema_tipo'] = 'danger';
        }

        header("Location: ".BASE."loja/codigos");
        exit;

    }

    /*
		Configuração da Página de Edição de Códigos na Loja
	*/
	public function editCodigo($id)
	{
        $l = new Loja();
        $this->arrayInfo['emblema'] = $l->getCodigo(intval($id));
        if (is_numeric($id) && count($this->arrayInfo['emblema']) > 0) {
            $this->arrayInfo['pageName'] = 'Editar Código - Loja'; 
            /* Fara com que a página seja carregada */
            $this->loadTemplate('loja/editCodigo', $this->arrayInfo);
        } else {
            $_SESSION['emblema'] = 'O código que está tentando acessar não existe.';
            $_SESSION['emblema_tipo'] = 'danger';
            
            header("Location: ".BASE."loja/codigos");
            exit;
        }
    }

    /*
		Configuração da Ação de Editar Códigos na Loja
	*/
	public function editCodigoAction()
	{
        $l = new Loja();

        $_SESSION['emblema'] = 'Tivemos um problema ao tenta editar o código!';
        $_SESSION['emblema_tipo'] = 'danger';

        if (
            isset($_POST['codigo']) && !empty($_POST['codigo']) &&
            isset($_POST['valor']) && !empty($_POST['valor']) &&
            isset($_POST['id']) && !empty($_POST['id'])
        ) {
            $id = intval($_POST['id']);
            $codigo = addslashes($_POST['codigo']);
            $valor = addslashes($_POST['valor']);
            $limite = (isset($_POST['limite']) && !empty($_POST['limite']))?addslashes($_POST['limite']):-1;
            $expiracao = (isset($_POST['expiracao']) && !empty($_POST['expiracao']))?addslashes($_POST['expiracao']):'0000-00-00 00:00:00';

            if ($expiracao != '0000-00-00 00:00:00') {
                $ut = explode('/', $expiracao);
                $u = $ut[2].'-'.$ut[1].'-'.$ut[0];
                $expiracao = $u.' '.date('H:i:s');
            }

            $is_limited = ($limite >= 0)?0:1;

            if (count($l->getCodigo($id)) > 0) {
                $l->editCodigo($codigo, $valor, $limite, $expiracao, $is_limited, $id, $this->acesso->getInfo('nickname'));

                $_SESSION['emblema'] = 'Código editado com sucesso!';
		        $_SESSION['emblema_tipo'] = 'success';
            }

        } 

        header("Location: ".BASE."loja/codigos");
        exit;

    }

    /*
		Configuração da Ação de Deletar Benefício na Loja
	*/
	public function delCodigo($id)
	{
        $l = new Loja();

        $_SESSION['emblema'] = 'Tivemos um problema ao tenta deletar o código!';
        $_SESSION['emblema_tipo'] = 'danger';
        
        if (is_numeric($id) && count($l->getCodigo($id)) > 0) {
            $l->delCodigo($id, $this->acesso->getInfo('nickname'));

            $_SESSION['emblema'] = 'Código deletado com sucesso!';
            $_SESSION['emblema_tipo'] = 'success';
        }

        header("Location: ".BASE."loja/codigos");
        exit;

    }

    /*
		Configuração da Página de Benefícios Comprados
	*/
    public function compras($tipo)
    {
        $l = new Loja();
        $tipos = [1,2];
        if (is_numeric($tipo) && in_array($tipo, $tipos)) {
            $this->arrayInfo['pageName'] = 'Itens comprados - Loja'; 
            $this->arrayInfo['items'] = $l->getItemsComprados($tipo); 
            /* Fara com que a página seja carregada */
            $this->loadTemplate('loja/compras', $this->arrayInfo);
        } else {            
            header("Location: ".BASE);
            exit;
        }
    }

    /*
		Configuração da Ação de aceitar um benefício
	*/
    public function confirmarCompra($id)
    {
        $l = new Loja();

        $_SESSION['emblema'] = 'Tivemos um problema ao tenta aceitar o benefício!';
        $_SESSION['emblema_tipo'] = 'danger';
        $compra = $l->getCompraItem($id);

        $fim = '';
        
        if (is_numeric($id) && count($compra) > 0) {
            $l->atualizarStatusCompra($id, 1, $this->acesso->getInfo('nickname'));

            $_SESSION['emblema'] = 'Benefício aceito com sucesso!';
            $_SESSION['emblema_tipo'] = 'success';
            $fim = $compra['tipo'];
        }

        header("Location: ".BASE."loja/compras/".$fim);
        exit;
    }

    /*
		Configuração da Ação de rejeitar um benefício
	*/
    public function negarCompra($id)
    {
        $l = new Loja();

        $_SESSION['emblema'] = 'Tivemos um problema ao tenta rejeitar o benefício!';
        $_SESSION['emblema_tipo'] = 'danger';
        $compra = $l->getCompraItem($id);

        $fim = '';
        
        if (is_numeric($id) && count($compra) > 0) {
            $l->atualizarStatusCompra($id, 2, $this->acesso->getInfo('nickname'));
            $r = new Registros();

            $_SESSION['emblema'] = 'Benefício rejeitado com sucesso!';
            $_SESSION['emblema_tipo'] = 'success';
            $fim = $compra['tipo'];
            $r->addMoedas2($compra['id_comprador'], $compra['preco']);
        }

        header("Location: ".BASE."loja/compras/".$fim);
        exit;
    }

    /*
		Configuração da Página de Vips
	*/
    public function vip()
    {
        $r = new Registros();

        $tipos = [1,2];
        $this->arrayInfo['pageName'] = 'Membros vips - Loja'; 
        $this->arrayInfo['items'] = $r->getVips(); 
        /* Fara com que a página seja carregada */
        $this->loadTemplate('loja/vips', $this->arrayInfo);
    }

    /*
		Configuração da Página de dar vip
	*/
    public function darVip()
    {
        $r = new Registros();

        $tipos = [1,2];
        $this->arrayInfo['pageName'] = 'Dar vip - Loja'; 
        $this->arrayInfo['items'] = $r->getVips(); 
        /* Fara com que a página seja carregada */
        $this->loadTemplate('loja/vip_doar', $this->arrayInfo);
    }

    /*
		Configuração da Ação de dar um vip
	*/
    public function addVipAction()
    {
        $r = new Registros();
        // echo date('Y-m-d 23:59:59', strtotime('+1 month'));
        $_SESSION['emblema'] = 'Tivemos um problema ao tenta adicionar o vip ao membro!';
        $_SESSION['emblema_tipo'] = 'danger';
        if (isset($_POST['nicksnames']) && !empty($_POST['nicksnames']) && isset($_POST['tempo']) && !empty($_POST['tempo'])) {
            $nicknames = $_POST['nicksnames'];
            $t = intval($_POST['tempo']);
            $tempo = '+'.$t.' month';
            $data_hoje = date('Y-m-d 23:59:59');

            foreach ($nicknames as $nickname) {
                $registro = $r->userExiste($nickname);
                
                if (count($registro) > 0) {
                    if ($registro['vip'] == 1 && $registro['vip_vencimento'] != '0000-00-00 00:00:00' && $registro['vip_vencimento'] >= $data_hoje) {
                        $data_v = date('Y-m-d 23:59:59', strtotime($tempo, strtotime($registro['vip_vencimento'])));  
                    } else {
                        $data_v = date('Y-m-d 23:59:59', strtotime($tempo));
                    }

                    $r->addVip($registro['id'], $data_v);
                    $_SESSION['emblema'] = 'Vip adicionado ao membro '.$registro['nickname'].' com sucesso!';
                    $_SESSION['emblema_tipo'] = 'success';
                }
            }
        }

        header("Location: ".BASE."loja/vip");
        exit;
    }

    public function moedas()
    {
        $r = new Registros();

        $tipos = [1,2];
        $this->arrayInfo['pageName'] = 'Dar moedas - Loja'; 
        /* Fara com que a página seja carregada */
        $this->loadTemplate('loja/meodas_doar', $this->arrayInfo);
    }

    public function addMoedasAction()
    {
        $r = new Registros();

        $_SESSION['emblema'] = 'Tivemos um problema ao tenta adicionar as moedas ao membro!';
        $_SESSION['emblema_tipo'] = 'danger';
        if (isset($_POST['nicksnames']) && !empty($_POST['nicksnames']) && isset($_POST['valor']) && !empty($_POST['valor'])) {
            $nicknames = $_POST['nicksnames'];
            $valor = intval($_POST['valor']);

            $inexistentes = [];

            foreach ($nicknames as $nickname) {
                $registro = $r->userExiste($nickname);
                
                if (count($registro) > 0) {
                    $r->addMoedas($registro['id'], $valor);
                    $_SESSION['emblema'] = 'Moedas adicionadas com sucesso!';
                    $_SESSION['emblema_tipo'] = 'success';
                } else {
                    $inexistentes[] = $nickname;
                }
            }

            if (count($inexistentes) > 0) {
                $_SESSION['emblema'] = 'O(s) nickname(s) ('.implode(', ', $inexistentes).') não é(são) membro(s) do SIHB ou está(ão) incorreto(s)!';
                $_SESSION['emblema_tipo'] = 'danger';
            }
        }

        header("Location: ".BASE."loja/moedas");
        exit;
    }

	
}
