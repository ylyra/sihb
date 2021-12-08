<?php

namespace Models;

use \Core\Model;

class Acesso extends Model
{

    private $id;
    private $id_registro;
    private $nickname;
    private $confirmado;
    private $patente;
    private $status;
    private $moedas;
    private $vip;
    private $vip_data;
    private $avatar;
    private $permissions;

    public function isLogged()
    {
        if (isset($_SESSION['sihb_login'])) {
            $id = $_SESSION['sihb_login'];

            $sql = "SELECT *, 
                (select registros.patente_id from registros where registros.id = acesso.id_registro) as patente_id, 
                (select registros.status_id from registros where registros.id = acesso.id_registro) as status_id, 
                (select registros.moedas from registros where registros.id = acesso.id_registro) as moedas, 
                (select registros.vip from registros where registros.id = acesso.id_registro) as vip,
                (select registros.vip_vencimento from registros where registros.id = acesso.id_registro) as vip_data,
                (select registros.avatar from registros where registros.id = acesso.id_registro) as avatar
                FROM acesso WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id', $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $data = $sql->fetch();
                $status_permitidos = [
                    1, 4
                ];

                if (in_array($data['status_id'], $status_permitidos)) {
                    $this->id = $data['id'];
                    $this->id_registro = $data['id_registro'];
                    $this->nickname = $data['nickname'];
                    $this->confirmado = $data['confirmado'];
                    $this->patente = $data['patente_id'];
                    $this->status = $data['status_id'];
                    $this->moedas = $data['moedas'];
                    $this->vip = $data['vip'];
                    $this->vip_data = $data['vip_data'];
                    $this->avatar = $data['avatar'];

                    $_SESSION['sihb_login'] = $data['id'];

                    return true;
                }
            } else {
                unset($_SESSION['sihb_login']);
            }
        }

        return false;
    }

    public function temCadastro1($idr)
    {
        $id = 0;
        $sql = $this->db->prepare("SELECT * FROM acesso WHERE id_registro = :id LIMIT 1");
        $sql->bindValue(":id", $idr);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $a = $sql->fetch();

            $id = $a['id'];
        }

        return $id;
    }

    public function temCadastro($id)
    {
        $sql = $this->db->prepare("SELECT * FROM acesso WHERE id_registro = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function verifyUser($nickname, $senha)
    {
        $sql = $this->db->prepare("SELECT * FROM acesso WHERE nickname = :nickname AND senha = :senha");
        $sql->bindValue(":nickname", $nickname);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();

            $_SESSION['sihb_login'] = $array['id'];


            $l = new \Models\Logs();
            $u = new \Models\Uteis();

            $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $array['nickname'] . " efetuou login usando o IP " . $_SERVER['REMOTE_ADDR'] . " (" . $u->geoLocationData($_SERVER['REMOTE_ADDR']) . ") .";
            $l->addLog('login', $msg);

            return true;
        }

        return false;
    }

    public function acessoConfirmarConta($id)
    {
        $sql = $this->db->prepare("UPDATE acesso SET confirmado = 1 WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function updateSenha($senha, $id, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE acesso SET senha = :senha WHERE id = :id");
        $sql->bindValue(':senha', $senha);
        $sql->bindValue(':id', $id);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " atualizou a senha de acesso.";
        $l->addLog('usuario_senha', $msg);
    }

    public function addUser($nickname, $id_registro, $senha)
    {
        $sql = $this->db->prepare("INSERT INTO acesso (id_registro, nickname, senha) VALUES (:id_registro, :nickname, :senha)");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':nickname', $nickname);
        $sql->bindValue(':senha', $senha);
        $sql->execute();
    }

    public function getInfo($info)
    {
        $array = get_object_vars($this);
        return $array[$info];
    }

    public function getNotificacoes($id_registro)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM notificacoes WHERE id_registro = :id_registro ORDER BY id DESC LIMIT 10");
        $sql->bindValue(":id_registro", $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function naoLidaNoti($id_registro)
    {
        $sql = $this->db->prepare("SELECT * FROM notificacoes WHERE id_registro = :id_registro AND view = 0");
        $sql->bindValue(":id_registro", $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function lerNotificacao($id_registro)
    {
        $sql = $this->db->prepare("UPDATE notificacoes SET view = 1 WHERE id_registro = :id_registro AND view = 0");
        $sql->bindValue(":id_registro", $id_registro);
        $sql->execute();
    }
}
