<?php

namespace Models;

use \Core\Model;
use \Models\Registros;

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
    private $permissions;

    public function __construct()
    {
        parent::__construct();
    }

    public function isLogged()
    {
        if (isset($_SESSION['sihb_login'])) {
            $id = $_SESSION['sihb_login'];

            $sql = "SELECT *, 
                (select registros.patente_id from registros where registros.id = acesso.id_registro) as patente_id, 
                (select registros.status_id from registros where registros.id = acesso.id_registro) as status_id, 
                (select registros.moedas from registros where registros.id = acesso.id_registro) as moedas, 
                (select registros.vip from registros where registros.id = acesso.id_registro) as vip,
                (select registros.vip_vencimento from registros where registros.id = acesso.id_registro) as vip_data
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

                    $_SESSION['sihb_login'] = $data['id'];

                    if ($this->confirmado == 1) {
                        return true;
                    } elseif ($this->confirmado == 0) {
                        return false;
                    }
                }
            } else {
                unset($_SESSION['sihb_login']);
            }
        }

        return false;
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

    public function verifyUser($nickname, $id_registro, $senha)
    {
        $sql = $this->db->prepare("SELECT * FROM acesso WHERE nickname = :nickname OR id_registro = :id_registro AND senha = :senha");
        $sql->bindValue(":nickname", $nickname);
        $sql->bindValue(":id_registro", $id_registro);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();

            $_SESSION['sihb_login'] = $array['id'];

            return true;
        }

        return false;
    }

    public function deuEntrada($id_registro)
    {
        $sql = $this->db->prepare("SELECT * FROM cartao WHERE id_registro = :id_registro AND inicio >= :inicio AND fim = '0000-00-00 00:00:00'");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':inicio', $this->inicio_dia);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function getCartaoDia($id_registro)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM cartao WHERE id_registro = :id_registro AND inicio >= :inicio AND fim = '0000-00-00 00:00:00'");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':inicio', $this->inicio_dia);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function acessoConfirmarConta($id)
    {
        $sql = $this->db->prepare("UPDATE acesso SET confirmado = 1 WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function updateSenha($senha, $id)
    {
        $sql = $this->db->prepare("UPDATE acesso SET senha = :senha WHERE id = :id");
        $sql->bindValue(':senha', $senha);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function darSaida($id, $fim)
    {
        $sql = $this->db->prepare("UPDATE cartao SET fim = :fim WHERE id = :id");
        $sql->bindValue(':fim', $fim);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function darEntrada($id_registro, $inicio, $tipo)
    {
        $sql = $this->db->prepare("INSERT INTO cartao (id_registro, inicio, tipo) VALUES (:id_registro, :inicio, :tipo)");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':inicio', $inicio);
        $sql->bindValue(':tipo', $tipo);
        $sql->execute();
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

    public function podePromover($patente_id, $minha_patente)
    {
        if ($minha_patente == 10 && $patente_id >= 12) {
            return true;
        } elseif ($minha_patente == 9 && $patente_id >= 11) {
            return true;
        } elseif ($minha_patente == 8 && $patente_id >= 11) {
            return true;
        } elseif ($minha_patente == 7 && $patente_id >= 10) {
            return true;
        } elseif ($minha_patente == 6 && $patente_id >= 10) {
            return true;
        } elseif ($minha_patente == 5 && $patente_id >= 10) {
            return true;
        } elseif ($minha_patente == 4 && $patente_id >= 5) {
            return true;
        } elseif ($minha_patente == 3 && $patente_id >= 3) {
            return true;
        } elseif ($minha_patente == 2 && $patente_id >= 2) {
            return true;
        } elseif ($minha_patente == 1 && $patente_id >= 1) {
            return true;
        }

        return false;
    }

    public function isExterno($externo, $id_registro)
    {
        $sql = $this->db->prepare("SELECT * FROM externos WHERE id_externo = :externo AND id_registro = :id_registro");
        $sql->bindValue(":externo", $externo);
        $sql->bindValue(":id_registro", $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }
        
        $r = new Registros();
        $registro = $r->getMembroByID($id_registro);

        if (intval($registro['patente_id']) <= 6) {
            return true;
        }

        return false;
    }

    public function deleteAcesso($id_registro)
    {
        $sql = $this->db->prepare("DELETE FROM acesso WHERE id_registro = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
    }

    public function deleteCartao($id_registro)
    {
        $sql = $this->db->prepare("DELETE FROM cartao WHERE id_registro = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
    }
}