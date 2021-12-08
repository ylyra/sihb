<?php
namespace Models;

use \Core\Model;

class Textos extends Model {

    public function getTextos()
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM textos");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTexto($id)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT * FROM textos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function atualizarTexto($id, $texto, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE textos SET texto = :texto WHERE id = :id");
        $sql->bindValue(':texto', $texto);
        $sql->bindValue(':id', $id);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " editou o texto com o #ID: ".$id.".";
        $l->addLog('textos_add', $msg);
    }

    public function addTexto($titulo, $local, $texto, $tipo, $ofc_nickname)
    {
        $sql = $this->db->prepare("INSERT INTO textos (titulo, local, texto, tipo) VALUES (:titulo, :local, :texto, :tipo)");
        $sql->bindValue(':titulo', $titulo);
        $sql->bindValue(':local', $local);
        $sql->bindValue(':texto', $texto);
        $sql->bindValue(':tipo', $tipo);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " adicionou um novo texto com o titulo: '".$titulo."'.";
        $l->addLog('textos_add', $msg);
    }	

    public function deletarTexto($id, $ofc_nickname)
    {
        $sql = $this->db->prepare("DELETE FROM textos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $ofc_nickname . " deletou o texto com o #ID: ".$id.".";
        $l->addLog('textos_del', $msg);
    }
}
