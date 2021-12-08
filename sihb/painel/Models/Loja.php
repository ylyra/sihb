<?php

namespace Models;

use \Core\Model;
use \Models\Registros;

class Loja extends Model
{

    // 1 = emblema
    // 2 = item_hb

    public function getProdutos($tipo)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM loja_prods WHERE tipo = :id ORDER BY id DESC");
        $sql->bindValue(':id', $tipo);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }


        return $array;
    }

    public function getProduto($id, $tipo)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM loja_prods WHERE id = :id AND tipo = :tipo");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':tipo', $tipo);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getCodigos()
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM loja_codigos ORDER BY id DESC");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }


        return $array;
    }

    public function getCodigo($id)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM loja_codigos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getItemsComprados($tipo)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM loja_compras WHERE tipo = :tipo ORDER BY id DESC");
        $sql->bindValue(':tipo', $tipo);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getCompraItem($id)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM loja_compras WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function addItemLoja($tipo, $img, $nome, $valor, $limite, $is_limited, $vip, $ofc_nickname)
    {
        $sql = $this->db->prepare("INSERT INTO loja_prods (tipo, vip, is_limited, limite, nome, valor_anterior, valor, img) VALUES (:tipo, :vip, :is_limited, :limite, :nome, 0, :valor, :img)");
        $sql->bindValue(':tipo', $tipo);
        $sql->bindValue(':vip', $vip);
        $sql->bindValue(':is_limited', $is_limited);
        $sql->bindValue(':limite', $limite);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':img', $img);
        $sql->execute();

        $tipos = [
            1 => 'emblema',
            2 => 'benefício'
        ];

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " adicionou um novo ".$tipos[$tipo].".";
        $l->addLog('loja_add', $msg);
    }

    public function addCodigo($codigo, $valor, $limite, $expiracao, $is_limited, $ofc_nickname)
    {
        $sql = $this->db->prepare("INSERT INTO loja_codigos (codigo, valor, expiracao, limite, is_limited) VALUES (:codigo, :valor, :expiracao, :limite, :is_limited)");
        $sql->bindValue(':codigo', $codigo);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':expiracao', $expiracao);
        $sql->bindValue(':limite', $limite);
        $sql->bindValue(':is_limited', $is_limited);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " adicionou um novo código de sihbcoins.";
        $l->addLog('loja_add', $msg);
    }

    public function editItemLoja($tipo, $img, $nome, $valor_anterior, $valor, $limite, $is_limited, $vip, $id, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE loja_prods SET vip = :vip, is_limited = :is_limited, limite = :limite, nome = :nome, valor_anterior = :valor_anterior, valor = :valor, img = :img WHERE id = :id AND tipo = :tipo");
        $sql->bindValue(':vip', $vip);
        $sql->bindValue(':is_limited', $is_limited);
        $sql->bindValue(':limite', $limite);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':valor_anterior', $valor_anterior);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':img', $img);
        $sql->bindValue(':id', $id);
        $sql->bindValue(':tipo', $tipo);
        $sql->execute();
        
        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " editou o item ".$nome.".";
        $l->addLog('loja_edit', $msg);
    }

    public function editCodigo($codigo, $valor, $limite, $expiracao, $is_limited, $id, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE loja_codigos SET codigo = :codigo, valor = :valor, expiracao = :expiracao, limite = :limite, is_limited = :is_limited WHERE id = :id");
        $sql->bindValue(':codigo', $codigo);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':expiracao', $expiracao);
        $sql->bindValue(':limite', $limite);
        $sql->bindValue(':is_limited', $is_limited);
        $sql->bindValue(':id', $id);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " editou o item ".$codigo.".";
        $l->addLog('loja_edit', $msg);
    }

    public function atualizarStatusCompra($id, $status, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE loja_compras SET status = :status WHERE id = :id");
        $sql->bindValue(':status', $status);
        $sql->bindValue(':id', $id);
        $sql->execute();

        $statuses = [
            1 => 'aceitou',
            2 => 'negou'
        ];
        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " ".$statuses[$status]." a compra de benefício de #ID ".$id.".";
        $l->addLog('loja_transacao', $msg);
    }

    public function delItemLoja($tipo, $id, $ofc_nickname)
    {
        $sql = $this->db->prepare("DELETE FROM loja_prods WHERE id = :id AND tipo = :tipo");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':tipo', $tipo);
        $sql->execute();

        $tipos = [
            1 => 'emblema',
            2 => 'benefício'
        ];
        
        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " deletou um item de tipo ".$tipos[$tipo].".";
        $l->addLog('loja_del', $msg);
    }

    public function delCodigo($id, $ofc_nickname)
    {
        $sql = $this->db->prepare("DELETE FROM loja_codigos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " deletou o código de #ID ".$id.".";
        $l->addLog('loja_del', $msg);
    }

    public function deleteCompras($id_registro)
    {
        $sql = $this->db->prepare("DELETE FROM loja_compras WHERE id_registro = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
    }
}
