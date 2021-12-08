<?php

namespace Models;

use \Core\Model;
use \Models\Notificacoes;

class Registros extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getMembro($nickname)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, (select patentes.nome from patentes where patentes.id = registros.patente_id) as patente, (select status.nome from status where status.id = registros.status_id) as status FROM registros WHERE nickname LIKE :nickname");
        $sql->bindValue(':nickname', $nickname . '%');
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getMembroByID($id_registro)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, (select patentes.nome from patentes where patentes.id = registros.patente_id) as patente, (select status.nome from status where status.id = registros.status_id) as status FROM registros WHERE id = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getMembroByNickname($nickname)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, (select patentes.nome from patentes where patentes.id = registros.patente_id) as patente, (select status.nome from status where status.id = registros.status_id) as status FROM registros WHERE nickname = :nickname");
        $sql->bindValue(':nickname', $nickname);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function userExiste($nickname)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM registros WHERE nickname = :nickname");
        $sql->bindValue(':nickname', $nickname);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getIdDe($nickname)
    {
        $id = 1;
        $registro = $this->userExiste($nickname);
        if (count($registro) > 0) {
            $id = $registro['id'];
        }

        return $id;
    }

    public function getRegistros()
    {
        $array = [];

        $sql = "SELECT *, (select patentes.nome from patentes where patentes.id = registros.patente_id) as patente FROM registros ORDER BY patente_id ASC";
        $sql = $this->db->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getRegistrosConfianca()
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, (select patentes.nome from patentes where patentes.id = registros.patente_id) as patente, (select count(*) from confianca_voto where data_voto >= :data1 and data_voto <= :data2) as voto_semana FROM registros WHERE patente_id >= 7 ORDER BY patente_id ASC");
        $sql->bindValue(':data1', $this->inicio_semana);
        $sql->bindValue(':data2', $this->fim_semana);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function totalRegistros()
    {
        $sql = "SELECT COUNT(*) as c FROM registros";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $row = $sql->fetch();
        return $row['c'];
    }

    public function agentesDia($data)
    {
        $sql = "SELECT COUNT(*) as c FROM registros WHERE data_alistamento LIKE :data_alistamento";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':data_alistamento', $data . ' %');
        $sql->execute();
        $row = $sql->fetch();
        return $row['c'];
    }

    public function diferencaAlistados($data, $este_mes)
    {
        $mes_passado =  $this->agentesDia(date('Y-m-d', strtotime('-1 month', strtotime($data))));
        if ($este_mes > 0) {
            return ($este_mes - $mes_passado) * 100 / $este_mes;
        }
        return 0;
    }

    public function getExecutivos()
    {
        $array = [];

        $sql = "SELECT nickname FROM registros WHERE patente_id <= 10 AND status_id = 1 ORDER BY patente_id";
        $sql = $this->db->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getPatentes()
    {
        $array = [];

        $sql = "SELECT id, nome FROM patentes ORDER BY ordem";
        $sql = $this->db->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getVips()
    {
        $array = [];

        $sql = "SELECT nickname, vip, vip_vencimento FROM registros WHERE vip = 1 ORDER BY vip_vencimento";
        $sql = $this->db->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getCartoes($patente_valor)
    {
        $array = [];

        if ($patente_valor == 1) {
            $tipo = '1=1';
        } elseif($patente_valor == 2) {
            $tipo = 'tipo = 1';
        }

        $sql = "SELECT *, (select registros.nickname from registros where registros.id = cartao.id_registro) as nickname FROM cartao WHERE $tipo ORDER BY id DESC";
        $sql = $this->db->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function addMoedas($id_registro, $valor_moedas)
    {
        $sql = $this->db->prepare("UPDATE registros SET moedas = moedas + (:valor_moedas) WHERE id = :id_registro");
        $sql->bindValue(':valor_moedas', $valor_moedas);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if ($valor_moedas >= 1) {
            $n = new Notificacoes();
            $msg = "<a href='javascript:;'>
            <img src='https://i.imgur.com/8qCqyzQ.png' alt='moeda' />
            <span>Você recebeu +" . $valor_moedas . " sihbcoins</span></a>";
            $n->addNotificacao(4, $msg, $id_registro);
        }
    }

    public function addMoedas2($id_registro, $valor_moedas)
    {
        $sql = $this->db->prepare("UPDATE registros SET moedas = moedas + (:valor_moedas) WHERE id = :id_registro");
        $sql->bindValue(':valor_moedas', $valor_moedas);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
    }

    public function atualizarRegistro($responsavel, $nickname, $patente, $status, $ultima_promocao, $id_registro, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE registros SET ultima_promocao = :ultima_promocao, promovido_por = :responsavel, patente_id = :patente, status_id = :status WHERE id = :id_registro");
        $sql->bindValue(':ultima_promocao', $ultima_promocao);
        $sql->bindValue(':responsavel', $responsavel);
        $sql->bindValue(':patente', $patente);
        $sql->bindValue(':status', $status);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
        
        if($patente == 13) {
            $this->atualizarDataAlistamento($id_registro);
        }

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " atualizou o registro " . $nickname . ".";
        $l->addLog('registros_edit', $msg);
    }

    public function addVip($id_registro, $validade)
    {
        $sql = $this->db->prepare("UPDATE registros SET vip = 1, vip_vencimento = :validade WHERE id = :id_registro");
        $sql->bindValue(':validade', $validade);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
    }

    public function addRegistro($promovido_por, $nickname, $patente, $status, $ultima_promocao, $ofc_nickname)
    {
        $data_alistamento = $ultima_promocao;
        
        if($patente == 14) {
            $data_alistamento = '0000-00-00 00:00:00';
        }
        
        $sql = $this->db->prepare("INSERT INTO registros (nickname, data_alistamento, ultima_promocao, promovido_por, patente_id, status_id) VALUES (:nickname, :data_alistamento, :ultima_promocao, :promovido_por, :patente, :status)");
        $sql->bindValue(':nickname', $nickname);
        $sql->bindValue(':data_alistamento', $data_alistamento);
        $sql->bindValue(':ultima_promocao', $ultima_promocao);
        $sql->bindValue(':promovido_por', $promovido_por);
        $sql->bindValue(':patente', $patente);
        $sql->bindValue(':status', $status);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " adicionou um novo registro com o nickname " . $nickname . ".";
        $l->addLog('registros_add', $msg);
    }

    public function confiarRegistro($id_registro, $data_voto, $por, $tipo, $confianca)
    {
        $sql = $this->db->prepare("INSERT INTO confianca_voto (data_voto, por, tipo) VALUES (:data_voto, :por, :tipo)");
        $sql->bindValue(':data_voto', $data_voto);
        $sql->bindValue(':por', $por);
        $sql->bindValue(':tipo', $tipo);
        $sql->execute();

        $sql = $this->db->prepare("UPDATE registros SET confianca = confianca + (:confianca) WHERE id = :id_registro");
        $sql->bindValue(':confianca', $confianca);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
    }

    public function deleteRegistro($id_registro, $ofc_nickname, $nickname)
    {
        $a = new \Models\Acesso();
        $e = new \Models\Externos();
        $l = new \Models\Loja();
        $m = new \Models\MAmigos();
        $n = new \Models\Notificacoes();
        $r = new \Models\Relatorios();

        $a->deleteAcesso($id_registro);
        $a->deleteCartao($id_registro);
        $e->deleteExterno($id_registro);
        $l->deleteCompras($id_registro);
        $m->deleteAmigosDe($id_registro);
        $m->deleteAmigosCom($id_registro);
        $n->deleteNotificacoes($id_registro);
        $r->deleteRelatorios($id_registro);

        $sql = $this->db->prepare("DELETE FROM perfil_favoritos WHERE id_registro = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        $sql = $this->db->prepare("DELETE FROM perfil_favoritos WHERE id_registro_favorito = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        $sql = $this->db->prepare("DELETE FROM perfil_mensagens WHERE id_registro_perfil = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        $sql = $this->db->prepare("DELETE FROM perfil_mensagens WHERE id_registro = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        $sql = $this->db->prepare("DELETE FROM registros WHERE id = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " deletou um registro com o nickname " . $nickname . ".";
        $l->addLog('registros_del', $msg);
    }
    
    private function atualizarDataAlistamento($id_registro) {
        $registro = $this->getMembroByID($id_registro);
        
        if($registro['data_alistamento'] == '0000-00-00 00:00:00') {
            $data_alistamento = date('Y-m-d H:i:s');

            $sql = $this->db->prepare("UPDATE registros SET data_alistamento = :data_alistamento WHERE id = :id_registro");
            $sql->bindValue(':data_alistamento', $data_alistamento);
            $sql->bindValue(':id_registro', $id_registro);
            $sql->execute();
            
        }
    }
}
