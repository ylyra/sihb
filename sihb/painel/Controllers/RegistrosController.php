<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Registros;

class RegistrosController extends Controller
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

        if ($this->acesso->getInfo('patente') >= 11) {
            $l = new \Models\Logs();
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
            $l->addLog('invasao', $msg);

            header("Location: " . BASE . "aviso");
            exit;
        }

        $this->arrayInfo = array(
            'page_active' => '',
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
        $r = new Registros();

        $this->arrayInfo['page_active'] = 'registros';
        $this->arrayInfo['pageName'] = 'Lista de membros';
        $this->arrayInfo['registros'] = $r->getRegistros();
        $this->arrayInfo['acesso'] = $this->acesso;

        /* Fara com que a página seja carregada */
        $this->loadTemplate('registros/lista', $this->arrayInfo);
    }

    /*
		Configuração de registros Adicionar/Promover do site
	*/
    public function promover()
    {
        $r = new Registros();

        $this->arrayInfo['page_active'] = 'registros';
        $this->arrayInfo['pageName'] = 'Adicionar/Promover';
        $this->arrayInfo['executivos'] = $r->getExecutivos();
        $this->arrayInfo['patentes'] = $r->getPatentes();
        $this->arrayInfo['acesso'] = $this->acesso;

        /* Fara com que a página seja carregada */
        $this->loadTemplate('registros/promover', $this->arrayInfo);
    }

    public function addRegistro()
    {
        $r = new Registros();

        $_SESSION['add_promover'] = 'Tivemos uma falha ao tenta atualizar/adicionar o registros! Tente novamente mais tarde';
        $_SESSION['add_promover_tipo'] = 'danger';

        if (
            isset($_POST['responsavel']) && !empty($_POST['responsavel']) &&
            isset($_POST['nicksnames']) && !empty($_POST['nicksnames']) &&
            isset($_POST['cargo']) && !empty($_POST['cargo']) &&
            isset($_POST['status']) && !empty($_POST['status'])
        ) {

            $responsvel = addslashes($_POST['responsavel']);
            $nicknames = $_POST['nicksnames'];
            $cargo = intval($_POST['cargo']);
            $status = intval($_POST['status']);

            $ultima_promocao = (isset($_POST['data_ultima_promocao']) && !empty($_POST['data_ultima_promocao'])) ? addslashes($_POST['data_ultima_promocao']) : date('d/m/Y');
            $ut = explode('/', $ultima_promocao);
            $u = $ut[2] . '-' . $ut[1] . '-' . $ut[0];
            $ultima_promocao = $u . ' ' . date('H:i:s');

            if ($this->acesso->podePromover($cargo, $this->acesso->getInfo('patente'))) {
                foreach ($nicknames as $nickname) {
                    $registro = $r->userExiste($nickname);
                    if (count($registro) > 0) {
                        if ($this->acesso->podePromover($registro['patente_id'], $this->acesso->getInfo('patente'))) {
                            $r->atualizarRegistro($responsvel, $nickname, $cargo, $status, $ultima_promocao, $registro['id'], $this->acesso->getInfo('nickname'));
                            $_SESSION['add_promover'] = 'Registro atualizado com sucesso!';
                            $_SESSION['add_promover_tipo'] = 'success';
                        }
                    } else {
                        $r->addRegistro($responsvel, $nickname, $cargo, $status, $ultima_promocao, $this->acesso->getInfo('nickname'));
                        $_SESSION['add_promover'] = 'Registro adicionado com sucesso!';
                        $_SESSION['add_promover_tipo'] = 'success';
                    }
                }
            }
        }

        header("Location: " . BASE . "registros/promover");
        exit;
    }

    public function editar($id)
    {
        $r = new Registros();

        if (is_numeric($id)) {
            $this->arrayInfo['registro'] = $r->getMembroByID($id);

            if ($this->acesso->podePromover($this->arrayInfo['registro']['patente_id'], $this->acesso->getInfo('patente')) && count($this->arrayInfo['registro']) > 0) {
                $this->arrayInfo['page_active'] = 'registros';
                $this->arrayInfo['pageName'] = 'Editar ' . $this->arrayInfo['registro']['nickname'];
                $this->arrayInfo['executivos'] = $r->getExecutivos();
                $this->arrayInfo['patentes'] = $r->getPatentes();
                $this->arrayInfo['acesso'] = $this->acesso;

                /* Fara com que a página seja carregada */
                $this->loadTemplate('registros/editar', $this->arrayInfo);
            } else {
                $_SESSION['edit_registro'] = 'Você está tentando editar um registro que não tem permissão.';
                $_SESSION['edit_registro_tipo'] = 'danger';
                header("Location: " . BASE . "registros");
                exit;
            }
        } else {
            $_SESSION['edit_registro'] = 'Você passou um id não numérico.';
            $_SESSION['edit_registro_tipo'] = 'danger';
            header("Location: " . BASE . "registros");
            exit;
        }
    }

    public function editRegistro($id)
    {
        $r = new Registros();

        if (is_numeric($id)) {
            $registro = $r->getMembroByID($id);

            if ($this->acesso->podePromover($registro['patente_id'], $this->acesso->getInfo('patente')) && count($registro) > 0) {

                $responsvel = addslashes($_POST['responsavel']);
                $nickname = $_POST['nickname'];
                $cargo = intval($_POST['cargo']);
                $status = intval($_POST['status']);

                $ultima_promocao = (isset($_POST['data_ultima_promocao']) && !empty($_POST['data_ultima_promocao'])) ? addslashes($_POST['data_ultima_promocao']) : date('d/m/Y');
                $ut = explode('/', $ultima_promocao);
                $u = $ut[2] . '-' . $ut[1] . '-' . $ut[0];
                $ultima_promocao = $u . ' ' . date('H:i:s');

                if ($this->acesso->podePromover($cargo, $this->acesso->getInfo('patente'))) {
                    $r->atualizarRegistro($responsvel, $nickname, $cargo, $status, $ultima_promocao, $registro['id'], $this->acesso->getInfo('nickname'));
                    $_SESSION['edit_registro'] = 'Registro atualizado com sucesso! Clique <strong><a href="' . BASE . 'registros/editar/' . $id . '" style="color:#155724;text-decoration:underline;">aqui</a></strong> para verificar.';
                    $_SESSION['edit_registro_tipo'] = 'success';
                }
            } else {
                $_SESSION['edit_registro'] = 'Você está tentando editar um registro que não tem permissão.';
                $_SESSION['edit_registro_tipo'] = 'danger';
            }
        } else {
            $_SESSION['edit_registro'] = 'Você passou um id não numérico.';
            $_SESSION['edit_registro_tipo'] = 'danger';
        }

        header("Location: " . BASE . "registros");
        exit;
    }

    public function confiancas()
    {
        $r = new Registros();

        if ($this->acesso->getInfo('patente') <= 6) {
            $this->arrayInfo['page_active'] = 'registros';
            $this->arrayInfo['pageName'] = 'Confianças';
            $this->arrayInfo['acesso'] = $this->acesso;
            $this->arrayInfo['registros'] = $r->getRegistrosConfianca();

            /* Fara com que a página seja carregada */
            $this->loadTemplate('registros/confiancas', $this->arrayInfo);
        } else {
            $l = new \Models\Logs();
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
            $l->addLog('invasao', $msg);
            $_SESSION['edit_registro'] = 'Você está tentando acessar uma página disponível apenas para a direção.';
            $_SESSION['edit_registro_tipo'] = 'danger';
            header("Location: " . BASE . "registros");
            exit;
        }
    }

    public function confianca($tipo, $id_registro)
    {
        $r = new Registros();
        $permitidos = [1, 2];

        if ($this->acesso->getInfo('patente') <= 6 && is_numeric($tipo) && is_numeric($id_registro) && in_array($tipo, $permitidos)) {
            $registro = $r->getMembroByID($id_registro);

            $data = date('Y-m-d H:i:s');

            if ($registro['patente_id'] >= 7) {
                if ($tipo == 1 && $registro['confianca'] <= 95) {
                    $r->confiarRegistro($id_registro, $data, $this->acesso->getInfo('nickname'), $tipo, 5);
                } elseif ($tipo == 2 && $registro['confianca'] >= 5) {
                    $r->confiarRegistro($id_registro, $data, $this->acesso->getInfo('nickname'), $tipo, -5);
                }

                $_SESSION['edit_registro'] = 'Confiança para com o(a) membro ' . $registro['nickname'] . ' alterada com sucesso!';
                $_SESSION['edit_registro_tipo'] = 'success';
            }
        }

        if ($this->acesso->getInfo('patente') >= 7) {
            $l = new \Models\Logs();
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
            $l->addLog('invasao', $msg);

            $_SESSION['edit_registro'] = 'Você está tentando acessar uma página disponível apenas para a direção.';
            $_SESSION['edit_registro_tipo'] = 'danger';
        }

        header("Location: " . BASE . "registros/confiancas");
        exit;
    }

    public function cartao()
    {
        $r = new Registros();

        if ($this->acesso->getInfo('patente') <= 10) {
            $adm = ($this->acesso->getInfo('patente') <= 6)?1:2;
            $this->arrayInfo['page_active'] = 'registros';
            $this->arrayInfo['pageName'] = 'Entrada/Saída';
            $this->arrayInfo['acesso'] = $this->acesso;
            $this->arrayInfo['registros'] = $r->getCartoes($adm);

            /* Fara com que a página seja carregada */
            $this->loadTemplate('registros/cartao', $this->arrayInfo);
        } else {
            $l = new \Models\Logs();
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
            $l->addLog('invasao', $msg);
            $_SESSION['edit_registro'] = 'Você está tentando acessar uma página disponível apenas para a direção.';
            $_SESSION['edit_registro_tipo'] = 'danger';
            header("Location: " . BASE . "registros");
            exit;
        }
    }

    public function logs()
    {
        $l = new \Models\Logs();

        if ($this->acesso->getInfo('patente') <= 6) {
            $this->arrayInfo['page_active'] = 'registros';
            $this->arrayInfo['pageName'] = 'Logs';
            $this->arrayInfo['acesso'] = $this->acesso;
            $this->arrayInfo['logs'] = $l->getLogs();

            /* Fara com que a página seja carregada */
            $this->loadTemplate('registros/logs', $this->arrayInfo);
        } else {
            $l = new \Models\Logs();
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
            $l->addLog('invasao', $msg);
            $_SESSION['edit_registro'] = 'Você está tentando acessar uma página disponível apenas para a direção.';
            $_SESSION['edit_registro_tipo'] = 'danger';
            header("Location: " . BASE . "registros");
            exit;
        }
    }

    public function destaque()
    {
        $l = new \Models\Logs();
        $d = new \Models\Destaques();
        $r = new Registros();

        if ($this->acesso->getInfo('patente') <= 6) {
            $this->arrayInfo['page_active'] = 'registros';
            $this->arrayInfo['pageName'] = 'Logs';
            $this->arrayInfo['acesso'] = $this->acesso;
            $this->arrayInfo['destaque'] = $d->getDestaque();
            $this->arrayInfo['patentes'] = $r->getPatentes();

            /* Fara com que a página seja carregada */
            $this->loadTemplate('registros/destaque', $this->arrayInfo);
        } else {
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
            $l->addLog('invasao', $msg);
            $_SESSION['edit_registro'] = 'Você está tentando acessar uma página disponível apenas para a direção.';
            $_SESSION['edit_registro_tipo'] = 'danger';
            header("Location: " . BASE . "registros");
            exit;
        }
    }

    public function addDestaque()
    {
        $l = new \Models\Logs();
        $d = new \Models\Destaques();
        $r = new Registros();
        $u = new \Models\Uteis();

        $_SESSION['edit_registro'] = 'Tivemos um problema ao tenta atualizar o destaque.';
        $_SESSION['edit_registro_tipo'] = 'danger';

        if ($this->acesso->getInfo('patente') <= 6) {

            if (isset($_POST['nickname']) && !empty($_POST['nickname']) && isset($_POST['data']) && !empty($_POST['data']) && isset($_POST['caracte']) && !empty($_POST['caracte'])) {

                $nickname = $u->trocarItens($_POST['nickname']);
                $de = $_POST['data'];
                $da = explode('/', $de);
                $data = $da[2] . '-' . $da[1] . '-' . $da[0];
                $caracte = $_POST['caracte'];
                $registro = $r->userExiste($nickname);

                if (count($caracte) == 4 && count($registro) > 0) {
                    $caracteristicas = implode(';', $caracte);
                    $d->addDestaque($registro, $data, $caracteristicas, $this->acesso->getInfo('nickname'));
                    $_SESSION['edit_registro'] = 'Destaque atualizado com sucesso!.';
                    $_SESSION['edit_registro_tipo'] = 'success';
                }
            }
        } else {
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
            $l->addLog('invasao', $msg);
            $_SESSION['edit_registro'] = 'Você está tentando acessar uma página disponível apenas para a direção.';
            $_SESSION['edit_registro_tipo'] = 'danger';
        }

        header("Location: " . BASE . "registros/destaque");
        exit;
    }

    public function delete($id_registro)
    {
        
        if ($this->acesso->getInfo('patente') >= 7) {
            $l = new \Models\Logs();
            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";
            $l->addLog('invasao', $msg);
            $_SESSION['edit_registro'] = 'Você está tentando acessar uma página disponível apenas para a direção.';
            $_SESSION['edit_registro_tipo'] = 'danger';
        }

        $r = new Registros();
        $registro = $r->getMembroByID($id_registro);
        if ($this->acesso->getInfo('patente') <= 6 && is_numeric($id_registro) && count($registro) >= 0 && !in_array($id_registro, [1,2])) {
            $r->deleteRegistro($id_registro, $this->acesso->getInfo('nickname'), $registro['nickname']);
            $_SESSION['edit_registro'] = 'Registro deletado com sucesso.';
            $_SESSION['edit_registro_tipo'] = 'success';
        } else {
            $_SESSION['edit_registro'] = 'Tivemos um problema ao tenta deletar o registro!';
            $_SESSION['edit_registro_tipo'] = 'danger';
        }

        header("Location: " . BASE . "registros");
        exit;
    }
}
