<?php

namespace Models;

use \Core\Model;
use \Models\Registros;
use \Models\Notificacoes;

class Loja extends Model
{

    // 1 = emblema
    // 2 = item_hb

    public function getProdutos($offset, $limit, $tipo)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM loja_prods WHERE tipo = :id ORDER BY id DESC LIMIT $offset, $limit");
        $sql->bindValue(':id', $tipo);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }


        return $array;
    }

    public function getEmblemas($id_registro, $limit)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM loja_compras WHERE id_registro = :id_registro AND tipo = 1 ORDER BY id DESC LIMIT $limit");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getItemById($id)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM loja_prods WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function compreiProduto($id_registro, $id_produto)
    {
        $sql = $this->db->prepare("SELECT * FROM loja_compras WHERE id_registro = :id_registro AND id_produto = :id_produto");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':id_produto', $id_produto);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function ultimasCompras($limit)
    {
        $array = [];

        $sql = $this->db->query("SELECT *, (select registros.nickname from registros where registros.id = loja_compras.id_comprador) as nickname_comprador FROM loja_compras ORDER BY id DESC LIMIT $limit");

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function ultimosItens($limit)
    {
        $array = [];

        $sql = $this->db->query("SELECT * FROM loja_prods ORDER BY id DESC LIMIT $limit");

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function verificarCodigo($codigo_moeda)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM loja_codigos WHERE codigo = :codigo_moeda ORDER BY id DESC LIMIT 1");
        $sql->bindValue(':codigo_moeda', $codigo_moeda);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function useiCodigo($id_codigo, $id_registro, $nome)
    {
        $sql = $this->db->prepare("SELECT * FROM loja_cods_confirm WHERE codigo = :codigo_moeda AND id_codigo = :id_codigo AND id_registro = :id_registro");
        $sql->bindValue(':codigo_moeda', $nome);
        $sql->bindValue(':id_codigo', $id_codigo);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function addUseiCodigo($id_codigo, $id_registro, $nome, $valor)
    {
        $sql = $this->db->prepare("INSERT INTO loja_cods_confirm (id_registro, id_codigo, codigo) VALUES (:id_registro, :id_codigo, :codigo)");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':id_codigo', $id_codigo);
        $sql->bindValue(':codigo', $nome);
        $sql->execute();

        $n = new Notificacoes();
        $msg = "<a href='javascript:;'>
            <img src='https://i.imgur.com/8qCqyzQ.png' alt='moeda' />
            <span>Você recebeu +" . $valor . " sihbcoins</span>
        </a>";
        $n->addNotificacao(4, $msg, $id_registro);
    }

    public function updateCodigo($id)
    {
        $sql = $this->db->prepare("UPDATE loja_codigos SET limite = limite - 1 WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function presentearItem($produto, $nickname, $moedas, $id_registro, $ofc_nickname)
    {
        $retorno = 6;
        if (intval($moedas) >= intval($produto['valor'])) {
            $r = new Registros();
            $registro = $r->getMembroByNickname($nickname);

            if (count($registro) > 0) {
                $data = date('Y-m-d H:i:s');

                $sql = $this->db->prepare("INSERT INTO loja_compras (id_registro, id_comprador, id_produto, nickname, data, tipo, img, msg, preco, presente) VALUES (:id_registro, :id_comprador, :id_produto, :nickname, :data, :tipo, :img, :msg, :preco, :presente)");
                $sql->bindValue(':id_registro', $registro['id']);
                $sql->bindValue(':id_comprador', $id_registro);
                $sql->bindValue(':id_produto', $produto['id']);
                $sql->bindValue(':nickname', $registro['nickname']);
                $sql->bindValue(':data', $data);
                $sql->bindValue(':tipo', 1);
                $sql->bindValue(':img', $produto['img']);
                $sql->bindValue(':msg', $produto['nome']);
                $sql->bindValue(':preco', $produto['valor']);
                $sql->bindValue(':presente', 1);
                $sql->execute();

                $retirada = intval($produto['valor']) * -1;
                if ($produto['limite'] >= 1) {
                    $this->reduzirEmblema($produto['id']);
                }
                $r->addMoedas($id_registro, $retirada);
                $retorno = 7;

                $n = new Notificacoes();
                $msg = "<a href='" . BASE . "profile/" . $registro['nickname'] . "'>
                    <img src='https://i.imgur.com/80OPtsi.png' alt='presente' />
                    <span>Você recebeu um presente</span>
                </a>";
                $n->addNotificacao(5, $msg, $registro['id']);

                $l = new \Models\Logs();
                $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " enviou um presente da loja para o(a) " . $registro['nickname'] . " .";
                $l->addLog('loja_presente', $msg);
            }
        }
        return $retorno;
    }

    public function comprarItem($produto, $moedas, $id_registro, $ofc_nickname)
    {
        $retorno = 6;
        if (intval($moedas) >= intval($produto['valor'])) {
            $r = new Registros();
            $registro = $r->getMembroByID($id_registro);

            if (count($registro) > 0) {
                $data = date('Y-m-d H:i:s');

                $sql = $this->db->prepare("INSERT INTO loja_compras (id_registro, id_comprador, id_produto, nickname, data, tipo, img, msg, preco, presente) VALUES (:id_registro, :id_comprador, :id_produto, :nickname, :data, :tipo, :img, :msg, :preco, :presente)");
                $sql->bindValue(':id_registro', $registro['id']);
                $sql->bindValue(':id_comprador', $id_registro);
                $sql->bindValue(':id_produto', $produto['id']);
                $sql->bindValue(':nickname', $registro['nickname']);
                $sql->bindValue(':data', $data);
                $sql->bindValue(':tipo', $produto['tipo']);
                $sql->bindValue(':img', $produto['img']);
                $sql->bindValue(':msg', $produto['nome']);
                $sql->bindValue(':preco', $produto['valor']);
                $sql->bindValue(':presente', 0);
                $sql->execute();

                $retirada = intval($produto['valor']) * -1;
                if ($produto['limite'] >= 1) {
                    $this->reduzirEmblema($produto['id']);
                }
                $r->addMoedas($id_registro, $retirada);
                $retorno = 7;

                $l = new \Models\Logs();
                $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " comprou um item da loja.";
                $l->addLog('loja_compra', $msg);
            }
        }
        return $retorno;
    }

    private function reduzirEmblema($id)
    {
        $sql = $this->db->prepare("UPDATE loja_prods SET limite = limite - 1 WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}
