<?php

namespace Models;

use \Core\Model;
use \Models\Notificacoes;

class Registros extends Model
{

    public function getMembro($nickname)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, (select patentes.nome from patentes where patentes.id = registros.patente_id) as patente, (select status.nome from status where status.id = registros.status_id) as status, (select faixas.slug from faixas where faixas.id = registros.faixa) as faixa_nome FROM registros WHERE nickname LIKE :nickname");
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

    public function getFavoritosUser($id_registro)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, (select registros.nickname from registros where registros.id = perfil_favoritos.id_registro_favorito) as favorito_nickname FROM perfil_favoritos WHERE id_registro = :id_registro ORDER BY id ASC");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getFavoriteiUser($id_registro, $id_registro2)
    {

        $sql = $this->db->prepare("SELECT * FROM perfil_favoritos WHERE id_registro = :id_registro AND id_registro_favorito = :id_favorito");
        $sql->bindValue(':id_registro', $id_registro2);
        $sql->bindValue(':id_favorito', $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function getMensagensPerfil($id_registro, $offset = 0, $limit = 3)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, (select registros.nickname from registros where registros.id = perfil_mensagens.id_registro) as mensagem_nickname FROM perfil_mensagens WHERE id_registro_perfil = :id_registro ORDER BY id ASC LIMIT $offset, $limit");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getMensagensPerfil2($id_registro)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, (select registros.nickname from registros where registros.id = perfil_mensagens.id_registro) as mensagem_nickname FROM perfil_mensagens WHERE id_registro_perfil = :id_registro ORDER BY id ASC");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getMensagemPerfil($id_msg)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, (select registros.nickname from registros where registros.id = perfil_mensagens.id_registro) as mensagem_nickname FROM perfil_mensagens WHERE id = :id_registro");
        $sql->bindValue(':id_registro', $id_msg);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getMensagensPerfilTotal($id_registro)
    {

        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM perfil_mensagens WHERE id_registro_perfil = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
        $sql = $sql->fetch();
        return $sql['c'];
    }

    public function updateFoto($url_foto, $id_registro, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE registros SET avatar = :url_foto WHERE id = :id_registro");
        $sql->bindValue(':url_foto', $url_foto);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " trocou a foto do perfil.";
        $l->addLog('perfil_foto', $msg);
    }

    public function updateFotoForum($url_foto, $id_registro, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE registros SET avatar_forum = :url_foto WHERE id = :id_registro");
        $sql->bindValue(':url_foto', $url_foto);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " atualizou a própria foto do fórum.";

        $l->addLog('forum_foto', $msg);
    }

    public function updateNome($nome, $id_registro, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE registros SET nome = :nome WHERE id = :id_registro");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " alterou o nome dele para " . $nome . ".";
        $l->addLog('perfil_nome', $msg);
    }

    public function updateEmail($email, $id_registro, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE registros SET email = :email WHERE id = :id_registro");
        $sql->bindValue(':email', $email);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " atualizou o e-mail para " . $email . ".";
        $l->addLog('perfil_email', $msg);
    }

    public function updateDescricaoForum($descricao_forum, $id_registro, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE registros SET descricao_forum = :descricao_forum WHERE id = :id_registro");
        $sql->bindValue(':descricao_forum', $descricao_forum);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " alterou a própria descrição no fórum.";
        $l->addLog('forum_descricao', $msg);
    }

    public function addMoedas($id_registro, $valor_moedas)
    {
        $sql = $this->db->prepare("UPDATE registros SET moedas = moedas + (:valor_moedas) WHERE id = :id_registro");
        $sql->bindValue(':valor_moedas', $valor_moedas);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
    }

    public function updateNascimento($nascimento, $id_registro, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE registros SET nascimento = :nascimento WHERE id = :id_registro");
        $sql->bindValue(':nascimento', $nascimento);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " atualizou a data de nascimento para ".(!empty($nascimento))?date('d/m/Y', strtotime($nascimento)):''.".";
        $l->addLog('registro_nascimento', $msg);
    }

    public function favoritarPerfil($tipo, $id_registro_favorito, $id_registro, $nickname)
    {
        // perfil_favoritos WHERE id_registro = :id_registro AND id_registro_favorito = :id_favorito

        $l = new \Models\Logs();
        if ($tipo == 1) {
            $data = date('Y-m-d');
            $sql = $this->db->prepare("INSERT INTO perfil_favoritos (id_registro, id_registro_favorito, data) VALUES (:id_registro, :id_registro_favorito, :data)");
            $sql->bindValue(':id_registro', $id_registro);
            $sql->bindValue(':id_registro_favorito', $id_registro_favorito);
            $sql->bindValue(':data', $data);
            $sql->execute();

            $n = new Notificacoes();
            $msg = "<a href='" . BASE . "profile/" . $nickname . "'>
                <img src='https://i.imgur.com/R2ddtXI.png' alt='estrela' />
                <span>Você foi adicionado aos favoritos</span>
            </a>";
            $n->addNotificacao(2, $msg, $id_registro_favorito);

            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $nickname . " favoritou o usuário com o #ID " . $id_registro_favorito . " .";
            $l->addLog('perfil_fav', $msg);

            return 'Usuário favoritado com sucesso!';
        } elseif ($tipo == 2) {
            $sql = $this->db->prepare("DELETE FROM perfil_favoritos WHERE id_registro = :id_registro AND id_registro_favorito = :id_registro_favorito");
            $sql->bindValue(':id_registro', $id_registro);
            $sql->bindValue(':id_registro_favorito', $id_registro_favorito);
            $sql->execute();

            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $nickname . " desfavoritou o usuário com o #ID " . $id_registro_favorito . " .";
            $l->addLog('perfil_fav', $msg);

            return 'Usuário desfavoritado com sucesso!';
        }
    }

    public function deleteMensagem($id_msg, $ofc_nickname)
    {
        $sql = $this->db->prepare("DELETE FROM perfil_mensagens WHERE id = :id_registro");
        $sql->bindValue(':id_registro', $id_msg);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " deletou uma mensagem do seu perfil.";
        $l->addLog('perfil_msg', $msg);
    }
}
