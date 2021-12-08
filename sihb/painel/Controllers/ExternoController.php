<?php

namespace Controllers;

use \Core\Controller;
use \Models\Acesso;
use \Models\Externos;
use \Models\Registros;

class ExternoController extends Controller
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
      'page_active' => '',
      'pageName' => '',
      'description' => '',
      'acesso' => $this->acesso
    );
  }

  /*
		Configuração da Página Inicial dos Externos
	*/
  public function lista($id_externo)
  {

    $e = new Externos();

    $tipos = [
      1 => 'ajudantes',
      2 => 'jornal',
      3 => 'forum',
      4 => 'professores',
      5 => 'entretenimento',
      6 => 'ouvidoria'
    ];

    $liberados = [
      1, 4, 5, 6
    ];

    if (is_numeric($id_externo) && $e->isMembro($id_externo, $this->acesso->getInfo('id_registro')) && in_array($id_externo, $liberados)) {
      $this->arrayInfo['page_active'] = $tipos[$id_externo];
      $this->arrayInfo['pageName'] = ucfirst($tipos[$id_externo]);
      $this->arrayInfo['minha_info'] = $e->getInfos($this->acesso->getInfo('id_registro'), $id_externo);

      if ($this->acesso->getInfo('patente') <= 6) {
        $this->arrayInfo['minha_info'] = [
          'id_registro' => $this->acesso->getInfo('id_registro'),
          'cargo' => 10,
          'id_externo' => $id_externo,
          'nickname' => $this->acesso->getInfo('nickname')
        ];
      }

      $this->arrayInfo['id_externo'] = $id_externo;
      $this->arrayInfo['membros'] = $e->getMembros($id_externo);


      /* Fara com que a página seja carregada */
      $this->loadTemplate('externos/lista', $this->arrayInfo);
    } else {
      $l = new \Models\Logs();
      $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";      
      $l->addLog('invasao', $msg);
    }
  }

  /*
		Configuração da Página para Adicionar membro dos Externos
	*/
  public function addMembro($id_externo)
  {

    $e = new Externos();

    $tipos = [
      1 => 'ajudantes',
      2 => 'jornal',
      3 => 'forum',
      4 => 'professores',
      5 => 'entretenimento',
      6 => 'ouvidoria'
    ];

    $liberados = [
      1, 4, 5, 6
    ];

    $this->arrayInfo['minha_info'] = $e->getInfos($this->acesso->getInfo('id_registro'), $id_externo);

    if ($this->acesso->getInfo('patente') <= 6) {
      $this->arrayInfo['minha_info'] = [
        'id_registro' => $this->acesso->getInfo('id_registro'),
        'cargo' => 10,
        'id_externo' => $id_externo,
        'nickname' => $this->acesso->getInfo('nickname')
      ];
    }

    if (is_numeric($id_externo) && $e->isMembro($id_externo, $this->acesso->getInfo('id_registro')) && in_array($id_externo, $liberados) && $this->arrayInfo['minha_info']['cargo'] >= 2) {
      $this->arrayInfo['page_active'] = $tipos[$id_externo];
      $this->arrayInfo['pageName'] = ucfirst($tipos[$id_externo]) . ' - Adicionar';
      $this->arrayInfo['id_externo'] = $id_externo;


      /* Fara com que a página seja carregada */
      $this->loadTemplate('externos/addMembro', $this->arrayInfo);
    } else {
      $l = new \Models\Logs();
      $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";      
      $l->addLog('invasao', $msg);
    }
  }

  /*
		Configuração da Página para Adicionar membro dos Externos
	*/
  public function addAction()
  {

    $e = new Externos();
    $r = new Registros();
    $pag = '';
    $_SESSION['externo'] = 'Membro(s) adicionado(s) com sucesso!';
    $_SESSION['externo_tipo'] = 'success';

    if (isset($_POST['nicksnames']) && !empty($_POST['nicksnames']) && isset($_POST['cargo']) && !empty($_POST['cargo']) && isset($_POST['id']) && !empty($_POST['id'])) {
      $nicknames = $_POST['nicksnames'];
      $cargo = intval($_POST['cargo']);
      $id_externo = intval($_POST['id']);

      $pag = 'externo/lista/' . $id_externo;

      $tipos = [
        1 => 'ajudantes',
        2 => 'jornal',
        3 => 'forum',
        4 => 'professores',
        5 => 'entretenimento',
        6 => 'ouvidoria'
      ];

      $liberados = [
        1, 4, 5, 6
      ];

      $this->arrayInfo['minha_info'] = $e->getInfos($this->acesso->getInfo('id_registro'), $id_externo);

      if ($this->acesso->getInfo('patente') <= 6) {
        $this->arrayInfo['minha_info'] = [
          'id_registro' => $this->acesso->getInfo('id_registro'),
          'cargo' => 10,
          'id_externo' => $id_externo,
          'nickname' => $this->acesso->getInfo('nickname')
        ];
      }

      $inexistentes = [];
      if (is_numeric($id_externo) && $e->isMembro($id_externo, $this->acesso->getInfo('id_registro')) && in_array($id_externo, $liberados) && $this->arrayInfo['minha_info']['cargo'] >= 2) {
        foreach ($nicknames as $nickname) {
          $registro = $r->userExiste($nickname);

          if (count($registro) > 0 && count($e->getInfos($registro['id'], $id_externo)) == 0) {
            $e->addMembro($registro['id'], $registro['nickname'], $cargo, $id_externo, $this->acesso->getInfo('nickname'));
          } else {
            $inexistentes[] = $nickname;
          }
        }

        if (count($inexistentes) > 0) {
          $_SESSION['externo'] = 'Os nicknames ' . implode(', ', $inexistentes) . ' não existem ou já são membros deste grupo externo, todos os outros foram adicionados';
          $_SESSION['externo_tipo'] = 'danger';
        }
      } else {
        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";      
        $l->addLog('invasao', $msg);
      }
    } else {
      $_SESSION['externo'] = 'Algum dos campos estavam em branco!';
      $_SESSION['externo_tipo'] = 'danger';
    }



    header("Location: " . BASE . $pag);
    exit;
  }

  /*
		Configuração da Página para Adicionar membro dos Externos
	*/
  public function editar($id_externo, $id)
  {

    $e = new Externos();

    $tipos = [
      1 => 'ajudantes',
      2 => 'jornal',
      3 => 'forum',
      4 => 'professores',
      5 => 'entretenimento',
      6 => 'ouvidoria'
    ];

    $liberados = [
      1, 4, 5, 6
    ];

    $this->arrayInfo['minha_info'] = $e->getInfos($this->acesso->getInfo('id_registro'), $id_externo);

    if ($this->acesso->getInfo('patente') <= 6) {
      $this->arrayInfo['minha_info'] = [
        'id_registro' => $this->acesso->getInfo('id_registro'),
        'cargo' => 10,
        'id_externo' => $id_externo,
        'nickname' => $this->acesso->getInfo('nickname')
      ];
    }

    if (
      is_numeric($id_externo) &&
      is_numeric($id) &&
      $e->isMembro($id_externo, $this->acesso->getInfo('id_registro')) &&
      in_array($id_externo, $liberados) &&
      $this->arrayInfo['minha_info']['cargo'] >= 2 &&
      count($e->getInfosById($id, $id_externo)) > 0
    ) {
      $this->arrayInfo['page_active'] = $tipos[$id_externo];
      $this->arrayInfo['pageName'] = ucfirst($tipos[$id_externo]) . ' - Editar';
      $this->arrayInfo['id_externo'] = $id_externo;
      $this->arrayInfo['info'] = $e->getInfosById($id, $id_externo);


      /* Fara com que a página seja carregada */
      $this->loadTemplate('externos/editMembro', $this->arrayInfo);
    } else {
      $l = new \Models\Logs();
      $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";      
      $l->addLog('invasao', $msg);
    }
  }

  /*
		Configuração da Página para Adicionar membro dos Externos
	*/
  public function editAction()
  {

    $e = new Externos();
    $r = new Registros();
    $pag = '';
    $_SESSION['externo'] = 'Membro editado com sucesso!';
    $_SESSION['externo_tipo'] = 'success';

    if (
      isset($_POST['nickname']) && !empty($_POST['nickname']) &&
      isset($_POST['cargo']) && !empty($_POST['cargo']) &&
      isset($_POST['id']) && !empty($_POST['id']) &&
      isset($_POST['id_externo']) && !empty($_POST['id_externo'])
    ) {
      $nickname = $_POST['nickname'];
      $cargo = intval($_POST['cargo']);
      $id = intval($_POST['id']);
      $id_externo = intval($_POST['id_externo']);

      $pag = 'externo/lista/' . $id_externo;

      $tipos = [
        1 => 'ajudantes',
        2 => 'jornal',
        3 => 'forum',
        4 => 'professores',
        5 => 'entretenimento',
        6 => 'ouvidoria'
      ];

      $liberados = [
        1, 4, 5, 6
      ];

      $this->arrayInfo['minha_info'] = $e->getInfos($this->acesso->getInfo('id_registro'), $id_externo);

      if ($this->acesso->getInfo('patente') <= 6) {
        $this->arrayInfo['minha_info'] = [
          'id_registro' => $this->acesso->getInfo('id_registro'),
          'cargo' => 10,
          'id_externo' => $id_externo,
          'nickname' => $this->acesso->getInfo('nickname')
        ];
      }

      if (
        is_numeric($id_externo) &&
        is_numeric($id) &&
        $e->isMembro($id_externo, $this->acesso->getInfo('id_registro')) &&
        in_array($id_externo, $liberados) &&
        $this->arrayInfo['minha_info']['cargo'] >= 2 &&
        count($e->getInfosById($id, $id_externo)) > 0
      ) {
        $e->updateMembro($id, $nickname, $cargo, $id_externo, $this->acesso->getInfo('nickname'));
      } else {
        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";      
        $l->addLog('invasao', $msg);
      }
    } else {
      $_SESSION['externo'] = 'Algum dos campos estavam em branco!';
      $_SESSION['externo_tipo'] = 'danger';
    }

    header("Location: " . BASE . $pag);
    exit;
  }

  public function deletar($id_externo, $id)
  {
    $e = new Externos();

    $tipos = [
      1 => 'ajudantes',
      2 => 'jornal',
      3 => 'forum',
      4 => 'professores',
      5 => 'entretenimento',
      6 => 'ouvidoria'
    ];

    $liberados = [
      1, 4, 5, 6
    ];

    $_SESSION['externo'] = 'Membro deletado com sucesso!';
    $_SESSION['externo_tipo'] = 'success';
    $pag = '';

    $this->arrayInfo['minha_info'] = $e->getInfos($this->acesso->getInfo('id_registro'), $id_externo);

    if ($this->acesso->getInfo('patente') <= 6) {
      $this->arrayInfo['minha_info'] = [
        'id_registro' => $this->acesso->getInfo('id_registro'),
        'cargo' => 10,
        'id_externo' => $id_externo,
        'nickname' => $this->acesso->getInfo('nickname')
      ];
    }

    $externo_membro = $e->getInfosById($id, $id_externo);

    if (
      is_numeric($id_externo) &&
      is_numeric($id) &&
      $e->isMembro($id_externo, $this->acesso->getInfo('id_registro')) &&
      in_array($id_externo, $liberados) &&
      $this->arrayInfo['minha_info']['cargo'] >= 2 &&
      count($externo_membro) > 0
    ) {
      $e->delMembro($id, $id_externo, $externo_membro['nickname'], $this->acesso->getInfo('nickname'));

      $pag = 'externo/lista/' . $id_externo;
    } else {
      $l = new \Models\Logs();
      $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $this->acesso->getInfo('nickname') . " tentou acessar uma página que não tinha acesso.";      
      $l->addLog('invasao', $msg);
    }

    header("Location: " . BASE . $pag);
    exit;
  }
}
