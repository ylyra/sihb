<?php
namespace Controllers;

header("Access-Control-Allow-Origin: *");

use \Core\Controller;
use \Models\Registros;
use \Models\Forum;
use \Models\Emblemas;
use Models\Noticias;
use \Models\Uteis;
use \Models\Acesso;
use \Models\Ranking;


class AjaxController extends Controller {

    public function pesquisar() {

        $r = new Registros();
        
		$json = file_get_contents('php://input');
        $obj = json_decode($json);
        $response = get_object_vars($obj);

        if (!empty($response['nickname'])) {
            $registro = $r->getMembro($response['nickname']);
        } else {
            $registro = [];
        }

        
        $this->loadView('ajax/pesquisa', [
            'registro' => $registro
        ]);
    }
    
    public function pesquisar_forum()
    {
        $f = new Forum();
        $u = new Uteis();
        
		$json = file_get_contents('php://input');
        $obj = json_decode($json);
        $response = get_object_vars($obj);

        if (!empty($response['pesquisa'])) {
            $pesquisas = $f->getSimilar($response['pesquisa']);
        } else {
            $pesquisas = [];
        }

        
        $this->loadView('ajax/pesquisa_forum', [
            'pesquisas' => $pesquisas,
            'u' => $u
        ]);
    }

    public function pesquisar_forum_cat()
    {
        $f = new Forum();
        $u = new Uteis();
        
		$json = file_get_contents('php://input');
        $obj = json_decode($json);

        if (empty($obj)) {
            exit;
        }

        $response = get_object_vars($obj);

        if (!empty($response['pesquisa'])) {
            $pesquisas = $f->getByCat($u->trocarItens($response['pesquisa']));
        } else {
            $pesquisas = [];
        }

        
        $this->loadView('ajax/pesquisa_forum', [
            'pesquisas' => $pesquisas,
            'u' => $u
        ]);
    }

    public function forum_msgs()
    {
        $u = new Uteis();
        $f = new Forum();
        $return = array();
        $offset = 0;
        $limit = 4;
        $currentPage = 1;

        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $response = get_object_vars($obj);

        $currentPage = (!empty($response['page'])) ? intval($response['page']) : $currentPage;

        $offset = ($currentPage * $limit) - $limit;
        $return['noticias'] = $f->getByCat($u->trocarItens($response['cat']), $offset, $limit);


        $return['status'] = (!empty($return['noticias'])) ? 1 : 2;
        $return['page'] = (!empty($return['noticias'])) ? $currentPage + 1 : $currentPage;

        echo json_encode($return);
        exit;
    }

    public function buscar_badge()
    {
        $e = new Emblemas();
        
		$json = file_get_contents('php://input');
        $obj = json_decode($json);
        $response = get_object_vars($obj);

        if (!empty($response['id']) && is_numeric($response['id'])) {
            $registro = $e->getBagdeById($response['id']);
        } else {
            $registro = $e->getBagdeById();
        }

        
        $this->loadView('ajax/busca_badge', [
            'badge' => $registro,
            'tipos' => [
                1 => 'aberto',
                2 => 'privado',
                3 => 'fechado'
            ],
            'urls' => [
                1 => 'https://i.imgur.com/FrPQ2Sq.png',
                2 => 'https://i.imgur.com/4HvJus0.png',
                3 => 'https://i.imgur.com/59YkcL5.png'
            ]
        ]);
    }

    public function votar_noticia()
    {

        $n = new Noticias();
        $acesso = new Acesso();

        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $response = get_object_vars($obj);

        if (is_numeric($response['id_noticia']) && is_numeric($response['quantidade']) && $acesso->isLogged() && $acesso->getInfo('confirmado') == 1) {
            $id_notocia = intval($response['id_noticia']);
            $quantidade = intval($response['quantidade']);
            $n->votarNoticia($id_notocia, $quantidade, $acesso->getInfo('id_registro'), $acesso->getInfo('nickname'));
        }
    }

    public function curtir_comentario()
    {

        $n = new Noticias();
        $acesso = new Acesso();

        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $response = get_object_vars($obj);

        if (
            $acesso->isLogged()
            && is_numeric($response['id_comentario']) 
            && is_numeric($response['id_registro']) 
            && is_numeric($response['tipo']) 
            && is_numeric($response['id_noticia']) 
            && intval($response['id_registro']) == $acesso->getInfo('id_registro') 
            && $acesso->getInfo('confirmado') == 1) 
        {

            $id_comentario = intval($response['id_comentario']);
            $id_registro = intval($response['id_registro']);
            $tipo = intval($response['tipo']);
            $id_noticia = intval($response['id_noticia']);

            $n->votarComentario($id_comentario, $id_registro, $tipo, $id_noticia, $acesso->getInfo('nickname'));
        } else {
        }
    }

    public function pesquisar_ranking()
    {
        $u = new Uteis();
        $r = new Registros();
        $ranking = new Ranking();

        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $response = get_object_vars($obj);

        if (
            isset($response['pesquisa'])
            && !empty($response['pesquisa'])
            ) 
        {
            $pesquisa = addslashes($u->trocarItens($response['pesquisa']));
            $user = $r->getMembro($pesquisa);
            $pesquisas = [];
            
            if (count($user) > 0) {
                $pesquisas = $ranking->getRankingById(5, $user['id']);
            }

            $this->loadView('ajax/pesquisa_ranking', [
                'meugeral' => $pesquisas,
                'u' => $u
            ]);
        }
    }

    public function marcaLidaNotificacoes()
    {
        $acesso = new Acesso();

        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $response = get_object_vars($obj);

        if ($acesso->isLogged()) {
            $acesso->lerNotificacao($acesso->getInfo('id_registro'));            
        }
    }

}
